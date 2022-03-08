<?php

class Narudzba
{

    public static function readOne($kljuc)
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
        select a.sifra, b.ime, b.prezime, b.ulica, b.kucniBroj, b.grad, b.postanskiBroj, b.email, a.iznos, a.datumNarudzbe, 
        a.nacinPlacanja, a.dostavnaSluzba, a.datumDostave, a.isporuceno
        from narudzba a inner join kupac b on
        a.kupac = b.sifra
        where a.sifra=:parametar;
        
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
        
        select a.sifra, b.ime, b.prezime, b.ulica, b.kucniBroj, b.grad, b.postanskiBroj, b.email, a.iznos, a.datumNarudzbe, 
        a.nacinPlacanja, a.dostavnaSluzba, a.datumDostave, a.isporuceno
        from narudzba a inner join kupac b on
        a.kupac = b.sifra
        where isporuceno is true;
        order by 3,2;
        
        ');
        $izraz->execute();
        return $izraz->fetchAll();
    }

    // C - Create
    public static function create($parametri)
    {
        $veza = DB::getInstanca();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        
        insert into kupac (ime, prezime, ulica, kucniBroj, grad, postanskiBroj, email) values
        (:ime, :prezime, :ulica, :kucniBroj, :grad, :postanskiBroj, :email)
        
        ');
        $izraz->execute([
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'ulica'=>$parametri['ulica'],
            'kucniBroj'=>$parametri['kucniBroj'],
            'grad'=>$parametri['grad'],
            'postanskiBroj'=>$parametri['postanskiBroj'],
            'email'=>$parametri['email']
        ]);

        $zadnjaSifra = $veza->lastInsertId();

        $izraz = $veza->prepare('
        
        insert into narudzba (kupac, iznos, datumNarudzbe, nacinPlacanja, dostavnaSluzba, datumDostave, isporuceno) values
        (:kupac, :iznos, :datumNarudzbe, :nacinPlacanja, :dostavnaSluzba, :datumDostave, :isporuceno)
        
        ');
        $izraz->execute([
            'kupac'=>$zadnjaSifra,
            'iznos'=>$parametri['iznos'],
            'datumNarudzbe'=>$parametri['datumNarudzbe'],
            'nacinPlacanja'=>$parametri['nacinPlacanja'],
            'dostavnaSluzba'=>$parametri['dostavnaSluzba'],
            'datumDostave'=>$parametri['datumDostave'],
            'isporuceno'=>$parametri['isporuceno']
        ]);

        $veza->commit();
    }
    

    // U - Update

    // Notice: Undefined index: sifra in C:\Users\hrvoj\Desktop\PP24\ZavrsniRad\app\model\Narudzba.php on line 101

    // Notice: Undefined index: sifra in C:\Users\hrvoj\Desktop\PP24\ZavrsniRad\app\model\Narudzba.php on line 143

    public static function update($parametri)
    {
        $veza = DB::getInstanca();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        
        select kupac from narudzba where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$parametri['sifra']
        ]);

        $sifraKupac = $izraz->fetchColumn();

        $izraz = $veza->prepare('
        
        update kupac set
        ime=:ime,
        prezime=:prezime,
        ulica=:ulica,
        kucniBroj=:kucniBroj,
        grad=:grad,
        postanskiBroj=:postanskiBroj,
        email=:email
        where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifraKupac,
            'ime'=>$parametri['ime'],
            'prezime'=>$parametri['prezime'],
            'ulica'=>$parametri['ulica'],
            'kucniBroj'=>$parametri['kucniBroj'],
            'grad'=>$parametri['grad'],
            'postanskiBroj'=>$parametri['postanskiBroj'],
            'email'=>$parametri['email']
        ]);

        $izraz = $veza->prepare('
        
        update narudzba set
        iznos=:iznos,
        datumNarudzbe=:datumNarudzbe,
        nacinPlacanja=:nacinPlacanja,
        dostavnaSluzba=:dostavnaSluzba,
        datumDostave=:datumDostave,
        isporuceno=:isporuceno
        where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$parametri['sifra'],
            'iznos'=>$parametri['iznos'],
            'datumNarudzbe'=>$parametri['datumNarudzbe'],
            'nacinPlacanja'=>$parametri['nacinPlacanja'],
            'dostavnaSluzba'=>$parametri['dostavnaSluzba'],
            'datumDostave'=>$parametri['datumDostave'],
            'isporuceno'=>$parametri['isporuceno']
        ]);

        $veza->commit();
    }

    // D - Delete
    public static function delete($sifra)
    {
        $veza = DB::getInstanca();
        $veza->beginTransaction();
        $izraz = $veza->prepare('
        
        delete from narudzba where sifra=:sifra
        
        ');
        $izraz->execute([
            'sifra'=>$sifra
        ]);

        $veza->commit();
    }
}