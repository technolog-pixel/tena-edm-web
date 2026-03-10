<?php
session_start();

if (empty($_SESSION['admin'])) {
    header('Location: index.html');
    exit;
}

// Načtení aktuálních dat z JSON
$json_file = __DIR__ . '/data/technologie.json';
$data = [];
if (file_exists($json_file)) {
    $data = json_decode(file_get_contents($json_file), true) ?? [];
}

// Výchozí hodnoty (CS)
$dcs = [
    't1_title' => 'CNC 3osé obrábění',
    't1_desc'  => 'Frézování na 3osých CNC centrech s vysokou přesností.<ul><li>Pracovní plocha: 2&nbsp;400 × 850 mm</li><li>Max. hmotnost obrobku: 3&nbsp;500 kg</li></ul>',
    't2_title' => 'CNC 5osé obrábění',
    't2_desc'  => 'Komplexní obrábění složitých tvarů v jednom upnutí.<ul><li>Pracovní plocha: 650 × 500 mm</li><li>Max. hmotnost obrobku: 2&nbsp;000 kg</li></ul>',
    't3_title' => 'CNC soustružení',
    't3_desc'  => 'Přesné soustružení rotačních dílů, kusová i sériová výroba.<ul><li>Max. průměr nad ložem: 330 mm</li><li>Max. průměr nad suportem: 260 mm</li><li>Max. délka soustružení (Z): 450 mm</li></ul>',
    't4_title' => 'Další technologie',
    't4_desc'  => 'Nabízíme široké spektrum dalších technologií:<ul><li>Drátové řezání</li><li>Broušení</li><li>Hloubení</li><li>Laserové řezání</li></ul>',
    't5_title' => 'Kontrola kvality',
    't5_desc'  => 'Měření a kontrola dílů pomocí moderních měřicích přístrojů. Zajištění shody s výkresovou dokumentací.<ul><li>Max. rozměr: 900 × 1&nbsp;000 × 600 mm</li><li>Rozlišení: 0,0001 mm (0,1 μm)</li><li>Max. hmotnost obrobku: 1&nbsp;200 kg</li></ul>',
];

// Výchozí hodnoty (EN)
$den = [
    't1_title' => 'CNC 3-Axis Machining',
    't1_desc'  => 'Milling on 3-axis CNC machining centers with high precision.<ul><li>Working area: 2,400 × 850 mm</li><li>Max. workpiece weight: 3,500 kg</li></ul>',
    't2_title' => 'CNC 5-Axis Machining',
    't2_desc'  => 'Complex machining of intricate shapes in a single setup.<ul><li>Working area: 650 × 500 mm</li><li>Max. workpiece weight: 2,000 kg</li></ul>',
    't3_title' => 'CNC Turning',
    't3_desc'  => 'Precision turning of rotational parts, single-piece and series production.<ul><li>Max. diameter over bed: 330 mm</li><li>Max. diameter over cross slide: 260 mm</li><li>Max. turning length (Z): 450 mm</li></ul>',
    't4_title' => 'Other Technologies',
    't4_desc'  => 'We offer a wide range of additional technologies:<ul><li>Wire EDM</li><li>Grinding</li><li>Sinker EDM</li><li>Laser cutting</li></ul>',
    't5_title' => 'Quality Control',
    't5_desc'  => 'Measurement and inspection of parts using modern measuring instruments. Ensuring conformance with technical drawings.<ul><li>Max. dimensions: 900 × 1,000 × 600 mm</li><li>Resolution: 0.0001 mm (0.1 μm)</li><li>Max. workpiece weight: 1,200 kg</li></ul>',
];

// Výchozí obrázky (cesty relativní k admin/)
$dimg = [
    1 => '../Technologie/3os.png',
    2 => '../Technologie/5os.png',
    3 => '../Technologie/soustruh.png',
    4 => '../Technologie/ostatní.png',
    5 => '../Technologie/kontrola.png',
];

