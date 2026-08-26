<div id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4" style="height: 400px;">
    </div>

<div class="flex gap-2 px-4 mb-2 overflow-x-auto">
    <button onclick="sugerir('Como ajustar o foco?')" class="bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] px-3 py-1 rounded-full">🎯 Foco</button>
    <button onclick="sugerir('Sinto tontura, o que fazer?')" class="bg-red-500/10 border border-red-500/20 text-red-400 text-[10px] px-3 py-1 rounded-full">🤢 Tontura</button>
</div>

<div class="p-4 border-t border-white/10 flex gap-2">
    <input type="text" id="inputChat" placeholder="Pergunte algo para a IA..." 
           class="flex-1 bg-slate-900 border border-white/10 rounded-xl px-4 py-3 text-white outline-none focus:border-cyan-500/50">
    <button onclick="enviarParaIA()" class="bg-cyan-500 text-slate-900 p-3 rounded-xl hover:bg-cyan-400 transition-all">
        <span class="material-symbols-outlined">send</span>
    </button>
</div>

<script>
// Função para os botões de sugestão
function sugerir(texto) {
    document.getElementById('inputChat').value = texto;
    enviarParaIA();
}

async function enviarParaIA() {
    const input = document.getElementById('inputChat');
    const container = document.getElementById('chat-container');
    const texto = input.value.trim();

    if (texto === "") return;

    // 1. Adiciona sua mensagem na tela
    container.innerHTML += `
        <div class="flex justify-end animate-in slide-in-from-right-5">
            <div class="bg-blue-600/20 border border-blue-500/30 p-4 rounded-2xl max-w-[80%] text-white shadow-lg">
                ${texto}
            </div>
        </div>`;

    input.value = "";
    container.scrollTop = container.scrollHeight;

    // 2. Cria balão de carregamento
    const idTemp = "ia-" + Date.now();
    container.innerHTML += `
        <div class="flex justify-start animate-in slide-in-from-left-5" id="${idTemp}">
            <div class="bg-slate-800/50 border border-white/10 p-4 rounded-2xl max-w-[80%] text-slate-300">
                <span class="animate-pulse">Sincronizando com Spatial Core...</span>
            </div>
        </div>`;

    try {
        const formData = new FormData();
        formData.append('mensagem', texto);

        // ATENÇÃO: Verifique se o nome do arquivo abaixo está correto
        const response = await fetch('processa_chat.php', {
            method: 'POST',
            body: formData
        });

        const respostaDaIA = await response.text();

        // 3. Substitui o carregamento pela resposta real
        document.getElementById(idTemp).innerHTML = `
            <div class="bg-slate-800/80 border border-cyan-500/30 p-4 rounded-2xl max-w-[80%] text-slate-100 shadow-[0_0_20px_rgba(6,182,212,0.1)]">
                ${respostaDaIA}
            </div>`;

    } catch (error) {
        document.getElementById(idTemp).innerHTML = "Erro na conexão neural.";
    }
    container.scrollTop = container.scrollHeight;
}

// Enviar ao apertar Enter
document.getElementById('inputChat').addEventListener('keypress', (e) => { if(e.key === 'Enter') enviarParaIA(); });
</script>