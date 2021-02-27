<?php


class PermisosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login'])){
            header('Location: '.base_url().'/login');
        }
    }

    public function show(int $id_rol)
    {
        $request_modules = $this->model->getModules();
        $request_permissions = $this->model->getPermissions($id_rol);

        foreach($request_modules as &$module){
            $module['permisos'] = [
                'leer' => 0,
                'escribir' => 0,
                'actualizar' => 0,
                'eliminar' => 0,
                'evaluar' => 0,
            ];

            if($request_permissions){
                foreach($request_permissions as &$permission){
                    if($module['id_modulo'] == $permission['modulo_id']){
                        $module['permisos'] = [
                            'leer' => $permission['leer'],
                            'escribir' => $permission['escribir'],
                            'actualizar' => $permission['actualizar'],
                            'eliminar' => $permission['eliminar'],
                            'evaluar' => $permission['evaluar'],
                        ];
                    }
                }
                unset($permission);
            }
        }
        unset($module);
        getModal('modalPermisos', $request_modules);
        die();
    }

    public function setPermissions()
    {

        if($_POST){
            $rol_id =  intval($_POST['rol_id']);
            $modulos = $_POST['modulos'];
            $request_delete = $this->model->deletePermissions($rol_id);

            if($request_delete == 1){
                foreach($modulos as $modulo){
                    $modulo_id = $modulo['modulo_id'];
                    $leer = $modulo['leer'] ?? 0;
                    $escribir = $modulo['escribir'] ?? 0;
                    $actualizar = $modulo['actualizar'] ?? 0;
                    $eliminar = $modulo['eliminar'] ?? 0;
                    $evaluar = $modulo['evaluar'] ?? 0;

                    $request_insert = $this->model->insertPermissions($rol_id, $modulo_id, $leer, $escribir, $actualizar, $eliminar, $evaluar);
                }

                if($request_insert == 1){
                    $response = [
                        'status' => 200,
                        'title' => 'Éxito',
                        'text' => 'Los permisos se asignaron correctamente'
                    ];
                }else{
                    $response = [
                        'status' => 500,
                        'title' => 'Error',
                        'text' => 'No fue posible asignar los permisos, por favor intente de nuevo'
                    ];
                }
            }else{
                $response = [
                    'status' => 500,
                    'title' => 'Error',
                    'text' => 'No fue posible asignar los permisos, por favor intente de nuevo'
                ];
            }
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}