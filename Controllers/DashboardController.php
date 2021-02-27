<?php


class DashboardController extends Controller
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
        $data['title'] = 'Dashboard';
        $data['page_title'] = 'Dashboard';
        $data['page_name'] = 'dashboard';
        $data['functions_js'] = "functions_dashboard.js";
        $this->view->getView($this, 'dashboard', $data);
    }
}