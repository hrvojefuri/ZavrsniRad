<?php

class ProizvodController extends AutorizacijaController
{

    private $viewDir = 'privatno' . DIRECTORY_SEPARATOR . 'proizvodi' . DIRECTORY_SEPARATOR;

    private $nf;

    private $poruka;

    private $proizvod;

    public function __construct()
    {
        parent::__construct();
        $this->nf=new \NumberFormatter("hr-HR", \NumberFormatter::DECIMAL);
        $this->nf->setPattern('#,##0.00 kn');
        $this->proizvod=new stdClass();
        $this->proizvod->zanr='';
        $this->proizvod->izvodac='';
        $this->proizvod->naziv='';
        $this->proizvod->cijena='';
        $this->proizvod->izdavackaKuca='';
        $this->proizvod->zaliha='';
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

    public function novi()
    {
        $this->view->render($this->viewDir . 'novi',[
            'poruka'=>'',
            'proizvod'=>$this->proizvod
        ]);
    }

    public function dodajNovi()
    {
        // prostor za kontrole
        $this->proizvod=(object)$_POST;

        if($this->kontrolaNaziv()
        && $this->kontrolaIzvodac()
        && $this->kontrolaCijena()){
            Proizvod::create($_POST);
            $this->index();
        }else{
            $this->view->render($this->viewDir . 'novi',[
                'poruka'=>$this->poruka,
                'proizvod'=>$this->proizvod
            ]);
        }        
    }

    private function kontrolaNaziv()
    {
        if(strlen($this->proizvod->naziv)===0){
            $this->poruka='Obavezan unos naziva';
            return false;
        }
        if(strlen($this->proizvod->naziv)>50){
            $this->poruka='Naziv ne smije biti duži od 50 znakova';
            return false;
        }        
        return true;
    }

    private function kontrolaIzvodac()
    {
        if(strlen($this->proizvod->izvodac)===0){
            $this->poruka='Obavezan unos izvođača';
            return false;
        }
        if(strlen($this->proizvod->izvodac)>50){
            $this->poruka='Naziv izvođača ne smije biti duži od 50 znakova';
            return false;
        }        
        return true;
    }
    
    private function kontrolaCijena()
    {
        if(strlen(trim($this->proizvod->cijena))>0){
            $broj = (float) trim($this->proizvod->cijena);
            if($broj<=0){
                $this->poruka='Cijena mora biti decimalni broj veći od 0, unijeli ste: ' . $this->proizvod->cijena;
                $this->proizvod->cijena='';
                return false;
            }
        }

        return true;
    }

    public function brisanje($sifra)
    {
        Proizvod::delete($sifra);
        $this->index();
    }
}