// Helper: získej hodnotu z JSON nebo výchozí, HTML-escapovaná pro atributy
function gv(array $data, string $lang, string $key, array $def): string {
    return htmlspecialchars($data[$lang][$key] ?? $def[$key] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Helper: pro textarea (hodnota mezi tagy)
function gt(array $data, string $lang, string $key, array $def): string {
    return htmlspecialchars($data[$lang][$key] ?? $def[$key] ?? '', ENT_NOQUOTES | ENT_HTML5, 'UTF-8');
}

// Příprava dat pro 5 technologií
$techs = [];
for ($i = 1; $i <= 5; $i++) {
    $imgPath = isset($data['images']["t{$i}"]) && $data['images']["t{$i}"] !== ''
        ? '../' . $data['images']["t{$i}"]
        : $dimg[$i];
    $techs[] = [
        'id'       => $i,
        'cs_title' => gv($data, 'cs', "t{$i}_title", $dcs),
        'cs_desc'  => gt($data, 'cs', "t{$i}_desc",  $dcs),
        'en_title' => gv($data, 'en', "t{$i}_title", $den),
        'en_desc'  => gt($data, 'en', "t{$i}_desc",  $den),
        'img'      => htmlspecialchars($imgPath, ENT_QUOTES, 'UTF-8'),
    ];
}

$lastUpdated = htmlspecialchars($data['lastUpdated'] ?? '—', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Technologie — TENA EDM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Exo 2', sans-serif;
            background: #EFEFEF;
            color: #1A1A1A;
            min-height: 100vh;
        }

        /* ---- Header ---- */
        .admin-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #1A1A1A;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 32px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.2);
        }
        .admin-header .logo-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .admin-header img { height: 32px; width: auto; filter: brightness(10); }
        .admin-header h1 {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        .admin-header h1 span { color: #F5C400; }
        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .last-saved {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
        }
        .btn-logout {
            padding: 7px 16px;
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 8px;
            font-family: 'Exo 2', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
        }
        .btn-logout:hover { border-color: #F5C400; color: #F5C400; }

        /* ---- Main layout ---- */
        .admin-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px 64px;
        }
        .page-title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .page-sub {
            font-size: 13px;
            color: #666;
            margin-bottom: 32px;
        }
        .page-sub strong { color: #1A1A1A; }
        .html-hint {
            font-size: 12px;
            color: #666;
            margin-top: 28px;
            margin-bottom: 4px;
            padding: 10px 14px;
            background: #fff;
            border-left: 3px solid #F5C400;
            border-radius: 0 8px 8px 0;
        }

        /* ---- Tech card ---- */
        .tech-section {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin-bottom: 24px;
            overflow: hidden;
        }
        .tech-head {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 18px 24px;
            border-bottom: 1px solid rgba(0,0,0,0.07);
            background: #fafafa;
        }
        .tech-num {
            font-size: 28px;
            font-weight: 800;
            color: #F5C400;
            letter-spacing: -1px;
            line-height: 1;
            min-width: 36px;
        }
        .tech-head-title {
            font-size: 16px;
            font-weight: 700;
            flex: 1;
        }
        .tech-img-preview {
            width: 80px;
            height: 60px;
            object-fit: contain;
            border-radius: 6px;
            background: #EFEFEF;
            border: 1px solid rgba(0,0,0,0.08);
        }
        .tech-body { padding: 24px; }

        /* ---- Fields grid CS/EN ---- */
        .fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        @media (max-width: 700px) {
            .fields-grid { grid-template-columns: 1fr; }
        }
        .field-block { display: flex; flex-direction: column; gap: 12px; }
        .lang-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            background: #F5C400;
            color: #1A1A1A;
            padding: 2px 8px;
            border-radius: 4px;
            margin-bottom: 8px;
        }
        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            margin-bottom: 4px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid rgba(0,0,0,0.10);
            border-radius: 8px;
            font-family: 'Exo 2', sans-serif;
            font-size: 14px;
            color: #1A1A1A;
            outline: none;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus { border-color: #F5C400; }
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid rgba(0,0,0,0.10);
            border-radius: 8px;
            font-family: 'Exo 2', monospace;
            font-size: 12.5px;
            color: #1A1A1A;
            resize: vertical;
            min-height: 130px;
            outline: none;
            transition: border-color 0.2s;
            line-height: 1.5;
        }
        textarea:focus { border-color: #F5C400; }

        /* ---- Image upload ---- */
        .img-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(0,0,0,0.07);
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .img-section label { margin-bottom: 0; font-size: 13px; font-weight: 600; color: #1A1A1A; }
        input[type="file"] {
            font-family: 'Exo 2', sans-serif;
            font-size: 13px;
            cursor: pointer;
        }
        .img-note { font-size: 11px; color: #999; margin-top: 4px; }

        /* ---- Actions bar ---- */
        .actions-bar {
            position: sticky;
            bottom: 0;
            background: #fff;
            border-top: 1px solid rgba(0,0,0,0.08);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.06);
            border-radius: 14px 14px 0 0;
            margin-top: 8px;
        }
        .btn-save {
            padding: 12px 32px;
            background: #F5C400;
            color: #1A1A1A;
            border: none;
            border-radius: 8px;
            font-family: 'Exo 2', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, opacity 0.2s;
        }
        .btn-save:hover { background: #e0b200; }
        .btn-save:disabled { opacity: 0.6; cursor: wait; }
        #save-status {
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s;
        }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="logo-wrap">
        <img src="../Logo_TENA_EDM.png" alt="TENA EDM"
             onerror="this.style.display='none'">
        <h1>TENA <span>EDM</span> — Admin</h1>
    </div>
    <div class="header-right">
        <span class="last-saved" id="last-saved-info">Poslední uložení: <?= $lastUpdated ?></span>
        <form method="POST" action="logout.php" style="margin:0">
            <button type="submit" class="btn-logout">Odhlásit se</button>
        </form>
    </div>
</header>

<main class="admin-main">
    <h2 class="page-title">Editor technologií</h2>
    <p class="page-sub">
        Upravte název a popis každé technologie pro obě jazykové verze.
        <strong>HTML tagy jsou povoleny</strong> — používejte
        <code>&lt;ul&gt;&lt;li&gt;...&lt;/li&gt;&lt;/ul&gt;</code> pro seznamy parametrů.
    </p>

    <form id="editor-form" enctype="multipart/form-data">
        <?php foreach ($techs as $t): ?>
        <div class="tech-section">
            <div class="tech-head">
                <div class="tech-num">0<?= $t['id'] ?></div>
                <div class="tech-head-title" id="heading-<?= $t['id'] ?>"><?= $t['cs_title'] ?></div>
                <img class="tech-img-preview"
                     id="preview-<?= $t['id'] ?>"
                     src="<?= $t['img'] ?>"
                     alt="Náhled obrázku"
                     onerror="this.style.opacity='0.3'">
            </div>
            <div class="tech-body">
                <div class="fields-grid">
                    <!-- CZ -->
                    <div class="field-block">
                        <div><span class="lang-badge">🇨🇿 Česky</span></div>
                        <div>
                            <label>Název</label>
                            <input type="text"
                                   name="t<?= $t['id'] ?>_title_cs"
                                   value="<?= $t['cs_title'] ?>"
                                   class="title-cs-input"
                                   data-tech="<?= $t['id'] ?>">
                        </div>
                        <div>
                            <label>Popis / parametry</label>
                            <textarea name="t<?= $t['id'] ?>_desc_cs"><?= $t['cs_desc'] ?></textarea>
                        </div>
                    </div>
                    <!-- EN -->
                    <div class="field-block">
                        <div><span class="lang-badge" style="background:#1A1A1A;color:#fff">🇬🇧 English</span></div>
                        <div>
                            <label>Title</label>
                            <input type="text"
                                   name="t<?= $t['id'] ?>_title_en"
                                   value="<?= $t['en_title'] ?>">
                        </div>
                        <div>
                            <label>Description / parameters</label>
                            <textarea name="t<?= $t['id'] ?>_desc_en"><?= $t['en_desc'] ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Image upload -->
                <div class="img-section">
                    <label>Nový obrázek:</label>
                    <div>
                        <input type="file"
                               name="img_<?= $t['id'] ?>"
                               accept="image/png,image/jpeg,image/webp"
                               class="img-upload"
                               data-preview="preview-<?= $t['id'] ?>">
                        <p class="img-note">PNG, JPG nebo WebP · max. 5 MB · aktuální obrázek se nahradí</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="actions-bar">
            <button type="button" class="btn-save" id="save-btn">Uložit změny</button>
            <span id="save-status"></span>
        </div>
    </form>
</main>

<script>
    // AJAX uložení
    document.getElementById('save-btn').addEventListener('click', async () => {
        const btn    = document.getElementById('save-btn');
        const status = document.getElementById('save-status');

        btn.disabled     = true;
        status.textContent = 'Ukládám…';
        status.style.color = '#666';

        try {
            const fd  = new FormData(document.getElementById('editor-form'));
            const res = await fetch('save.php', { method: 'POST', body: fd });
            const json = await res.json();

            if (json.status === 'success') {
                status.textContent = '✓ Uloženo — ' + json.lastUpdated;
                status.style.color = '#15803d';
                document.getElementById('last-saved-info').textContent =
                    'Poslední uložení: ' + json.lastUpdated;
            } else {
                status.textContent = '✗ Chyba: ' + (json.message || 'Neznámá chyba');
                status.style.color = '#c00';
            }
        } catch (e) {
            status.textContent = '✗ Chyba připojení k serveru';
            status.style.color = '#c00';
        }

        btn.disabled = false;
    });

    // Náhled obrázku po výběru souboru
    document.querySelectorAll('.img-upload').forEach(input => {
        input.addEventListener('change', function () {
            const preview = document.getElementById(this.dataset.preview);
            if (this.files[0] && preview) {
                preview.src = URL.createObjectURL(this.files[0]);
                preview.style.opacity = '1';
            }
        });
    });

    // Živá aktualizace nadpisu karty při psaní CZ názvu
    document.querySelectorAll('.title-cs-input').forEach(input => {
        input.addEventListener('input', function () {
            const heading = document.getElementById('heading-' + this.dataset.tech);
            if (heading) heading.textContent = this.value;
        });
    });
</script>
</body>
</html>
