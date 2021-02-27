<?php


class UsuariosController extends Controller
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
        $data['title'] = 'Usuario';
        $data['page_title'] = 'Usuario';
        $data['page_name'] = 'usuario';
        $data['functions_js'] = "functions_users.js";
        $this->view->getView($this, 'usuarios', $data);
    }

    public function showAll()
    {
        $data = $this->model->getUsers();

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
                $btn_view = '<button class="btn btn-secondary btn-sm" title="Ver" type="button" onclick="userActions(\'view\', '.$datum['id_usuario'].')">
                    <i class="far fa-eye"></i>
                </button>';
            }

            if($_SESSION['permisos_modulo']['actualizar']){
                $btn_edit = '<button class="btn btn-info btn-sm" title="Editar" type="button" onclick="userActions(\'edit\','.$datum['id_usuario'].')">
                    <i class="fas fa-pencil-alt"></i>
                </button>';
            }

            if($_SESSION['permisos_modulo']['eliminar']){
                $btn_delete = '<button class="btn btn-danger btn-sm" title="Eliminar" type="button" onclick="userActions(\'delete\', '.$datum['id_usuario'].')">
                    <i class="fas fa-trash-alt"></i>
                </button>';
            }

            $datum['opciones'] = '<div class="text-center">'.$btn_view.' '.$btn_edit.' '.$btn_delete.'</div>';
        }

        unset($datum);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function showOne(int $id_usuario)
    {
        $data = $this->model->getUser($id_usuario);

        if(empty($data)){
            $response = [
                'status' => 404,
                'title' => 'No encontrado',
                'text' => 'El usuario no se encontro en el registro, se actualizará la tabla'
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
        $rol_id = intval($_POST['rol_id']);
        $nombre = $_POST['nombre'];
        $apll_paterno = $_POST['apll_paterno'];
        $apll_materno = $_POST['apll_materno'];
        $correo = $_POST['correo'];
        $contrasena = hash('SHA256', $_POST['contrasena']);
        $estatus = intval($_POST['estatus']);

        $request = $this->model->insertUser($rol_id, $nombre, $apll_paterno, $apll_materno, $correo, $contrasena, $estatus);

        if($request == 1){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El usuario se ha creado exitosamente'
            ];
        }else if($request === 'duplicate'){
            $response = [
                'status' => 422,
                'title' => 'Registro duplicado',
                'text' => 'El correo ingresado ya existe'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo crear el usuario, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function update(int $id_usuario)
    {

        $rol_id = intval($_POST['rol_id']);
        $nombre = $_POST['nombre'];
        $apll_paterno = $_POST['apll_paterno'];
        $apll_materno = $_POST['apll_materno'];
        $correo = $_POST['correo'];
        $contrasena = empty($_POST['contrasena']) ? '' : hash('SHA256', $_POST['contrasena']);
        $estatus = intval($_POST['estatus']);

        $request = $this->model->updateUser($id_usuario, $rol_id, $nombre, $apll_paterno, $apll_materno, $correo, $contrasena, $estatus);

        if($request == 1){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El usuario se ha actualizado exitosamente'
            ];
        }else if($request === 'duplicate'){
            $response = [
                'status' => 422,
                'title' => 'Registro duplicado',
                'text' => 'El correo ingresado ya existe'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo actualizar el usuario, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete(int $id_usaurio)
    {
        $request = $this->model->deleteUser($id_usaurio);

        if($request === 'ok'){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El usuario se ha eliminado exitosamente'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo eliminar el usuario, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();

    }
}