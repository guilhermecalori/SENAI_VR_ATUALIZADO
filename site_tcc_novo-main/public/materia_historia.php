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
// DEFINIÇÃO DOS LINKS MOZAIK 3D (HISTÓRIA)
// ==========================================================
$mozaik_cavalo_troia_url       = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Cavalo_de_Troia-146821?mode=directlink";
$mozaik_peste_negra_url        = "https://us.mozaweb.com/pt/Extra-Cenas_3D-A_Peste_Negra_Europa_1347_1353-252339?mode=directlink";
$mozaik_engenhos_cerco_url     = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Engenhos_de_cerco-4731033?mode=directlink";
$mozaik_santa_maria_url        = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Santa_Maria_Seculo_XV-12045?mode=directlink";
$mozaik_descobrimentos_url     = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Descobrimentos_seculos_XV_XVII-45111?mode=directlink";
$mozaik_revolucao_ind_url      = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Extracao_mineira_durante_a_Revolucao_Industrial-45113?mode=directlink";
$mozaik_guerras_napoleao_url   = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Guerras_Napoleonicas-276395?mode=directlink";
$mozaik_muro_berlim_url        = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Muro_de_Berlim_1961_1989-12037?mode=directlink";

// ==========================================================
// LISTA DE VÍDEOS E CONTEÚDOS 3D (ORDEM CRONOLÓGICA)
// ==========================================================
$videos_historia = [
    [
        'titulo' => 'O Cavalo de Tróia',
        'subtitulo' => 'GRÉCIA ANTIGA E MITOLOGIA (SÉC. XII a.C.) • MOZAIK 3D',
        'video_id' => 'cavalo_troia_3d',
        'embed_url' => $mozaik_cavalo_troia_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_cavalo_troia_url)
    ],
    [
        'titulo' => 'A Peste Negra na Europa (1347 - 1353)',
        'subtitulo' => 'IDADE MÉDIA • MOZAIK 3D',
        'video_id' => 'peste_negra_3d',
        'embed_url' => $mozaik_peste_negra_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_peste_negra_url)
    ],
    [
        'titulo' => 'Engenhos de Cerco Medievais',
        'subtitulo' => 'IDADE MÉDIA E TECNOLOGIA MILITAR • MOZAIK 3D',
        'video_id' => 'engenhos_cerco_3d',
        'embed_url' => $mozaik_engenhos_cerco_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_engenhos_cerco_url)
    ],
    [
        'titulo' => 'A Nau Santa Maria',
        'subtitulo' => 'SÉCULO XV E ERA DOS DESCOBRIMENTOS • MOZAIK 3D',
        'video_id' => 'santa_maria_3d',
        'embed_url' => $mozaik_santa_maria_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_santa_maria_url)
    ],
    [
        'titulo' => 'Grandes Navegações e Descobrimentos',
        'subtitulo' => 'SÉCULOS XV A XVII • MOZAIK 3D',
        'video_id' => 'descobrimentos_3d',
        'embed_url' => $mozaik_descobrimentos_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_descobrimentos_url)
    ],
    [
        'titulo' => 'Mineração na Revolução Industrial',
        'subtitulo' => 'SÉCULO XVIII E XIX • MOZAIK 3D',
        'video_id' => 'extracao_mineira_3d',
        'embed_url' => $mozaik_revolucao_ind_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_revolucao_ind_url)
    ],
    [
        'titulo' => 'As Guerras Napoleônicas',
        'subtitulo' => 'INÍCIO DO SÉCULO XIX (1803 - 1815) • MOZAIK 3D',
        'video_id' => 'guerras_napoleonicas_3d',
        'embed_url' => $mozaik_guerras_napoleao_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_guerras_napoleao_url)
    ],
    [
        'titulo' => 'O Muro de Berlim (1961 - 1989)',
        'subtitulo' => 'GUERRA FRIA E SÉCULO XX • MOZAIK 3D',
        'video_id' => 'muro_berlim_3d',
        'embed_url' => $mozaik_muro_berlim_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_muro_berlim_url)
    ]
];

// Configurações Globais da Página
$titulo_pagina = "História Imersiva";
$subtitulo_pagina = "Viagens Temporais e Grandes Civilizações";
$icone_materia = "history";

// Ícones via render_icon ou Fallback
$header_icon = function_exists('render_icon') ? render_icon($icone_materia, "w-8 h-8 text-rose-600") : '<span class="material-symbols-outlined text-rose-600 text-3xl">history</span>';
$back_icon   = function_exists('render_icon') ? render_icon('arrow_back', 'w-4 h-4 text-slate-500') : '<span class="material-symbols-outlined text-sm">arrow_back</span>';

ob_start();
?>

<div class="max-w-7xl mx-auto space-y-8 p-4">
    
    <!-- Cabeçalho da Página -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-rose-50 rounded-2xl flex items-center justify-center border border-rose-200 shadow-sm">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold text-rose-600 uppercase tracking-widest mt-0.5"><?php echo $subtitulo_pagina; ?></p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_historia as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-rose-100 overflow-hidden hover:shadow-md transition-all">
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
                            <p class="text-xs font-semibold tracking-wider text-rose-600 uppercase mt-1">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas no desktop) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center bg-rose-50/50 p-6 rounded-2xl border border-rose-100 text-center h-full">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-rose-200 mb-3">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Sincronizar Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Aponte a câmera do headset para caminhar entre monumentos históricos e testemunhar o passado.
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

