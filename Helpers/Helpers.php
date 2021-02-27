<?php

function base_url()
{
    return sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
    );
}

function media()
{
    return base_url().'/assets';
}

function headerTemplate($data='')
{
    require_once('Views/Template/header.php');
}

function footerTemplate($data='')
{
    require_once('Views/Template/footer.php');
}

function getModal(string $nameModal, $data)
{
    require_once("Views/Template/Modals/{$nameModal}.php");
}

function getPermissions(int $id_modulo)
{
    require_once('Models/Permisos.php');
    $obj_permissions = new Permisos();
    $id_rol = $_SESSION['user_data']['rol_id'];
    $array_permissions = $obj_permissions->modulePermissions($id_rol);
    $permissions = '';
    $permissions_module = '';

    if(count($array_permissions) > 0){
        $permissions = $array_permissions;
        $permissions_module = $array_permissions[$id_modulo] ?? '' ;
    }

    $_SESSION['permisos'] = $permissions;
    $_SESSION['permisos_modulo'] = $permissions_module;
}

function pretty_print($array)
{
    $format = print_r('<pre>');
    $format .= print_r($array);
    $format .= print_r('</pre>');
    return $format;
}
