<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

// Configurações específicas de Filosofia
$titulo = "Filosofia Imersiva";
$subtitulo = "O Pensamento Humano e Grandes Dilemas Éticos";
$icone = "psychology_alt";
$cor = "violet"; 
$videoID = "lVDasqyK-E8"; // Vídeo VR sobre a Alegoria da Caverna (Platão)
$videoTitulo = "A Alegoria da Caverna: Uma Experiência VR";
$videoTempo = "07:30";

$extra_css = "
<style>
    .video-card { background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 0, 0, 0.06); transition: all 0.3s ease; }
    .video-card:hover { border-color: #7c3aed; transform: translateY(-8px); background: rgba(139, 92, 246, 0.08); }
    .play-overlay { background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(2px); opacity: 0; transition: opacity 0.3s ease; }
    .video-card:hover .play-overlay { opacity: 1; }
    .qr-box { background: #fff; padding: 16px; border-radius: 2rem; display: inline-block; box-shadow: 0 0 40px rgba(139, 92, 246, 0.2); }
</style>";

$conteudo = $extra_css . "
<div class='p-10 animate-in fade-in duration-500'>
    <div class='max-w-4xl mx-auto space-y-12'>
        
        <header class='flex justify-between items-center'>
            <div class='flex items-center gap-6'>
                <div class='w-20 h-20 bg-violet-50 rounded-[2rem] flex items-center justify-center border border-violet-200 shadow-[0_0_20px_rgba(139,92,246,0.08)]'>
                    <span class='material-symbols-outlined text-violet-600'>{$icone}</span>
                </div>
                <div>
                    <h1 class='text-4xl font-bold headline text-slate-900'>{$titulo}</h1>
                    <p class='text-violet-700/80 font-bold uppercase tracking-widest text-[10px] mt-1'>{$subtitulo}</p>
                </div>
            </div>
            <a href='materias.php' class='px-6 py-2 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-500 flex items-center gap-2'>
                 <span class='material-symbols-outlined text-sm'>arrow_back</span> Voltar
            </a>
        </header>

        <section class='space-y-6 text-center'>
            <br>
            <div class='video-card rounded-[3rem] overflow-hidden group cursor-pointer max-w-2xl mx-auto' onclick='abrirVideo(\"https://www.youtube.com/embed/{$videoID}\")'>
                <div class='relative h-64 bg-slate-100'>
                    <img src='https://img.youtube.com/vi/{$videoID}/maxresdefault.jpg' class='w-full h-full object-cover opacity-60'>
                    <div class='play-overlay absolute inset-0 flex items-center justify-center'>
                        <div class='w-20 h-20 bg-violet-600 rounded-full flex items-center justify-center shadow-lg'>
                            <span class='material-symbols-outlined text-white text-5xl'>play_arrow</span>
                        </div>
                    </div>
                </div>
                <div class='p-8'>
                    <h3 class='text-2xl font-bold text-slate-900 mb-2'>{$videoTitulo}</h3>
                    <p class='text-slate-500 text-xs uppercase font-bold tracking-widest'>Reflexão Filosófica • VR 360° • {$videoTempo}</p>
                </div>
            </div>
        </section>

        <section class='glass p-12 rounded-[4rem] border-violet-200 text-center bg-violet-50/50'>
            <h2 class='text-2xl font-bold text-slate-900 headline mb-4'>Reflexão no Meta Quest</h2>
            <p class='text-slate-500 text-sm mb-8'>Escanear para vivenciar a Alegoria da Caverna e questionar a percepção da realidade através da imersão.</p>
            <div class='qr-box'>
                <img src='https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://youtu.be/{$videoID}' class='w-40 h-40'>
            </div>
            <p class='mt-6 text-violet-600 font-mono text-[10px] tracking-widest uppercase'>Protocolo: PHILO-SOPHIA-VR</p>
        </section>
    </div>
</div>

<div id='videoModal' class='fixed inset-0 z-[100] hidden flex items-center justify-center p-6 bg-black/80 backdrop-blur-md'>
    <div class='relative w-full max-w-5xl aspect-video bg-black rounded-[3rem] overflow-hidden border border-slate-200'>
        <button onclick='fecharVideo()' class='absolute top-6 right-6 text-slate-900 z-[110] bg-black/50 p-2 rounded-full'>
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
</script>";

renderizar_pagina($titulo, $conteudo);
?>