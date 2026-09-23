<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

// 1. Pega o nome do utilizador salvo na sessão
$nome_usuario = $_SESSION['usuario_nome'] ?? $_SESSION['nome'] ?? 'Usuário';

// 2. Identifica o e-mail guardado na sessão
$email_usuario = strtolower(
    $_SESSION['usuario_email'] ?? 
    $_SESSION['email'] ?? 
    $_SESSION['user_email'] ?? ''
);

// 3. Identifica o tipo do utilizador salvo na sessão ou via parâmetro GET
$tipo_usuario = strtolower(
    $_GET['tipo'] ?? 
    $_SESSION['usuario_tipo'] ?? 
    $_SESSION['tipo'] ?? 
    $_SESSION['nivel'] ?? 
    $_SESSION['perfil'] ?? ''
);

// 4. Lógica para identificar se é Professor ou Aluno:
// O perfil assume "Professor" se o tipo for definido como tal OU se o email/nome contiver termos chave (ex: 'vitor', 'prof', 'docente')
$is_professor = (
    in_array($tipo_usuario, ['professor', 'docente', 'instrutor', 'admin']) ||
    str_contains($email_usuario, 'prof') ||
    str_contains($email_usuario, 'docente') ||
    str_contains($email_usuario, 'vitor') || 
    str_contains(strtolower($nome_usuario), 'vitor')
);

// Define o texto exacto a ser exibido no badge
$rotulo_painel = $is_professor ? 'Painel do Professor' : 'Painel do Aluno';

// Ícones
$icon_badge        = render_icon($is_professor ? 'badge' : 'school', 'w-4 h-4 text-cyan-600');
$icon_stories      = render_icon('auto_stories', 'w-6 h-6 text-cyan-600');
$icon_forum        = render_icon('forum', 'w-6 h-6 text-purple-600');
$icon_display      = render_icon('smart_display', 'w-6 h-6 text-emerald-600');
$icon_arrow_cyan   = render_icon('arrow_forward', 'w-4 h-4 text-cyan-600 group-hover:translate-x-1 transition-transform');
$icon_arrow_purple = render_icon('arrow_forward', 'w-4 h-4 text-purple-600 group-hover:translate-x-1 transition-transform');
$icon_arrow_emer   = render_icon('arrow_forward', 'w-4 h-4 text-emerald-600 group-hover:translate-x-1 transition-transform');

$conteudo = "
<!-- PASSO 3: Link para o arquivo CSS global em /css/style.css -->
<link rel='stylesheet' href='../css/style.css'>

<!-- PASSO 4: Estrutura visual de fundo com luzes e malha -->
<div class='fixed inset-0 -z-10 pointer-events-none overflow-hidden'>
    <div class='absolute inset-0 grid-faint-interno'></div>
    <div class='absolute -top-20 -left-20 w-[400px] h-[400px] bg-cyan-400/15 blur-[120px] rounded-full'></div>
    <div class='absolute bottom-0 right-0 w-[500px] h-[500px] bg-slate-400/15 blur-[140px] rounded-full'></div>
</div>

