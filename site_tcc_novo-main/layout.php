<?php

function render_icon(string $name, string $class = ''): string
{
    $base = 'aria-hidden="true" class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"';
    $icons = [
        'vrpano' => '<svg ' . $base . '><path d="M4 7.5C4 6.12 5.12 5 6.5 5h11C18.88 5 20 6.12 20 7.5v6c0 1.38-1.12 2.5-2.5 2.5H14l-2 2-2-2H6.5C5.12 16 4 14.88 4 13.5v-6Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 9.5h6M8.5 12h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'home' => '<svg ' . $base . '><path d="M4 11.5 12 5l8 6.5V19a1 1 0 0 1-1 1h-4.5v-5h-5V20H5a1 1 0 0 1-1-1v-7.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>',
        'forum' => '<svg ' . $base . '><path d="M5 6.8A2.8 2.8 0 0 1 7.8 4h8.4A2.8 2.8 0 0 1 19 6.8v5.4A2.8 2.8 0 0 1 16.2 15H11l-4.2 3v-3.3A2.8 2.8 0 0 1 5 12.2V6.8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M8 8.2h8M8 10.8h5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'auto_stories' => '<svg ' . $base . '><path d="M12 6.2c-1.7-1.3-3.7-1.9-6-1.9v11.7c2.3 0 4.3.6 6 1.9m0-11.7c1.7-1.3 3.7-1.9 6-1.9v11.7c-2.3 0-4.3.6-6 1.9m0-11.7v11.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'smart_display' => '<svg ' . $base . '><rect x="4" y="6" width="16" height="10" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M9 18h6M10.5 16h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M9.5 9.2 13.5 12 9.5 14.8V9.2Z" fill="currentColor"/></svg>',
        'history_edu' => '<svg ' . $base . '><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M5 7.5A3.5 3.5 0 0 1 8.5 4H20v11.5A3.5 3.5 0 0 1 16.5 19H8A3 3 0 0 0 5 22V7.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>',
        'person' => '<svg ' . $base . '><path d="M12 11.2a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8"/><path d="M5.5 20a6.5 6.5 0 0 1 13 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'notifications' => '<svg ' . $base . '><path d="M15 17H9m8-2H7l1.2-1.5c.5-.7.8-1.6.8-2.4V10a3 3 0 1 1 6 0v1.1c0 .8.3 1.7.8 2.4L17 15Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M10 17a2 2 0 0 0 4 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'logout' => '<svg ' . $base . '><path d="M10 17.5H7.2A2.2 2.2 0 0 1 5 15.3V8.7A2.2 2.2 0 0 1 7.2 6.5H10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M13 8l3 4-3 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 12H10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'menu' => '<svg ' . $base . '><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>',
        'close' => '<svg ' . $base . '><path d="m6 6 12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
    ];

    return $icons[$name] ?? '';
}

