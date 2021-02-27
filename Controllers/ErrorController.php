<?php


class ErrorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
        $data['title'] = 'Página no encontrada';
        $this->view->getView($this, 'Error');
    }
}

$notFound = new ErrorController();
$notFound->notFound();