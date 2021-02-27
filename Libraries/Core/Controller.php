<?php


class Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->loadModel();
    }

    public function loadModel()
    {
        $model = str_replace('Controller', '', get_class($this));
        $routeClass = 'Models/'.$model.'.php';
        if(file_exists($routeClass)){
            require_once($routeClass);
            $this->model = new $model;
        }
    }
}