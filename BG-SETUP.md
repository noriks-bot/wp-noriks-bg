# devbg.noriks.com — kaj je treba narediti, da stran dela

Izhodišče: **kopija trga SK** (ker je v evrih). Repozitorij vsebuje **samo
`wp-content`** — torej temo, vtičnike in jezikovne datoteke. Vsa besedila, ki
jih ureja WordPress (imena izdelkov, opisi, strani, kategorije, ACF
nastavitve), **so v bazi, ne tukaj**. Zato je najhitrejša pot klon SK baze in
nato prevod v bazi.

---

## 1. Strežnik (to naredi hosting / ti)

1. Poddomena `devbg.noriks.com` + SSL.
2. Nova WordPress namestitev **ali** klon SK namestitve:
   ```bash
   # jedro WP + wp-config iz SK
   rsync -a --exclude wp-content /pot/do/sk/ /pot/do/devbg/
   ```
3. Nova baza, uvoz dumpa SK baze:
   ```bash
   mysqldump -u UPORABNIK -p SK_BAZA > sk.sql
   mysql -u UPORABNIK -p BG_BAZA < sk.sql
   ```
4. V `wp-config.php` nastavi novo `DB_NAME`, `DB_USER`, `DB_PASSWORD` in dodaj:
   ```php
   define( 'WP_HOME',    'https://devbg.noriks.com' );
   define( 'WP_SITEURL', 'https://devbg.noriks.com' );
   ```
5. Zamenjaj naslove v bazi (WP-CLI, vključno s serializiranimi polji):
   ```bash
   wp search-replace 'noriks.com/sk' 'devbg.noriks.com' --all-tables --precise
   ```
6. `wp-content` zamenjaj z vsebino tega repozitorija:
   ```bash
   cd /pot/do/devbg/wp-content && git clone https://github.com/noriks-bot/wp-noriks-bg.git tmp \
     && rsync -a tmp/wp-content/ . && rm -rf tmp
   ```
   (Na obstoječih trgih delaš `git pull` v `wp-content` — enako naredi tukaj.)
7. `wp-content/uploads` **ni v gitu**. Prekopiraj iz SK:
   ```bash
   rsync -a /pot/do/sk/wp-content/uploads/ /pot/do/devbg/wp-content/uploads/
   ```

---

## 2. WordPress nastavitve

| Kje | Kaj nastaviti |
|---|---|
| Nastavitve → Splošno | Jezik strani **български (bg_BG)**, časovni pas **Europe/Sofia** |
| Nastavitve → Trajne povezave | enako kot na SK (`/%postname%/`) |
| WooCommerce → Splošno | Država trgovine **Bolgarija**, prodaja samo v Bolgarijo, **valuta EUR** |
| WooCommerce → Dostava | območje Bolgarija, brezplačna dostava nad **70 €**, naložen platež 1,99 € |
| Vtičniki | aktiviraj iste kot na SK (orto-product, ACF Pro, WooCommerce, PixelYourSite, Klaviyo, side-cart …) |

> **Valuta:** izhodišče je SK, torej EUR. Če bo BG trg vseeno v levih, je to
> sprememba valute v WooCommerce + preračun vseh cen — povej in to uredim prek
> REST API-ja, kot smo delali za CLOUD/PAL/CONTROLPRO.

Jezikovne datoteke: WooCommerce in WordPress bolgarščino poberejo sama
(Nadzorna plošča → Posodobitve → prevodi). Naše napise v temi lovi
`functions/lang/bg.php`, ki je že v repozitoriju.

---

## 3. Kaj je že narejeno v kodi (ni ti treba nič)

- `functions/lang/bg.php` — gettext prevodi za WooCommerce napise
- `functions.php` — veja `$webshop_language == "BG"`
- `functions/checkout_mods.php` — privzeta država BG, oznake polj, sporočila napak
- `functions/phone-validate.php` — klicna **+359**, primer `0888123456`
- predpona naročil **`NORIKS-BG-`**
- `auto_reviews/SK*.php` → `BG*.php` (27 datotek) + popravljene vse vključitve
- povezave `noriks.com/sk` in `/sk/...` → `/bg/...`
- izbirnik držav v glavi: dodana Bolgarija, Slovaška spet kaže na `/sk`
- noga: zastavica in napis **България (BG)**
- `functions/acf-text-fix.php` — dodani bolgarski besedi za pravilo
  »zamenjava ni brezplačna«

**Prevod teme je zaključen.** V bolgarščini je vse, kar vidi kupec:

| sklop | obseg |
|---|---|
| produktna stran `woocommerce/single-product/meta.php` | ikone, okno dostave, opisi 19 izdelkov, tabele velikosti, pranje, vračila, PDF navodila |
| `template_parts/single-product-bottom-nicer.php` | sistem mnenj + FAQ vseh **21 izdelkov** |
| `template_parts/product-bottom/why-*.php` | **27 datotek**, vse why-sekcije |
| `auto_reviews/BG*.php` | **28 datotek, ~1 150 mnenj** — besedila in imena |
| domača stran, glava, noga, blagajna, košarica, stran z navodili | vsi napisi |
| vtičnik `orto-product` | izbirnik ponudb, značke, števec, barve, kontrolni seznam |
| modali tabel velikosti | 6 datotek |
| `single-lander2.php` | advertorial (prej hrvaški) |

