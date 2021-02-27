<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="Aplicación web prospectos" content="aplicación web prospectos">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Denisse Enríquez">
    <meta name="theme-color" content="#009688">
    <link rel="icon" href="<?= media(); ?>/images/favicon.png">
    <title>Página no encontrada</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/all.min.css">

</head>
<body>

    <div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle"></i> Error 404: Página no encontrada</h1>
        <p><a class="btn btn-primary" href="javascript:window.history.back();">Regresar</a></p>
    </div>

<!-- Essential javascripts for application to work-->
<script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?= media(); ?>/js/popper.min.js"></script>
<script src="<?= media(); ?>/js/bootstrap.min.js"></script>
<script src="<?= media(); ?>/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?= media(); ?>/js/plugins/pace.min.js"></script>

</body>
</html>