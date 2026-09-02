<?php
session_start();

if (isset($_POST['action']) && $_POST['action'] === 'toggle_internet') {
    header('Content-Type: application/json');
    $status = $_POST['status'] ?? 'online';
    
    $is_windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    $output = [];
    $return_var = 0;

    if ($status === 'offline') {
        if ($is_windows) {
            exec('netsh interface set interface "Wi-Fi" disable', $output, $return_var);
            exec('netsh interface set interface "Ethernet" disable', $output, $return_var);
        } else {
            exec('sudo nmcli networking off', $output, $return_var);
        }
    } else {
        if ($is_windows) {
            exec('netsh interface set interface "Wi-Fi" enable', $output, $return_var);
            exec('netsh interface set interface "Ethernet" enable', $output, $return_var);
        } else {
            exec('sudo nmcli networking on', $output, $return_var);
        }
    }

    echo json_encode(['success' => true, 'status' => $status]);
    exit();
}

if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}

if (file_exists('../conexao.php')) {
    require_once '../conexao.php';
}
if (file_exists('../layout.php')) {
    require_once '../layout.php';
}

$nome_usuario = $_SESSION['usuario_nome'] ?? $_SESSION['usuario_logado'] ?? 'Teste';

$icon_antenna     = function_exists('render_icon') ? render_icon('settings_input_antenna', 'w-4 h-4 text-cyan-600 inline-block align-middle') : '';
$icon_security    = function_exists('render_icon') ? render_icon('security', 'w-5 h-5 text-slate-500') : '';
$icon_lock_open   = function_exists('render_icon') ? render_icon('lock_open', 'w-8 h-8 text-cyan-600 transition-transform') : '';
$icon_lock_closed = function_exists('render_icon') ? render_icon('lock', 'w-8 h-8 text-red-600 transition-transform') : '';
$icon_privacy     = function_exists('render_icon') ? render_icon('visibility_off', 'w-8 h-8 text-purple-600 group-hover:scale-105 transition-transform id="svg-privacy"') : '';

$svg_wifi_on = '<svg class="w-8 h-8 text-emerald-600 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>';
$svg_wifi_off = '<svg class="w-8 h-8 text-orange-600 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M12 20h.01m-4.242-3.596a5.5 5.5 0 015.656-.828m3.987 1.838a5.498 5.498 0 00-1.127-1.01M4.929 12.929a10 10 0 0113.142-1.2m2.071 2.071a9.96 9.96 0 001.216-1.78M1.394 9.393a15 15 0 0119.544-1.353"></path></svg>';

$conteudo = <<<HTML
<div class="p-6 md:p-8 animate-in fade-in duration-500 bg-transparent flex flex-col h-[calc(100vh-120px)] overflow-y-auto scroller-limpo">
    <div class="max-w-5xl mx-auto w-full flex flex-col flex-1">
        
        <!-- HEADER NO TOPO -->
        <header class="flex justify-between items-center flex-wrap gap-4 shrink-0">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    {$icon_antenna}
                    <span class="text-[10px] font-bold text-cyan-700 uppercase tracking-widest">Admin Console</span>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Modo Quiosque</h1>
                <p class="text-slate-500 text-xs mt-0.5">
                    <br> Usuário Conectado: <span class="font-bold text-slate-700 user-name-display">{$nome_usuario}</span>
                </p>
            </div>
            
            <div id="status-badge" class="px-4 py-2 bg-green-50 border border-green-200 rounded-xl text-green-700 text-xs font-bold flex items-center gap-2.5 shadow-sm transition-all duration-300">
                <span class="relative flex h-2 w-2">
                    <span id="ping-status" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span id="dot-status" class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span id="text-status">SISTEMA ATIVO</span>
            </div>
        </header>

        <!-- QUADRADO COM OS 3 BOTÕES -->
        <section class="glass p-8 rounded-2xl border border-slate-200 bg-white shadow-sm mt-24">
            <h2 class="text-base font-bold mb-6 flex items-center gap-2 text-slate-800">
                {$icon_security}
                Controles Críticos
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <button id="btn-travar" onclick="abrirModalSenha()" class="p-8 bg-white rounded-xl flex flex-col items-center justify-center gap-4 border border-slate-200 hover:bg-slate-50 transition-all group focus:outline-none">
                    <div id="lock-icon-container" class="w-14 h-14 rounded-lg flex items-center justify-center bg-cyan-50 transition-colors">
                        {$icon_lock_open}
                    </div>
                    <span id="lock-text" class="text-xs font-bold uppercase tracking-wider text-slate-600 text-center">Travar Menu</span>
                </button>

                <button id="btn-privacidade" onclick="togglePrivacy()" class="p-8 bg-white rounded-xl flex flex-col items-center justify-center gap-4 border border-slate-200 hover:bg-slate-50 transition-all group focus:outline-none">
                    <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-purple-50">
                        {$icon_privacy}
                    </div>
                    <span id="privacy-text" class="text-xs font-bold uppercase tracking-wider text-slate-600 text-center">Privacidade</span>
                </button>

                <button id="btn-offline" onclick="toggleOffline()" class="p-8 bg-white rounded-xl flex flex-col items-center justify-center gap-4 border border-slate-200 hover:bg-slate-50 transition-all group focus:outline-none">
                    <div id="wifi-icon-container" class="w-14 h-14 rounded-lg flex items-center justify-center bg-emerald-50 transition-colors">
                        {$svg_wifi_on}
                    </div>
                    <span id="wifi-text" class="text-xs font-bold uppercase tracking-wider text-emerald-600 text-center">Online</span>
                </button>
                
            </div>
        </section>

    </div>
