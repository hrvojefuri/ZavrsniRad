<?php

if($_SERVER['SERVER_ADDR']==='127.0.0.1'){
    $url = 'http://furiousvortex.xyz/';
    $dev = true;
    $baza = [
        'server'=>'localhost',
        'baza'=>'furiousvortex',
        'korisnik'=>'edunova',
        'lozinka'=>'edunova'
    ];
}else{
    $url = 'https://www.polaznik31.edunova.hr/';
    $dev = false;
    $baza = [
        'server'=>'localhost',
        'baza'=>'bront_furiousvortex',
        'korisnik'=>'bront_korisnik',
        'lozinka'=>'n4nNCTFeY}N?'
    ];
}

return [
    'dev'=>true,
    'url'=>$url,
    'naslovApp'=>'FuriousVortex',
    'baza'=>$baza
];