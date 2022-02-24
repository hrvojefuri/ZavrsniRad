<?php

class ProizvodController extends AutorizacijaController
{

    private $viewDir = 'privatno' . DIRECTORY_SEPARATOR . 'proizvodi' . DIRECTORY_SEPARATOR;

    public function index()
    {
        // print_r(Proizvod::read());
        $this->view->render($this->viewDir . 'index',[
            'proizvodi'=>Proizvod::read()
        ]);
    }
}