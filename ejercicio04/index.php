<?php
session_start();

// Inicializar o reiniciar juego
if (!isset($_SESSION['numero']) || isset($_GET['nuevo'])) {
    $_SESSION['numero']   = rand(1, 100);
    $_SESSION['intentos'] = 0;
    $_SESSION['historial'] = [];
    $_SESSION['ganado']   = false;
}

$feedback = null;
$ganado = $_SESSION['ganado'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$ganado) {
    $intento = intval($_POST['numero'] ?? 0);

    if ($intento < 1 || $intento > 100) {
        $feedback = ['tipo' => 'error', 'msg' => 'Ingresa un número entre 1 y 100.'];
    } else {
        $_SESSION['intentos']++;
        $secreto = $_SESSION['numero'];

        if ($intento === $secreto) {
            $feedback = ['tipo' => 'win', 'msg' => "¡Correcto! El número era $secreto."];
            $_SESSION['ganado'] = true;
            $ganado = true;
        } elseif ($intento < $secreto) {
            $diff = $secreto - $intento;
            $pista = $diff <= 5 ? '🔥 ¡Muy cerca! Sube un poco.' : ($diff <= 15 ? '↑ Más alto.' : '⬆ Mucho más alto.');
            $feedback = ['tipo' => 'alto', 'msg' => $pista];
        } else {
            $diff = $intento - $secreto;
            $pista = $diff <= 5 ? '🔥 ¡Muy cerca! Baja un poco.' : ($diff <= 15 ? '↓ Más bajo.' : '⬇ Mucho más bajo.');
            $feedback = ['tipo' => 'bajo', 'msg' => $pista];
        }

        // Guardar en historial
        array_unshift($_SESSION['historial'], [
            'num'   => $intento,
            'tipo'  => $feedback['tipo'],
            'intento' => $_SESSION['intentos'],
        ]);
    }
}