<div class='p-6 md:p-8 animate-in fade-in duration-500 flex flex-col h-[calc(100vh-120px)] overflow-y-auto scroller-limpo relative z-10'>
    <div class='max-w-6xl mx-auto w-full flex flex-col h-full justify-between space-y-6'>
        
        <!-- CABEÇALHO BOAS-VINDAS -->
        <header class='relative p-8 md:p-10 rounded-3xl border border-slate-200/80 shadow-sm bg-white/90 backdrop-blur-md overflow-hidden shrink-0'>
            <div class='absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-cyan-500/10 to-transparent blur-3xl pointer-events-none rounded-full'></div>
            
            <div class='relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4'>
                <div>
                    <div class='flex items-center gap-2 mb-3'>
                        <span class='px-3 py-1.5 bg-cyan-50 border border-cyan-100 rounded-full text-[11px] font-bold text-cyan-700 tracking-wider uppercase flex items-center gap-2 shadow-xs'>
                            {$icon_badge} {$rotulo_painel}
                        </span>
                    </div>
                    <h1 class='text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight'>
                        Olá, <span class='user-name-display text-slate-900 font-extrabold inline-block max-w-[280px] sm:max-w-none truncate align-bottom'>{$nome_usuario}</span>!
                    </h1>
                    <p class='text-slate-500 text-sm md:text-base max-w-2xl leading-relaxed mt-2'>
                        O ecossistema <strong class='text-slate-800 font-semibold'>SENAI VR</strong> está operando em capacidade total. Selecione uma das plataformas abaixo para iniciar suas atividades.
                    </p>
                </div>

                <div class='hidden lg:flex items-center gap-2 px-4 py-2 bg-slate-50/80 rounded-2xl border border-slate-200/60 text-xs text-slate-500 font-medium'>
                    <span class='w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_#10b981]'></span>
                    Servidor Principal: ATIVO
                </div>
            </div>
        </header>

        <!-- CARDS DE ACESSO RÁPIDO -->
        <div class='grid grid-cols-1 md:grid-cols-3 gap-6 flex-1 my-2'>
            
            <!-- CARD MANUAL TÉCNICO -->
            <a href='tutorial.php' class='bg-white/90 backdrop-blur-md p-7 rounded-3xl border border-slate-200/80 hover:border-cyan-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between block cursor-pointer'>
                <div>
                    <div class='w-14 h-14 bg-cyan-50/80 border border-cyan-200/60 group-hover:border-cyan-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-105 transition-all duration-300 shadow-xs'>
                        {$icon_stories}
                    </div>
                    <h3 class='text-xl font-bold text-slate-900 mb-2 group-hover:text-cyan-700 transition-colors'>Manual Técnico</h3>
                    <p class='text-slate-500 text-xs md:text-sm leading-relaxed'>Acesse os protocolos de segurança, guias operacionais e setup do Meta Quest 3S.</p>
                </div>
                <div class='flex items-center justify-between text-cyan-600 text-xs font-bold uppercase tracking-wider mt-6 pt-4 border-t border-slate-100'>
                    <span>Acessar Guia</span>
                    {$icon_arrow_cyan}
                </div>
            </a>

            <!-- CARD CHAT IMERSIVO -->
            <a href='dashboard.php' class='bg-white/90 backdrop-blur-md p-7 rounded-3xl border border-slate-200/80 hover:border-purple-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between block cursor-pointer'>
                <div>
                    <div class='w-14 h-14 bg-purple-50/80 border border-purple-200/60 group-hover:border-purple-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-105 transition-all duration-300 shadow-xs'>
                        {$icon_forum}
                    </div>
                    <h3 class='text-xl font-bold text-slate-900 mb-2 group-hover:text-purple-700 transition-colors'>Chat Imersivo</h3>
                    <p class='text-slate-500 text-xs md:text-sm leading-relaxed'>Tire dúvidas com o assistente virtual em tempo real sobre os experimentos teóricos.</p>
                </div>
                <div class='flex items-center justify-between text-purple-600 text-xs font-bold uppercase tracking-wider mt-6 pt-4 border-t border-slate-100'>
                    <span>Iniciar Chat</span>
                    {$icon_arrow_purple}
                </div>
            </a>

            <!-- CARD MODO QUIOSQUE -->
            <a href='quiosque.php' class='bg-white/90 backdrop-blur-md p-7 rounded-3xl border border-slate-200/80 hover:border-emerald-400 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between block cursor-pointer'>
                <div>
                    <div class='w-14 h-14 bg-emerald-50/80 border border-emerald-200/60 group-hover:border-emerald-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-105 transition-all duration-300 shadow-xs'>
                        {$icon_display}
                    </div>
                    <h3 class='text-xl font-bold text-slate-900 mb-2 group-hover:text-emerald-700 transition-colors'>Modo Quiosque</h3>
                    <p class='text-slate-500 text-xs md:text-sm leading-relaxed'>Gerencie os óculos de realidade virtual conectados, telemetria e execuções de apps.</p>
                </div>
                <div class='flex items-center justify-between text-emerald-600 text-xs font-bold uppercase tracking-wider mt-6 pt-4 border-t border-slate-100'>
                    <span>Painel de Controle</span>
                    {$icon_arrow_emer}
                </div>
            </a>

        </div>

        <!-- FOOTER / STATUS BAR -->
        <section class='bg-white/90 backdrop-blur-md px-6 py-4 rounded-2xl border border-slate-200/80 shadow-sm'>
            <div class='flex items-center justify-between flex-wrap gap-4'>
                <!-- Status principal -->
                <div class='flex items-center gap-3'>
                    <span class='relative flex h-2.5 w-2.5'>
                        <span class='animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75'></span>
                        <span class='relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500 shadow-[0_0_8px_#10b981]'></span>
                    </span>
                    <span class='text-xs font-bold text-slate-700 uppercase tracking-wider'>Status dos Serviços</span>
                </div>

                <!-- Métricas do Sistema -->
                <div class='hidden sm:flex items-center gap-6 text-xs text-slate-500'>
                    <div class='flex items-center gap-2'>
                        <span class='w-2 h-2 rounded-full bg-emerald-500'></span>
                        <span>Óculos Conectados: <strong class='text-slate-700'>12/12</strong></span>
                    </div>
                    <div class='flex items-center gap-2'>
                        <span class='w-2 h-2 rounded-full bg-cyan-500'></span>
                        <span>Latência: <strong class='text-slate-700'>14ms</strong></span>
                    </div>
                </div>

                <!-- Data de Sincronização -->
                <div class='text-slate-400 text-xs font-mono tracking-tight flex items-center gap-2 bg-slate-50/80 px-3 py-1 rounded-lg border border-slate-100'>
                    <span>ÚLTIMA SINCRONIZAÇÃO:</span>
                    <strong class='text-slate-600'>" . date('d/m/Y H:i') . "</strong>
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