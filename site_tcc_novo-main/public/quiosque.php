<?php
session_start();

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

$icon_antenna = function_exists('render_icon') ? render_icon('settings_input_antenna', 'w-4 h-4 text-cyan-600 inline-block align-middle') : '';
$icon_security = function_exists('render_icon') ? render_icon('security', 'w-5 h-5 text-slate-500') : '';

$conteudo = <<<HTML
<div id="kiosk-app-wrapper" class="p-6 md:p-8 animate-in fade-in duration-500 bg-transparent flex flex-col w-full">
    <div class="max-w-5xl mx-auto w-full space-y-6">
        
        <!-- HEADER NO TOPO -->
        <header class="flex justify-between items-center flex-wrap gap-4 shrink-0">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    {$icon_antenna}
                    <span class="text-[10px] font-bold text-cyan-700 uppercase tracking-widest">Admin Console</span>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Modo Quiosque</h1>
                <p class="text-slate-500 text-xs mt-0.5">
                    Usuário Conectado: <span class="font-bold text-slate-700 user-name-display">{$nome_usuario}</span>
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

        <!-- DASHBOARD METRICS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Modo de Operação</span>
                <span class="text-sm font-bold text-slate-700 mt-1" id="info-kiosk-mode">Padrão / Desbloqueado</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Conectividade local</span>
                <span class="text-sm font-bold text-emerald-600 mt-1" id="info-net-status">Interface Ativa</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Endereço IP Host</span>
                <span class="text-sm font-bold text-slate-700 mt-1">127.0.0.1</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tempo de Sessão</span>
                <span class="text-sm font-bold text-slate-700 mt-1" id="session-timer">00:00:00</span>
            </div>
        </div>

        <!-- CONTROLES CRÍTICOS -->
        <section class="glass p-6 md:p-8 rounded-2xl border border-slate-200 bg-white shadow-sm">
            <h2 class="text-base font-bold mb-6 flex items-center gap-2 text-slate-800">
                {$icon_security}
                Controles Críticos
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- BOTÃO TRAVAR MENU -->
                <button id="btn-travar" onclick="abrirModalSenha()" class="p-8 bg-white rounded-xl flex flex-col items-center justify-center gap-4 border border-slate-200 hover:bg-slate-50 transition-all group focus:outline-none shadow-sm">
                    <div id="lock-icon-container" class="w-14 h-14 rounded-lg flex items-center justify-center bg-cyan-50 transition-colors">
                        <svg class="w-8 h-8 text-cyan-600 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" y="11" width="14" height="10" rx="2" stroke-width="2"/>
                            <path d="M8 11V7a4 4 0 0 1 7.5-2" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span id="lock-text" class="text-xs font-bold uppercase tracking-wider text-slate-600 text-center">Travar Menu</span>
                </button>

                <!-- BOTÃO PRIVACIDADE -->
                <button id="btn-privacidade" onclick="togglePrivacy()" class="p-8 bg-white rounded-xl flex flex-col items-center justify-center gap-4 border border-slate-200 hover:bg-slate-50 transition-all group focus:outline-none shadow-sm">
                    <div class="w-14 h-14 rounded-lg flex items-center justify-center bg-purple-50">
                        <svg class="w-8 h-8 text-purple-600 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <span id="privacy-text" class="text-xs font-bold uppercase tracking-wider text-slate-600 text-center">Privacidade</span>
                </button>
                
            </div>
        </section>

        <!-- AÇÕES DE MANUTENÇÃO & AUDITORIA -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm md:col-span-1 space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Utilitários do Quiosque</h3>
                <button type="button" onclick="recarregarAplicacaoPreservandoQuiosque()" class="w-full py-2.5 px-4 bg-slate-50 hover:bg-slate-100 text-slate-700 font-semibold text-xs rounded-xl border border-slate-200 flex items-center justify-between transition-colors">
                    <span>Recarregar Aplicação</span>
                    <span class="text-slate-400">↺</span>
                </button>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm md:col-span-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Histórico de Eventos Recentes</h3>
                <ul id="kiosk-logs" class="space-y-2 text-xs text-slate-600">
                    <li class="p-2 bg-slate-50 rounded-lg border border-slate-100 flex justify-between">
                        <span>Sessão de administração inicializada</span>
                        <span class="text-slate-400 font-mono" id="log-time-init">--:--</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<!-- MODAL DE SENHA -->
