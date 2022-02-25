<?php

class Proizvod
{
    // CRUD

    // R - Read
    public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select a.sifra, a.zanr, a.izvodac, a.naziv, a.cijena, a.izdavackaKuca, a.zaliha,
        count(b.sifra) as kosarica
        from proizvod a left join kosarica b
        on a.sifra=b.proizvod
        group by a.sifra, a.zanr, a.izvodac, a.naziv, a.cijena, a.izdavackaKuca, a.zaliha;
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    // C - Create

    

    // U - Update

    // D - Delete
}