Imena v mnenjih so prepisana v bolgarsko cirilico (Tomáš L. → Томислав Л.),
kraji v mnenjih zamenjani z bolgarskimi (Bratislava → София, Košice → Пловдив …),
imena zdravnikov in terapevtov prav tako. `php -l` je čist na vseh
**270 datotekah** teme.

### Namenoma neprevedeno

- **`template-vigocheckout.php`** (375 vrstic slovaščine/hrvaščine) — to je
  *»pixel-perfect vigoshop.sk checkout replica«*, torej kopija tuje blagajne za
  referenco. Ni nikjer vključena, ni naša blagajna (ta teče prek WooCommerce +
  `checkout_mods.php`) in nobena stran je ne uporablja. Če je ne potrebuješ več,
  jo lahko zbrišem — povej.
- **`auto_reviews/EN.php`** — angleški bazen mnenj, ki ga BG ne vključuje
  (vključujeta se `BG.php` in `BG-2.php`).
- **`functions/lang/hr.php`** — hrvaška jezikovna datoteka, ostaja nedotaknjena.
- Razvijalski komentarji v kodi (nevidni kupcu) in večjezični seznami besed v
  `functions/acf-text-fix.php` ter prepoznavanje atributov v `orto-product`,
  kjer slovaške besede morajo ostati.

---

## 4. Kaj je treba prevesti v bazi (kode se ne da)

Tega repozitorij ne pokriva — po klonu SK baze ostane slovaško:

1. **Izdelki** — imena, kratki in dolgi opisi, imena atributov (`Размер`,
   `Цвят`) in njihove vrednosti.
   > Vrednosti atributov velikosti **morajo ostati gole črke** (`XS, S, M, L,
   > XL, 2XL, 3XL`). Na njih visijo cene po velikosti in košarica. Vidni napis
   > sestavi koda.
2. **Kategorije** — imena; slugi naj ostanejo isti kot na SK, ker se na njih
   sklicuje koda (`tricka`, `boxerky`, `sady`, `startovaci-balicek`, `ponozky`,
   `orto-*`).
3. **Strani** — Pogoji, Zasebnost, Dostava, Navodila (`ochrana-osobnych-udajov`,
   `navody`). Slug pusti, besedilo prevedi.
4. **ACF nastavitve (98 polj)** — harmonike na produktni strani, ikone,
   stolpci noge, napisi ponudb, besedila mnenj. Vse v *Nastavitve izgleda* /
   ACF Options.
5. **Kuponi** — kode in opisi.
6. **Mandrill predloge** in **Klaviyo flowi** za BG.

Ko bo baza na devbg, lahko to prevedem prek WooCommerce in WP REST API-ja —
tako kot pri drugih trgih. Potrebujem le vrstico v
`noriks-credentials-vsi.json`:

```json
"devbg": {
  "url": "https://devbg.noriks.com",
  "wp_app_password": "...",
  "wc_consumer_key": "ck_...",
  "wc_consumer_secret": "cs_..."
}
```

---

## 5. Slike s slovaškim besedilom

Te prevoda kode ne doseže — treba jih je narediti na novo (ali vzeti HR
izvirnik in napisati bolgarsko besedilo):

| Datoteka | Kaj je |
|---|---|
| `img/kidsnest/tablica-velicine-sk.webp` | tabela velikosti KidsNest |
| `boxers_size_sk.png` *(v uploads)* | tabela velikosti bokserice |
| `Nogavice_tabela_velikosti_sk.png` *(v uploads)* | tabela velikosti nogavice |
| `starter-1_sk.png`, `starter-2_sk.png`, `starter-3_sk.png` *(v uploads)* | sekcije startnega paketa |
| `satisfaction_icon_sk.png` | značka zadovoljstva |
| `01-poravnan-sk.webp` | why-sekcija |
| `manuals/*.pdf` (11 datotek) | navodila za uporabo |

---

## 6. Klaviyo

`footer.php` ima `$nf_klaviyo_list = '';` — **namenoma prazno**, da prijave na
novice ne padejo v slovaški seznam (`SF2NXX`). Ko ustvariš bolgarski seznam,
vpiši njegov List ID na to mesto.

---

## 7. Vrstni red, ki ga predlagam

1. Postavi devbg po 1. in 2. točki → stran se naloži v bolgarščini (vmesnik).
2. Dodaj dostope v `noriks-credentials-vsi.json`.
3. Jaz dokončam prevod teme (3. točka, »še v delu«).
4. Jaz prevedem bazo prek API-ja (4. točka).
5. Slike in PDF-i (5. točka).
6. Ko devbg stoji, gre isti repozitorij na produkcijo `noriks.com/bg`.
