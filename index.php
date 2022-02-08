<?php

//prikaz grešaka i upozorenja

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();

define('BP', __DIR__ . DIRECTORY_SEPARATOR);
define('BP_APP', __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR);

// test
// echo BP;


// putanje za učitavanje PHP klasa

$putanje = implode(
    PATH_SEPARATOR,
    [
        BP_APP . 'model',
        BP_APP . 'controller',
        BP_APP . 'core'
    ]
);

// test
// echo $putanje;

set_include_path($putanje);

spl_autoload_register(function($klasa){
    $putanje = explode(PATH_SEPARATOR,get_include_path());
    foreach($putanje as $p){
        $datoteka = $p . DIRECTORY_SEPARATOR . $klasa . '.php';
        if(file_exists($datoteka)){
            include_once $datoteka;
            break;
        }
    }
    // echo $klasa;
    // echo '<pre>';
    // print_r($putanje);
    // echo '</pre>';
});


App::start();