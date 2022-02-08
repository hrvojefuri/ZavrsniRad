<?php

class App
{
    public static function start()
    {
        // echo '<pre>';
        // print_r($_SERVER);
        // echo '</pre>';
        $ruta = Request::getRuta();
        echo $ruta;
    }
}