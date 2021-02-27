<?php


class View
{
    function getView($controller, $view, $data=''){
        $controller = str_replace('Controller', '', get_class($controller));
        if($controller == 'Home'){
            $view = 'Views/'.$view.'.php';
        }else{
            $view = 'Views/'.$controller.'/'.$view.'.php';
        }
        require_once($view);
    }
}
