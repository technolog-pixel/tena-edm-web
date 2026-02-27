# Prompt pro Claude Code — Web firmy TENA EDM

Zkopíruj celý tento text a vlož ho do Claude Code.

---

## INSTRUKCE PRO CLAUDE CODE — ZAČÁTEČNÍK

Uživatel je úplný začátečník a neví jak cokoli nainstalovat nebo spustit. Proto:

1. **Začni tím, že uživateli vysvětlíš co budeš dělat** — jednoduše, bez technického žargonu
2. **Zkontroluj a nainstaluj vše potřebné automaticky** — pokud něco chybí, nainstaluj to sám pomocí příkazů
3. **Vytvoř složku projektu** — např. `tena-edm-web` na ploše nebo v domovském adresáři
4. **Vytvoř soubor `index.html`** se vším kódem uvnitř
5. **Zkopíruj logo** `Logo_TENA_EDM.png` do složky projektu — pokud ho uživatel ještě nepřidal, řekni mu přesně kam ho má vložit (vypište celou cestu ke složce)
6. **Po dokončení řekni uživateli přesně:**
   - Kde najde složku s webem (celá cesta, např. `C:\Users\Jméno\Desktop\tena-edm-web\`)
   - Jak web otevřít (dvakrát kliknout na soubor `index.html`)
   - Kam vložit logo pokud ho ještě nemá ve složce
7. **Používej jednoduchý jazyk** — žádné technické výrazy bez vysvětlení, piš jako bys vysvětloval někomu kdo nikdy neprogramoval
8. **Pokud nastane chyba**, vysvětli co se stalo a oprav ji sám bez toho aby musel uživatel něco dělat

---

---

## ZADÁNÍ

Vytvoř kompletní firemní web pro firmu **TENA EDM** — výrobce specializující se na přesné CNC obrábění a EDM technologie (elektrojiskrové obrábění). Web musí být profesionální, industriální a důvěryhodný.

Web bude tvořen **jedním HTML souborem** (`index.html`) s CSS a JavaScriptem přímo v souboru. Není potřeba žádný backend ani server — web musí fungovat po otevření souboru v prohlížeči.

---

## STRUKTURA WEBU

Web se skládá z **hlavní stránky** a **5 sekcí/záložek**:

1. **Hlavní stránka (Hero)** — úvodní sekce viditelná hned po načtení
2. **O nás** — představení firmy
3. **HUB — Projekt** — projekty a reference
4. **Práce** — ukázky prací / portfolio
5. **Technologie** — přehled strojního vybavení a technologií
6. **Kontakt** — kontaktní formulář a údaje

---

## NAVIGACE — DŮLEŽITÉ CHOVÁNÍ

### Na hlavní stránce (Hero sekci):
- Navigační menu je **trvale viditelné** — zobrazené jako horizontální seznam záložek vpravo nebo nahoře
- Záložky: O nás | HUB — Projekt | Práce | Technologie | Kontakt

### Na všech ostatních stránkách/sekcích:
- Navigační menu je **skryté** a zobrazí se pouze při **najetí myší** (hover) na okraj nebo na hamburger ikonu
- Při odjetí myší se menu opět skryje
- Animované vysunutí (slide-in efekt)

---

## DESIGN

### Barevná paleta (přesně dodržuj):
- Pozadí: světle šedá `#EFEFEF` až bílá `#FFFFFF`
- Primární akcentová barva: zlatožlutá `#F5C400`
- Text: tmavě šedá/černá `#1A1A1A`
- Sekundární text: středně šedá `#666666`
- Tlačítka: žlutá `#F5C400` s tmavým textem `#1A1A1A`, zaoblené rohy

### Typografie:
- Použij Google Fonts — doporučuji **"Barlow"** nebo **"Exo 2"** (industriální, technický charakter)
- Nadpisy: tučné, výrazné
- Body text: čitelný, přiměřená velikost

### Vizuální styl:
- Industriální, technický, přesný — jako výroba a inženýrství
- Světlé pozadí s jemnými šedými akcenty
- Fotografie/obrázky: použij placeholder obrázky z `https://picsum.photos` (nebo SVG ilustrace nástrojů/strojů)
- Jemné stíny, čisté hrany, precizní spacing
- Na hero sekci: velký nadpis vlevo, navigace vpravo, jemný šedý background efekt (gradient nebo subtle texture)

### Logo:
- Logo firmy je soubor `Logo_TENA_EDM.png` — vlož ho jako `<img src="Logo_TENA_EDM.png">` do hlavičky
- Pokud soubor není dostupný, zobraz textové logo "TENA EDM" stylizovaným fontem

---

## OBSAH JEDNOTLIVÝCH SEKCÍ (placeholder texty k úpravě)

### Hero (Hlavní stránka):
- Velký nadpis: **"Přesné CNC obrábění a EDM technologie"** (česky) / **"Precision CNC Machining and EDM Technologies"** (anglicky)
- Podnadpis: "Zakázková výroba dílů s důrazem na přesnost a kvalitu" / "Custom parts manufacturing with focus on precision and quality"
- CTA tlačítko: **"Nezávazná poptávka"** / **"Request a Quote"**
- Kontaktní info vpravo nahoře: `info@tenadm.cz` | `+420 603 331 601`

### O nás:
- Nadpis: "O nás" / "About Us"
- Text (placeholder): "Firma TENA EDM se specializuje na přesnou výrobu součástek metodami CNC obrábění a elektrojiskrového obrábění (EDM). Nabízíme zakázkovou výrobu pro průmyslové zákazníky s důrazem na přesnost, kvalitu a spolehlivost. [Zde doplňte více informací o historii a hodnotách firmy]"
- Přidej 3 ikony s hodnotami (např. Přesnost / Kvalita / Spolehlivost) se SVG ikonami

### HUB — Projekt:
- Nadpis: "Naše projekty" / "Our Projects"
- Grid karet (3 sloupce) s placeholder projekty — každá karta má obrázek, název a krátký popis
- Tlačítko "Zobrazit více" / "Show more"

### Práce:
- Nadpis: "Ukázky práce" / "Our Work"
- Foto galerie (masonry nebo grid layout) s placeholder obrázky obráběných dílů
- Filtrovací tlačítka: Vše / CNC / EDM / Jiné

### Technologie:
- Nadpis: "Naše technologie" / "Our Technologies"
- Přehled technologií v kartách:
  - CNC frézování
  - CNC soustružení  
  - EDM hloubení (elektrojiskrové)
  - EDM drátové řezání
  - Broušení
- Každá karta: ikona (SVG), název, krátký popis

### Kontakt:
- Nadpis: "Kontaktujte nás" / "Contact Us"
- Kontaktní formulář: Jméno, Email, Telefon, Zpráva, tlačítko Odeslat
- Vedle formuláře: kontaktní údaje
  - Email: `info@tenadm.cz`
  - Telefon: `+420 603 331 601`
  - [Placeholder pro adresu]

---

## JAZYKOVÉ PŘEPÍNÁNÍ (CZ / EN)

- V pravém horním rohu přidej přepínač jazyka: **CZ | EN**
- Po kliknutí se veškerý text na stránce přepne do příslušného jazyka
- Implementuj pomocí JavaScriptu — všechny texty ulož do JS objektu s překladem

---

## ANIMACE A INTERAKCE

- Plynulé scrollování mezi sekcemi (`scroll-behavior: smooth`)
- Fade-in animace při scrollování (Intersection Observer API)
- Hover efekty na tlačítkách a kartách (jemné zvětšení, stín)
- Aktivní záložka v navigaci zvýrazněna žlutou barvou nebo podtržením
- Vysouvací menu na podstránkách — CSS transition `transform: translateX()`

---

## TECHNICKÉ POŽADAVKY

- Čistý HTML5, CSS3, vanilla JavaScript (bez frameworků, bez npm)
- Responzivní design (mobile, tablet, desktop) pomocí CSS media queries
- Jeden soubor `index.html` — CSS ve `<style>` tagu, JS ve `<script>` tagu
- Google Fonts načteny přes `<link>` tag
- Web musí fungovat po přímém otevření souboru v prohlížeči (bez serveru)
- Validní HTML, přístupné (alt texty na obrázcích, ARIA labels)

---

## POZNÁMKY PRO CLAUDE CODE

- Logo soubor `Logo_TENA_EDM.png` bude ve stejné složce jako `index.html`
- Pokud logo není dostupné, použij fallback textové logo
- Placeholder obrázky: `https://picsum.photos/seed/cnc/800/600` (obměňuj seed parametr pro různé obrázky)
- Veškerý kód piš do jediného souboru `index.html`
- Po dokončení zkontroluj, zda web funguje správně na mobilních zařízeních

---

*Tento prompt byl připraven pro projekt TENA EDM. Po vygenerování webu nahraďte placeholder texty skutečným obsahem a přidejte vlastní fotografie.*
