drop database if exists furiousvortex;
create database furiousvortex character set utf8mb4;

# c:\xampp\mysql\bin -uedunova -pedunova --default_character_set=utf8 < C:\Users\hrvoj\Desktop\PP24\ZavrsniRad\furiousvortex.sql


use furiousvortex;

create table operater (
    sifra       int not null primary key auto_increment,
    email       varchar(50) not null,
    lozinka     char(60) not null,
    ime         varchar(50) not null,
    prezime     varchar(50) not null,
    uloga       varchar(10) not null
);

create table kupac (
    sifra           int not null primary key auto_increment,
    ime             varchar(50) not null,
    prezime         varchar(50) not null,
    ulica           varchar(50) not null,
    kucniBroj       varchar(5) not null,
    grad            varchar(50) not null,
    postanskiBroj   char(5) not null,
    email           varchar(50)
);

create table narudzba (
    sifra           int not null primary key auto_increment,
    kupac           int not null,
    iznos           decimal(18,2) not null,
    datumNarudzbe   datetime not null,
    nacinPlacanja   varchar(50) not null,
    dostavnaSluzba  varchar(50) not null,
    datumDostave    datetime,
    isporuceno      boolean
);

create table kosarica (
    sifra       int not null primary key auto_increment,
    narudzba    int not null,
    proizvod    int not null,
    kolicina    int not null,
    cijena      decimal(18,2) not null
);

create table proizvod (
    sifra           int not null primary key auto_increment,
    zanr            int not null,
    izvodac         int not null,
    naziv           varchar(50) not null,
    cijena          decimal(18,2) not null,
    izdavackaKuca   varchar(50) not null,
    zaliha          int not null
);

create table izvodac (
    sifra   int not null primary key auto_increment,
    naziv   varchar(50) not null,
    web     varchar(255)
);

create table zanr (
    sifra   int not null primary key auto_increment,
    naziv   varchar(50) not null
);

alter table narudzba add foreign key (kupac) references kupac(sifra);

alter table kosarica add foreign key (narudzba) references narudzba(sifra);
alter table kosarica add foreign key (proizvod) references proizvod(sifra);

alter table proizvod add foreign key (zanr) references zanr(sifra);
alter table proizvod add foreign key (izvodac) references izvodac(sifra);


# inserti u tablicu operater 17_02_2022

insert into operater(email,lozinka,ime,prezime,uloga) values
# lozinka a
('admin@edunova.hr','$2a$12$Q5OY9RlK.2P6P7ek37PJiO3oqJxwVpdBT2tDPvHFGm/F0j5Q5Erwu','Administrator','Edunova','admin'),
# lozinka o
('oper@edunova.hr','$2a$12$9f.L/1fyhBOq1XFaiMSTHuyvhbb8o09romnSaK0DODz7250hhfGi2','Operater','Edunova','oper');


# inserti u tablice 23_11_2021

# 1-4
insert into zanr (sifra,naziv) values
(null,'Heavy Metal'),
(null,'Power Metal'),
(null,'Thrash Metal'),
(null,'Death Metal');

# 1-4
insert into izvodac (sifra,naziv,web) values
(null,'Iron Maiden','https://www.ironmaiden.com/'),
(null,'Judas Priest','https://www.judaspriest.com/'),
(null,'Black Sabbath','https://www.blacksabbath.com/'),
(null,'Motorhead','https://imotorhead.com/'),
# 5-8
(null,'Blind Guardian','https://www.blind-guardian.com/'),
(null,'Helloween','https://www.helloween.org/'),
(null,'Gamma Ray','https://www.gammaray.org/en/'),
(null,'Manowar','https://manowar.com/'),
# 9-12
(null,'Metallica','https://www.metallica.com/'),
(null,'Megadeth','https://megadeth.com/'),
(null,'Slayer','https://www.slayer.net/'),
(null,'Anthrax','https://www.anthrax.com/'),
# 13-16
(null,'Morbid Angel','http://www.morbidangel.com/'),
(null,'Entombed','https://www.entombedad.com/'),
(null,'Suffocation','https://www.suffocationofficial.com/'),
(null,'Obituary','https://www.obituary.cc/');

# inserti u tablice 27_11_2021

# inserti u tablicu proizvod

