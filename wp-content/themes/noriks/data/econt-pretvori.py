# -*- coding: utf-8 -*-
"""Econt Nomenclatures -> data/econt-ofisi.tsv

Vir: https://ee.econt.com/services/Nomenclatures/NomenclaturesService.getOffices.json
(javen, brez kljuca). Stolpci so enaki kot pri CZ/PL: zadnji je polje za
iskanje (male crke, brez locil), da gre iskanje po datoteki z enim strpos.
"""
import json, sys, datetime, zoneinfo, unicodedata

SOFIA = zoneinfo.ZoneInfo("Europe/Sofia")

def ura(ms):
    if not ms:
        return ""
    t = datetime.datetime.fromtimestamp(int(ms) / 1000, SOFIA)
    return t.strftime("%H:%M")

def cas(od, do):
    a, b = ura(od), ura(do)
    return f"{a}–{b}" if a and b else ""

# Latinica za bolgarscino: kupec lahko tipka "sofia" ali "София".
PRESLIKAVA = {
    'а':'a','б':'b','в':'v','г':'g','д':'d','е':'e','ж':'zh','з':'z','и':'i',
    'й':'y','к':'k','л':'l','м':'m','н':'n','о':'o','п':'p','р':'r','с':'s',
    'т':'t','у':'u','ф':'f','х':'h','ц':'ts','ч':'ch','ш':'sh','щ':'sht',
    'ъ':'a','ь':'y','ю':'yu','я':'ya',
}

def latinica(s):
    return "".join(PRESLIKAVA.get(z, z) for z in s.lower())

def main(vir, cilj):
    offices = json.load(open(vir, encoding="utf-8"))["offices"]
    vrstice = []
    for o in offices:
        a = o.get("address") or {}
        c = a.get("city") or {}
        mesto = (c.get("name") or "").strip()
        kod   = (c.get("postCode") or "").strip()
        naziv = (o.get("name") or "").strip()
        # ime pisarne se pogosto zacne z imenom kraja ("Айдемир") — ne podvajamo
        naslov = (a.get("fullAddress") or "").strip()
        naslov = " ".join(naslov.split())
        ulica  = " ".join(x for x in ((a.get("street") or "").strip(),
                                      (a.get("num") or "").strip()) if x)
        tip = "Автомат" if o.get("isAPS") else ("Мобилен офис" if o.get("isMPS") else "Офис")
        loc = a.get("location") or {}
        ure = cas(o.get("normalBusinessHoursFrom"), o.get("normalBusinessHoursTo"))
        sob = cas(o.get("halfDayBusinessHoursFrom"), o.get("halfDayBusinessHoursTo"))
        if sob and sob != ure:
            ure = f"{ure} · съб {sob}" if ure else f"съб {sob}"
        if not ure:
            ure = "—"
        koda = (o.get("code") or "").strip()
        if not koda or not mesto:
            continue
        iskalno = " ".join([koda, naziv, naslov, mesto, kod, tip])
        iskalno = iskalno.lower()
        iskalno = iskalno + " " + latinica(iskalno)
        iskalno = " ".join(iskalno.split())
        vrstice.append([
            koda, naziv, naslov, tip, ure,
            f"{loc.get('latitude','') or ''}", f"{loc.get('longitude','') or ''}",
            ulica, kod, mesto, iskalno,
        ])
    # urejeno po postni stevilki, kot pri CZ/PL — na vrhu so Sofija in veliki kraji
    vrstice.sort(key=lambda v: (v[8], v[9], v[1]))
    with open(cilj, "w", encoding="utf-8", newline="\n") as f:
        for v in vrstice:
            f.write("\t".join(x.replace("\t", " ").replace("\n", " ") for x in v) + "\n")
    print(f"zapisanih vrstic: {len(vrstice)}")

if __name__ == "__main__":
    main(sys.argv[1], sys.argv[2])