<div id="modal-senha" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl p-6 w-full max-w-xs text-center space-y-4 animate-in zoom-in-95 duration-200">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl mx-auto flex items-center justify-center" id="icon-modal-container">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="11" width="14" height="10" rx="2" stroke-width="2"/>
                <path d="M8 11V7a4 4 0 0 1 8 0v4" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>
        <div>
            <h3 class="text-base font-bold text-slate-800" id="titulo-modal">Segurança</h3>
            <p class="text-slate-500 text-xs mt-1" id="subtitulo-modal">Digite a senha para prosseguir</p>
        </div>
        <div>
            <input type="password" id="input-senha-destrava" onkeydown="tratarTeclaInput(event)" placeholder="Senha" autocomplete="off" class="w-full text-center px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 focus:outline-none text-sm font-bold tracking-widest text-slate-800">
            <p id="erro-senha" class="text-xs text-red-500 font-bold mt-1.5 hidden">Senha incorreta!</p>
        </div>
        <div class="flex gap-2">
            <button type="button" onclick="fecharModalSenha()" class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition-all">Cancelar</button>
            <button type="button" onclick="validarSenhaAcao()" class="flex-1 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md transition-all">Confirmar</button>
        </div>
    </div>
</div>

<style>
    .btn-sair-desativado {
        opacity: 0.4 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
    }
</style>

