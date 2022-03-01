<?php

class ProizvodController extends AutorizacijaController
{

    private $viewDir = 'privatno' . DIRECTORY_SEPARATOR . 'proizvodi' . DIRECTORY_SEPARATOR;

    private $nf;

    public function __construct()
    {
        parent::__construct();
        $this->nf=new \NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        $this->nf->setPattern('#,##0.00 kn');
    }

    public function index()
    {
        $proizvodi = Proizvod::read();

        foreach($proizvodi as $proizvod){
            $proizvod->cijena=$this->nf->format($proizvod->cijena);            
        }
        
        $this->view->render($this->viewDir . 'index',[
            'proizvodi'=>$proizvodi,
            'css'=>'<link rel="stylesheet" href="' . App::config('url') . 'public/css/proizvodindex.css">'
        ]);
    }

    public function brisanje($sifra)
    {
        Proizvod::delete($sifra);
        $this->index();
    }
}