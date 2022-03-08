<?php

class Predlozak
{

    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        SQL SELECT za promjenu
        
        ');
        $izraz->execute(['parametar'=>$kljuc]);
        return $izraz->fetch();
    }

    // CRUD

    // R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        SQL SELECT lista za index
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    // C - Create
    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        SQL INSERT
        
        ');
        $izraz->execute($parametri);
    }
    

    // U - Update

    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        SQL UPDATE
        
        ');
        $izraz->execute($parametri);
    }

    // D - Delete
    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        SQL DELETE
        
        ');
        $izraz->execute(['sifra'=>$sifra]);
    }
}