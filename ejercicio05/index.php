<?php
// Gallery: Scan images directory (or use demo URLs if empty)
$imgDir = __DIR__ . '/images/';
$imagenes = [];

if (is_dir($imgDir)) {
    foreach (glob($imgDir . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) as $path) {
        $imagenes[] = [
            'src'   => 'images/' . basename($path),
            'name'  => pathinfo($path, PATHINFO_FILENAME),
            'size'  => filesize($path),
            'type'  => strtoupper(pathinfo($path, PATHINFO_EXTENSION)),
        ];
    }
}

// If no local images, use Picsum demo images
if (empty($imagenes)) {
    $seeds = [
        ['id'=>10,'name'=>'Naturaleza','cat'=>'Paisaje'],
        ['id'=>20,'name'=>'Ciudad','cat'=>'Urbano'],
        ['id'=>30,'name'=>'Arquitectura','cat'=>'Arte'],
        ['id'=>40,'name'=>'Tecnología','cat'=>'Tech'],
        ['id'=>50,'name'=>'Abstracto','cat'=>'Arte'],
        ['id'=>60,'name'=>'Montaña','cat'=>'Paisaje'],
        ['id'=>70,'name'=>'Mar','cat'=>'Paisaje'],
        ['id'=>80,'name'=>'Bosque','cat'=>'Naturaleza'],
        ['id'=>91,'name'=>'Retrato','cat'=>'Fotografía'],
        ['id'=>100,'name'=>'Atardecer','cat'=>'Paisaje'],
        ['id'=>200,'name'=>'Flores','cat'=>'Naturaleza'],
        ['id'=>300,'name'=>'Animal','cat'=>'Naturaleza'],
    ];
    foreach ($seeds as $s) {
        $imagenes[] = [
            'src'  => "https://picsum.photos/seed/{$s['id']}/600/400",
            'thumb'=> "https://picsum.photos/seed/{$s['id']}/300/200",
            'name' => $s['name'],
            'cat'  => $s['cat'],
            'type' => 'JPG',
            'size' => rand(50,300)*1024,
        ];
    }
}

