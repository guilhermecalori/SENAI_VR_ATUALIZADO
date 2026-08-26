<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config.php';

function render_login_icon(string $name, string $class = ''): string
{
    $base = 'aria-hidden="true" class="' . $class . '" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"';
    $icons = [
        'vrpano' => '<svg ' . $base . '><path d="M4 7.5C4 6.12 5.12 5 6.5 5h11C18.88 5 20 6.12 20 7.5v6c0 1.38-1.12 2.5-2.5 2.5H14l-2 2-2-2H6.5C5.12 16 4 14.88 4 13.5v-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 9.5h6M8.5 12h7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'alternate_email' => '<svg ' . $base . '><path d="M4.5 7.5A3.5 3.5 0 0 1 8 4h8a3.5 3.5 0 0 1 3.5 3.5v9A3.5 3.5 0 0 1 16 20H8a3.5 3.5 0 0 1-3.5-3.5v-9Z" stroke="currentColor" stroke-width="1.7"/><path d="M7.5 9.5h9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M7.5 12h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'lock' => '<svg ' . $base . '><path d="M8 11V8.5A4 4 0 0 1 16 8" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><rect x="6" y="11" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M12 14v2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'visibility' => '<svg ' . $base . '><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><circle cx="12" cy="12" r="2.8" stroke="currentColor" stroke-width="1.7"/></svg>',
        'visibility_off' => '<svg ' . $base . '><path d="m4 4 16 16" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M10.6 5.4A10 10 0 0 1 21.5 12s-3.5 6-9.5 6a10 10 0 0 1-4.1-.9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.4 8.2A3.8 3.8 0 0 0 7 12a4 4 0 0 0 5 3.9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>',
        'arrow_forward' => '<svg ' . $base . '><path d="m10 7 5 5-5 5M6 12h9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    ];

    return $icons[$name] ?? '';
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE (email = ? OR nome = ?) AND senha = ?");
    $stmt->execute([$usuario, $usuario, $senha]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['usuario_logado'] = true;
        $_SESSION['usuario_nome'] = $user['nome'];
        header('Location: public/home.php');
        exit();
    }

    $erro = 'Falha na autenticação. Verifique as credenciais.';
}

$icon_vrpano = render_login_icon('vrpano', 'w-6 h-6');
$icon_email = render_login_icon('alternate_email', 'w-5 h-5');
$icon_lock = render_login_icon('lock', 'w-5 h-5');
$icon_visibility = render_login_icon('visibility', 'w-5 h-5');
$icon_arrow = render_login_icon('arrow_forward', 'w-5 h-5');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI VR | Iniciar sessão</title>
    
    <!-- FORÇA SAIR DO LAYOUT SE ESTIVER CARREGADO DENTRO DE UMA CONTAINER/IFRAME DA PAINEL -->
    <script>
        if (window.top !== window.self || document.querySelector('.scroller-limpo')) {
            window.top.location.href = window.location.href;
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(8, 145, 178, 0.06), transparent 28%),
                radial-gradient(circle at top right, rgba(59, 130, 246, 0.04), transparent 24%),
                linear-gradient(180deg, #f0f9ff 0%, #f8fafc 100%);
        }

        .headline {
            font-family: 'Space Grotesk', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .input-dark {
            background: rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.10);
            color: #0f172a;
        }

        .input-dark:focus {
            border-color: rgba(8, 145, 178, 0.55);
            box-shadow: 0 0 0 4px rgba(8, 145, 178, 0.08);
            outline: none;
        }

        .grid-faint {
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.3), transparent 80%);
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen overflow-x-hidden">
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 grid-faint"></div>
        <div class="absolute top-1/4 left-1/4 w-80 h-80 bg-cyan-400/20 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-blue-500/15 blur-[120px] rounded-full"></div>
    </div>

    <main class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl grid lg:grid-cols-2 gap-10 items-center">
            <section class="hidden lg:block pr-6">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-slate-200 text-[10px] font-bold uppercase tracking-[0.25em] text-slate-500 mb-8">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Sistema Educacional SENAI
                </span>

                <h1 class="headline text-6xl xl:text-7xl font-bold tracking-tight leading-[0.95] mb-6 text-slate-900">
                    Entre na<br>
                    <span class="text-cyan-600">EDUCAÇÃO IMERSIVA</span>
                </h1>

                <p class="text-slate-500 text-lg max-w-xl leading-relaxed">
                    Acesso ao ambiente de aprendizagem virtual com uma interface limpa, rápida e preparada para uma experiência mais profissional.
                </p>

                <div class="mt-10 grid grid-cols-3 gap-4 max-w-xl">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-2">Estado</p>
                        <p class="font-semibold text-slate-800">ONLINE</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-2">Plataforma</p>
                        <p class="font-semibold text-slate-800">SENAI VR</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mb-2">Versão</p>
                        <p class="font-semibold text-slate-800">v2.4.0</p>
                    </div>
                </div>
            </section>

            <section class="flex justify-center lg:justify-end">
                <div class="glass-card w-full max-w-[460px] rounded-[2rem] p-6 sm:p-8 lg:p-10 relative overflow-hidden">
                    <div class="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-cyan-500 to-transparent"></div>

                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-11 h-11 rounded-2xl bg-cyan-50 border border-cyan-200 flex items-center justify-center text-cyan-600">
                                <?php echo $icon_vrpano; ?>
                            </div>
                            <div>
                                <h2 class="headline text-2xl font-bold tracking-tight text-slate-900">SENAI VR</h2>
                                <p class="text-sm text-slate-400">Preencha suas credenciais</p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" class="space-y-5">
                        <div class="space-y-2">
                            <label for="usuario" class="block text-xs uppercase tracking-[0.24em] font-bold text-cyan-600">
                                Nome de utilizador ou e-mail
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><?php echo $icon_email; ?></span>
                                <input
                                    id="usuario"
                                    name="usuario"
                                    type="text"
                                    autocomplete="username"
                                    required
                                    placeholder="exemplo@senai.com"
                                    class="w-full rounded-2xl input-dark px-12 py-4 placeholder:text-slate-400 transition-all"
                                >
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="senha" class="block text-xs uppercase tracking-[0.24em] font-bold text-cyan-600">
                                Chave de acesso
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"><?php echo $icon_lock; ?></span>
                                <input
                                    id="senha"
                                    name="senha"
                                    type="password"
                                    autocomplete="current-password"
                                    required
                                    placeholder="••••••••"
                                    class="w-full rounded-2xl input-dark px-12 pr-12 py-4 placeholder:text-slate-400 transition-all"
                                >
                                <button
                                    type="button"
                                    id="togglePassword"
                                    aria-label="Mostrar ou ocultar senha"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-cyan-600 transition-colors"
                                >
                                    <span id="toggleIcon"><?php echo $icon_visibility; ?></span>
                                </button>
                            </div>
                        </div>

                        <?php if ($erro): ?>
                            <div class="rounded-2xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                                <?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                        <?php endif; ?>

                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-cyan-600 hover:bg-cyan-500 text-white font-extrabold py-4 flex items-center justify-center gap-2 transition-all active:scale-[0.98] shadow-lg shadow-cyan-200"
                        >
                            Entrar
                            <span class="text-white"><?php echo $icon_arrow; ?></span>
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-slate-200 grid grid-cols-3 gap-3 text-[10px] uppercase tracking-[0.22em] text-slate-400">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            Seguro
                        </div>
                        <div class="text-center">PT-BR</div>
                        <div class="text-right">v2.4.0</div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('senha');
        const toggleIcon = document.getElementById('toggleIcon');
        const iconVisibility = <?php echo json_encode($icon_visibility); ?>;
        const iconVisibilityOff = <?php echo json_encode(render_login_icon('visibility_off', 'w-5 h-5')); ?>;

        togglePasswordButton?.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleIcon.innerHTML = isPassword ? iconVisibilityOff : iconVisibility;
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. FAZ A BOLINHA DO TOPO (SISTEMA EDUCACIONAL SENAI) PISCAR COM BRILHO NEON
            const bolinhasExistentes = document.querySelectorAll('.bg-emerald-500, .bg-green-500, span[class*="rounded-full"]');
            
            bolinhasExistentes.forEach(bolinha => {
                if (bolinha.offsetWidth <= 16 || bolinha.offsetHeight <= 16) {
                    bolinha.classList.add('animate-pulse');
                    bolinha.style.backgroundColor = '#10b981';
                    bolinha.style.boxShadow = '0 0 8px #10b981, 0 0 16px rgba(16, 185, 129, 0.8)';
                }
            });

            // 2. ADICIONA A BOLINHA VERDE NEON PISCANDO ANTES DA PALAVRA "ONLINE"
            const elementosTexto = document.querySelectorAll('span, p, div, b, strong, h1, h2, h3, h4');

            elementosTexto.forEach(el => {
                if (el.children.length === 0 && el.textContent) {
                    const texto = el.textContent.trim().toUpperCase();
                    
                    if (texto === 'ONLINE') {
                        if (!el.innerHTML.includes('dot-verde-solida')) {
                            const bolinhaHTML = `<span class="dot-verde-solida animate-pulse" style="
                                display: inline-block;
                                width: 10px;
                                height: 10px;
                                background-color: #10b981;
                                border-radius: 50%;
                                margin-right: 8px;
                                vertical-align: middle;
                                box-shadow: 0 0 8px #10b981, 0 0 16px rgba(16, 185, 129, 0.8);
                            "></span>`;
                            
                            el.innerHTML = bolinhaHTML + el.textContent;
                        }
                    }
                }
            });
            
        });
    </script>
</body>
</html>