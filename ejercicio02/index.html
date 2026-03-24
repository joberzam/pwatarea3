<?php
$enviado = false;
$errores = [];
$datos = ['nombre' => '', 'email' => '', 'mensaje' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos['nombre']  = trim($_POST['nombre'] ?? '');
    $datos['email']   = trim($_POST['email'] ?? '');
    $datos['mensaje'] = trim($_POST['mensaje'] ?? '');

    if (empty($datos['nombre']))  $errores['nombre']  = 'El nombre es requerido.';
    if (empty($datos['email']))   $errores['email']   = 'El correo es requerido.';
    elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) $errores['email'] = 'Correo inválido.';
    if (empty($datos['mensaje'])) $errores['mensaje'] = 'El mensaje es requerido.';
    elseif (strlen($datos['mensaje']) < 10) $errores['mensaje'] = 'Mínimo 10 caracteres.';

    if (empty($errores)) {
        $enviado = true;
        $datos = ['nombre' => '', 'email' => '', 'mensaje' => ''];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 – Formulario de Contacto</title>
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
            --error: #f87171;
            --success: #4ade80;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Syne', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; flex-direction: column; }
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(ellipse at 70% 30%, rgba(124,58,237,.07) 0%, transparent 60%);
            pointer-events: none;
        }
        header {
            border-bottom: 1px solid var(--border);
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo { font-family: 'Space Mono', monospace; font-size: 0.9rem; color: var(--accent2); }
        .back { font-family: 'Space Mono', monospace; font-size: 0.75rem; color: var(--muted); text-decoration: none; border: 1px solid var(--border); padding: 0.4rem 0.9rem; border-radius: 8px; transition: all .2s; }
        .back:hover { border-color: var(--accent); color: var(--text); }

        main { flex: 1; display: flex; align-items: center; justify-content: center; padding: 3rem 1rem; }
        .wrapper { width: 100%; max-width: 560px; }
        .tag { font-family: 'Space Mono', monospace; font-size: 0.7rem; color: var(--accent2); letter-spacing: .2em; text-transform: uppercase; margin-bottom: 0.8rem; }
        h1 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem; }
        .sub { color: var(--muted); font-size: 0.95rem; margin-bottom: 2.5rem; line-height: 1.6; }

        /* SUCCESS */
        .success-box {
            background: rgba(74,222,128,.08);
            border: 1px solid rgba(74,222,128,.3);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            animation: fadeIn .4s ease;
        }
        .success-box .icon { font-size: 3rem; margin-bottom: 1rem; }
        .success-box h2 { color: var(--success); margin-bottom: 0.5rem; }
        .success-box p { color: var(--muted); font-size: 0.9rem; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:none; } }

        /* FORM */
        form { display: flex; flex-direction: column; gap: 1.5rem; }
        .field { display: flex; flex-direction: column; gap: 0.5rem; }
        label { font-size: 0.85rem; font-weight: 700; letter-spacing: 0.05em; color: var(--text); }
        label .req { color: var(--accent); }
        input, textarea {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.9rem 1rem;
            color: var(--text);
            font: inherit;
            font-size: 0.95rem;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            resize: vertical;
        }
        input:focus, textarea:focus { border-color: var(--accent2); box-shadow: 0 0 0 3px rgba(6,182,212,.15); }
        input.invalid, textarea.invalid { border-color: var(--error); box-shadow: 0 0 0 3px rgba(248,113,113,.15); }
        input.valid, textarea.valid { border-color: var(--success); }
        textarea { min-height: 130px; }
        .error-msg {
            font-size: 0.78rem;
            color: var(--error);
            font-family: 'Space Mono', monospace;
            display: flex;
            align-items: center;
            gap: 6px;
            min-height: 1rem;
        }
        .counter { font-size: 0.75rem; color: var(--muted); text-align: right; font-family: 'Space Mono', monospace; }
        .counter.warn { color: var(--error); }

        button[type="submit"] {
            background: linear-gradient(135deg, var(--accent), #5b21b6);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            font: inherit;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            position: relative;
            overflow: hidden;
        }
        button[type="submit"]:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(124,58,237,.4); }
        button[type="submit"]:active { transform: translateY(0); }
        button[type="submit"]:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        .php-errors {
            background: rgba(248,113,113,.08);
            border: 1px solid rgba(248,113,113,.3);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            font-size: 0.85rem;
            color: var(--error);
        }
    </style>
</head>
<body>
<header>
    <div class="logo">Jhonny Bermudez</div>
    <a href="../index.php" class="back">← Volver</a>
