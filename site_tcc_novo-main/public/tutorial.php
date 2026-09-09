<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
if (file_exists('../layout.php')) {
    require_once '../layout.php';
}

$extra_css = "
<style>
    .glass-panel { 
        background: rgba(255, 255, 255, 0.7); 
        backdrop-filter: blur(20px); 
        border: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }
    
    .sidebar-manual-list::-webkit-scrollbar { width: 4px; }
    .sidebar-manual-list::-webkit-scrollbar-thumb { background: rgba(8, 145, 178, 0.3); border-radius: 10px; }
    
    .nav-manual-btn { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(0,0,0,0.06); margin-bottom: 0.5rem; text-align: left; padding: 0.85rem 1rem; width: 100%; border-radius: 1rem; font-size: 0.85rem; color: #64748b; background: white; }
    .nav-manual-btn:hover { background: rgba(8, 145, 178, 0.05); transform: translateX(6px); border-color: rgba(8, 145, 178, 0.3); color: #0f172a; }
    .nav-manual-btn.active { background-color: rgba(8, 145, 178, 0.1); border-color: #0891b2; color: #0891b2; font-weight: 700; }
    
    .content-section { display: none; }
    .content-section.active { display: block; animation: slideIn 0.5s ease forwards; }
    
    @keyframes slideIn { 
        from { opacity: 0; transform: translateY(10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    .step-img { 
        width: 100%; 
        border-radius: 1.5rem; 
        border: 1px solid rgba(0, 0, 0, 0.06); 
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
    }

    .status-badge-manual {
        display: inline-flex;
        align-items: center;
        background: rgba(5, 150, 105, 0.08);
        color: #059669;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 10px;
        font-weight: bold;
        border: 1px solid rgba(5, 150, 105, 0.2);
    }
    .status-dot-manual { width: 6px; height: 6px; background: #059669; border-radius: 50%; margin-right: 8px; animation: pulse-manual 2s infinite; }
    @keyframes pulse-manual { 0% { opacity: 1; } 50% { opacity: 0.3; } 100% { opacity: 1; } }
</style>
";

$conteudo = $extra_css . "
<div class='p-6 md:p-8 h-[calc(100vh-80px)] flex flex-col w-full overflow-hidden'>
    
    <header class='flex justify-between items-end mb-4 shrink-0'>
        <div>
            <div class='status-badge-manual mb-2'>
                <span class='status-dot-manual'></span> SISTEMA OPERACIONAL ATIVO
            </div>
            <h1 class='text-3xl font-bold headline tracking-tight text-slate-900'>Manual de Operação Técnica</h1>
            <p class='text-cyan-700/80 text-[10px] uppercase tracking-[0.3em] font-bold mt-1'>SENAI VR | Protocolo Meta Quest 3S</p>
        </div>
    </header>

    <div class='flex gap-6 flex-1 overflow-hidden min-h-0'>
        <!-- BARRA LATERAL COM BOTÃO VISUALIZAR TUDO FIXO NO RODAPÉ -->
        <aside class='w-1/4 flex flex-col shrink-0 h-full overflow-hidden'>
            <div class='sidebar-manual-list flex-1 overflow-y-auto pr-2 space-y-1'>
                <button onclick='selectTopic(this, \"s1\")' class='nav-manual-btn active'>01. Setup Inicial & QR</button>
                <button onclick='selectTopic(this, \"s2\")' class='nav-manual-btn'>02. Ajuste de Lentes (IPD)</button>
                <button onclick='selectTopic(this, \"s3\")' class='nav-manual-btn'>03. Espaçador de Óculos</button>
                <button onclick='selectTopic(this, \"s4\")' class='nav-manual-btn'>04. Tampa da Bateria</button>
                <button onclick='selectTopic(this, \"s5\")' class='nav-manual-btn text-red-500'>05. Cuidado Crítico (Sol)</button>
                <button onclick='selectTopic(this, \"s6\")' class='nav-manual-btn'>06. Rastreamento</button>
                <button onclick='selectTopic(this, \"s7\")' class='nav-manual-btn'>07. Ajuste de Faixa (Strap)</button>
                <button onclick='selectTopic(this, \"s8\")' class='nav-manual-btn'>08. Anatomia do Headset</button>
                <button onclick='selectTopic(this, \"s9\")' class='nav-manual-btn'>09. Anatomia dos Controles</button>
            </div>
            
            <div class='pt-3 pr-2 shrink-0 bg-transparent'>
                <button onclick='showAllManual(this)' class='nav-manual-btn border-cyan-400 text-center font-bold text-cyan-700 hover:bg-cyan-50 shadow-sm'>VISUALIZAR TUDO</button>
            </div>
        </aside>

        <!-- ÁREA PRINCIPAL DE CONTEÚDO -->
        <main id='manual-content-area' class='w-3/4 glass-panel p-8 md:p-12 rounded-[2.5rem] overflow-y-auto custom-scrollbar h-full'>
            
            <div id='s1' class='content-section active space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Iniciação de Hardware
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>01. Setup Inicial & QR Code</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 text-lg text-justify'>
                        Escaneie o código QR abaixo para acessar os vídeos. Você pode fazer isso diretamente pela câmera do seu smartphone ou através das lentes do Meta Quest 3S.
                    </p>
                    <img src='./img/Passo1.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                    <img src='./img/passo_1.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                </div>
            </div>

            <div id='s2' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Calibração Óptica
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>02. Ajuste de Lentes</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 text-lg text-justify'>
                        Mova as lentes manualmente para a esquerda ou direita até que a imagem central fique perfeitamente nítida. O ajuste correto evita fadiga ocular e garante a melhor imersão.
                    </p>
                    <img src='./img/Passo2.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                </div>
            </div>

            <div id='s3' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Protocolo de Ergonomia
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>03. Uso com Óculos</h2>
                <div class='space-y-6'>
                    <div class='flex gap-4 items-start'>
                        <span class='bg-cyan-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold shrink-0'>1</span>
                        <p class='text-slate-600 text-lg text-justify'>Remova a <strong>interface facial</strong> puxando firmemente pelas bordas laterais.</p>
                    </div>
                    <div class='flex gap-4 items-start'>
                        <span class='bg-cyan-600 text-white w-8 h-8 rounded-full flex items-center justify-center font-bold shrink-0'>2</span>
                        <p class='text-slate-600 text-lg text-justify'>Encaixe o <strong>espaçador de óculos</strong> entre o headset e a interface facial.</p>
                    </div>
                    <img src='./img/Passo3.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                </div>
            </div>

            <div id='s4' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Energia do Sistema
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>04. Tampa da Bateria</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 text-lg text-justify'>
                        Pressione o botão de ejeção na lateral do controle para liberar a tampa. Deslize-a para baixo para substituir a pilha AA.
                    </p>
                    <img src='./img/Passo4.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                </div>
            </div>

            <div id='s5' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-red-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-red-600'></span> Alerta de Segurança
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>05. Cuidado Crítico: Luz Solar</h2>
                <div class='space-y-6 bg-red-50 p-6 rounded-3xl border border-red-200'>
                    <p class='text-lg text-justify text-red-800'>
                        <strong>IMPORTANTE:</strong> Nunca exponha as lentes internas ao sol. A luz solar direta pode queimar permanentemente os ecrãs LCD do headset em poucos segundos.
                    </p>
                    <img src='./img/Passo5.jpg' class='w-full rounded-[2rem] border border-red-200 shadow-sm aspect-video object-cover'>
                </div>
            </div>

            <div id='s6' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Sensores Ópticos
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>06. Rastreamento (Tracking)</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 text-lg text-justify'>
                        Mantenha as câmeras de rastreamento externas limpas. O sistema utiliza estas câmeras para mapear o ambiente.
                    </p>
                    <img src='./img/Passo6.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                </div>
            </div>

            <div id='s7' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Ergonomia
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>07. Ajuste de Faixa (Strap)</h2>
                <div class='space-y-6'>
                    <p class='text-slate-600 text-lg text-justify'>
                        Posicione a parte traseira da faixa na base do crânio. Ajuste as alças laterais e a alça de topo até que o headset esteja firme.
                    </p>
                    <img src='./img/Passo7.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                </div>
            </div>

            <div id='s8' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Hardware Overview
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>08. Anatomia do Headset</h2>

                <div class='space-y-6'>
                    <div class='grid grid-cols-1 gap-4 bg-slate-50 p-6 rounded-3xl border border-slate-200'>
                        <div class='space-y-4'>
                            <p class='text-slate-600 text-lg text-justify'>
                                <strong class='text-cyan-700'>[Liga/Desliga]:</strong> Localizado na lateral esquerda.
                            </p>
                            <p class='text-slate-600 text-lg text-justify'>
                                <strong class='text-cyan-700'>[Botões de Volume]:</strong> Posicionados na parte inferior do visor.
                            </p>
                            <p class='text-slate-600 text-lg text-justify'>
                                <strong class='text-cyan-700'>[Entrada USB-C]:</strong> Localizada na lateral esquerda do headset.
                            </p>
                        </div>
                    </div>

                    <div class='relative rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden bg-slate-100 aspect-video'>
                        <img src='./img/Passo8.jpg' alt='Anatomia Meta Quest 3S' class='w-full h-full object-cover'>
                    </div>
                </div>
            </div>

            <div id='s9' class='content-section space-y-8'>
                <div class='flex items-center gap-4 text-cyan-600 font-bold tracking-widest text-xs uppercase'>
                    <span class='h-[1px] w-8 bg-cyan-600'></span> Controladores Touch Plus
                </div>
                <h2 class='text-4xl font-bold text-slate-900 headline'>09. Anatomia dos Controles</h2>
                
                <div class='space-y-8'>
                    <div class='bg-slate-50 p-6 rounded-3xl border border-slate-200'>
                        <h3 class='text-cyan-700 font-bold mb-3'>ATIVAÇÃO E PAREAMENTO</h3>
                        <p class='text-slate-600 text-lg text-justify'>
                            Para ligar os controles do <strong>Meta Quest 3S</strong>, basta colocar as pilhas AA e movimentá-los.
                        </p>
                    </div>

                    <div class='grid grid-cols-1 md:grid-cols-2 gap-6 px-2'>
                        <div class='space-y-2'>
                            <p class='text-slate-800 font-semibold'>• Botões A e B (Direito)</p>
                            <p class='text-slate-500 text-sm'>A (Ação), B (Menu/Voltar).</p>
                        </div>
                        <div class='space-y-2'>
                            <p class='text-slate-800 font-semibold'>• Botão Meta (Direito)</p>
                            <p class='text-slate-500 text-sm'>Abre o menu universal.</p>
                        </div>
                    </div>

                    <div class='relative'>
                        <img src='./img/Passo9.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                    </div>
                    <div class='relative'>
                        <img src='./img/Passo9_1.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                    </div>
                    <div class='relative'>
                        <img src='./img/Passo9_2.jpg' class='w-full rounded-[2rem] border border-slate-200 shadow-sm aspect-video object-cover'>
                    </div>
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