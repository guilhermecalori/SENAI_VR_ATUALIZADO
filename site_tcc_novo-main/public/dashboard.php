<?php
session_start();

// 1. PROTOCOLO DE SEGURANÇA
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}

// 2. INTERFACE VISUAL DO CHAT
require_once '../layout.php';

$nome_exibicao = $_SESSION['usuario_nome'] ?? 'Estudante';

// Ícones minimalistas
$icon_sparkles = function_exists('render_icon') ? render_icon('auto_awesome', 'w-4 h-4 text-cyan-600') : '✨';

$conteudo = <<<HTML
<!-- PASSO 3: Link para o arquivo CSS global em /css/style.css -->
<link rel="stylesheet" href="../css/style.css">

<!-- PASSO 4: Estrutura visual de fundo com luzes e malha -->
<div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
    <div class="absolute inset-0 grid-faint-interno"></div>
    <div class="absolute -top-20 -left-20 w-[400px] h-[400px] bg-cyan-400/15 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-slate-400/15 blur-[140px] rounded-full"></div>
</div>

<style>
    /* TRAVA OVERFLOW DA PÁGINA */
    html, body {
        overflow: hidden !important;
        height: 100vh !important;
    }

    .viewport-chat-wrapper {
        height: calc(100vh - 85px);
        display: flex;
        flex-direction: column;
    }

    /* CONTAINER DO CHAT COM RECORTE SUPERIOR */
    .chat-card-container {
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px -2px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        position: relative;
    }

    /* ESCONDE O CABEÇALHO ESCURO E O POWERED BY DIALOGFLOW */
    .chat-iframe {
        width: 100%;
        height: calc(100% + 110px);
        margin-top: -110px;
        border: none;
    }
</style>

<div class="px-6 py-2 animate-in fade-in duration-500 viewport-chat-wrapper relative z-10">
    <div class="max-w-7xl mx-auto w-full flex flex-col h-full space-y-3">
        
        <!-- HEADER LIMPO -->
        <header class="flex justify-between items-center pb-2 border-b border-slate-200/70 shrink-0">
            <div>
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight leading-tight">Chat de Suporte VR</h1>
                <p class="text-slate-500 text-xs font-medium">Assistente virtual para o Meta Quest 3S.</p>
            </div>
            
            <div class="hidden sm:flex items-center gap-3">
                <div class="px-3 py-1 bg-slate-100 border border-slate-200 rounded-xl text-slate-600 text-xs font-bold flex items-center gap-2 shadow-xs">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    DIALOGFLOW ONLINE
                </div>
            </div>
        </header>

        <!-- GRID PADRONIZADA -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 flex-1 min-h-0 items-stretch">
            
            <!-- CHAT (COLUNA ESQUERDA) -->
            <div class="lg:col-span-2 w-full h-full">
                <div class="chat-card-container">
                    <iframe
                        class="chat-iframe"
                        allow="microphone;"
                        src="https://console.dialogflow.com/api-client/demo/embedded/d2632a25-ee0e-4154-9108-ee09038db7ab">
                    </iframe>
                </div>
            </div>

            <!-- LATERAL CLEAN (COLUNA DIREITA AGRUPADA NO TOPO) -->
            <div class="hidden lg:flex flex-col gap-3 h-full justify-start">
                
                <!-- CARD GUIA DE USO -->
                <div class="bg-white/90 backdrop-blur-md p-4 rounded-2xl border border-slate-200/80 shadow-xs space-y-2">
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-2">
                        {$icon_sparkles}
                        <h3 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">Capacidades do Assistente</h3>
                    </div>
                    
                    <p class="text-[11px] text-slate-500 leading-snug">
                        Você pode tirar dúvidas enviando mensagens no chat sobre:
                    </p>

                    <ul class="space-y-1.5 text-xs text-slate-600">
                        <li class="p-2 rounded-lg bg-slate-50/80 border border-slate-100 text-slate-700 font-medium flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 shrink-0"></span>
                            <span class="text-[11px]">Calibração e sensores do Meta Quest 3S</span>
                        </li>
                        <li class="p-2 rounded-lg bg-slate-50/80 border border-slate-100 text-slate-700 font-medium flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 shrink-0"></span>
                            <span class="text-[11px]">Conexão de rede e pareamento</span>
                        </li>
                        <li class="p-2 rounded-lg bg-slate-50/80 border border-slate-100 text-slate-700 font-medium flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 shrink-0"></span>
                            <span class="text-[11px]">Resolução de erros nos experimentos VR</span>
                        </li>
                    </ul>
                </div>

                <!-- CARD TELEMETRIA -->
                <div class="bg-slate-50/90 backdrop-blur-md p-4 rounded-2xl border border-slate-200/80 shadow-xs space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Telemetria da IA</span>
                        <span class="text-[9px] bg-slate-200/80 px-1.5 py-0.5 rounded text-slate-600 font-mono font-bold">v1.2-ES</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="bg-white/90 p-2.5 rounded-xl border border-slate-200/70">
                            <span class="text-[9px] text-slate-400 block mb-0.5 font-medium">Tempo Resposta</span>
                            <strong class="text-sm font-bold text-slate-800">&lt; 1.2s</strong>
                        </div>
                        <div class="bg-white/90 p-2.5 rounded-xl border border-slate-200/70">
                            <span class="text-[9px] text-slate-400 block mb-0.5 font-medium">Acurácia</span>
                            <strong class="text-sm font-bold text-cyan-600">98.4%</strong>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
HTML;

renderizar_pagina("Chat Neural", $conteudo);
?>