</div>

<!-- MODAL DE SENHA -->
<div id="modal-senha" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl p-6 w-full max-w-xs text-center space-y-4 animate-in zoom-in-95 duration-200">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl mx-auto flex items-center justify-center" id="icon-modal-container">
            {$icon_lock_closed}
        </div>
        <div>
            <h3 class="text-base font-bold text-slate-800" id="titulo-modal">Segurança</h3>
            <p class="text-slate-500 text-xs mt-1" id="subtitulo-modal">Digite a senha para prosseguir</p>
        </div>
        <div>
            <input type="password" id="input-senha-destrava" placeholder="Senha" autocomplete="off" class="w-full text-center px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm font-bold tracking-widest text-slate-800">
            <p id="erro-senha" class="text-xs text-red-500 font-bold mt-1.5 hidden">Senha incorreta!</p>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="fecharModalSenha()" class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">Cancelar</button>
            <button type="button" onclick="validarSenhaAcao()" class="flex-1 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md transition-all">Confirmar</button>
        </div>
    </div>
</div>

<style>
    html, body {
        overflow: hidden !important;
        height: 100% !important;
    }
    .scroller-limpo::-webkit-scrollbar {
        display: none;
    }
    .scroller-limpo {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    /* Estilo visual para desativar os botões de saída quando travado */
    .btn-sair-desativado {
        opacity: 0.4 !important;
        cursor: not-allowed !allowed !important;
        pointer-events: none !important;
    }
</style>

<script>
    const SENHA_MESTRE = "1234";
    const NOME_REAL_USUARIO = "{$nome_usuario}";
    const NOME_ANONIMO = '********';

    const ICON_LOCK_OPEN = `{$icon_lock_open}`;
    const ICON_LOCK_CLOSED = `{$icon_lock_closed}`;
    const SVG_WIFI_ON = `{$svg_wifi_on}`;
    const SVG_WIFI_OFF = `{$svg_wifi_off}`;

    let isOffline = false;

    function estaMenuTravado() {
        return localStorage.getItem('senai_menu_travado') === 'true';
    }

    function entraTelaCheia() {
        let elem = document.documentElement;
        if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen().catch(() => {});
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        }
    }

    function saiTelaCheia() {
        if (document.exitFullscreen) {
            document.exitFullscreen().catch(() => {});
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }

    function abrirModalSenha() {
        const modal = document.getElementById('modal-senha');
        const input = document.getElementById('input-senha-destrava');
        const erro = document.getElementById('erro-senha');
        const titulo = document.getElementById('titulo-modal');
        const subtitulo = document.getElementById('subtitulo-modal');
        
        if (estaMenuTravado()) {
            titulo.innerText = "Destravar Menu";
            subtitulo.innerText = "Digite a senha para liberar o sistema";
        } else {
            titulo.innerText = "Travar Menu";
            subtitulo.innerText = "Digite a senha para ativar o modo quiosque";
        }

        input.value = '';
        erro.classList.add('hidden');
        modal.classList.remove('hidden');
        setTimeout(() => input.focus(), 150);
    }

    function fecharModalSenha() {
        document.getElementById('modal-senha').classList.add('hidden');
    }

    function validarSenhaAcao() {
        const input = document.getElementById('input-senha-destrava');
        const erro = document.getElementById('erro-senha');

        if (input.value === SENHA_MESTRE) {
            fecharModalSenha();
            
            if (estaMenuTravado()) {
                localStorage.setItem('senai_menu_travado', 'false');
                saiTelaCheia();

                if (navigator.keyboard && navigator.keyboard.unlock) {
                    navigator.keyboard.unlock();
                }

                atualizarInterfaceLock(false);
            } else {
                localStorage.setItem('senai_menu_travado', 'true');
                entraTelaCheia();

                if (navigator.keyboard && navigator.keyboard.lock) {
                    navigator.keyboard.lock(['F11', 'Escape', 'AltLeft', 'Tab', 'MetaLeft']).catch(() => {});
                }

                atualizarInterfaceLock(true);
            }
        } else {
            erro.classList.remove('hidden');
            input.value = '';
            input.focus();
        }
    }

    function atualizarInterfaceLock(travado) {
        const badge = document.getElementById('status-badge');
        const ping = document.getElementById('ping-status');
        const dot = document.getElementById('dot-status');
        const textStatus = document.getElementById('text-status');
        const label = document.getElementById('lock-text');
        const btn = document.getElementById('btn-travar');
        const iconContainer = document.getElementById('lock-icon-container');

        // BLOQUEIO/DESBLOQUEIO VISUAL DE BOTÕES DE SAIR/LOGOUT
        const elementosSair = document.querySelectorAll('a[href*="logout"], a[href*="sair"], button[onclick*="logout"], .btn-logout, #btn-sair');
        elementosSair.forEach(el => {
            if (travado) {
                el.classList.add('btn-sair-desativado');
                el.setAttribute('tabindex', '-1');
            } else {
                el.classList.remove('btn-sair-desativado');
                el.removeAttribute('tabindex');
            }
        });

        if (!badge || !label) return;

        if (travado) {
            textStatus.innerText = 'SISTEMA BLOQUEADO';
            badge.className = 'px-4 py-2 bg-red-50 border border-red-200 rounded-xl text-red-700 text-xs font-bold flex items-center gap-2.5 shadow-sm transition-all duration-300';
            ping.className = 'animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75';
            dot.className = 'relative inline-flex rounded-full h-2 w-2 bg-red-500';
            
            label.innerText = 'Menu Travado';
            btn.classList.add('bg-red-50', 'border-red-300');
            
            if (iconContainer) {
                iconContainer.className = 'w-14 h-14 rounded-lg flex items-center justify-center bg-red-100 transition-colors';
                iconContainer.innerHTML = ICON_LOCK_CLOSED;
            }
        } else {
            textStatus.innerText = 'SISTEMA ATIVO';
            badge.className = 'px-4 py-2 bg-green-50 border border-green-200 rounded-xl text-green-700 text-xs font-bold flex items-center gap-2.5 shadow-sm transition-all duration-300';
            ping.className = 'animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75';
            dot.className = 'relative inline-flex rounded-full h-2 w-2 bg-green-500';
            
            label.innerText = 'Travar Menu';
            btn.classList.remove('bg-red-50', 'border-red-300');
            
            if (iconContainer) {
                iconContainer.className = 'w-14 h-14 rounded-lg flex items-center justify-center bg-cyan-50 transition-colors';
                iconContainer.innerHTML = ICON_LOCK_OPEN;
            }
        }
    }

    // INTERCEPTADOR DE CLIQUE GLOBAL PARA BLOQUEAR AÇÕES DE SAÍDA E LOGOUT
    document.addEventListener('click', function(e) {
        if (!estaMenuTravado()) return;

        // Procura se o elemento clicado (ou seus pais) é um botão/link de saída
        const alvo = e.target.closest('a[href*="logout"], a[href*="sair"], button[onclick*="logout"], .btn-logout, #btn-sair');
        
        if (alvo) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            return false;
        }

        // Mantém a tela cheia ativa em qualquer outro clique
        if (!document.fullscreenElement) {
            entraTelaCheia();
        }
    }, true);

    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('modal-senha');
        
        if (modal && !modal.classList.contains('hidden') && (e.key === 'Enter' || e.keyCode === 13)) {
            e.preventDefault();
            validarSenhaAcao();
            return false;
        }

        if (e.key === 'F11' || e.keyCode === 122) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            
            if (estaMenuTravado()) {
                entraTelaCheia();
            }
            return false;
        }

        if (estaMenuTravado()) {
            if (
                e.key === 'Escape' || 
                (e.ctrlKey && (e.key === 't' || e.key === 'n' || e.key === 'w' || e.key === 'r'))
            ) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            }
        }
    }, true);

    const reengajarFullscreen = () => {
        if (estaMenuTravado() && (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement)) {
            setTimeout(entraTelaCheia, 50);
        }
    };

    document.addEventListener('fullscreenchange', reengajarFullscreen);
    document.addEventListener('webkitfullscreenchange', reengajarFullscreen);
    document.addEventListener('mozfullscreenchange', reengajarFullscreen);
    document.addEventListener('MSFullscreenChange', reengajarFullscreen);
    window.addEventListener('resize', reengajarFullscreen);

    function aplicarPrivacidadeUI(ativo) {
        const btn = document.getElementById('btn-privacidade');
        const textLabel = document.getElementById('privacy-text');

        document.querySelectorAll('.user-name-display').forEach(el => {
            if (!el.dataset.nomeOriginal && el.innerText !== NOME_ANONIMO) {
                el.dataset.nomeOriginal = el.innerText;
            }
            el.innerText = ativo ? NOME_ANONIMO : (el.dataset.nomeOriginal || NOME_REAL_USUARIO);
        });

        const primeiroNome = NOME_REAL_USUARIO.split(' ')[0];
        document.querySelectorAll('aside span, aside div, aside p, .sidebar span, .sidebar div, .sidebar p').forEach(el => {
            if (el.children.length === 0) {
                if (el.innerText.includes(primeiroNome) || el.innerText === NOME_ANONIMO) {
                    if (!el.dataset.nomeOriginal) {
                        el.dataset.nomeOriginal = el.innerText;
                    }
                    el.innerText = ativo ? NOME_ANONIMO : el.dataset.nomeOriginal;
                }
            }
        });

        if (!btn) return;
        if (ativo) {
            btn.classList.add('bg-purple-50', 'border-purple-300');
            if (textLabel) textLabel.innerText = 'Nome Oculto';
        } else {
            btn.classList.remove('bg-purple-50', 'border-purple-300');
            if (textLabel) textLabel.innerText = 'Privacidade';
        }
    }

    function togglePrivacy() {
        const estadoAtual = localStorage.getItem('senai_privacidade_ativa') === 'true';
        const novoEstado = !estadoAtual;
        
        localStorage.setItem('senai_privacidade_ativa', novoEstado ? 'true' : 'false');
        window.dispatchEvent(new Event('storage'));
        aplicarPrivacidadeUI(novoEstado);
    }

    function toggleOffline() {
        isOffline = !isOffline;
        const btn = document.getElementById('btn-offline');
        const text = document.getElementById('wifi-text');
        const iconContainer = document.getElementById('wifi-icon-container');

        const novoStatus = isOffline ? 'offline' : 'online';

        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'action': 'toggle_internet',
                'status': novoStatus
            })
        }).then(response => response.json())
          .then(data => {
              console.log('Comando de rede enviado:', data);
          }).catch(err => console.error('Erro ao alterar conectividade:', err));

        if (isOffline) {
            btn.classList.add('bg-orange-50', 'border-orange-300');
            text.innerText = 'OFF-LINE';
            text.className = 'text-xs font-bold uppercase tracking-wider text-orange-600 text-center';
            
            if (iconContainer) {
                iconContainer.className = 'w-14 h-14 rounded-lg flex items-center justify-center bg-orange-100 transition-colors';
                iconContainer.innerHTML = SVG_WIFI_OFF;
            }
        } else {
            btn.classList.remove('bg-orange-50', 'border-orange-300');
            text.innerText = 'ONLINE';
            text.className = 'text-xs font-bold uppercase tracking-wider text-emerald-600 text-center';
            
            if (iconContainer) {
                iconContainer.className = 'w-14 h-14 rounded-lg flex items-center justify-center bg-emerald-50 transition-colors';
                iconContainer.innerHTML = SVG_WIFI_ON;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const ativo = localStorage.getItem('senai_privacidade_ativa') === 'true';
        aplicarPrivacidadeUI(ativo);
        atualizarInterfaceLock(estaMenuTravado());
    });

    window.addEventListener('storage', () => {
        const ativo = localStorage.getItem('senai_privacidade_ativa') === 'true';
        aplicarPrivacidadeUI(ativo);
        atualizarInterfaceLock(estaMenuTravado());
    });
</script>
HTML;

if (function_exists('renderizar_pagina')) {
    renderizar_pagina("Modo Quiosque", $conteudo);
} else {
    echo $conteudo;
}
?>