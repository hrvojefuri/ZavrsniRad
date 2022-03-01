<?php

class App
{
    public static function start()
    {
        // echo '<pre>';
        // print_r($_SERVER);
        // echo '</pre>';
        $ruta = Request::getRuta();
        // echo $ruta;

        $dijelovi = explode('/',$ruta);

        // echo '<pre>';
        // print_r($dijelovi);
        // echo '</pre>';

        $klasa = '';
        if(!isset($dijelovi[1]) || $dijelovi[1]===''){
            $klasa = 'Index';
        }else{
            $klasa = ucfirst($dijelovi[1]);
        }
        $klasa .= 'Controller';
        // echo $klasa;

        $metoda = '';
        if(!isset($dijelovi[2]) || $dijelovi[2]===''){
            $metoda = 'index';
        }else{
            $metoda = $dijelovi[2];
        }

        $parametar = '';
        if(!isset($dijelovi[3]) || $dijelovi[3]===''){
            $parametar = null;
        }else{
            $parametar = $dijelovi[3];
        }
        
        // echo $klasa . '->' . $metoda . '()';

        if(class_exists($klasa) && method_exists($klasa,$metoda)){
            // klasa i metoda postoje, instancirati klasu i pozvati metodu
            $instanca = new $klasa();
            if($parametar==null){
                $instanca->$metoda();    
            }else{
                $instanca->$metoda($parametar);
            }            
        }else{
            // metoda na klasi ne postoji, obavijestiti korisnika
            $view = new View();
            $view->render('error404',[
                'onoceganema'=>$klasa . '->' . $metoda
            ]);
            // echo $klasa . '->' . $metoda . '() ne postoji';
        }

        //$kontroler = new IndexController();
        //$kontroler->index();

    }

    public static function config($kljuc)
    {
        $config = include BP_APP . 'konfiguracija.php';
        return $config[$kljuc];
    }

    public static function autoriziran()
    {
        if(isset($_SESSION) && isset($_SESSION['autoriziran'])){
            return true;
        }

        return false;
    }
}