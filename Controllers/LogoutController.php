<?php


class LogoutController extends Controller
{
    public function __construct()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: '.base_url().'/login');
    }
}