insert into proizvod (sifra,zanr,izvodac,naziv,cijena,izdavackaKuca,zaliha) values
(null,1,1,'Brave New World',149.99,'Metal Blade Records',100),
(null,1,1,'Powerslave',149.99,'Metal Blade Records',100),
(null,1,2,'Sad Wings Of Destiny',149.99,'Roadrunner Records',100),
(null,1,2,'Brittish Steel',149.99,'Roadrunner Records',100),
(null,1,3,'Black Sabbath',149.99,'Metal Blade Records',100),
(null,1,3,'Heaven and Hell',149.99,'Metal Blade Records',100),
(null,1,4,'Inferno',149.99,'Roadrunner Records',100),
(null,1,4,'Bomber',149.99,'Roadrunner Records',100),
(null,2,5,'Imaginations from the Other Side',149.99,'Metal Blade Records',100),
(null,2,5,'Battalions of Fear',149.99,'Metal Blade Records',100),
(null,2,6,'The Dark Ride',149.99,'Roadrunner Records',100),
(null,2,6,'Better than Raw',149.99,'Roadrunner Records',100),
(null,2,7,'Power Metal',149.99,'Nuclear Blast Records',100),
(null,2,7,'No World Order',149.99,'Nuclear Blast Records',100),
(null,2,8,'Gods of War',149.99,'Metal Blade Records',100),
(null,2,8,'Battle Hymns',149.99,'Metal Blade Records',100),
(null,3,9,'Kill ''em All',149.99,'Megaforce Records',100),
(null,3,9,'Ride the Lightning',149.99,'Megaforce Records',100),
(null,3,10,'Rust in Peace',149.99,'Roadrunner Records',100),
(null,3,10,'Peace Sells... But Who''s Buying?',149.99,'Roadrunner Records',100),
(null,3,11,'Seasons in the Abyss',149.99,'Nuclear Blast Records',100),
(null,3,11,'Show no Mercy',149.99,'Nuclear Blast Records',100),
(null,3,12,'Among the Living',149.99,'Metal Blade Records',100),
(null,3,12,'Spreading the Disease',149.99,'Metal Blade Records',100),
(null,4,13,'Blessed are the Sick',149.99,'Roadrunner Records',100),
(null,4,13,'Formulas Fatal to the Flesh',149.99,'Roadrunner Records',100),
(null,4,14,'Left Hand Path',149.99,'Nuclear Blast Records',100),
(null,4,14,'Clandestine',149.99,'Nuclear Blast Records',100),
(null,4,15,'As Grace Descends',149.99,'Megaforce Records',100),
(null,4,15,'Suffocation',149.99,'Megaforce Records',100),
(null,4,16,'The Erosion of Sanity',149.99,'Metal Blade Records',100),
(null,4,16,'Cause of Death',149.99,'Metal Blade Records',100);

# inserti u tablicu kupac

insert into kupac (sifra,ime,prezime,ulica,kucniBroj,grad,postanskiBroj,email) values
(null,'Dinko','Dinčević','Osječka ulica','6','Dubrovnik','40000','dinko.dincevic@gmail.com'),
(null,'Marija','Maras','Zagrebačka ulica','24','Osijek','31000','marija.maras@gmail.com'),
(null,'Ivan','Ivčević','Dubrovačka ulica','139','Zagreb','10000','ivan.ivcevic@gmail.com');

# inserti u tablicu narudzba

insert into narudzba (sifra,kupac,iznos,datumNarudzbe,nacinPlacanja,dostavnaSluzba,datumDostave,isporuceno) values
(null,1,449.97,'2021-11-03','Pouzeće','Overseas Express','2021-11-08',1),
(null,2,299.98,'2021-11-25','Visa Classic','GLS','2021-11-29',0),
(null,3,149.99,'2021-11-15','Diners','HP Express','2021-11-16',1);

# inserti u tablicu kosarica

insert into kosarica (sifra,narudzba,proizvod,kolicina,cijena) values
# kupac 1
(null,1,3,1,149.99),
(null,1,5,1,149.99),
(null,1,7,1,149.99),
# kupac 2
(null,2,22,1,149.99),
(null,2,30,1,149.99),
# kupac 3
(null,3,9,1,149.99);