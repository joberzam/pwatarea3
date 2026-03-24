<?php
// Contador de visitas usando archivo de texto como almacenamiento persistente
$archivo = __DIR__ . '/visitas.txt';

// Leer visitas actuales
$visitas = 0;
if (file_exists($archivo)) {
    $visitas = (int) file_get_contents($archivo);
}

// Incrementar en cada visita (solo si no es recarga en la misma sesión)
session_start();
if (empty($_SESSION['visitado'])) {
    $visitas++;
    file_put_contents($archivo, $visitas);
    $_SESSION['visitado'] = true;
    $nueva = true;
} else {
    $nueva = false;
}

// Reset manual
if (isset($_GET['reset'])) {
    file_put_contents($archivo, 0);
    unset($_SESSION['visitado']);
    header('Location: index.php');
    exit;
}

// Datos de ejemplo para el historial visual
$hora = date('H:i:s');
$fecha = date('d/m/Y');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 – Contador de Visitas</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #040a14;
            --surface: #0d1b2a;
            --surface2: #112236;
            --border: #1e3a5f;
            --accent: #3b82f6;
            --accent2: #38bdf8;
            --text: #e2e8f0;
            --muted: #64748b;
            --glow: rgba(59,130,246,.3);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Syne', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse at 50% 0%, rgba(59,130,246,.12) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 80%, rgba(56,189,248,.06) 0%, transparent 50%);
            pointer-events: none;
        }
        header {
            border-bottom: 1px solid var(--border);
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        .logo { font-family: 'Space Mono', monospace; font-size: 0.9rem; color: var(--accent2); }
        .back { font-family: 'Space Mono', monospace; font-size: 0.75rem; color: var(--muted); text-decoration: none; border: 1px solid var(--border); padding: .4rem .9rem; border-radius: 8px; transition: all .2s; }
        .back:hover { border-color: var(--accent); color: var(--text); }
        main {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
            padding: 4rem 2rem;
            text-align: center;
        }
        .tag { font-family: 'Space Mono', monospace; font-size: .7rem; color: var(--accent2); letter-spacing: .2em; text-transform: uppercase; margin-bottom: 1rem; }
        h1 { font-size: 2rem; font-weight: 800; margin-bottom: 3rem; }

        /* BIG COUNTER */
        .counter-display {
            position: relative;
            margin: 0 auto 3rem;
            width: 280px;
            height: 280px;
        }
        .counter-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid var(--border);
            animation: spinRing 20s linear infinite;
        }
        .counter-ring::before {
            content: '';
            position: absolute;
            top: -2px; left: 30%;
            width: 40%;
            height: 4px;
            background: var(--accent);
            border-radius: 4px;
            box-shadow: 0 0 12px var(--accent), 0 0 24px var(--glow);
        }
        @keyframes spinRing { to { transform: rotate(360deg); } }
        .counter-inner {
            position: absolute;
            inset: 16px;
            background: var(--surface);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            box-shadow: inset 0 0 40px rgba(59,130,246,.1);
        }
        .counter-num {
            font-family: 'Space Mono', monospace;
            font-size: clamp(3rem, 10vw, 5rem);
            font-weight: 700;
            color: var(--accent2);
            line-height: 1;
            text-shadow: 0 0 20px rgba(56,189,248,.5);
            animation: <?= $nueva ? 'countUp .5s ease' : 'none' ?>;
        }
        @keyframes countUp {
            0% { transform: scale(1.3); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .counter-label {
            font-size: .75rem;
            color: var(--muted);
            letter-spacing: .15em;
            text-transform: uppercase;
            margin-top: .4rem;
        }

        /* STATUS BADGE */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: .5rem 1.2rem;
            border-radius: 100px;
            font-family: 'Space Mono', monospace;
            font-size: .75rem;
            margin-bottom: 2.5rem;
            animation: fadeIn .5s .3s both;
        }
        .badge.nueva { background: rgba(74,222,128,.1); border: 1px solid rgba(74,222,128,.3); color: #4ade80; }
        .badge.repeat { background: rgba(100,116,139,.1); border: 1px solid rgba(100,116,139,.3); color: var(--muted); }
        .badge::before {
            content: '';
            width: 7px; height: 7px;
            border-radius: 50%;
            background: currentColor;
            animation: pulse 2s infinite;
        }
        @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:.3; } }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

        /* INFO GRID */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.2rem;
        }
        .info-card .val {
            font-family: 'Space Mono', monospace;
            font-size: 1rem;
            color: var(--accent2);
            font-weight: 700;
            margin-bottom: .3rem;
        }
        .info-card .lbl { font-size: .75rem; color: var(--muted); }

        /* ACTIONS */
        .actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
        .btn {
            padding: .8rem 1.8rem;
            border-radius: 10px;
            font: inherit;
            font-size: .9rem;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: all .2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #2563eb; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(59,130,246,.4); }
        .btn-ghost { background: var(--surface); border: 1px solid var(--border); color: var(--muted); }
        .btn-ghost:hover { border-color: var(--accent); color: var(--text); }
        .btn-danger { background: rgba(248,113,113,.1); border: 1px solid rgba(248,113,113,.3); color: #f87171; }
        .btn-danger:hover { background: rgba(248,113,113,.2); }

        .php-note {
            margin-top: 2rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-left: 3px solid var(--accent);
            border-radius: 12px;
            padding: 1.2rem;
            font-family: 'Space Mono', monospace;
            font-size: .75rem;
            color: var(--muted);
            text-align: left;
            line-height: 1.9;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">Jhonny Bermudez</div>
    <a href="../index.php" class="back">← Volver</a>
</header>
<main>
    <p class="tag">// Ejercicio 03</p>
    <h1>Contador de Visitas</h1>

    <div class="badge <?= $nueva ? 'nueva' : 'repeat' ?>">
        <?= $nueva ? '✓ Nueva visita registrada' : '↺ Sesión activa (no contada dos veces)' ?>
    </div>

    <div class="counter-display">
        <div class="counter-ring"></div>
        <div class="counter-inner">
            <div class="counter-num"><?= number_format($visitas) ?></div>
            <div class="counter-label">Visitas totales</div>
        </div>
    </div>

    <div class="info-grid">
        <div class="info-card">
            <div class="val"><?= $hora ?></div>
            <div class="lbl">Hora actual</div>
        </div>
        <div class="info-card">
            <div class="val"><?= $fecha ?></div>
            <div class="lbl">Fecha</div>
        </div>
        <div class="info-card">
            <div class="val"><?= $nueva ? '+1' : '=0' ?></div>
            <div class="lbl">Esta sesión</div>
        </div>
    </div>

    <div class="actions">
        <a href="index.php" class="btn btn-primary">Simular nueva visita</a>
        <a href="?reset=1" class="btn btn-danger"
           onclick="return confirm('¿Resetear el contador a 0?')">Resetear contador</a>
    </div>

</main>
</body>
</html>
