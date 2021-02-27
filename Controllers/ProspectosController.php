<?php


class ProspectosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login'])){
            header('Location: '.base_url().'/login');
        }
        getPermissions(2);
    }

    public function index()
    {
        if(empty($_SESSION['permisos_modulo']['leer'])){
            header('Location: '.base_url().'/dashboard');
        }
        $data['title'] = 'Prospectos';
        $data['page_title'] = 'Prospectos';
        $data['page_name'] = 'prospectos';
        $data['functions_js'] = "functions_clients.js";
        $this->view->getView($this, 'prospectos', $data);
    }

    public function showAll()
    {
        $data = $this->model->getClients();
        foreach($data as &$datum){
            $approve_disabled = '';
            $reject_disabled = '';
            $btn_view = '';
            $btn_edit = '';
            $btn_delete = '';
            $btn_approve = '';
            $btn_reject = '';

            if($datum['estatus_prospecto'] == 'Enviado'){
                $datum['estatus_prospecto'] = '<span class="badge badge-info">Enviado</span>';
            }else if($datum['estatus_prospecto'] == 'Autorizado'){
                $datum['estatus_prospecto'] = '<span class="badge badge-success">Autorizado</span>';
                $approve_disabled = 'disabled';
                $reject_disabled = 'disabled';
            }else if($datum['estatus_prospecto'] == 'Rechazado'){
                $datum['estatus_prospecto'] = '<span class="badge badge-danger">Rechazado</span>';
                $approve_disabled = 'disabled';
                $reject_disabled = 'disabled';
            }

            if($_SESSION['permisos_modulo']['leer']){
                $btn_view = '<button class="btn btn-secondary btn-sm" title="Ver" type="button" onclick="clientActions(\'view\', '.$datum['id_prospecto'].')">
                    <i class="far fa-eye"></i>
                </button>';
            }

            if($_SESSION['permisos_modulo']['actualizar']){
                $btn_edit = '<button class="btn btn-info btn-sm" title="Editar" type="button" onclick="clientActions(\'edit\','.$datum['id_prospecto'].')">
                    <i class="fas fa-pencil-alt"></i>
                </button>';
            }

            if($_SESSION['permisos_modulo']['eliminar']){
                $btn_delete = '<button class="btn btn-danger btn-sm" title="Eliminar" type="button" onclick="clientActions(\'delete\', '.$datum['id_prospecto'].')">
                    <i class="fas fa-trash-alt"></i>
                </button>';
            }

            if($_SESSION['permisos_modulo']['evaluar']){
                $btn_approve = '<button class="btn btn-success btn-sm" title="Autorizar" type="button" onclick="clientActions(\'approve\', '.$datum['id_prospecto'].')" '.$approve_disabled.'>
                    <i class="fas fa-check"></i>
                </button>';
                $btn_reject = '<button class="btn btn-danger btn-sm" title="Rechazar" type="button" onclick="clientActions(\'reject\', '.$datum['id_prospecto'].')" '.$reject_disabled.'>
                    <i class="fas fa-times"></i>
                </button>';
            }

            $datum['opciones'] = '<div class="text-center">'.$btn_view.' '.$btn_edit.' '.$btn_delete.' '.$btn_approve.' '.$btn_reject.'</div>';
        }

        unset($datum);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function showOne(int $id_prospecto)
    {
        $data = $this->model->getClient($id_prospecto);

        if(empty($data)){
            $response = [
                'status' => 404,
                'title' => 'No encontrado',
                'text' => 'El prospecto no se encontro en el registro, se actualizará la tabla'
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
        $usuario_id = intval($_SESSION['user_data']['id_usuario']);
        $nombre = $_POST['nombre'];
        $apll_paterno = $_POST['apll_paterno'];
        $apll_materno = $_POST['apll_materno'];
        $calle = $_POST['calle'];
        $numero = intval($_POST['numero']);
        $colonia = $_POST['colonia'];
        $codigo_postal = intval($_POST['codigo_postal']);
        $telefono = intval($_POST['telefono']);
        $rfc = $_POST['rfc'];

        $request = $this->model->insertClient($usuario_id, $nombre, $apll_paterno, $apll_materno, $calle, $numero, $colonia, $codigo_postal, $telefono, $rfc);

        if($request == 1){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El prospecto se ha creado exitosamente'
            ];
        }else if($request === 'duplicate'){
            $response = [
                'status' => 422,
                'title' => 'Registro duplicado',
                'text' => 'El RFC ingresado ya existe'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo crear el prospecto, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function update(int $id_prospecto)
    {
        $nombre = $_POST['nombre'];
        $apll_paterno = $_POST['apll_paterno'];
        $apll_materno = $_POST['apll_materno'];
        $calle = $_POST['calle'];
        $numero = intval($_POST['numero']);
        $colonia = $_POST['colonia'];
        $codigo_postal = intval($_POST['codigo_postal']);
        $telefono = intval($_POST['telefono']);
        $rfc = $_POST['rfc'];
        $estatus_prospecto = $_POST['estatus_prospecto'];

        if($estatus_prospecto == 'Autorizado'){
            $response = [
                'status' => 422,
                'title' => 'Estatus Autorizado',
                'text' => 'El prospecto esta autorizado, no se puede actualizar'
            ];
        }else{
            $request = $this->model->updateClient($id_prospecto, $nombre, $apll_paterno, $apll_materno, $calle, $numero, $colonia, $codigo_postal, $telefono, $rfc);

            if($request == 1){
                $response = [
                    'status' => 200,
                    'title' => 'Éxito',
                    'text' => 'El prospecto se ha actualizado exitosamente'
                ];
            }else if($request === 'duplicate'){
                $response = [
                    'status' => 422,
                    'title' => 'Registro duplicado',
                    'text' => 'El RFC ingresado ya existe'
                ];
            }else{
                $response = [
                    'status' => 500,
                    'title' => 'Error',
                    'text' => 'No se pudo actualizar el prospecto, por favor intente de nuevo'
                ];
            }
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete(int $id_prospecto)
    {
        $request = $this->model->deleteClient($id_prospecto);

        if($request === 'ok'){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El prospecto se ha eliminado exitosamente'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo eliminar el prospecto, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function approve(int $id_prospecto)
    {
        $request = $this->model->approveClient($id_prospecto);

        if($request === 'ok'){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El prospecto se ha autorizado exitosamente'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo autorizado el prospecto, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function reject(int $id_prospecto)
    {
        $observaciones = $_POST['observaciones'];
        $request = $this->model->rejectClient($id_prospecto, $observaciones);

        if($request === 'ok'){
            $response = [
                'status' => 200,
                'title' => 'Éxito',
                'text' => 'El prospecto se ha rechazado exitosamente'
            ];
        }else{
            $response = [
                'status' => 500,
                'title' => 'Error',
                'text' => 'No se pudo rechazado el prospecto, por favor intente de nuevo'
            ];
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function getCountStatus()
    {

        $array_status = [
            'enviados' => 0,
            'autorizados' => 0,
            'rechazados' => 0
        ];
        $request = $this->model->countStatus();

        if(count($request) > 0){
            foreach($request as &$data){
                if($data['estatus_prospecto'] == 'Enviado'){
                    $array_status['enviados'] = intval($data['total']);

                }else if($data['estatus_prospecto'] == 'Autorizado'){
                    $array_status['autorizados'] = intval($data['total']);

                }else if($data['estatus_prospecto'] == 'Rechazado'){
                    $array_status['rechazados'] = intval($data['total']);
                }
            }
        }

        echo json_encode($array_status, JSON_UNESCAPED_UNICODE);
        die();
    }
}