$intentos = $_SESSION['intentos'];
$historial = array_slice($_SESSION['historial'], 0, 10);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 – Juego de Adivinanzas</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0f0a1a;
            --surface: #17102a;
            --surface2: #1f183a;
            --border: #2d2050;
            --accent: #a855f7;
            --accent2: #e879f9;
            --text: #f0e6ff;
            --muted: #7c6ba0;
            --win: #4ade80;
            --hot: #fb923c;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Syne',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }
        body::before {
            content:'';
            position:fixed;
            inset:0;
            background: radial-gradient(ellipse at 30% 20%, rgba(168,85,247,.1) 0%, transparent 50%),
                        radial-gradient(ellipse at 70% 80%, rgba(232,121,249,.06) 0%, transparent 50%);
            pointer-events:none;
        }
        header { border-bottom:1px solid var(--border); padding:1.2rem 2rem; display:flex; justify-content:space-between; align-items:center; position:relative; z-index:1; }
        .logo { font-family:'Space Mono',monospace; font-size:.9rem; color:var(--accent2); }
        .back { font-family:'Space Mono',monospace; font-size:.75rem; color:var(--muted); text-decoration:none; border:1px solid var(--border); padding:.4rem .9rem; border-radius:8px; transition:all .2s; }
        .back:hover { border-color:var(--accent); color:var(--text); }

        main { position:relative; z-index:1; max-width:620px; margin:0 auto; padding:3.5rem 1.5rem; }
        .tag { font-family:'Space Mono',monospace; font-size:.7rem; color:var(--accent2); letter-spacing:.2em; text-transform:uppercase; margin-bottom:.8rem; }
        h1 { font-size:2.2rem; font-weight:800; margin-bottom:.5rem; }
        .sub { color:var(--muted); font-size:.9rem; margin-bottom:2rem; }

        /* RANGE BAR */
        .range-bar {
            background: var(--surface);
            border:1px solid var(--border);
            border-radius:12px;
            padding:1.2rem 1.5rem;
            margin-bottom:1.5rem;
            display:flex;
            align-items:center;
            gap:1rem;
        }
        .range-label { font-family:'Space Mono',monospace; font-size:.75rem; color:var(--muted); white-space:nowrap; }
        .range-track {
            flex:1;
            height:6px;
            background:var(--border);
            border-radius:3px;
            position:relative;
        }
        .range-fill {
            position:absolute;
            left:0; top:0; bottom:0;
            background:linear-gradient(90deg, var(--accent), var(--accent2));
            border-radius:3px;
            transition:width .5s ease;
        }

        /* INPUT AREA */
        .game-box {
            background:var(--surface);
            border:1px solid var(--border);
            border-radius:16px;
            padding:2rem;
            margin-bottom:1.5rem;
        }
        .attempts-badge {
            display:inline-flex;
            align-items:center;
            gap:8px;
            font-family:'Space Mono',monospace;
            font-size:.8rem;
            color:var(--accent);
            background:rgba(168,85,247,.1);
            border:1px solid rgba(168,85,247,.3);
            padding:.3rem .9rem;
            border-radius:100px;
            margin-bottom:1.5rem;
        }
        .input-row { display:flex; gap:.8rem; }
        input[type="number"] {
            flex:1;
            background:var(--surface2);
            border:1px solid var(--border);
            border-radius:10px;
            padding:1rem 1.2rem;
            color:var(--text);
            font-family:'Space Mono',monospace;
            font-size:1.5rem;
            font-weight:700;
            text-align:center;
            outline:none;
            transition:border-color .2s, box-shadow .2s;
            -moz-appearance:textfield;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button { -webkit-appearance:none; }
        input[type="number"]:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(168,85,247,.2); }
        input[type="number"]:disabled { opacity:.5; }
        button.guess-btn {
            background:linear-gradient(135deg, var(--accent), #7c3aed);
            color:#fff;
            border:none;
            border-radius:10px;
            padding:1rem 1.8rem;
            font:inherit;
            font-size:1rem;
            font-weight:700;
            cursor:pointer;
            transition:all .2s;
            white-space:nowrap;
        }
        button.guess-btn:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(168,85,247,.4); }
        button.guess-btn:disabled { opacity:.5; cursor:not-allowed; transform:none; }

        /* FEEDBACK */
        .feedback {
            text-align:center;
            padding:1rem;
            border-radius:10px;
            font-size:1.1rem;
            font-weight:700;
            margin-top:1rem;
            animation:popIn .3s cubic-bezier(.4,0,.2,1);
        }
        @keyframes popIn { from{transform:scale(.8);opacity:0;} to{transform:scale(1);opacity:1;} }
        .feedback.alto { background:rgba(251,146,60,.1); border:1px solid rgba(251,146,60,.3); color:var(--hot); }
        .feedback.bajo  { background:rgba(96,165,250,.1); border:1px solid rgba(96,165,250,.3); color:#60a5fa; }
        .feedback.win   { background:rgba(74,222,128,.1); border:1px solid rgba(74,222,128,.3); color:var(--win); font-size:1.3rem; }
        .feedback.error { background:rgba(248,113,113,.1); border:1px solid rgba(248,113,113,.3); color:#f87171; }

        /* WIN SCREEN */
        .win-screen {
            text-align:center;
            padding:2rem;
            background:var(--surface);
            border:1px solid rgba(74,222,128,.3);
            border-radius:16px;
            animation:fadeIn .5s ease;
        }
        @keyframes fadeIn { from{opacity:0;transform:translateY(10px);} to{opacity:1;transform:none;} }
        .win-screen .trophy { font-size:4rem; margin-bottom:1rem; }
        .win-screen h2 { font-size:1.8rem; color:var(--win); margin-bottom:.5rem; }
        .win-screen p { color:var(--muted); margin-bottom:1.5rem; }
        .win-screen .score {
            font-family:'Space Mono',monospace;
            font-size:3rem;
            color:var(--accent2);
            font-weight:700;
        }
        .win-screen .score-label { font-size:.8rem; color:var(--muted); margin-bottom:1.5rem; }

        /* HISTORY */
        .history-list { display:flex; flex-direction:column; gap:.5rem; margin-top:1.5rem; }
        .history-item {
            display:flex;
            align-items:center;
            gap:.8rem;
            padding:.6rem 1rem;
            border-radius:8px;
            font-family:'Space Mono',monospace;
            font-size:.8rem;
            background:var(--surface2);
            border:1px solid var(--border);
        }
        .history-item.win   { border-color:rgba(74,222,128,.3); }
        .history-item.alto  { border-color:rgba(251,146,60,.2); }
        .history-item.bajo  { border-color:rgba(96,165,250,.2); }
        .history-num { font-size:1.1rem; font-weight:700; color:var(--text); min-width:40px; }
        .history-icon { font-size:1rem; }
        .history-txt { flex:1; color:var(--muted); }
        .history-idx { color:var(--muted); font-size:.7rem; }

        a.btn {
            display:inline-block;
            background:linear-gradient(135deg, var(--accent), #7c3aed);
            color:#fff;
            text-decoration:none;
            border-radius:10px;
            padding:.8rem 2rem;
            font-weight:700;
            transition:all .2s;
        }
        a.btn:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(168,85,247,.4); }
    </style>
</head>
<body>
<header>
    <div class="logo">Jhonny Bermudez</div>
    <a href="../index.php" class="back">← Volver</a>
</header>
<main>
    <p class="tag">// Ejercicio 04</p>
    <h1>Adivina el Número</h1>
    <p class="sub">Tengo un número del 1 al 100. ¿Puedes adivinarlo? 🎲</p>

    <div class="range-bar">
        <span class="range-label">1</span>
        <div class="range-track">
            <div class="range-fill" id="progressFill" style="width:0%"></div>
        </div>
        <span class="range-label">100</span>
    </div>

    <?php if (!$ganado): ?>
    <div class="game-box">
        <div class="attempts-badge">🎯 Intento #<?= $intentos + 1 ?></div>
        <form method="POST" id="guessForm">
            <div class="input-row">
                <input type="number" id="num" name="numero" min="1" max="100" placeholder="?" autocomplete="off" autofocus required>
                <button type="submit" class="guess-btn">Adivinar</button>
            </div>
        </form>

        <?php if ($feedback): ?>
        <div class="feedback <?= $feedback['tipo'] ?>">
            <?= $feedback['msg'] ?>
        </div>
        <?php endif; ?>
    </div>

    <?php else: ?>
    <div class="win-screen">
        <div class="trophy">🏆</div>
        <h2>¡Lo lograste!</h2>
        <p>Adivinaste el número <strong><?= $_SESSION['numero'] ?></strong></p>
        <div class="score"><?= $intentos ?></div>
        <div class="score-label"><?= $intentos === 1 ? '¡Increíble! En 1 intento' : "intentos" ?></div>
        <a href="?nuevo=1" class="btn">Jugar de nuevo</a>
    </div>
    <?php endif; ?>

    <?php if (!empty($historial)): ?>
    <div class="history-list">
        <?php foreach ($historial as $h): ?>
        <?php
            $icon = match($h['tipo']) {
                'win'  => '✅',
                'alto' => '⬆️',
                'bajo' => '⬇️',
                default => '❓'
            };
            $txt = match($h['tipo']) {
                'win'  => '¡Correcto!',
                'alto' => 'Más alto',
                'bajo' => 'Más bajo',
                default => '?'
            };
        ?>
        <div class="history-item <?= $h['tipo'] ?>">
            <span class="history-num"><?= $h['num'] ?></span>
            <span class="history-icon"><?= $icon ?></span>
            <span class="history-txt"><?= $txt ?></span>
            <span class="history-idx">#<?= $h['intento'] ?></span>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div style="margin-top:1.5rem;text-align:right">
        <a href="?nuevo=1" style="font-family:'Space Mono',monospace;font-size:.75rem;color:var(--muted);text-decoration:none;border:1px solid var(--border);padding:.4rem .9rem;border-radius:8px;transition:all .2s;">
            ↺ Nuevo juego
        </a>
    </div>
</main>

<script>
// Visual progress bar based on history hints
(function() {
    const fill = document.getElementById('progressFill');
    if (!fill) return;
    <?php
    if (!empty($historial)) {
        // Calculate approximate range to show progress
        echo "const intentos = " . $intentos . ";";
        echo "const pct = Math.min(intentos * 10, 90);";
        echo "fill.style.width = pct + '%';";
    }
    ?>
})();

// Input: shake on invalid
const form = document.getElementById('guessForm');
form?.addEventListener('submit', function(e) {
    const val = parseInt(document.getElementById('num').value);
    if (isNaN(val) || val < 1 || val > 100) {
        e.preventDefault();
        const inp = document.getElementById('num');
        inp.style.animation = 'none';
        inp.offsetHeight;
        inp.style.animation = 'shake .4s ease';
    }
});
</script>
<style>
@keyframes shake {
    0%,100%{transform:translateX(0)}
    20%{transform:translateX(-8px)}
    40%{transform:translateX(8px)}
    60%{transform:translateX(-5px)}
    80%{transform:translateX(5px)}
}
</style>
</body>
</html>
