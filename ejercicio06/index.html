<?php
session_start();

// ===== USUARIOS (sin MySQL — arreglo PHP como pide la rúbrica) =====
$usuarios = [
    ['usuario' => 'admin',    'password' => 'admin123',   'nombre' => 'Administrador', 'rol' => 'Admin'],
    ['usuario' => 'joberzam', 'password' => 'pass123',    'nombre' => 'Joberzam',      'rol' => 'Editor'],
    ['usuario' => 'demo',     'password' => 'demo123',    'nombre' => 'Usuario Demo',  'rol' => 'Lector'],
];

$error = null;

// LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// LOGIN
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['usuario'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    if (empty($user) || empty($pass)) {
        $error = 'Completa todos los campos.';
    } else {
        $found = null;
        foreach ($usuarios as $u) {
            if ($u['usuario'] === $user && $u['password'] === $pass) {
                $found = $u;
                break;
            }
        }
        if ($found) {
            $_SESSION['autenticado'] = true;
            $_SESSION['usuario']     = $found['usuario'];
            $_SESSION['nombre']      = $found['nombre'];
            $_SESSION['rol']         = $found['rol'];
            $_SESSION['login_time']  = date('d/m/Y H:i:s');
            header('Location: index.php');
            exit;
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
    }
}

$loggedIn = !empty($_SESSION['autenticado']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 – Sistema de Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #030712;
            --surface: #0f172a;
            --surface2: #1e293b;
            --border: #1e3a5f;
            --accent: #0ea5e9;
            --accent2: #38bdf8;
            --text: #f1f5f9;
            --muted: #64748b;
            --success: #4ade80;
            --error: #f87171;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Syne',sans-serif; background:var(--bg); color:var(--text); min-height:100vh; }
        body::before {
            content:'';
            position:fixed;
            inset:0;
            background: radial-gradient(ellipse at 20% 50%, rgba(14,165,233,.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 20%, rgba(56,189,248,.05) 0%, transparent 50%);
            pointer-events:none;
        }
        header { border-bottom:1px solid var(--border); padding:1.2rem 2rem; display:flex; justify-content:space-between; align-items:center; position:relative; z-index:1; }
        .logo { font-family:'Space Mono',monospace; font-size:.9rem; color:var(--accent2); }
        .back { font-family:'Space Mono',monospace; font-size:.75rem; color:var(--muted); text-decoration:none; border:1px solid var(--border); padding:.4rem .9rem; border-radius:8px; transition:all .2s; }
        .back:hover { border-color:var(--accent); color:var(--text); }

        main { position:relative; z-index:1; }

        /* ===== LOGIN FORM ===== */
        .login-wrap {
            display:flex;
            min-height:calc(100vh - 57px);
            align-items:center;
            justify-content:center;
            padding:2rem;
        }
        .login-box {
            width:100%;
            max-width:440px;
        }
        .login-icon {
            width:60px; height:60px;
            background:linear-gradient(135deg, var(--accent), #0369a1);
            border-radius:16px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:1.6rem;
            margin-bottom:1.5rem;
            box-shadow:0 8px 20px rgba(14,165,233,.3);
        }
        .tag { font-family:'Space Mono',monospace; font-size:.7rem; color:var(--accent2); letter-spacing:.2em; text-transform:uppercase; margin-bottom:.5rem; }
        h1 { font-size:2rem; font-weight:800; margin-bottom:.5rem; }
        .sub { color:var(--muted); font-size:.9rem; margin-bottom:2rem; }

        .demo-hint {
            background:rgba(56,189,248,.08);
            border:1px solid rgba(56,189,248,.2);
            border-radius:10px;
            padding:1rem;
            font-family:'Space Mono',monospace;
            font-size:.75rem;
            color:var(--muted);
            margin-bottom:1.5rem;
            line-height:1.9;
        }
        .demo-hint strong { color:var(--accent2); }

        form { display:flex; flex-direction:column; gap:1.2rem; }
        .field { display:flex; flex-direction:column; gap:.4rem; }
        label { font-size:.82rem; font-weight:700; letter-spacing:.04em; }
        .input-wrap { position:relative; }
        .input-wrap .icon {
            position:absolute;
            left:1rem; top:50%;
            transform:translateY(-50%);
            font-size:.9rem;
            color:var(--muted);
        }
        input {
            width:100%;
            background:var(--surface);
            border:1px solid var(--border);
            border-radius:10px;
            padding:.9rem 1rem .9rem 2.8rem;
            color:var(--text);
            font:inherit;
            font-size:.95rem;
            outline:none;
            transition:border-color .2s, box-shadow .2s;
        }
        input:focus { border-color:var(--accent2); box-shadow:0 0 0 3px rgba(56,189,248,.15); }
        input.err { border-color:var(--error); box-shadow:0 0 0 3px rgba(248,113,113,.15); }

        .toggle-pass {
            position:absolute;
            right:.8rem; top:50%;
            transform:translateY(-50%);
            background:none;
            border:none;
            color:var(--muted);
            cursor:pointer;
            font-size:.9rem;
            padding:.3rem;
            transition:color .2s;
        }
        .toggle-pass:hover { color:var(--text); }

        .error-box {
            background:rgba(248,113,113,.1);
            border:1px solid rgba(248,113,113,.3);
            border-radius:10px;
            padding:.9rem 1.1rem;
            font-size:.85rem;
            color:var(--error);
            display:flex;
            align-items:center;
            gap:.6rem;
            animation:shake .4s ease;
        }
        @keyframes shake {0%,100%{transform:translateX(0)}20%{transform:translateX(-6px)}40%{transform:translateX(6px)}60%{transform:translateX(-4px)}80%{transform:translateX(4px)}}

        button[type="submit"] {
            background:linear-gradient(135deg, var(--accent), #0369a1);
            color:#fff;
            border:none;
            border-radius:10px;
            padding:1rem;
            font:inherit;
            font-size:1rem;
            font-weight:700;
            cursor:pointer;
            transition:all .2s;
        }
        button[type="submit"]:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(14,165,233,.4); }

        /* ===== DASHBOARD ===== */
        .dashboard {
            max-width:900px;
            margin:0 auto;
            padding:3rem 1.5rem;
        }
        .welcome-header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:2.5rem;
            flex-wrap:wrap;
            gap:1rem;
        }
        .welcome-header h1 { font-size:2rem; }
        .welcome-header h1 span { color:var(--accent2); }
        .logout-btn {
            font-family:'Space Mono',monospace;
            font-size:.75rem;
            color:var(--error);
            text-decoration:none;
            border:1px solid rgba(248,113,113,.3);
            padding:.5rem 1rem;
            border-radius:8px;
            transition:all .2s;
        }
        .logout-btn:hover { background:rgba(248,113,113,.1); border-color:var(--error); }

        .session-info {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));
            gap:1rem;
            margin-bottom:2.5rem;
        }
        .s-card {
            background:var(--surface);
            border:1px solid var(--border);
            border-radius:12px;
            padding:1.3rem;
        }
        .s-card .label { font-size:.72rem; color:var(--muted); letter-spacing:.1em; text-transform:uppercase; margin-bottom:.4rem; font-family:'Space Mono',monospace; }
        .s-card .val { font-size:1rem; font-weight:700; color:var(--text); }
        .s-card .val.rol-admin { color:var(--accent2); }
        .s-card .val.rol-editor { color:#a78bfa; }
        .s-card .val.rol-lector { color:var(--success); }

        .users-table-wrap {
            background:var(--surface);
            border:1px solid var(--border);
            border-radius:14px;
            overflow:hidden;
        }
        .table-header {
            padding:1.2rem 1.5rem;
            border-bottom:1px solid var(--border);
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .table-header h3 { font-size:.95rem; }
        .table-header span { font-family:'Space Mono',monospace; font-size:.7rem; color:var(--muted); }
        table { width:100%; border-collapse:collapse; }
        th { padding:.8rem 1.2rem; text-align:left; font-size:.75rem; color:var(--muted); letter-spacing:.08em; text-transform:uppercase; font-family:'Space Mono',monospace; border-bottom:1px solid var(--border); }
        td { padding:.9rem 1.2rem; font-size:.9rem; border-bottom:1px solid rgba(30,58,95,.5); }
        tr:last-child td { border-bottom:none; }
        tr:hover td { background:rgba(14,165,233,.04); }
        .rol-badge {
            display:inline-block;
            padding:.2rem .7rem;
            border-radius:6px;
            font-family:'Space Mono',monospace;
            font-size:.7rem;
            font-weight:700;
        }
        .rol-badge.admin  { background:rgba(56,189,248,.15); color:var(--accent2); border:1px solid rgba(56,189,248,.3); }
        .rol-badge.editor { background:rgba(167,139,250,.15); color:#a78bfa; border:1px solid rgba(167,139,250,.3); }
        .rol-badge.lector { background:rgba(74,222,128,.1); color:var(--success); border:1px solid rgba(74,222,128,.3); }
        .you-badge { font-family:'Space Mono',monospace; font-size:.65rem; color:var(--accent); background:rgba(14,165,233,.1); border:1px solid rgba(14,165,233,.2); border-radius:4px; padding:.1rem .4rem; margin-left:.5rem; }
    </style>
</head>
<body>
<header>
    <div class="logo">Jhonny Bermudez</div>
    <a href="../index.php" class="back">← Volver</a>
</header>
<main>
<?php if (!$loggedIn): ?>
<!-- ===== LOGIN ===== -->
<div class="login-wrap">
    <div class="login-box">
        <div class="login-icon">🔐</div>
        <p class="tag">// Ejercicio 06</p>
        <h1>Iniciar sesión</h1>
        <p class="sub">Sistema de autenticación con PHP y arreglo de usuarios.</p>

        <div class="demo-hint">
            Usuarios de prueba:<br>
            <strong>admin</strong> / admin123 &nbsp;·&nbsp;
            <strong>joberzam</strong> / pass123 &nbsp;·&nbsp;
            <strong>demo</strong> / demo123
        </div>

        <?php if ($error): ?>
        <div class="error-box">⚠ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" id="loginForm">
            <div class="field">
                <label for="usuario">Usuario</label>
                <div class="input-wrap">
                    <span class="icon">👤</span>
                    <input type="text" id="usuario" name="usuario"
                           value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>"
                           placeholder="Ej: admin"
                           autocomplete="username"
                           class="<?= $error ? 'err' : '' ?>" required>
                </div>
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <div class="input-wrap">
                    <span class="icon">🔑</span>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           autocomplete="current-password"
                           class="<?= $error ? 'err' : '' ?>" required>
                    <button type="button" class="toggle-pass" onclick="togglePass()" title="Mostrar contraseña">👁</button>
                </div>
            </div>
            <button type="submit">Ingresar al sistema</button>
        </form>
    </div>
</div>

<?php else: ?>
<!-- ===== DASHBOARD ===== -->
<div class="dashboard">
    <div class="welcome-header">
        <div>
            <p class="tag">// Dashboard</p>
            <h1>Hola, <span><?= htmlspecialchars($_SESSION['nombre']) ?></span> 👋</h1>
        </div>
        <a href="?logout=1" class="logout-btn">Cerrar sesión →</a>
    </div>

    <div class="session-info">
        <div class="s-card">
            <div class="label">Usuario</div>
            <div class="val"><?= htmlspecialchars($_SESSION['usuario']) ?></div>
        </div>
        <div class="s-card">
            <div class="label">Rol</div>
            <div class="val rol-<?= strtolower($_SESSION['rol']) ?>"><?= $_SESSION['rol'] ?></div>
        </div>
        <div class="s-card">
            <div class="label">Sesión iniciada</div>
            <div class="val"><?= $_SESSION['login_time'] ?></div>
        </div>
        <div class="s-card">
            <div class="label">Estado</div>
            <div class="val" style="color:var(--success)">● Autenticado</div>
        </div>
    </div>

    <div class="users-table-wrap">
        <div class="table-header">
            <h3>Usuarios del sistema</h3>
            <span><?= count($usuarios) ?> registros</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $i => $u): ?>
            <tr>
                <td style="color:var(--muted);font-family:'Space Mono',monospace;font-size:.8rem"><?= $i+1 ?></td>
                <td style="font-family:'Space Mono',monospace">
                    <?= htmlspecialchars($u['usuario']) ?>
                    <?php if ($u['usuario'] === $_SESSION['usuario']): ?>
                    <span class="you-badge">tú</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td>
                    <span class="rol-badge <?= strtolower($u['rol']) ?>"><?= $u['rol'] ?></span>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
</main>

<script>
function togglePass() {
    const inp = document.getElementById('password');
    inp.type = inp.type === 'password' ? 'text' : 'password';
}
// JS validation
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    const u = document.getElementById('usuario').value.trim();
    const p = document.getElementById('password').value.trim();
    if (!u || !p) {
        e.preventDefault();
        if (!u) document.getElementById('usuario').classList.add('err');
        if (!p) document.getElementById('password').classList.add('err');
    }
});
['usuario','password'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', function() {
        this.classList.remove('err');
    });
});
</script>
</body>
</html>
