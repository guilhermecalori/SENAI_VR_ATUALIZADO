<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

$nome_usuario = $_SESSION['usuario_nome'] ?? 'Estudante';

$icon_cloud        = render_icon('partly_cloudy_day', 'w-5 h-5 text-cyan-600');
$icon_stories      = render_icon('auto_stories', 'w-6 h-6 text-cyan-600');
$icon_forum        = render_icon('forum', 'w-6 h-6 text-purple-600');
$icon_display      = render_icon('smart_display', 'w-6 h-6 text-emerald-600');
$icon_arrow_cyan   = render_icon('arrow_forward', 'w-4 h-4 text-cyan-600 inline-block align-middle ml-1');
$icon_arrow_purple = render_icon('arrow_forward', 'w-4 h-4 text-purple-600 inline-block align-middle ml-1');
$icon_arrow_emer   = render_icon('arrow_forward', 'w-4 h-4 text-emerald-600 inline-block align-middle ml-1');

$conteudo = "
<div class='p-6 md:p-8 animate-in fade-in duration-700 flex flex-col h-[calc(100vh-120px)] overflow-y-auto scroller-limpo'>
    <div class='max-w-6xl mx-auto w-full flex flex-col h-full justify-between space-y-4 md:space-y-6'>
        
        <header class='relative p-8 md:p-10 rounded-3xl overflow-hidden border border-slate-200 shadow-sm bg-white shrink-0'>
            <div class='absolute -top-24 -right-24 w-96 h-96 bg-cyan-500/5 blur-[100px] rounded-full pointer-events-none'></div>
            
            <div class='relative z-10'>
                <div class='flex items-center gap-2 mb-3'>
                    {$icon_cloud}
                    <span class='text-xs font-bold text-cyan-700 uppercase tracking-[0.25em]'>Bem-vindo de volta</span>
                </div>
                <h1 class='text-3xl md:text-4xl font-bold text-slate-900 mb-2 tracking-tight'>
                    Olá, <span class='user-name-display'>{$nome_usuario}</span>!
                </h1>
                <p class='text-slate-500 text-sm md:text-base max-w-2xl leading-relaxed'>
                    O sistema <span class='text-slate-900 font-semibold'>SENAI VR</span> está operando em capacidade total. 
                    Explore seus módulos de treinamento e laboratórios virtuais abaixo.
                </p>
            </div>
        </header>

        <div class='grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 flex-1 my-2'>
            
            <!-- CARD MANUAL TÉCNICO -->
            <a href='tutorial.php' class='glass p-6 rounded-2xl border border-slate-200 hover:border-cyan-300 hover:bg-white transition-all duration-300 group flex flex-col justify-between shadow-sm'>
                <div>
                    <div class='w-12 h-12 bg-cyan-50 rounded-xl flex items-center justify-center mb-5 group-hover:scale-105 transition-transform duration-300'>
                        {$icon_stories}
                    </div>
                    <h3 class='text-lg font-bold text-slate-800 mb-2'>Manual Técnico</h3>
                    <p class='text-slate-500 text-xs md:text-sm leading-relaxed mb-4'>Acesse os protocolos de segurança e setup do Quest 3S.</p>
                </div>
                <div class='flex items-center gap-1 text-cyan-600 text-xs font-bold uppercase tracking-wider mt-auto pt-2'>
                    <span>Acessar</span> {$icon_arrow_cyan}
                </div>
            </a>

            <!-- CARD CHAT NEURAL -->
            <a href='dashboard.php' class='glass p-6 rounded-2xl border border-slate-200 hover:border-purple-300 hover:bg-white transition-all duration-300 group flex flex-col justify-between shadow-sm'>
                <div>
                    <div class='w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center mb-5 group-hover:scale-105 transition-transform duration-300'>
                        {$icon_forum}
                    </div>
                    <h3 class='text-lg font-bold text-slate-800 mb-2'>Chat Neural</h3>
                    <p class='text-slate-500 text-xs md:text-sm leading-relaxed mb-4'>Interaja com o suporte e tire dúvidas sobre os experimentos.</p>
                </div>
                <div class='flex items-center gap-1 text-purple-600 text-xs font-bold uppercase tracking-wider mt-auto pt-2'>
                    <span>Conversar</span> {$icon_arrow_purple}
                </div>
            </a>

            <!-- CARD MODO QUIOSQUE -->
            <a href='quiosque.php' class='glass p-6 rounded-2xl border border-slate-200 hover:border-emerald-300 hover:bg-white transition-all duration-300 group flex flex-col justify-between shadow-sm'>
                <div>
                    <div class='w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center mb-5 group-hover:scale-105 transition-transform duration-300'>
                        {$icon_display}
                    </div>
                    <h3 class='text-lg font-bold text-slate-800 mb-2'>Modo Quiosque</h3>
                    <p class='text-slate-500 text-xs md:text-sm leading-relaxed mb-4'>Gerencie as aplicações VR em execução e telemetria.</p>
                </div>
                <div class='flex items-center gap-1 text-emerald-600 text-xs font-bold uppercase tracking-wider mt-auto pt-2'>
                    <span>Monitorar</span> {$icon_arrow_emer}
                </div>
            </a>

        </div>

        <section class='glass px-6 py-4 rounded-xl border border-slate-200 shadow-sm'>
            <div class='flex items-center justify-between flex-wrap gap-2'>
                <div class='flex items-center gap-3'>
                    <span class='relative flex h-2 w-2'>
                        <span class='animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75'></span>
                        <span class='relative inline-flex rounded-full h-2 w-2 bg-green-500'></span>
                    </span>
                    <span class='text-xs font-bold text-slate-500 uppercase tracking-wider'>Status Global: Online</span>
                </div>
                <div class='text-slate-400 text-[11px] font-mono tracking-tight'>
                    LAST_SYNC: " . date('d/m/Y H:i') . "
                </div>
            </div>
        </section>

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
</style>

<script>
    (function() {
        const NOME_ANONIMO = '********';

        function aplicarPrivacidade() {
            const ativo = localStorage.getItem('senai_privacidade_ativa') === 'true';

            document.querySelectorAll('.user-name-display').forEach(el => {
                if (!el.dataset.nomeOriginal && el.innerText !== NOME_ANONIMO) {
                    el.dataset.nomeOriginal = el.innerText;
                }
                if (el.dataset.nomeOriginal) {
                    el.innerText = ativo ? NOME_ANONIMO : el.dataset.nomeOriginal;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', aplicarPrivacidade);
        window.addEventListener('storage', aplicarPrivacidade);
        aplicarPrivacidade();
    })();
</script>


";

renderizar_pagina("Início", $conteudo);


?>