function renderizar_pagina(string $titulo, string $conteudo): void
{
    date_default_timezone_set('America/Sao_Paulo');

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $pagina_atual = basename($_SERVER['PHP_SELF']);
    $usuario_nome = $_SESSION['usuario_nome'] ?? 'Estudante';
    
    // Tratamento de saídas seguras
    $usuario_nome_seguro = htmlspecialchars($usuario_nome, ENT_QUOTES, 'UTF-8');
    $usuario_nome_js = json_encode($usuario_nome, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    $titulo_seguro = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');

    // Estruturação do Menu por Seções PROFISSIONAIS
    $secoes_menu = [
        'NAVEGAÇÃO' => [
            'home.php' => ['Início', 'home'],
            'dashboard.php' => ['Chat Imersivo', 'forum'],
            'materias.php' => ['Matérias 3D', 'history_edu'],
        ],
        'SISTEMA & SUPORTE' => [
            'tutorial.php' => ['Manual Técnico', 'auto_stories'],
            'quiosque.php' => ['Modo Quiosque', 'smart_display'],
        ]
    ];

    $icon_vrpano = render_icon('vrpano', 'icon');
    $icon_person = render_icon('person', 'icon');
    $icon_logout = render_icon('logout', 'icon');
    $icon_menu = render_icon('menu', 'icon');
    $icon_close = render_icon('close', 'icon');

    // Construção HTML agrupada por seções
    $nav_content = '';
    foreach ($secoes_menu as $titulo_secao => $links) {
        $nav_content .= <<<HTML
            <div class="pt-2 pb-1.5 px-3">
                <span class="text-[10px] font-extrabold uppercase tracking-[0.22em] text-slate-400/90 select-none">{$titulo_secao}</span>
            </div>
HTML;
        foreach ($links as $url => [$label, $icon]) {
            $ativo = $pagina_atual === $url ? 'active' : '';
            $icone = render_icon($icon, 'icon');
            $nav_content .= <<<HTML
                <a href="{$url}" class="sidebar-link {$ativo} group flex items-center gap-3 px-3.5 py-2.5 my-0.5 rounded-xl text-xs font-bold transition-all duration-200 relative">
                    <span class="icon-container flex items-center justify-center text-slate-400 group-hover:text-cyan-600 transition-colors duration-200">
                        {$icone}
                    </span>
                    <span class="truncate tracking-tight">{$label}</span>
                </a>
HTML;
        }
    }

    echo <<<HTML
<!DOCTYPE html>
<html lang="pt-BR" class="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{$titulo_seguro} | SENAI VR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        background: '#f8fafc',
                        surface: '#ffffff',
                        border: 'rgba(226, 232, 240, 0.8)',
                        cyan: {
                            50: '#ecfeff',
                            100: '#cffafe',
                            500: '#06b6d4',
                            600: '#0891b2',
                            700: '#0e7490',
                        }
                    },
                    fontFamily: {
                        headline: ['Space Grotesk', 'sans-serif'],
                        body: ['Plus Jakarta Sans', 'sans-serif']
                    },
                    boxShadow: {
                        premium: '0 10px 30px -5px rgba(0, 0, 0, 0.03), 0 20px 25px -5px rgba(0, 0, 0, 0.02)',
                        glow: '0 4px 20px -2px rgba(8, 145, 178, 0.25)'
                    }
                }
            }
        }
    </script>
    <style>
        :root { color-scheme: light; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #0f172a; }
        .headline { font-family: 'Space Grotesk', sans-serif; }
        
        /* BARRA LATERAL ENTERPRISE */
        .sidebar-container { 
            background: #ffffff; 
            border-right: 1px solid #e2e8f0; 
        }

        /* LINKS E ITENS DA SIDEBAR */
        .sidebar-link { 
            color: #64748b; 
            background: transparent;
            border: 1px solid transparent;
        }
        
        .sidebar-link:hover { 
            background: #f8fafc; 
            color: #0f172a; 
            border-color: #f1f5f9;
            transform: translateX(3px);
        }

        .sidebar-link.active { 
            background: linear-gradient(90deg, #ecfeff 0%, #ffffff 100%) !important; 
            color: #0891b2 !important; 
            border-color: #cffafe !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 10px -2px rgba(8, 145, 178, 0.12);
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -1px;
            top: 15%;
            height: 70%;
            width: 3.5px;
            background-color: #0891b2;
            border-radius: 0 4px 4px 0;
            box-shadow: 0 0 10px #0891b2;
        }

        .sidebar-link.active .icon-container {
            color: #0891b2 !important;
        }

        .icon { width: 1.25rem; height: 1.25rem; display: inline-block; vertical-align: middle; flex-shrink: 0; }
        
        /* MALHA SUAVE DE FUNDO */
        .bg-grid-subtle {
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 24px 24px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.4), transparent 80%);
            pointer-events: none;
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden bg-slate-50 text-slate-900 antialiased">
    <div class="fixed inset-0 bg-grid-subtle z-0"></div>

    <!-- Header Mobile -->
    <header class="lg:hidden flex items-center justify-between p-4 bg-white/90 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-cyan-600 to-cyan-500 flex items-center justify-center text-white shadow-glow">
                {$icon_vrpano}
            </div>
            <div class="flex flex-col">
                <span class="headline text-base font-bold text-slate-900 tracking-tight leading-none">SENAI VR</span>
                <span class="text-[9px] font-bold text-cyan-600 tracking-widest uppercase mt-0.5">Console</span>
            </div>
        </div>
        <button id="mobile-menu-toggle" aria-label="Abrir Menu" class="p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl transition-colors">
            {$icon_menu}
        </button>
    </header>

    <!-- Overlay Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-40 hidden lg:hidden"></div>

    <!-- Sidebar Lateral Pro -->
    <aside id="sidebar" class="sidebar-container fixed inset-y-0 left-0 w-64 z-50 flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-out">
        
        <!-- HEADER DA SIDEBAR -->
        <div class="px-6 py-6 border-b border-slate-100 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 to-cyan-500 flex items-center justify-center text-white shadow-glow shrink-0">
                    {$icon_vrpano}
                </div>
                <div class="flex flex-col">
                    <span class="headline text-base font-extrabold tracking-tight text-slate-900 leading-none">SENAI VR</span>
                    <div class="flex items-center gap-1.5 mt-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span>
                        <span class="text-[10px] font-extrabold text-slate-400 tracking-widest uppercase">Meta Quest 3S</span>
                    </div>
                </div>
            </div>
            <button id="mobile-menu-close" aria-label="Fechar Menu" class="lg:hidden p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                {$icon_close}
            </button>
        </div>

        <!-- LISTA DE NAVEGAÇÃO COMPONENTIZADA -->
        <nav class="flex-1 px-3.5 py-4 space-y-3 overflow-y-auto custom-scrollbar">
            {$nav_content}
        </nav>

        <!-- CARD DE USUÁRIO ENTERPRISE (RODAPÉ) -->
        <div class="p-3.5 border-t border-slate-100 bg-slate-50/50 shrink-0">
            <div class="rounded-xl bg-white border border-slate-200/80 p-3 shadow-xs hover:border-slate-300 transition-all group">
                <div class="flex items-center gap-3">
                    <div class="relative w-9 h-9 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 shrink-0 group-hover:border-cyan-200 group-hover:bg-cyan-50 group-hover:text-cyan-600 transition-colors">
                        {$icon_person}
                        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-white"></span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-slate-800 truncate user-name-display tracking-tight">{$usuario_nome_seguro}</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[9px] font-extrabold uppercase tracking-wider text-emerald-600">Conectado</span>
                        </div>
                    </div>
                    <a href="../logout.php" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 transition-all shrink-0" title="Encerrar Sessão">
                        {$icon_logout}
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Conteúdo Principal -->
    <div class="lg:pl-64 min-h-screen relative z-10 flex flex-col">
        <main class="mx-auto w-full max-w-[1600px] px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex-1">
            {$conteudo}
        </main>
    </div>

    <script>
        // Gestão de Privacidade Segura
        function aplicarPrivacidadeGlobal() {
            const privacidadeAtiva = localStorage.getItem('senai_privacidade_ativa') === 'true';
            const nomeUsuario = {$usuario_nome_js};
            const NOME_ANONIMO = '********';

            document.querySelectorAll('.user-name-display').forEach(el => {
                el.textContent = privacidadeAtiva ? NOME_ANONIMO : nomeUsuario;
            });
        }

        // Toggle do Menu Mobile
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const btnToggle = document.getElementById('mobile-menu-toggle');
        const btnClose = document.getElementById('mobile-menu-close');

        function toggleMenu() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        if (btnToggle) btnToggle.addEventListener('click', toggleMenu);
        if (btnClose) btnClose.addEventListener('click', toggleMenu);
        if (overlay) overlay.addEventListener('click', toggleMenu);

        document.addEventListener('DOMContentLoaded', aplicarPrivacidadeGlobal);
        window.addEventListener('storage', aplicarPrivacidadeGlobal);
    </script>
</body>
</html>
HTML;
}