<?php

require_once('Config/config.php');
require_once('Helpers/Helpers.php');

$url = $_GET['url'] ?? 'dashboard';
$arrayUrl = explode('/', $url);
$controller = $arrayUrl[0].'Controller';
$method = $arrayUrl[1] ?? 'index';
$params = '';

if(isset($arrayUrl[2]) && $arrayUrl[2] != ''){
    $arrayParams = array_slice($arrayUrl, 2);
    $params = implode(',', $arrayParams);
}

require_once('Libraries/Core/Autoload.php');
require_once('Libraries/Core/Load.php');

