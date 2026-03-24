<?php
$ejercicios = [
    1 => ["título" => "Menú Desplegable", "desc" => "Navegación con submenús interactivos", "icon" => "☰"],
    2 => ["título" => "Formulario de Contacto", "desc" => "Formulario con validación JS", "icon" => "✉"],
    3 => ["título" => "Contador de Visitas", "desc" => "Contador persistente con PHP", "icon" => "👁"],
    4 => ["título" => "Juego de Adivinanzas", "desc" => "Adivina el número secreto", "icon" => "🎲"],
    5 => ["título" => "Galería de Imágenes", "desc" => "Galería dinámica con PHP", "icon" => "🖼"],
    6 => ["título" => "Sistema de Login", "desc" => "Autenticación con PHP", "icon" => "🔐"],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea # 3 - Programación Web | Jhonny Bermudez</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0f;
            --surface: #12121a;
            --border: #2a2a3a;
            --accent: #7c3aed;
            --accent2: #06b6d4;
            --text: #e2e8f0;
            --muted: #64748b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Syne', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }
        /* Animated background */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(124,58,237,.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 20%, rgba(6,182,212,.06) 0%, transparent 50%);
            animation: drift 20s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }
        @keyframes drift {
            0% { transform: translate(0,0) rotate(0deg); }
            100% { transform: translate(2%,2%) rotate(1deg); }
        }
        header {
            position: relative;
            z-index: 1;
            border-bottom: 1px solid var(--border);
            padding: 2rem 4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            font-family: 'Space Mono', monospace;
            font-size: 1.1rem;
            color: var(--accent2);
            letter-spacing: 0.1em;
        }
        .logo span { color: var(--accent); }
        .badge {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            padding: 0.3rem 0.8rem;
            border: 1px solid var(--border);
            border-radius: 100px;
            color: var(--muted);
        }
        main {
            position: relative;
            z-index: 1;
            max-width: 1100px;
            margin: 0 auto;
            padding: 5rem 2rem;
        }
        .hero {
            text-align: center;
            margin-bottom: 5rem;
        }
        .hero-tag {
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
            color: var(--accent2);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }
        h1 {
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 800;
            line-height: 1.05;
            background: linear-gradient(135deg, #fff 0%, var(--accent2) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
        }
        .hero p {
            color: var(--muted);
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.7;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .card {
            display: block;
            text-decoration: none;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(.4,0,.2,1);
            position: relative;
            overflow: hidden;
            color: var(--text);
        }
        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(124,58,237,.08), rgba(6,182,212,.04));
            opacity: 0;
            transition: opacity 0.3s;
        }
        .card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(124,58,237,.2);
        }
        .card:hover::before { opacity: 1; }
        .card-num {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
        }
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
        }
        .card h2 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .card p {
            font-size: 0.9rem;
            color: var(--muted);
            line-height: 1.6;
        }
        .card-arrow {
            position: absolute;
            bottom: 1.5rem;
            right: 1.5rem;
            font-size: 1.2rem;
            color: var(--accent);
            opacity: 0;
            transition: all 0.3s;
            transform: translateX(-8px);
        }
        .card:hover .card-arrow {
            opacity: 1;
            transform: translateX(0);
        }
        footer {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 2rem;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
        }
        footer a { color: var(--accent2); text-decoration: none; }
    </style>
</head>
<body>
<header>
    <div class="logo"><span>Jhonny </span>Bermudez</div>
    <div class="badge">Tarea 3 · Programación Web</div>
</header>
<main>
    <div class="hero">
        <p class="hero-tag">// HTML · CSS · JavaScript · PHP</p>
        <h1>Programación<br>Web</h1>
        <p>Colección de ejercicios prácticos aplicando tecnologías fundamentales del desarrollo web front-end y back-end.</p>
    </div>
    <div class="grid">
        <?php foreach ($ejercicios as $num => $e): ?>
        <a class="card" href="ejercicio0<?= $num ?>/index.php">
            <div class="card-num">// EJERCICIO <?= str_pad($num,2,'0',STR_PAD_LEFT) ?></div>
            <span class="card-icon"><?= $e['icon'] ?></span>
            <h2><?= $e['título'] ?></h2>
            <p><?= $e['desc'] ?></p>
            <span class="card-arrow">→</span>
        </a>
        <?php endforeach; ?>
    </div>
</main>
<footer>
    <p>github.com/<a href="https://github.com/joberzam/pwatarea3" target="_blank">joberzam</a>/pwatarea3 &nbsp;·&nbsp; Programación Web <?= date('Y') ?></p>
</footer>
</body>
</html>
