# Prevzemna mesta Econt na blagajni (BG)

Kupec na blagajni izbere med **офис на еконт** in **доставка до дома**, po
vzoru vigoshop.bg. Pri prevzemnem mestu izbere pisarno ali Еконтомат iz
iskalnega seznama, polja naslova se skrijejo, naslov naročila pa se napolni z
naslovom prevzemnega mesta.

## 0. Stikalo (najprej to)

`functions/econt-stikalo.php` — ena vrstica:

```php
$noriks_econt_stikalo = array( 'devbg.noriks.com' );   // samo dev
// true  = povsod
// false = nikjer
```

Ko je izklopljeno, se `econt.php` **sploh ne naloži**: način dostave se ne
registrira, blagajna je natanko taka kot prej (samo dostava na naslov).

> **Past:** PHP vrhnje funkcije prevede tudi, če datoteka prej naredi `return`,
> zato so konstante **nad** stikalom. Ne premikaj jih pod stikalo — klic iz
> `form-checkout.php` bi podrl blagajno.

## 1. Vklop v WooCommerce

WooCommerce → Dostava → cona **BG** → Dodaj način dostave →
**Еконт — офиси и автомати**.

| polje | privzeto |
|---|---|
| Име (MetaKocka) | `Офис на Еконт` |
| Цена (€) | 2.99 |
| Безплатно над (€) | 70 |

Ime mora biti enako tistemu, ki ga preslikaš v Metakocki.

## 2. Metakocka

Dokumentacija: freshdesk **3000106381** (Econt — prilagoditev košarice) in
**3000117556** (Integracija Econt Express).

**Metakocko je treba vnaprej obvestiti** — na računu morajo vklopiti dodatno
funkcionalnost za več vrst dostave. Brez tega preslikava ne dela.

Vrsta dostave gre v meto naročila `Econt_Shipping_To`:

| izbira kupca | `Econt_Shipping_To` | dodatna polja |
|---|---|---|
| pisarna Econt | `OFFICE` | `Econt_Office_Town`, `Econt_Office`, `Econt_Office_Postcode` |
| Еконтомат | `Machine` | `Econt_Machine_Town`, `Econt_Machine`, `Econt_Machine_Postcode` |
| na naslov | `DOOR` | `Econt_Door_Town`, `_Postcode`, `_Street`, `_street_num`, `_building_num`, `_Entrance_num`, `_Floor_num`, `_Apartment_num` |

V `Econt_Office` / `Econt_Machine` pošiljamo **šifro pisarne** (stolpec `code`
iz Econtovega šifranta, npr. `1127`). Metakockina dokumentacija oblike vrednosti
ne navaja — to je edino, kar je vredno potrditi pri njihovi podpori, ko bodo
vklapljali funkcionalnost.

Blok, vhod, nadstropje in stanovanje (`building_num`, `Entrance_num`,
`Floor_num`, `Apartment_num`) pošiljamo prazna — teh polj naša blagajna nima.
vigoshop.bg jih ima (бл./вх./ет./ап.); če jih bomo hoteli, se dodajo v
`checkout_mods.php` in napolnijo v `noriks_econt_meta_mk()`.

Preslikava v Metakocki (»Preberi dostavne službe«) bere **oznake razredov**
načinov dostave, ne naslovov posameznih primerkov — naš se tam pokaže kot
**`Еконт — офиси и автомати`**.

## 3. Podatki o pisarnah

`data/econt-ofisi.tsv`, **639 prevzemnih mest** v 212 krajih (569 pisarn,
47 Еконтоматов, 23 mobilnih pisarn).

Vir: javni Econt Nomenclatures API, brez ključa:

```bash
curl -s -X POST -H "Content-Type: application/json" -d '{"countryCode":"BGR"}' \
  https://ee.econt.com/services/Nomenclatures/NomenclaturesService.getOffices.json \
  -o offices.json
python3 data/econt-pretvori.py offices.json data/econt-ofisi.tsv
```

Stolpci: `koda · naziv · naslov · vrsta · delovni čas · lat · lon · ulica ·
poštna · kraj · iskalno`. Zadnji stolpec je polje za iskanje (male črke,
dodana latinična preslikava, da kupec lahko tipka »sofia« ali »София«).
Datoteka je urejena po poštni številki, zato je na vrhu Sofija.

Iskanje teče na strežniku: `GET /wp-json/noriks/v1/econt?q=…`. Brez poizvedbe
vrne prvih 150 mest (kupec jih vidi takoj, brez tipkanja).

> Econtova mreža avtomatov je v resnici večja od 47 — javni šifrant jih toliko
> objavi. Ob vsakem ponovnem zagonu skripte se seznam osveži.

## 4. Plačljiv vtičnik Econt je ugasnjen

`wp-content/mu-plugins/noriks-econt-vticnik-ugasnjen.php` prepreči nalaganje
vtičnika **Доставка с Еконт Експрес**. Vtičnik se v dostavni coni ne uporablja,
brez licence pa ob vsakem nalaganju administracije javlja
»Няма активен лиценз«. Mora biti mu-plugin, ker WordPress vtičnike naloži
pred temo.

Nazaj se prižge z brisanjem te datoteke.

## 5. Pasti (vse ugotovljene z meritvijo na CZ/PL)

1. Skripta mora v **nogo** in **počakati na `jQuery.fn.selectWoo`** —
   WooCommerce ga nalaga z `defer`, sicer izbirnik pade na rezervno polje.
2. Skripta blagajne po nalaganju **prestavi vse `.form-row` na konec ovoja**;
   naše bloke je treba po tem postaviti nazaj (in ob `updated_checkout`).
3. `<p>` ne sme vsebovati `<ul>`/`<table>` — brskalnik ga razbije.
4. CSS kartic je **že v temi** (`css/vendor/parcel-pickup-hr-*.css`,
   `extra-shipping-method-buttons-*.css`); podvajanje mu nasprotuje. Tu samo
   poenotimo višino, sredinjenje in logotip.
5. Mere polj **naših** obrazcev: 60 px višine, 18 px pisave, obroba 1,5 px
   `#c9c9c9`, zaobljenost 4 px.
6. Tema ima **lastno preverjanje hišne številke** — pri prevzemnem mestu ga
   preskočimo (`checkout_mods.php`), skrita polja pa napolnimo z naslovom
   pisarne (hišna številka `BB`), da preverjanje v brskalniku ne zastane.
7. Ta različica WooCommerca pri `update_order_review` bere način dostave samo
   iz vrhnjega polja zahteve, **ne iz `post_data`** — izbiro iz obrazca
   uveljavimo sami, sicer bi kupec videl eno, naročilo pa bi nosilo drugo.
8. Izbira mora preživeti osvežitev strani — zato `_nacin` v seji in
   `noriks_econt_obnovi_izbiro()`.
9. `WC()` je lahko null (admin, cron, REST) — branje mora biti null-varno.

## 6. Privzeta kartica

`NORIKS_ECONT_PRIVZETO` v `econt.php` je `'ofis'` — kupec privzeto dobi
prevzem v pisarni, tako kot na vigoshop.bg (na CZ/PL je privzeta dostava na
naslov). Za obratno nastavi `'dom'`.

## 7. Oznaka različice

V HTML blagajne je `<!-- necont 2026-11-13-a -->`, da se da z žive strani
preveriti, katera različica modula je naložena.
