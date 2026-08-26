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

$conteudo = "
<style>
    /* DESATIVA QUALQUER SCROLL DA PÁGINA */
    html, body {
        overflow: hidden !important;
    }

    /* CAIXA DO CHAT - TAMANHO IDEAL */
    .chat-card-container {
        width: 100%;
        max-width: 680px; 
        height: 450px !important;
        background-color: #ffffff;
        border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .chat-iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
</style>

<div class='px-4 pt-4 animate-in fade-in duration-500 bg-transparent flex flex-col overflow-hidden'>
    <div class='max-w-6xl mx-auto w-full flex flex-col space-y-3'>
        
        <!-- HEADER INSTITUCIONAL COM ESPAÇAMENTO AJUSTADO -->
        <header class='flex justify-between items-center flex-shrink-0 pb-1 border-b border-slate-200/50'>
            <div class='flex flex-col'>
                <!-- ESPAÇAMENTO ADICIONADO AQUI (mb-2.5) -->
                <div class='inline-flex items-center gap-1.5 px-2.5 py-0.5 bg-cyan-50 border border-cyan-100 rounded-lg w-fit mb-2.5'>
                    <span class='material-symbols-outlined text-cyan-600 text-xs'>psychology</span>
                    <span class='text-[10px] font-bold text-cyan-700 uppercase tracking-wider'>Interface Dialogflow ES</span>
                </div>
                <div>
                    <h1 class='text-xl font-extrabold headline text-slate-800 tracking-tight'>Chat de Suporte VR</h1>
                    <p class='text-slate-500 text-xs font-medium mt-0.5'>Assistente virtual treinado no Dialogflow para o Meta Quest 3S.</p>
                </div>
            </div>
            
            <div class='px-3 py-1 bg-emerald-50 border border-emerald-200/60 rounded-xl text-emerald-600 text-xs font-bold flex items-center gap-2 shadow-sm'>
                <span class='relative flex h-2 w-2'>
                    <span class='animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75'></span>
                    <span class='relative inline-flex rounded-full h-2 w-2 bg-emerald-500'></span>
                </span>
                DIALOGFLOW ONLINE
            </div>
        </header>

        <!-- CONTAINER INTEGRADO DO CHAT -->
        <div class='w-full flex justify-start items-start pt-1 overflow-hidden'>
            
            <div class='chat-card-container'>
                <iframe
                    class='chat-iframe'
                    allow='microphone;'
                    src='https://console.dialogflow.com/api-client/demo/embedded/d2632a25-ee0e-4154-9108-ee09038db7ab'>
                </iframe>
            </div>

        </div>
    </div>
</div>


";

renderizar_pagina("Chat Neural", $conteudo);
?>