<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}

if (file_exists(__DIR__ . '/layout.php')) {
    require_once __DIR__ . '/layout.php';
} else {
    require_once __DIR__ . '/../layout.php';
}

$extra_css = "
<link rel='stylesheet' href='../css/style.css'>

<!-- Estrutura visual de fundo com luzes e malha -->
<div class='fixed inset-0 -z-10 pointer-events-none overflow-hidden'>
    <div class='absolute inset-0 grid-faint-interno'></div>
    <div class='absolute -top-20 -left-20 w-[400px] h-[400px] bg-cyan-400/15 blur-[120px] rounded-full'></div>
    <div class='absolute bottom-0 right-0 w-[500px] h-[500px] bg-slate-400/15 blur-[140px] rounded-full'></div>
</div>

<style>
    .glass-panel { 
        background: rgba(255, 255, 255, 0.85); 
        backdrop-filter: blur(20px); 
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05);
    }
    
    .sidebar-manual-list::-webkit-scrollbar { width: 4px; }
    .sidebar-manual-list::-webkit-scrollbar-thumb { background: rgba(8, 145, 178, 0.3); border-radius: 10px; }
    
    .nav-manual-btn { 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        border: 1px solid rgba(226, 232, 240, 0.8); 
        margin-bottom: 0.5rem; 
        text-align: left; 
        padding: 0.85rem 1rem; 
        width: 100%; 
        border-radius: 1rem; 
        font-size: 0.85rem; 
        color: #64748b; 
        background: rgba(255, 255, 255, 0.9); 
    }
    .nav-manual-btn:hover { 
        background: rgba(8, 145, 178, 0.05); 
        transform: translateX(4px); 
        border-color: rgba(8, 145, 178, 0.3); 
        color: #0f172a; 
    }
    .nav-manual-btn.active { 
        background-color: rgba(8, 145, 178, 0.1); 
        border-color: #0891b2; 
        color: #0891b2; 
        font-weight: 700; 
    }
    
    .content-section { display: none; }
    .content-section.active { display: block; animation: slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    
    @keyframes slideIn { 
        from { opacity: 0; transform: translateY(8px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    .step-img { 
        width: 100%; 
        border-radius: 1.5rem; 
        border: 1px solid rgba(226, 232, 240, 0.8); 
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
    }

    .status-badge-manual {
        display: inline-flex;
        align-items: center;
        background: rgba(5, 150, 105, 0.08);
        color: #059669;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 10px;
        font-weight: 700;
        border: 1px solid rgba(5, 150, 105, 0.2);
    }
    .status-dot-manual { width: 6px; height: 6px; background: #059669; border-radius: 50%; margin-right: 8px; animation: pulse-manual 2s infinite; }
    @keyframes pulse-manual { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }
</style>
";

$conteudo = $extra_css . "
<div class='p-6 md:p-8 h-[calc(100vh-80px)] flex flex-col w-full overflow-hidden relative z-10'>
    
    <header class='flex justify-between items-end mb-6 shrink-0'>
        <div>
            <div class='status-badge-manual mb-2'>
                <span class='status-dot-manual'></span> SISTEMA OPERACIONAL ATIVO
            </div>
            <h1 class='text-3xl font-extrabold tracking-tight text-slate-900'>Manual de Operação Técnica</h1>
            <p class='text-cyan-700/80 text-[10px] uppercase tracking-[0.3em] font-bold mt-1'>SENAI VR | Protocolo Meta Quest 3S</p>
        </div>
    </header>

    <div class='flex gap-6 flex-1 overflow-hidden min-h-0'>
        <!-- BARRA LATERAL -->
        <aside class='w-1/4 flex flex-col shrink-0 h-full overflow-hidden'>
            <div class='sidebar-manual-list flex-1 overflow-y-auto pr-2 space-y-1'>
                <button onclick='selectTopic(this, \"s1\")' class='nav-manual-btn active'>01. Setup Inicial & QR</button>
                <button onclick='selectTopic(this, \"s2\")' class='nav-manual-btn'>02. Ajuste de Lentes (IPD)</button>
                <button onclick='selectTopic(this, \"s3\")' class='nav-manual-btn'>03. Espaçador de Óculos</button>
                <button onclick='selectTopic(this, \"s4\")' class='nav-manual-btn'>04. Tampa da Bateria</button>
                <button onclick='selectTopic(this, \"s5\")' class='nav-manual-btn text-rose-600 font-semibold'>05. Cuidado Crítico (Sol)</button>
                <button onclick='selectTopic(this, \"s6\")' class='nav-manual-btn'>06. Rastreamento</button>
                <button onclick='selectTopic(this, \"s7\")' class='nav-manual-btn'>07. Ajuste de Faixa (Strap)</button>
                <button onclick='selectTopic(this, \"s8\")' class='nav-manual-btn'>08. Anatomia do Headset</button>
                <button onclick='selectTopic(this, \"s9\")' class='nav-manual-btn'>09. Anatomia dos Controles</button>
            </div>
            
            <div class='pt-3 pr-2 shrink-0 bg-transparent'>
                <button onclick='showAllManual(this)' class='nav-manual-btn border-cyan-400 text-center font-bold text-cyan-700 hover:bg-cyan-50/80 shadow-xs'>VISUALIZAR TUDO</button>
            </div>
        </aside>

        <!-- ÁREA PRINCIPAL DE CONTEÚDO -->
        <main id='manual-content-area' class='w-3/4 glass-panel p-8 md:p-10 rounded-[2rem] overflow-y-auto custom-scrollbar h-full'>
            
            <div id='s1' class='content-section active space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Iniciação de Hardware
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>01. Setup Inicial & QR Code</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 leading-relaxed text-justify'>
                        Escaneie o código QR abaixo para acessar os vídeos. Você pode fazer isso diretamente pela câmera do seu smartphone ou através das lentes do Meta Quest 3S.
                    </p>
                    <img src='./img/Passo1.jpg' class='step-img aspect-video object-cover'>
                    <img src='./img/passo_1.jpg' class='step-img aspect-video object-cover'>
                </div>
            </div>

            <div id='s2' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Calibração Óptica
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>02. Ajuste de Lentes</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 leading-relaxed text-justify'>
                        Mova as lentes manualmente para a esquerda ou direita até que a imagem central fique perfeitamente nítida. O ajuste correto evita fadiga ocular e garante a melhor imersão.
                    </p>
                    <img src='./img/Passo2.jpg' class='step-img aspect-video object-cover'>
                </div>
            </div>

            <div id='s3' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Protocolo de Ergonomia
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>03. Uso com Óculos</h2>
                <div class='space-y-6'>
                    <div class='flex gap-4 items-start'>
                        <span class='bg-cyan-600 text-white w-7 h-7 rounded-full flex items-center justify-center font-bold text-sm shrink-0 mt-0.5'>1</span>
                        <p class='text-slate-600 leading-relaxed text-justify'>Remova a <strong>interface facial</strong> puxando firmemente pelas bordas laterais.</p>
                    </div>
                    <div class='flex gap-4 items-start'>
                        <span class='bg-cyan-600 text-white w-7 h-7 rounded-full flex items-center justify-center font-bold text-sm shrink-0 mt-0.5'>2</span>
                        <p class='text-slate-600 leading-relaxed text-justify'>Encaixe o <strong>espaçador de óculos</strong> entre o headset e a interface facial.</p>
                    </div>
                    <img src='./img/Passo3.jpg' class='step-img aspect-video object-cover'>
                </div>
            </div>

            <div id='s4' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Energia do Sistema
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>04. Tampa da Bateria</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 leading-relaxed text-justify'>
                        Pressione o botão de ejeção na lateral do controle para liberar a tampa. Deslize-a para baixo para substituir a pilha AA.
                    </p>
                    <img src='./img/Passo4.jpg' class='step-img aspect-video object-cover'>
                </div>
            </div>

            <div id='s5' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-rose-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-rose-600'></span> Alerta de Segurança
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>05. Cuidado Crítico: Luz Solar</h2>
                <div class='space-y-6 bg-rose-50/80 p-6 rounded-2xl border border-rose-200/80'>
                    <p class='text-justify text-rose-900 leading-relaxed'>
                        <strong>IMPORTANTE:</strong> Nunca exponha as lentes internas ao sol. A luz solar direta pode queimar permanentemente os ecrãs LCD do headset em poucos segundos.
                    </p>
                    <img src='./img/Passo5.jpg' class='step-img aspect-video object-cover border-rose-200'>
                </div>
            </div>

            <div id='s6' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Sensores Ópticos
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>06. Rastreamento (Tracking)</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 leading-relaxed text-justify'>
                        Mantenha as câmeras de rastreamento externas limpas. O sistema utiliza estas câmeras para mapear o ambiente.
                    </p>
                    <img src='./img/Passo6.jpg' class='step-img aspect-video object-cover'>
                </div>
            </div>

            <div id='s7' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Ergonomia
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>07. Ajuste de Faixa (Strap)</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 leading-relaxed text-justify'>
                        Posicione a parte traseira da faixa na base do crânio. Ajuste as alças laterais e a alça de topo até que o headset esteja firme.
                    </p>
                    <img src='./img/Passo7.jpg' class='step-img aspect-video object-cover'>
                </div>
            </div>

            <div id='s8' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Hardware Overview
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>08. Anatomia do Headset</h2>

                <div class='space-y-6'>
                    <div class='space-y-4 bg-slate-50/80 p-6 rounded-2xl border border-slate-200/80'>
                        <p class='text-slate-600 leading-relaxed text-justify'>
                            <strong class='text-cyan-700'>[Liga/Desliga]:</strong> Localizado na lateral esquerda.
                        </p>
                        <p class='text-slate-600 leading-relaxed text-justify'>
                            <strong class='text-cyan-700'>[Botões de Volume]:</strong> Posicionados na parte inferior do visor.
                        </p>
                        <p class='text-slate-600 leading-relaxed text-justify'>
                            <strong class='text-cyan-700'>[Entrada USB-C]:</strong> Localizada na lateral esquerda do headset.
                        </p>
                    </div>

                    <img src='./img/Passo8.jpg' alt='Anatomia Meta Quest 3S' class='step-img aspect-video object-cover'>
                </div>
            </div>

            <div id='s9' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Controladores Touch Plus
                </div>
                <h2 class='text-3xl font-extrabold text-slate-900 tracking-tight'>09. Anatomia dos Controles</h2>
                
                <div class='space-y-6'>
                    <div class='bg-slate-50/80 p-6 rounded-2xl border border-slate-200/80'>
                        <h3 class='text-cyan-700 font-bold text-sm tracking-wide mb-2 uppercase'>ATIVAÇÃO E PAREAMENTO</h3>
                        <p class='text-slate-600 leading-relaxed text-justify'>
                            Para ligar os controles do <strong>Meta Quest 3S</strong>, basta colocar as pilhas AA e movimentá-los.
                        </p>
                    </div>

                    <div class='grid grid-cols-1 md:grid-cols-2 gap-4 px-1'>
                        <div class='p-4 bg-white/60 rounded-xl border border-slate-200/60'>
                            <p class='text-slate-800 font-bold text-sm'>• Botões A e B (Direito)</p>
                            <p class='text-slate-500 text-xs mt-1'>A (Ação), B (Menu/Voltar).</p>
                        </div>
                        <div class='p-4 bg-white/60 rounded-xl border border-slate-200/60'>
                            <p class='text-slate-800 font-bold text-sm'>• Botão Meta (Direito)</p>
                            <p class='text-slate-500 text-xs mt-1'>Abre o menu universal.</p>
                        </div>
                    </div>

                    <img src='./img/Passo9.jpg' class='step-img aspect-video object-cover'>
                    <img src='./img/Passo9_1.jpg' class='step-img aspect-video object-cover'>
                    <img src='./img/Passo9_2.jpg' class='step-img aspect-video object-cover'>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    function selectTopic(btn, id) {
        document.querySelectorAll('.nav-manual-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.content-section').forEach(c => c.classList.remove('active'));
        document.getElementById(id).classList.add('active');
        document.getElementById('manual-content-area').scrollTop = 0;
    }

    function showAllManual(btn) {
        document.querySelectorAll('.nav-manual-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.content-section').forEach(c => c.classList.add('active'));
        document.getElementById('manual-content-area').scrollTop = 0;
    }
</script>
";

if (function_exists('renderizar_pagina')) {
    renderizar_pagina("Manual Técnico", $conteudo);
} else {
    echo $conteudo;
}
?>