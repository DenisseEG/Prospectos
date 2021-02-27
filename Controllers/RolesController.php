<?php


class RolesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login'])){
            header('Location: '.base_url().'/login');
        }
        getPermissions(1);
    }

    public function index()
    {
        if(empty($_SESSION['permisos_modulo']['leer'])){
            header('Location: '.base_url().'/dashboard');
        }
        $data['title'] = 'Roles de usuario';
        $data['page_title'] = 'Roles de usuario';
        $data['page_name'] = 'rol_usuario';
        $data['functions_js'] = "functions_roles.js";
        $this->view->getView($this, 'roles', $data);
    }

    public function showAll()
    {
        $data = $this->model->getRoles();

        foreach($data as &$datum){
            $btn_view = '';
            $btn_edit = '';
            $btn_delete = '';

            if($datum['estatus'] == 1){
                $datum['estatus'] = '<span class="badge badge-success">Activo</span>';
            }else{
                $datum['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
            }

            if($_SESSION['permisos_modulo']['leer']){
                $btn_view = '<button class="btn btn-secondary btn-sm" title="Permisos" type="button" onclick="roleActions(\'permissions\', '.$datum['id_rol'].')">
                    <i class="fas fa-key"></i>
                </button>';
            }

            if($_SESSION['permisos_modulo']['actualizar']){
                $btn_edit = '<button class="btn btn-info btn-sm" title="Editar" type="button" onclick="roleActions(\'edit\','.$datum['id_rol'].')">
                    <i class="fas fa-pencil-alt"></i>
                </button>';
            }

            if($_SESSION['permisos_modulo']['eliminar']){
                $btn_delete = '<button class="btn btn-danger btn-sm" title="Eliminar" type="button" onclick="roleActions(\'delete\', '.$datum['id_rol'].')">
                    <i class="fas fa-trash-alt"></i>
                </button>';
            }

            $datum['opciones'] = '<div class="text-center">'.$btn_view.' '.$btn_edit.' '.$btn_delete.'</div>';
        }

        unset($datum);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getRoles(){
        $options = '';
        $data = $this->model->getRolesUser();

        if($data){
            foreach($data as &$datum){
                $options .= '<option value="'.$datum['id_rol'].'">'.$datum['nombre'].'</option>';
            }
        }
        unset($datum);
        echo $options;
        die();
    }

    public function showOne(int $id_rol)
    {
        $data = $this->model->getRole($id_rol);

        if(empty($data)){
            $response = [
                'status' => 404,
                'title' => 'No encontrado',
                'text' => 'El rol no se encontro en el registro, se actualizará la tabla'
            ];
        }else{
            $response = [
                'status' => 200,
                'data' => $data
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function create()
    {
        $rol = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $estatus = intval($_POST['estatus']);
        $request = $this->model->insertRole($rol, $descripcion, $estatus);

        if($request == 1){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El rol se ha creado exitosamente'
            ];
        }else if($request === 'duplicate'){
            $response = [
                'status' => 422,
                'title' => 'Registro duplicado',
                'text' => 'El rol ingresado ya existe'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo crear el rol, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function update(int $id_rol)
    {

        $rol = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $estatus = intval($_POST['estatus']);
        $request = $this->model->updateRole($id_rol, $rol, $descripcion, $estatus);

        if($request['request'] == 1 && $request['msg'] == 'success'){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El rol se ha actualizado exitosamente'
            ];
        }else if($request['request'] == 1 && $request['msg'] == 'exist'){
            $response = [
                'status' => 200,
                'rol' => 'exist',
                'title' => 'Rol asociado',
                'text' => 'No es posible inactivar un rol asociado a usuarios, los demás datos se han actualizado exitosamente'
            ];
        }else if($request['msg'] == 'duplicate'){
            $response = [
                'status' => 422,
                'title' => 'Registro duplicado',
                'text' => 'El rol ingresado ya existe'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo actualizar el rol, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete(int $id_rol)
    {
        $request = $this->model->deleteRole($id_rol);

        if($request === 'ok'){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El rol se ha eliminado exitosamente'
            ];
        }else if($request === 'exist'){
            $response = [
                'status' => 422,
                'title' => 'Rol asociado',
                'text' => 'No es posible eliminar un rol asociado a usuarios'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo eliminar el rol, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();

    }
}