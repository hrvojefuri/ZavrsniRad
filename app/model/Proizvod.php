<?php

class Proizvod
{
    // CRUD

    // R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from proizvod;
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    // C - Create

    

    // U - Update

    // D - Delete
}