$categorias = ['Todas'];
foreach ($imagenes as $img) {
    if (!empty($img['cat']) && !in_array($img['cat'], $categorias)) {
        $categorias[] = $img['cat'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 – Galería de Imágenes</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #080a0e;
            --surface: #0f1117;
            --surface2: #161b22;
            --border: #21262d;
            --accent: #f97316;
            --accent2: #fbbf24;
            --text: #f0f6fc;
            --muted: #7d8590;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Syne',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }
        header { border-bottom:1px solid var(--border); padding:1.2rem 2rem; display:flex; justify-content:space-between; align-items:center; }
        .logo { font-family:'Space Mono',monospace; font-size:.9rem; color:var(--accent2); }
        .back { font-family:'Space Mono',monospace; font-size:.75rem; color:var(--muted); text-decoration:none; border:1px solid var(--border); padding:.4rem .9rem; border-radius:8px; transition:all .2s; }
        .back:hover { border-color:var(--accent); color:var(--text); }

        main { max-width:1200px; margin:0 auto; padding:3rem 1.5rem; }
        .page-header { margin-bottom:2.5rem; }
        .tag { font-family:'Space Mono',monospace; font-size:.7rem; color:var(--accent2); letter-spacing:.2em; text-transform:uppercase; margin-bottom:.8rem; }
        h1 { font-size:2.5rem; font-weight:800; margin-bottom:.5rem; }
        .sub { color:var(--muted); }
        .meta { font-family:'Space Mono',monospace; font-size:.75rem; color:var(--muted); margin-top:.5rem; }

        /* FILTERS */
        .filters {
            display:flex;
            gap:.5rem;
            flex-wrap:wrap;
            margin-bottom:2rem;
            align-items:center;
        }
        .filter-btn {
            padding:.45rem 1rem;
            border-radius:100px;
            font:inherit;
            font-size:.8rem;
            font-weight:700;
            cursor:pointer;
            border:1px solid var(--border);
            background:var(--surface);
            color:var(--muted);
            transition:all .2s;
        }
        .filter-btn.active, .filter-btn:hover {
            background:var(--accent);
            border-color:var(--accent);
            color:#fff;
        }
        .search-wrap { margin-left:auto; position:relative; }
        .search-wrap input {
            background:var(--surface2);
            border:1px solid var(--border);
            border-radius:8px;
            padding:.45rem 1rem .45rem 2.2rem;
            color:var(--text);
            font:inherit;
            font-size:.8rem;
            outline:none;
            transition:border-color .2s;
        }
        .search-wrap input:focus { border-color:var(--accent2); }
        .search-wrap::before {
            content:'🔍';
            position:absolute;
            left:.6rem;
            top:50%;
            transform:translateY(-50%);
            font-size:.75rem;
        }

        /* GALLERY */
        .gallery {
            columns:4 220px;
            gap:1rem;
        }
        .img-card {
            break-inside:avoid;
            margin-bottom:1rem;
            border-radius:12px;
            overflow:hidden;
            border:1px solid var(--border);
            background:var(--surface);
            cursor:pointer;
            transition:transform .3s, box-shadow .3s;
        }
        .img-card:hover { transform:translateY(-4px); box-shadow:0 16px 32px rgba(0,0,0,.5); border-color:var(--accent); }
        .img-card img {
            width:100%;
            display:block;
            transition:transform .4s;
        }
        .img-card:hover img { transform:scale(1.04); }
        .img-info { padding:.8rem 1rem; }
        .img-name { font-size:.85rem; font-weight:700; margin-bottom:.25rem; }
        .img-meta { display:flex; gap:.5rem; align-items:center; }
        .img-cat {
            font-family:'Space Mono',monospace;
            font-size:.65rem;
            padding:.15rem .5rem;
            border-radius:4px;
            background:rgba(249,115,22,.15);
            color:var(--accent);
            border:1px solid rgba(249,115,22,.3);
        }
        .img-type { font-family:'Space Mono',monospace; font-size:.65rem; color:var(--muted); }

        .no-results { text-align:center; padding:4rem; color:var(--muted); font-family:'Space Mono',monospace; }

        /* LIGHTBOX */
        .lightbox {
            display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.9);
            z-index:1000;
            align-items:center;
            justify-content:center;
            backdrop-filter:blur(8px);
            animation:lbIn .2s ease;
        }
        @keyframes lbIn { from{opacity:0;} to{opacity:1;} }
        .lightbox.open { display:flex; }
        .lb-inner {
            max-width:90vw;
            max-height:90vh;
            position:relative;
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        .lb-img {
            max-width:90vw;
            max-height:80vh;
            border-radius:12px;
            object-fit:contain;
            box-shadow:0 40px 80px rgba(0,0,0,.8);
        }
        .lb-caption {
            margin-top:1rem;
            font-size:.9rem;
            color:rgba(255,255,255,.7);
            font-family:'Space Mono',monospace;
        }
        .lb-close {
            position:fixed;
            top:1.5rem; right:1.5rem;
            background:rgba(255,255,255,.1);
            border:1px solid rgba(255,255,255,.2);
            color:#fff;
            border-radius:50%;
            width:44px; height:44px;
            font-size:1.2rem;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            transition:all .2s;
        }
        .lb-close:hover { background:rgba(255,255,255,.2); }
        .lb-nav {
            position:fixed;
            top:50%;
            transform:translateY(-50%);
            background:rgba(255,255,255,.1);
            border:1px solid rgba(255,255,255,.15);
            color:#fff;
            width:48px; height:48px;
            border-radius:50%;
            font-size:1.4rem;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            transition:all .2s;
        }
        .lb-nav:hover { background:rgba(255,255,255,.2); }
        .lb-prev { left:1.5rem; }
        .lb-next { right:1.5rem; }
    </style>
</head>
<body>
<header>
    <div class="logo">Jhonny Bermudez</div>
    <a href="../index.php" class="back">← Volver</a>
</header>
<main>
    <div class="page-header">
        <p class="tag">// Ejercicio 05</p>
        <h1>Galería de Imágenes</h1>
        <p class="sub">Galería dinámica cargada con PHP. Haz clic para ver en pantalla completa.</p>
        <p class="meta"><?= count($imagenes) ?> imágenes &nbsp;·&nbsp; PHP <?= phpversion() ?></p>
    </div>

    <div class="filters">
        <?php foreach ($categorias as $cat): ?>
        <button class="filter-btn <?= $cat === 'Todas' ? 'active' : '' ?>"
                onclick="filtrar('<?= $cat ?>', this)">
            <?= $cat ?>
        </button>
        <?php endforeach; ?>
        <div class="search-wrap">
            <input type="text" id="searchInput" placeholder="Buscar..." oninput="buscar(this.value)">
        </div>
    </div>

    <div class="gallery" id="gallery">
        <?php foreach ($imagenes as $i => $img): ?>
        <div class="img-card" data-cat="<?= $img['cat'] ?? 'General' ?>" data-name="<?= strtolower($img['name']) ?>"
             onclick="openLightbox(<?= $i ?>)">
            <img src="<?= isset($img['thumb']) ? $img['thumb'] : $img['src'] ?>" 
                 alt="<?= htmlspecialchars($img['name']) ?>" loading="lazy">
            <div class="img-info">
                <div class="img-name"><?= htmlspecialchars($img['name']) ?></div>
                <div class="img-meta">
                    <?php if (!empty($img['cat'])): ?>
                    <span class="img-cat"><?= $img['cat'] ?></span>
                    <?php endif; ?>
                    <span class="img-type"><?= $img['type'] ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div id="noResults" class="no-results" style="display:none">No se encontraron imágenes.</div>
</main>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
    <div class="lb-inner" onclick="event.stopPropagation()">
        <img class="lb-img" id="lbImg" src="" alt="">
        <div class="lb-caption" id="lbCaption"></div>
    </div>
    <button class="lb-close" onclick="closeLightbox()">✕</button>
    <button class="lb-nav lb-prev" onclick="navLb(-1)">‹</button>
    <button class="lb-nav lb-next" onclick="navLb(+1)">›</button>
</div>

<script>
const imgs = <?= json_encode(array_map(fn($i) => ['src'=>$i['src'],'name'=>$i['name']], $imagenes)) ?>;
let currentIdx = 0;

function openLightbox(i) {
    currentIdx = i;
    document.getElementById('lbImg').src = imgs[i].src;
    document.getElementById('lbCaption').textContent = imgs[i].name;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox(e) {
    if (!e || e.target === document.getElementById('lightbox')) {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
}
function navLb(dir) {
    currentIdx = (currentIdx + dir + imgs.length) % imgs.length;
    document.getElementById('lbImg').style.opacity = '0';
    setTimeout(() => {
        document.getElementById('lbImg').src = imgs[currentIdx].src;
        document.getElementById('lbCaption').textContent = imgs[currentIdx].name;
        document.getElementById('lbImg').style.opacity = '1';
    }, 150);
}
document.addEventListener('keydown', e => {
    if (!document.getElementById('lightbox').classList.contains('open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') navLb(-1);
    if (e.key === 'ArrowRight') navLb(+1);
});
document.getElementById('lbImg').style.transition = 'opacity .15s';

// Filter
function filtrar(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.img-card').forEach(card => {
        const match = cat === 'Todas' || card.dataset.cat === cat;
        card.style.display = match ? '' : 'none';
    });
    checkEmpty();
}
function buscar(q) {
    q = q.toLowerCase();
    document.querySelectorAll('.img-card').forEach(card => {
        card.style.display = card.dataset.name.includes(q) ? '' : 'none';
    });
    checkEmpty();
}
function checkEmpty() {
    const visible = [...document.querySelectorAll('.img-card')].filter(c => c.style.display !== 'none');
    document.getElementById('noResults').style.display = visible.length ? 'none' : 'block';
}
</script>
</body>
</html>
