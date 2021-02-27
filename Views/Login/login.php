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
    <title><?= $data['title']; ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/all.min.css">
    <!-- SweetAlert2 css-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/sweetalert2.min.css">
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1><?= $data['page_name']; ?></h1>
    </div>
    <div class="login-box">
        <form class="login-form" id="formLogin" name="formLogin">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>
            <div class="form-group">
                <label class="control-label">CORREO</label>
                <input class="form-control" type="text" placeholder="Correo" id="login_correo" name="correo" autofocus>
            </div>
            <div class="form-group">
                <label class="control-label">CONTRASEÑA</label>
                <input class="form-control" type="password" placeholder="Contraseña" id="login_contrasena" name="contrasena">
            </div>
            <div class="form-group">
                <div class="utility">
                </div>
            </div>
            <div id="alert_login" class="text-center"></div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> INICIAR SESIÓN</button>
            </div>
        </form>
    </div>
</section>
<script>
    const base_url = '<?= base_url(); ?>';
</script>
<!-- Essential javascripts for application to work-->
<script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?= media(); ?>/js/popper.min.js"></script>
<script src="<?= media(); ?>/js/bootstrap.min.js"></script>
<script src="<?= media(); ?>/js/main.js"></script>
<script src="<?= media(); ?>/js/functions.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
<!-- SweetAlert2-->
<script src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>
<script src="<?= media(); ?>/js/<?= $data['functions_js']; ?>"></script>
</body>
</html>