<script>
    if (typeof SENHA_MESTRE === 'undefined') {
        var SENHA_MESTRE = "1234";
        var NOME_REAL_USUARIO = "{$nome_usuario}";
        var NOME_ANONIMO = '********';

        var ICON_LOCK_OPEN = `<svg class="w-8 h-8 text-cyan-600 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="11" width="14" height="10" rx="2" stroke-width="2"/><path d="M8 11V7a4 4 0 0 1 7.5-2" stroke-width="2" stroke-linecap="round"/></svg>`;
        var ICON_LOCK_CLOSED = `<svg class="w-8 h-8 text-red-600 group-hover:scale-105 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="11" width="14" height="10" rx="2" stroke-width="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4" stroke-width="2" stroke-linecap="round"/></svg>`;
    }

    function recarregarAplicacaoPreservandoQuiosque() {
        const wrapper = document.getElementById('kiosk-app-wrapper');
        if(!wrapper) return;

        wrapper.style.opacity = '0.5';

        fetch(window.location.href, { cache: 'no-store' })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const novoConteudo = doc.getElementById('kiosk-app-wrapper');

                if (novoConteudo) {
                    wrapper.innerHTML = novoConteudo.innerHTML;
                }
                
                sincronizarEstadoUI();
                addLog('Aplicação recarregada com sucesso');
                wrapper.style.opacity = '1';
            })
            .catch(err => {
                console.error('Erro ao recarregar via AJAX:', err);
                wrapper.style.opacity = '1';
            });
    }

    function addLog(mensagem) {
        const logs = document.getElementById('kiosk-logs');
        if(!logs) return;
        const now = new Date().toLocaleTimeString();
        const li = document.createElement('li');
        li.className = 'p-2 bg-slate-50 rounded-lg border border-slate-100 flex justify-between animate-in fade-in duration-300';
        li.innerHTML = `<span>\${mensagem}</span><span class="text-slate-400 font-mono">\${now}</span>`;
        logs.prepend(li);
    }

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

    function tratarTeclaInput(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            event.preventDefault();
            event.stopPropagation();
            validarSenhaAcao();
        }
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
                addLog('Menu destravado via autenticação');
            } else {
                localStorage.setItem('senai_menu_travado', 'true');
                entraTelaCheia();

                if (navigator.keyboard && navigator.keyboard.lock) {
                    navigator.keyboard.lock(['F12', 'F11', 'Escape', 'AltLeft', 'Tab', 'MetaLeft', 'KeyI', 'KeyJ', 'KeyU', 'KeyC']).catch(() => {});
                }

                atualizarInterfaceLock(true);
                addLog('Modo Quiosque travado');
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
        const infoKioskMode = document.getElementById('info-kiosk-mode');

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
            if(infoKioskMode) infoKioskMode.innerText = "Restrito / Bloqueado";
            
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
            if(infoKioskMode) infoKioskMode.innerText = "Padrão / Desbloqueado";
            
            if (iconContainer) {
                iconContainer.className = 'w-14 h-14 rounded-lg flex items-center justify-center bg-cyan-50 transition-colors';
                iconContainer.innerHTML = ICON_LOCK_OPEN;
            }
        }
    }

    function aplicarPrivacidadeUI(ativo) {
        const btn = document.getElementById('btn-privacidade');
        const textLabel = document.getElementById('privacy-text');

        document.querySelectorAll('.user-name-display').forEach(el => {
            if (!el.dataset.nomeOriginal && el.innerText !== NOME_ANONIMO) {
                el.dataset.nomeOriginal = el.innerText;
            }
            el.innerText = ativo ? NOME_ANONIMO : (el.dataset.nomeOriginal || NOME_REAL_USUARIO);
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
        addLog(novoEstado ? 'Modo de privacidade ativado' : 'Modo de privacidade desativado');
    }

    function sincronizarEstadoUI() {
        const travado = estaMenuTravado();
        const ativo = localStorage.getItem('senai_privacidade_ativa') === 'true';
        aplicarPrivacidadeUI(ativo);
        atualizarInterfaceLock(travado);
        
        if (travado) {
            entraTelaCheia();
        }

        const initLogTime = document.getElementById('log-time-init');
        if(initLogTime) initLogTime.innerText = new Date().toLocaleTimeString();
    }

    if (typeof window.kioskTimerInterval === 'undefined') {
        let totalSeconds = 0;
        window.kioskTimerInterval = setInterval(() => {
            totalSeconds++;
            const hrs = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            const mins = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            const secs = String(totalSeconds % 60).padStart(2, '0');
            const timerEl = document.getElementById('session-timer');
            if(timerEl) timerEl.innerText = `\${hrs}:\${mins}:\${secs}`;
        }, 1000);
    }

    // Executa a sincronização imediatamente na carga do script
    sincronizarEstadoUI();
    document.addEventListener('DOMContentLoaded', sincronizarEstadoUI);
</script>
HTML;

/**
 * NAVEGAÇÃO SPA + TROCA DINÂMICA DA SIDEBAR E CONTEÚDO PRINCIPAL
 */
$script_persistencia_global = <<<JS
<script>
    (function() {
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[href]');
            
            if (localStorage.getItem('senai_menu_travado') === 'true') {
                if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
                    let elem = document.documentElement;
                    if (elem.requestFullscreen) { elem.requestFullscreen().catch(() => {}); }
                    else if (elem.webkitRequestFullscreen) { elem.webkitRequestFullscreen(); }
                }

                const logoutBtn = e.target.closest('a[href*="logout"], a[href*="sair"], button[onclick*="logout"], .btn-logout, #btn-sair');
                if (logoutBtn) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }

                if (link && link.href && !link.href.includes('#') && !link.href.includes('javascript:') && !link.href.includes('logout')) {
                    const urlDestino = link.href;
                    if (urlDestino.startsWith(window.location.origin)) {
                        e.preventDefault();
                        fetch(urlDestino)
                            .then(res => res.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');

                                // 1. ATUALIZA O CONTEÚDO PRINCIPAL
                                const novoConteudo = doc.querySelector('main') || doc.body;
                                const mainAtual = document.querySelector('main') || document.body;
                                if (novoConteudo && mainAtual) {
                                    mainAtual.innerHTML = novoConteudo.innerHTML;
                                }

                                // 2. SUBTITUI A BARRA LATERAL (SIDEBAR) INTEIRA
                                const novaSidebar = doc.getElementById('sidebar') || doc.querySelector('aside');
                                const sidebarAtual = document.getElementById('sidebar') || document.querySelector('aside');
                                if (novaSidebar && sidebarAtual) {
                                    sidebarAtual.innerHTML = novaSidebar.innerHTML;
                                }

                                window.history.pushState({}, '', urlDestino);

                                // 3. RE-EXECUTA OS SCRIPTS DA NOVA PÁGINA
                                if (novoConteudo) {
                                    novoConteudo.querySelectorAll('script').forEach(oldScript => {
                                        const newScript = document.createElement('script');
                                        Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                                        document.body.appendChild(newScript);
                                    });
                                }

                                // 4. FORÇA A RE-SINCRONIZAÇÃO DA INTERFACE DE QUIOSQUE
                                if (typeof sincronizarEstadoUI === 'function') {
                                    sincronizarEstadoUI();
                                }
                            })
                            .catch(() => { window.location.href = urlDestino; });
                    }
                }
            }
        }, true);

        document.addEventListener('contextmenu', function(e) {
            if (localStorage.getItem('senai_menu_travado') === 'true') {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        }, true);

        function travarTeclas(e) {
            const modalSenha = document.getElementById('modal-senha');
            const modalOpen = modalSenha && !modalSenha.classList.contains('hidden');
            if (modalOpen && (e.key === 'Enter' || e.keyCode === 13)) {
                return true; 
            }

            if (localStorage.getItem('senai_menu_travado') === 'true') {
                const k = e.key || e.keyCode;
                const isF12 = k === 'F12' || e.keyCode === 123;
                const isF11 = k === 'F11' || e.keyCode === 122;
                const isF5 = k === 'F5' || e.keyCode === 116;
                const isEsc = k === 'Escape' || e.keyCode === 27;
                
                if (isF5) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (typeof recarregarAplicacaoPreservandoQuiosque === 'function') {
                        recarregarAplicacaoPreservandoQuiosque();
                    }
                    return false;
                }

                const isDevTools = (e.ctrlKey || e.metaKey) && (
                    (e.shiftKey && (e.key === 'I' || e.key === 'i' || e.key === 'J' || e.key === 'j' || e.key === 'C' || e.key === 'c')) ||
                    (e.key === 'u' || e.key === 'U' || e.key === 's' || e.key === 'S' || e.key === 'r' || e.key === 'R')
                );

                if (isF12 || isF11 || isEsc || isDevTools) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    return false;
                }
            }
        }

        window.addEventListener('keydown', travarTeclas, true);
        window.addEventListener('keyup', travarTeclas, true);
    })();
</script>
JS;

$conteudo .= $script_persistencia_global;

if (function_exists('renderizar_pagina')) {
    renderizar_pagina("Modo Quiosque", $conteudo);
} else {
    echo $conteudo;
}
?>