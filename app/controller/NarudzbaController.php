<?php

class NarudzbaController extends AutorizacijaController
{

    private $viewDir = 'privatno' . DIRECTORY_SEPARATOR . 'narudzbe' . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }

    public function test($sto)
    {
        switch($sto){
            case 'dodaj':
                Narudzba::create([
                'ime'=>'Hrvoje',
                'prezime'=>'Furi',
                'ulica'=>'Drinska ulica',
                'kucniBroj'=>79,
                'grad'=>'Osijek',
                'postanskiBroj'=>31000,
                'email'=>'hrvoje.furi@gmail.com',
                'iznos'=>529,99,
                'datumNarudzbe'=>'2021-08-03 20:40:32',
                'nacinPlacanja'=>'pouzeće',
                'dostavnaSluzba'=>'Overeseas Express',
                'datumDostave'=>'2021-08-06 09:40:32',
                'isporuceno'=>0
                ]);
                break;
               
             case 'promijeni':
                Narudzba::update([
                'sifra'=>6,
                'ime'=>'Tamara',
                'prezime'=>'Šolaja',
                'ulica'=>'Drinska ulica',
                'kucniBroj'=>79,
                'grad'=>'Osijek',
                'postanskiBroj'=>31000,
                'email'=>'hrvoje.furi@gmail.com',
                'iznos'=>529,99,
                'datumNarudzbe'=>'2021-08-03 20:40:32',
                'nacinPlacanja'=>'pouzeće',
                'dostavnaSluzba'=>'HP Express',
                'datumDostave'=>'2021-08-06 09:40:32',
                'isporuceno'=>0
                ]);
                break;

            case 'obrisi':
                Narudzba::delete(6);
        }
    }
}