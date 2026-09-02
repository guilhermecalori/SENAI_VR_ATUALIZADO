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
// LISTA DE VÍDEOS (ADICIONE NOVOS VÍDEOS NESTE ARRAY)
// ==========================================================
$videos_portugues = [
    [
        'titulo' => 'Dom Casmurro em Realidade Virtual',
        'subtitulo' => 'IMERSÃO LITERÁRIA • VR 360° • 07:45',
        'video_id' => 'B91tO_Y2Yis',
        'embed_url' => 'https://www.youtube.com/embed/B91tO_Y2Yis',
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://youtu.be/B91tO_Y2Yis'
    ],
    // Para adicionar mais vídeos, basta desentear e preencher abaixo:
    /*
    [
        'titulo' => 'Novo Vídeo de Português',
        'subtitulo' => 'AULA PRÁTICA • VR 360° • 05:30',
        'video_id' => 'OUTRO_ID_AQUI',
        'embed_url' => 'https://www.youtube.com/embed/OUTRO_ID_AQUI',
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://youtu.be/OUTRO_ID_AQUI'
    ],
    */
];

// Configurações Globais da Página
$titulo_pagina = "Português Virtual";
$subtitulo_pagina = "Imersão Literária e Gramatical";
$icone_materia = "auto_stories";
$cor_tema = "blue"; // emerald, blue, purple, etc.

$header_icon = render_icon($icone_materia, "w-8 h-8 text-blue-500");
$back_icon   = render_icon('arrow_back', 'w-4 h-4 text-slate-500');

ob_start();
?>

<div class="max-w-7xl mx-auto space-y-8 p-4">
    
    <!-- Cabeçalho da Página -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-blue-50 bg-opacity-60 rounded-2xl flex items-center justify-center border border-blue-100 shadow-sm">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold text-blue-500 uppercase tracking-widest mt-0.5"><?php echo $subtitulo_pagina; ?></p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_portugues as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 items-center">
                    
                    <!-- Coluna do Vídeo (8 colunas) -->
                    <div class="lg:col-span-8">
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-black shadow-inner">
                            <iframe 
                                class="w-full h-full border-0" 
                                src="<?php echo $video['embed_url']; ?>" 
                                title="<?php echo $video['titulo']; ?>"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="mt-4">
                            <h2 class="text-xl font-bold text-slate-900"><?php echo $video['titulo']; ?></h2>
                            <p class="text-xs font-semibold tracking-wider text-blue-500 uppercase mt-1">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center bg-slate-50 p-6 rounded-2xl border border-slate-100 text-center h-full">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-200 mb-3">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Sincronizar Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Aponte a câmera do headset para o código acima para iniciar esta aula em VR.
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