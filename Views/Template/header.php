<!DOCTYPE html>
<html lang="en">
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
<body class="app sidebar-mini">
<header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>/dashboard">ConCrédito</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!-- User Menu-->
        <a class="app-nav__item" href="<?= base_url(); ?>/logout" title="Logout">
            <i class="fas fa-sign-out-alt fa-lg"></i>
        </a>
    </ul>
</header>
<?php require_once('navbar.php'); ?>