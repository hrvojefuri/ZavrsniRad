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
    zanr            varchar(50) not null,
    izvodac         varchar(50) not null,
    naziv           varchar(50) not null,
    cijena          decimal(18,2) not null,
    izdavackaKuca   varchar(50) not null,
    zaliha          int not null
);


alter table narudzba add foreign key (kupac) references kupac(sifra);

alter table kosarica add foreign key (narudzba) references narudzba(sifra);
alter table kosarica add foreign key (proizvod) references proizvod(sifra);


# inserti u tablicu operater 17_02_2022

insert into operater(email,lozinka,ime,prezime,uloga) values
# lozinka a
('admin@edunova.hr','$2a$12$Q5OY9RlK.2P6P7ek37PJiO3oqJxwVpdBT2tDPvHFGm/F0j5Q5Erwu','Administrator','Edunova','admin'),
# lozinka o
('oper@edunova.hr','$2a$12$9f.L/1fyhBOq1XFaiMSTHuyvhbb8o09romnSaK0DODz7250hhfGi2','Operater','Edunova','oper');


# inserti u tablice 27_11_2021 (ispravljeno 22_02_2022)

# inserti u tablicu proizvod

insert into proizvod (sifra,zanr,izvodac,naziv,cijena,izdavackaKuca,zaliha) values
(null,'Heavy Metal','Iron Maiden','Brave New World',129.99,'Metal Blade Records',100),
(null,'Heavy Metal','Iron Maiden','Powerslave',149.99,'Metal Blade Records',100),
(null,'Heavy Metal','Judas Priest','Sad Wings Of Destiny',189.99,'Roadrunner Records',100),
(null,'Heavy Metal','Judas Priest','Brittish Steel',209.99,'Roadrunner Records',100),
(null,'Heavy Metal','Black Sabbath','Black Sabbath',139.99,'Metal Blade Records',100),
(null,'Heavy Metal','Black Sabbath','Heaven and Hell',159.99,'Metal Blade Records',100),
(null,'Heavy Metal','Motorhead','Inferno',179.99,'Roadrunner Records',100),
(null,'Heavy Metal','Motorhead','Bomber',149.99,'Roadrunner Records',100),
(null,'Power Metal','Blind Guardian','Imaginations from the Other Side',129.99,'Metal Blade Records',100),
(null,'Power Metal','Blind Guardian','Battalions of Fear',179.99,'Metal Blade Records',100),
(null,'Power Metal','Helloween','The Dark Ride',119.99,'Roadrunner Records',100),
(null,'Power Metal','Helloween','Better than Raw',139.99,'Roadrunner Records',100),
(null,'Power Metal','Gamma Ray','Power Metal',179.99,'Nuclear Blast Records',100),
(null,'Power Metal','Gamma Ray','No World Order',139.99,'Nuclear Blast Records',100),
(null,'Power Metal','Manowar','Gods of War',209.99,'Metal Blade Records',100),
(null,'Power Metal','Manowar','Battle Hymns',199.99,'Metal Blade Records',100),
(null,'Thrash Metal','Metallica','Kill ''em All',189.99,'Megaforce Records',100),
(null,'Thrash Metal','Metallica','Ride the Lightning',169.99,'Megaforce Records',100),
(null,'Thrash Metal','Megadeth','Rust in Peace',159.99,'Roadrunner Records',100),
(null,'Thrash Metal','Megadeth','Peace Sells... But Who''s Buying?',119.99,'Roadrunner Records',100),
(null,'Thrash Metal','Slayer','Seasons in the Abyss',139.99,'Nuclear Blast Records',100),
(null,'Thrash Metal','Slayer','Show no Mercy',129.99,'Nuclear Blast Records',100),
(null,'Thrash Metal','Anthrax','Among the Living',159.99,'Metal Blade Records',100),
(null,'Thrash Metal','Anthrax','Spreading the Disease',199.99,'Metal Blade Records',100),
(null,'Death Metal','Morbid Angel','Blessed are the Sick',159.99,'Roadrunner Records',100),
(null,'Death Metal','Morbid Angel','Formulas Fatal to the Flesh',149.99,'Roadrunner Records',100),
(null,'Death Metal','Entombed','Left Hand Path',169.99,'Nuclear Blast Records',100),
(null,'Death Metal','Entombed','Clandestine',139.99,'Nuclear Blast Records',100),
(null,'Death Metal','Suffocation','As Grace Descends',149.99,'Megaforce Records',100),
(null,'Death Metal','Suffocation','Suffocation',119.99,'Megaforce Records',100),
(null,'Death Metal','Obituary','The Erosion of Sanity',129.99,'Metal Blade Records',100),
(null,'Death Metal','Obituary','Cause of Death',139.99,'Metal Blade Records',100);

# inserti u tablicu kupac

insert into kupac (sifra,ime,prezime,ulica,kucniBroj,grad,postanskiBroj,email) values
(null,'Dinko','Dinčević','Osječka ulica','6','Dubrovnik','40000','dinko.dincevic@gmail.com'),
(null,'Marija','Maras','Zagrebačka ulica','24','Osijek','31000','marija.maras@gmail.com'),
(null,'Ivan','Ivčević','Dubrovačka ulica','139','Zagreb','10000','ivan.ivcevic@gmail.com');

# inserti u tablicu narudzba

insert into narudzba (sifra,kupac,iznos,datumNarudzbe,nacinPlacanja,dostavnaSluzba,datumDostave,isporuceno) values
(null,1,509.97,'2021-11-03','Pouzeće','Overseas Express','2021-11-08',1),
(null,2,289.98,'2021-11-25','Visa Classic','GLS','2021-11-29',0),
(null,3,129.99,'2021-11-15','Diners','HP Express','2021-11-16',1);

# inserti u tablicu kosarica

insert into kosarica (sifra,narudzba,proizvod,kolicina,cijena) values
# kupac 1
(null,1,3,1,189.99),
(null,1,5,1,139.99),
(null,1,7,1,179.99),
# kupac 2
(null,2,22,1,159.99),
(null,2,30,1,129.99),
# kupac 3
(null,3,9,1,129.99);