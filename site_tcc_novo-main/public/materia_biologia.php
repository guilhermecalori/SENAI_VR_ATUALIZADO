<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

// Estilização refinada
$extra_css = "
<style>
    .video-card {
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(0, 0, 0, 0.06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .video-card:hover {
        border-color: #059669;
        transform: translateY(-8px);
        background: rgba(16, 185, 129, 0.06);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }
    .play-overlay {
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(2px);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .video-card:hover .play-overlay {
        opacity: 1;
    }
    .qr-box {
        background: #fff;
        padding: 16px;
        border-radius: 2rem;
        box-shadow: 0 0 40px rgba(16, 185, 129, 0.15);
        display: inline-block;
    }
</style>
";

// CORREÇÃO AQUI: Mudado de 'videocam' para 'science' para carregar o frasco correto!
$header_icon = render_icon('science', 'w-10 h-10 text-emerald-600');
$back_icon = render_icon('arrow_back', 'w-4 h-4 text-slate-500');
$section_icon = render_icon('videocam', 'w-6 h-6 text-emerald-600');
$play_icon = render_icon('play_arrow', 'w-12 h-12 text-white');

$conteudo = $extra_css . "
<div class='p-10 animate-in fade-in duration-500'>
    <div class='max-w-4xl mx-auto space-y-12'>
        
        <header class='flex justify-between items-center'>
            <div class='flex items-center gap-6'>
                <div class='w-20 h-20 bg-emerald-50 rounded-[2rem] flex items-center justify-center border border-emerald-200 shadow-inner'>
                    {$header_icon}
                </div>
                <div>
                    <h1 class='text-4xl font-bold headline text-slate-900'>Biologia Virtual</h1>
                    <p class='text-emerald-500/60 font-bold uppercase tracking-widest text-[10px] mt-1'>Módulo: Interior do Corpo Humano</p>
                </div>
            </div>
            <a href='materias.php' class='px-6 py-2 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-500 flex items-center gap-2'>
                {$back_icon} Voltar
            </a>
        </header>

        <section class='space-y-6'>
            
            <br>
            <div class='video-card rounded-[3rem] overflow-hidden group cursor-pointer max-w-2xl mx-auto' onclick='abrirVideo(\"https://www.youtube.com/embed/XN6GsVRHnhM\")'>
                <div class='relative h-64 bg-slate-100'>
                    <img src='https://img.youtube.com/vi/XN6GsVRHnhM/maxresdefault.jpg' class='w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700'>
                    <div class='play-overlay absolute inset-0 flex items-center justify-center'>
                        <div class='w-20 h-20 bg-emerald-600 rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(16,185,129,0.5)] group-hover:scale-110 transition-transform'>
                            {$play_icon}
                        </div>
                    </div>
                </div>
                <div class='p-8 text-center'>
                    <h3 class='text-2xl font-bold text-slate-900 mb-2'>O que acontece dentro do seu corpo?</h3>
                    <p class='text-slate-500 text-xs uppercase font-bold tracking-widest'>Imersão Total • VR 360° • 09:03</p>
                </div>
            </div>
        </section>

        <section class='glass p-12 rounded-[4rem] border-emerald-500/10 text-center bg-emerald-500/[0.02]'>
            <div class='mb-10'>
                <h2 class='text-2xl font-bold text-slate-900 headline mb-2'>Sincronizar com Meta Quest</h2>
                <p class='text-slate-500 text-sm'>Aponte a câmera do headset para o código abaixo para iniciar a aula em Realidade Virtual.</p>
            </div>

            <div class='flex flex-col items-center gap-6'>
                <div class='qr-box'>
                    <img src='https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://youtu.be/XN6GsVRHnhM' class='w-40 h-40'>
                </div>
                <div class='px-4 py-1.5 bg-emerald-50 border border-emerald-200 rounded-full'>
                    <span class='text-emerald-600 text-[10px] font-black uppercase tracking-[0.3em]'>ID: VR-BODY-360</span>
                </div>
            </div>
        </section>

    </div>
</div>

<div id='videoModal' class='fixed inset-0 z-[100] hidden flex items-center justify-center p-6 bg-black/80 backdrop-blur-md'>
    <div class='relative w-full max-w-5xl aspect-video bg-black rounded-[3rem] overflow-hidden border border-slate-200 shadow-2xl'>
        <button onclick='fecharVideo()' class='absolute top-6 right-6 text-slate-900 hover:text-red-500 z-[110] bg-black/50 p-2 rounded-full transition-colors'>
            <span class='material-symbols-outlined'>close</span>
        </button>
        <iframe id='videoFrame' class='w-full h-full' src='' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
    </div>
</div>

<script>
    function abrirVideo(url) {
        document.getElementById('videoFrame').src = url;
        document.getElementById('videoModal').classList.remove('hidden');
    }
    function fecharVideo() {
        document.getElementById('videoModal').classList.add('hidden');
        document.getElementById('videoFrame').src = '';
    }
</script>
";

renderizar_pagina("Biologia VR", $conteudo);
?>
