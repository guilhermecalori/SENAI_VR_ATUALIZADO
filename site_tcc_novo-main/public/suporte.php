<!DOCTYPE html>
<html class="dark" lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte Neural | SENAI VR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Manrope:wght@300;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        body { 
            background: linear-gradient(-45deg, #010204, #061621, #010204, #0a1f2e);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
            font-family: 'Manrope', sans-serif; 
            color: #fff; 
            height: 100vh;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h1, h2, h3, h4 { font-family: 'Space Grotesk', sans-serif; }
        
        .glass-panel { 
            background: rgba(18, 22, 33, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(255,255,255,0.08); 
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }

        .chat-panel {
            background: rgba(10, 13, 20, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.03);
        }

        #chat-box::-webkit-scrollbar { width: 4px; }
        #chat-box::-webkit-scrollbar-thumb { background: #06b6d4; border-radius: 10px; }
        
        .typing-dot { animation: typing-blink 1s infinite; }
        @keyframes typing-blink { 0%, 100% { opacity: 0.2; } 50% { opacity: 1; } }

        .btn-neural {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-neural:hover {
            background: rgba(6, 182, 212, 0.1);
            border-color: rgba(6, 182, 212, 0.3);
            transform: translateX(5px);
        }
    </style>
</head>
<body class="flex items-center justify-center p-6">

    <div class="w-full h-full flex flex-col gap-6 max-w-[1600px]">
        
        <header class="glass-panel p-6 rounded-[2rem] flex items-center justify-between shrink-0">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-cyan-500/10 rounded-2xl flex items-center justify-center border border-cyan-500/20 shadow-inner">
                    <span class="material-symbols-outlined text-cyan-400 text-3xl">psychology</span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-white">Spatial Core <span class="text-cyan-500">Suporte Neural</span></h1>
                    <p class="text-slate-400 text-xs uppercase tracking-widest font-bold">Assistente Técnico Inteligente</p>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <div class="text-[10px] text-slate-500 font-bold uppercase">Hardware ID</div>
                    <div class="text-sm font-mono text-cyan-400">MQ3-5X41-99B7</div>
                </div>
                <div class="h-10 w-[1px] bg-white/10"></div>
                <span class="material-symbols-outlined text-emerald-400 text-4xl">check_circle</span>
            </div>
        </header>
        
        <div class="flex-1 grid grid-cols-4 gap-6 overflow-hidden">
            
            <div class="col-span-1 space-y-6 flex flex-col">
                <section class="chat-panel p-6 rounded-[2rem] space-y-4 shadow-xl">
                    <h2 class="text-sm font-bold text-cyan-400 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">quiz</span> Consultas Rápidas
                    </h2>
                    <div class="space-y-2">
                        <button onclick="setQuery('Como calibrar o sistema de rastreamento Inside-Out?')" class="btn-neural w-full text-left p-4 rounded-2xl text-xs font-medium">Calibragem de Rastreamento</button>
                        <button onclick="setQuery('Quais os passos para pareamento de controladores Touch Pro?')" class="btn-neural w-full text-left p-4 rounded-2xl text-xs font-medium">Parear Controles Pro</button>
                        <button onclick="setQuery('Como otimizar a latência em streaming sem fio (Air Link)?')" class="btn-neural w-full text-left p-4 rounded-2xl text-xs font-medium">Otimizar Air Link</button>
                    </div>
                </section>

                <section class="chat-panel p-6 rounded-[2rem] space-y-4 shadow-xl border-l-2 border-cyan-500/30">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2 italic">
                        <span class="status-pulse w-2 h-2 bg-emerald-500 rounded-full typing-dot"></span> Status do Hardware
                    </h3>
                    <div class="space-y-3 text-[11px]">
                        <div class="flex justify-between items-center"><span class="text-slate-400">Estado do Sensor</span><span class="font-bold text-emerald-400 uppercase">Operacional</span></div>
                        <div class="flex justify-between items-center"><span class="text-slate-400">Nível de Carga</span><span class="font-bold text-white">78%</span></div>
                        <div class="flex justify-between items-center"><span class="text-slate-400">Firmware</span><span class="font-mono text-slate-400">v62.1.2-STABLE</span></div>
                    </div>
                </section>

                <a href="dashboard.php" class="mt-auto glass-panel p-5 rounded-2xl text-center text-sm font-bold hover:bg-white/5 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Retornar ao Dashboard
                </a>
            </div>

            <div class="col-span-3 flex flex-col chat-panel rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/5">
                <div class="p-5 border-b border-white/5 flex items-center justify-between bg-white/5">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 flex items-center justify-center border border-cyan-500/20 text-cyan-400">
                            <span class="material-symbols-outlined">neurology</span>
                        </div>
                        <div>
                            <div class="font-bold text-sm">Assistente Neural Core</div>
                            <div class="text-[10px] text-emerald-400 flex items-center gap-1.5"><span class="typing-dot text-lg">●</span> Sincronizado</div>
                        </div>
                    </div>
                </div>

                <div id="chat-box" class="flex-1 overflow-y-auto p-8 space-y-8">
                    <div class="flex gap-4 items-start">
                        <div class="w-8 h-8 rounded-lg bg-cyan-900/30 border border-cyan-700/50 flex items-center justify-center text-cyan-400 font-bold text-[10px]">IA</div>
                        <div class="bg-white/5 p-5 rounded-[1.5rem] rounded-tl-none max-w-[80%] text-sm text-slate-300 border border-white/5 leading-relaxed">
                            Bem-vindo ao suporte Meta Quest. Eu sou o núcleo de inteligência do Spatial Core. Como posso auxiliar seu diagnóstico hoje?
                        </div>
                    </div>
                </div>
                
                <div class="p-6 bg-black/20 shrink-0">
                    <div class="relative max-w-4xl mx-auto">
                        <input type="text" id="user-input" placeholder="Descreva sua dúvida técnica..." 
                               class="w-full bg-slate-950/50 border border-white/10 rounded-2xl p-5 pr-28 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500/30 transition-all placeholder:text-slate-600">
                        <button onclick="sendMessage()" class="absolute right-2 top-2 bottom-2 bg-cyan-600 text-slate-950 font-bold px-6 rounded-xl hover:bg-cyan-400 transition-colors">
                            Enviar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const chatBox = document.getElementById('chat-box');
    const userInput = document.getElementById('user-input');

    // Mantemos o banco local para as imagens dos passos
    const baseConhecimento = [
        { id: "passo1", palavras: ["passo 1", "qr code", "configuração"], resposta: "<strong>PASSO 1: Configuração Inicial</strong><br><br>Escaneie o código QR para vídeos e app Meta Horizon.<br><img src='img/passo1.jpg' class='rounded-xl mt-3 border border-cyan-500/30'>" },
        { id: "passo2", palavras: ["passo 2", "lentes", "nítida"], resposta: "<strong>PASSO 2: Ajuste de Lentes</strong><br><br>Mova as lentes para encontrar a visão mais nítida.<br><img src='img/passo2.jpg' class='rounded-xl mt-3 border border-cyan-500/30'>" },
        { id: "passo5", palavras: ["passo 5", "limpeza", "sol", "álcool"], resposta: "<strong>PASSO 5: Cuidado e Limpeza</strong><br><br>NUNCA use álcool ou exponha ao sol.<br><img src='img/passo5.jpg' class='rounded-xl mt-3 border border-cyan-500/30'>" }
        // ... adicione os outros passos aqui se desejar manter as fotos
    ];

    async function sendMessage() {
        const textoOriginal = userInput.value.trim();
        const textoBusca = textoOriginal.toLowerCase();
        
        if(textoBusca === "") return;

        // 1. Mostrar mensagem do usuário
        chatBox.innerHTML += `
            <div class="flex gap-4 items-start justify-end">
                <div class="bg-cyan-500 text-slate-950 p-4 rounded-2xl rounded-tr-none max-w-[80%] text-sm font-bold shadow-lg">
                    ${textoOriginal}
                </div>
            </div>`;
        
        userInput.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;

        // 2. Mostrar "IA processando..."
        const tempId = "ai-" + Date.now();
        chatBox.innerHTML += `
            <div id="${tempId}" class="flex gap-4 items-start">
                <div class="w-8 h-8 rounded-lg bg-cyan-900/30 border border-cyan-700/50 flex items-center justify-center text-cyan-400 font-bold text-[10px]">IA</div>
                <div class="bg-white/5 p-5 rounded-[1.5rem] rounded-tl-none max-w-[80%] text-sm text-slate-300 border border-white/5">
                    <span class="typing-dot">●●●</span> Sincronizando com núcleo neural...
                </div>
            </div>`;
        chatBox.scrollTop = chatBox.scrollHeight;

        // 3. Lógica: Tenta banco local (fotos), se não achar, vai pro Gemini
        let respostaFinal = null;
        /* baseConhecimento.forEach(item => {
            if (item.palavras.some(p => textoBusca.includes(p))) {
                respostaFinal = item.resposta;
            }
        }); */

        if (respostaFinal) {
            exibirResposta(tempId, respostaFinal);
        } else {
            // Chamar o Gemini via PHP
            try {
                const response = await fetch('api_nova.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ message: textoOriginal })
                });
                const data = await response.json();
                exibirResposta(tempId, data.response);
            } catch (e) {
                exibirResposta(tempId, "Erro de conexão com o servidor de IA.");
            }
        }
    }
    function exibirResposta(id, texto) {
    const div = document.getElementById(id);
    if (div) {
        // Usamos este seletor especial para que a barra '/' do Tailwind não quebre o código
        const corpoResposta = div.querySelector('[class*="bg-white/5"]');
        if (corpoResposta) {
            corpoResposta.innerHTML = texto;
        }
    }
    chatBox.scrollTop = chatBox.scrollHeight;
    }

    function setQuery(pergunta) {
    const input = document.getElementById('user-input');
    if (input) {
        input.value = pergunta;
        sendMessage(); // Envia automaticamente ao clicar no botão
    }
}
    </script>
</body>
</html>