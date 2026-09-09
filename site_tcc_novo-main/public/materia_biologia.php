<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}

// Tenta incluir o layout.php (seja na raiz ou na mesma pasta)
if (file_exists(__DIR__ . '/layout.php')) {
    require_once __DIR__ . '/layout.php';
} else {
    require_once __DIR__ . '/../layout.php';
}

// ==========================================================
// LISTA DE CONTEÚDOS / VÍDEOS
// ==========================================================
$videos_biologia = [
    [
        'titulo' => 'Tyrannosaurus Rex 3D',
        'subtitulo' => 'CENA INTERATIVA • MOZAIK 3D',
        'embed_url' => 'https://us.mozaweb.com/Extra-cenas_3D-Tyrannosaurus_rex_tirano-170423',
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode('https://us.mozaweb.com/Extra-cenas_3D-Tyrannosaurus_rex_tirano-170423')
    ],
    [
        'titulo' => 'Sistema Respiratório Humano 3D',
        'subtitulo' => 'ANATOMIA HUMANA • MOZAIK 3D',
        'embed_url' => 'https://us.mozaweb.com/pt/Extra-Cenas_3D-em_Sistema_em_em_respi_em_ratorio-12049?mode=directlink',
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode('https://us.mozaweb.com/pt/Extra-Cenas_3D-em_Sistema_em_em_respi_em_ratorio-12049?mode=directlink')
    ],
    [
        'titulo' => 'O que acontece dentro do seu corpo?',
        'subtitulo' => 'IMERSÃO TOTAL • VR 360° • 09:03',
        'embed_url' => 'https://www.youtube.com/embed/XN6GsVRHnhM',
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://youtu.be/XN6GsVRHnhM'
    ]
];

// Configurações Globais da Página
$titulo_pagina = "Biologia Imersiva";
$subtitulo_pagina = "ANATOMIA HUMANA, BIOLOGIA CELULAR E ECOSSISTEMAS";
$icone_materia = "microscope";

// Ícones via render_icon ou Fallback
$header_icon = function_exists('render_icon') ? render_icon($icone_materia, "w-8 h-8 text-emerald-600") : '<span class="material-symbols-outlined text-emerald-600 text-3xl">microscope</span>';
$back_icon   = function_exists('render_icon') ? render_icon('arrow_back', 'w-4 h-4 text-slate-500') : '<span class="material-symbols-outlined text-sm">arrow_back</span>';

ob_start();
?>

<div class="max-w-7xl mx-auto space-y-8 p-4">
    
    <!-- Cabeçalho da Página -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center border border-emerald-200 shadow-sm">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mt-0.5"><?php echo $subtitulo_pagina; ?></p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_biologia as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-emerald-100 overflow-hidden hover:shadow-md transition-all">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 items-center">
                    
                    <!-- Coluna do Vídeo / Iframe (8 colunas no desktop) -->
                    <div class="lg:col-span-8">
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-black shadow-inner">
                            <iframe 
                                class="w-full h-full border-0" 
                                src="<?php echo $video['embed_url']; ?>" 
                                title="<?php echo $video['titulo']; ?>"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; xr-spatial-tracking; webxr; fullscreen" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="mt-4">
                            <h2 class="text-xl font-bold text-slate-900"><?php echo $video['titulo']; ?></h2>
                            <p class="text-xs font-semibold tracking-wider text-emerald-600 uppercase mt-1">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas no desktop) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center bg-emerald-50/50 p-6 rounded-2xl border border-emerald-100 text-center h-full">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-emerald-200 mb-3">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Sincronizar no Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Aponte a câmera do headset para o código acima para iniciar esta aula em Realidade Virtual.
                        </p>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php
$conteudo = ob_get_clean();
renderizar_pagina($titulo_pagina, $conteudo);
?>