</header>
<main>
    <div class="wrapper">
        <p class="tag">// Ejercicio 02</p>
        <h1>Contáctanos</h1>
        <p class="sub">Validación de campos en tiempo real con JavaScript y validación segura en servidor con PHP.</p>

        <?php if ($enviado): ?>
        <div class="success-box">
            <div class="icon">✅</div>
            <h2>¡Mensaje enviado!</h2>
            <p>Gracias por escribirnos. Te responderemos pronto.</p>
            <a href="index.php" style="display:inline-block;margin-top:1rem;color:var(--accent2);font-family:'Space Mono',monospace;font-size:.8rem;">← Enviar otro</a>
        </div>
        <?php else: ?>

        <?php if (!empty($errores)): ?>
        <div class="php-errors">
            ⚠ Por favor corrige los errores antes de enviar.
        </div>
        <?php endif; ?>

        <form id="form" method="POST" action="" novalidate>
            <div class="field">
                <label for="nombre">Nombre completo <span class="req">*</span></label>
                <input type="text" id="nombre" name="nombre"
                       value="<?= htmlspecialchars($datos['nombre']) ?>"
                       placeholder="Ej: Juan Pérez"
                       class="<?= isset($errores['nombre']) ? 'invalid' : '' ?>">
                <span class="error-msg" id="err-nombre">
                    <?= $errores['nombre'] ?? '' ?>
                </span>
            </div>

            <div class="field">
                <label for="email">Correo electrónico <span class="req">*</span></label>
                <input type="email" id="email" name="email"
                       value="<?= htmlspecialchars($datos['email']) ?>"
                       placeholder="correo@ejemplo.com"
                       class="<?= isset($errores['email']) ? 'invalid' : '' ?>">
                <span class="error-msg" id="err-email">
                    <?= $errores['email'] ?? '' ?>
                </span>
            </div>

            <div class="field">
                <label for="mensaje">Mensaje <span class="req">*</span></label>
                <textarea id="mensaje" name="mensaje"
                          placeholder="Escribe tu mensaje aquí (mínimo 10 caracteres)..."
                          class="<?= isset($errores['mensaje']) ? 'invalid' : '' ?>"><?= htmlspecialchars($datos['mensaje']) ?></textarea>
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <span class="error-msg" id="err-mensaje"><?= $errores['mensaje'] ?? '' ?></span>
                    <span class="counter" id="counter">0 / 500</span>
                </div>
            </div>

            <button type="submit" id="btn">Enviar mensaje</button>
        </form>
        <?php endif; ?>
    </div>
</main>

<script>
const form    = document.getElementById('form');
const nombre  = document.getElementById('nombre');
const email   = document.getElementById('email');
const mensaje = document.getElementById('mensaje');
const counter = document.getElementById('counter');

// Live counter
mensaje?.addEventListener('input', () => {
    const len = mensaje.value.length;
    counter.textContent = `${len} / 500`;
    counter.className = 'counter' + (len > 450 ? ' warn' : '');
    if (len > 500) mensaje.value = mensaje.value.slice(0, 500);
});

// Field validators
function validateNombre() {
    const val = nombre.value.trim();
    if (!val) return setError(nombre, 'err-nombre', 'El nombre es requerido.');
    if (val.length < 2) return setError(nombre, 'err-nombre', 'Mínimo 2 caracteres.');
    return setOk(nombre, 'err-nombre');
}
function validateEmail() {
    const val = email.value.trim();
    if (!val) return setError(email, 'err-email', 'El correo es requerido.');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) return setError(email, 'err-email', 'Correo no válido.');
    return setOk(email, 'err-email');
}
function validateMensaje() {
    const val = mensaje.value.trim();
    if (!val) return setError(mensaje, 'err-mensaje', 'El mensaje es requerido.');
    if (val.length < 10) return setError(mensaje, 'err-mensaje', `Faltan ${10 - val.length} caracteres.`);
    return setOk(mensaje, 'err-mensaje');
}

function setError(field, errId, msg) {
    field.className = 'invalid';
    document.getElementById(errId).textContent = '⚠ ' + msg;
    return false;
}
function setOk(field, errId) {
    field.className = 'valid';
    document.getElementById(errId).textContent = '';
    return true;
}

// Blur listeners
nombre.addEventListener('blur', validateNombre);
email.addEventListener('blur', validateEmail);
mensaje.addEventListener('blur', validateMensaje);
nombre.addEventListener('input', validateNombre);
email.addEventListener('input', validateEmail);

// Submit
form?.addEventListener('submit', e => {
    const ok = [validateNombre(), validateEmail(), validateMensaje()].every(Boolean);
    if (!ok) {
        e.preventDefault();
        document.querySelector('.invalid')?.focus();
    }
});
</script>
</body>
</html>
