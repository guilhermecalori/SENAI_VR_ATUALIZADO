<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

// ==========================================================
// 1. PERSONALIZE AQUI OS DADOS DA MATÉRIA
// ==========================================================
$titulo = "Português Virtual"; // Nome da Matéria
$subtitulo = "Imersão Literária e Gramatical";
$icone = "auto_stories"; // CORREÇÃO: Mudado para o nome oficial do livro aberto no seu sistema!
$cor = "blue"; // emerald, blue, purple, orange, cyan, rose, etc.
$videoID = "B91tO_Y2Yis"; // ID do vídeo do YouTube (depois do v=)
$videoTitulo = "Dom Casmurro em Realidade Virtual";
$videoTempo = "07:45";
// ==========================================================

$extra_css = "
<style>
    .video-card { background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 0, 0, 0.06); transition: all 0.3s ease; }
    .video-card:hover { border-color: var(--cor-tema); transform: translateY(-8px); background: rgba(0, 0, 0, 0.03); }
    .play-overlay { background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(2px); opacity: 0; transition: opacity 0.3s ease; }
    .video-card:hover .play-overlay { opacity: 1; }
    .qr-box { background: #fff; padding: 16px; border-radius: 2rem; display: inline-block; box-shadow: 0 0 40px rgba(255,255,255,0.1); }
    :root { --cor-tema: " . ($cor == 'blue' ? '#3b82f6' : ($cor == 'purple' ? '#a855f7' : ($cor == 'emerald' ? '#10b981' : '#64748b'))) . "; }
</style>";

// CORREÇÃO: Renderização dos ícones do seu sistema usando a função do layout.php
$header_icon = render_icon($icone, "w-10 h-10 text-{$cor}-400");
$back_icon   = render_icon('arrow_back', 'w-4 h-4 text-slate-500');
$play_icon   = render_icon('play_arrow', 'w-12 h-12 text-white');
$close_icon  = render_icon('close', 'w-6 h-6 text-slate-900');

$conteudo = $extra_css . "
<div class='p-10 animate-in fade-in duration-500'>
    <div class='max-w-4xl mx-auto space-y-12'>
        
        <header class='flex justify-between items-center'>
            <div class='flex items-center gap-6'>
                <div class='w-20 h-20 bg-{$cor}-500/10 rounded-[2rem] flex items-center justify-center border border-{$cor}-500/20 shadow-inner'>
                    {$header_icon}
                </div>
                <div>
                    <h1 class='text-4xl font-bold headline text-slate-900'>{$titulo}</h1>
                    <p class='text-{$cor}-500/60 font-bold uppercase tracking-widest text-[10px] mt-1'>{$subtitulo}</p>
                </div>
            </div>
            <a href='materias.php' class='px-6 py-2 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-500 flex items-center gap-2'>
                {$back_icon} Voltar
            </a>
        </header>

        <section class='space-y-6'>
            <br>
            <div class='video-card rounded-[3rem] overflow-hidden group cursor-pointer max-w-2xl mx-auto' onclick='abrirVideo(\"https://www.youtube.com/embed/{$videoID}\")'>
                <div class='relative h-64 bg-slate-100'>
                    <img src='https://img.youtube.com/vi/{$videoID}/maxresdefault.jpg' class='w-full h-full object-cover opacity-60'>
                    <div class='play-overlay absolute inset-0 flex items-center justify-center'>
                        <div class='w-20 h-20 bg-{$cor}-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform'>
                            {$play_icon}
                        </div>
                    </div>
                </div>
                <div class='p-8 text-center'>
                    <h3 class='text-2xl font-bold text-slate-900 mb-2'>{$videoTitulo}</h3>
                    <p class='text-slate-500 text-xs uppercase font-bold tracking-widest'>VR 360° • {$videoTempo}</p>
                </div>
            </div>
        </section>

        <section class='glass p-12 rounded-[4rem] border-slate-200 text-center'>
            <h2 class='text-2xl font-bold text-slate-900 headline mb-6'>Sincronizar Meta Quest</h2>
            <div class='qr-box'>
                <img src='https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://youtu.be/{$videoID}' class='w-40 h-40'>
            </div>
        </section>
    </div>
</div>

<div id='videoModal' class='fixed inset-0 z-[100] hidden flex items-center justify-center p-6 bg-black/80 backdrop-blur-md'>
    <div class='relative w-full max-w-5xl aspect-video bg-black rounded-[3rem] overflow-hidden border border-slate-200'>
        <button onclick='fecharVideo()' class='absolute top-6 right-6 text-slate-900 z-[110] bg-black/50 p-2 rounded-full transition-colors hover:bg-black/80'>
            {$close_icon}
        </button>
        <iframe id='videoFrame' class='w-full h-full' src='' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
    </div>
</div>

<script>
    function abrirVideo(url) { document.getElementById('videoFrame').src = url; document.getElementById('videoModal').classList.remove('hidden'); }
    function fecharVideo() { document.getElementById('videoModal').classList.add('hidden'); document.getElementById('videoFrame').src = ''; }
</script>";

renderizar_pagina($titulo, $conteudo);
?>