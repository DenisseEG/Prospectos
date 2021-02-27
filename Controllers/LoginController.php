<?php


class LoginController extends Controller
{
    public function __construct()
    {
        session_start();
        if(isset($_SESSION['login'])){
            header('Location: '.base_url().'/dashboard');
        }
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Login';
        $data['page_title'] = 'Login';
        $data['page_name'] = 'ConCrédito';
        $data['functions_js'] = "functions_login.js";
        $this->view->getView($this, 'login', $data);
    }

    public function login()
    {
        //pretty_print($_POST);
        $correo = $_POST['correo'];
        $contrasena = hash('SHA256', $_POST['contrasena']);
        $request = $this->model->loginUser($correo, $contrasena);

        if(empty($request)){
            $response = [
                'status' => 422,
                'title' => 'Error',
                'text' => 'El correo o la contraseña es incorrecto'
            ];
        }else{
            if($request['estatus'] == 1){
                $_SESSION['id_user'] = $request['id_usuario'];
                $_SESSION['login'] = true;

                $_SESSION['user_data'] = $this->model->sessionLogin($_SESSION['id_user']);

                $response = [
                    'status' => 200,
                    'title' => 'Bienvenido',
                    'text' => ''
                ];

            }else{
                $response = [
                    'status' => 422,
                    'title' => 'Error',
                    'text' => 'El usuario se encuentra inactivo'
                ];
            }
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
}