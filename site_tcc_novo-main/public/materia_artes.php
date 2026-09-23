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
// DEFINIÇÃO DOS LINKS MOZAIK 3D (ARTES)
// ==========================================================
$mozaik_estatuetas_venus_url = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Estatuetas_de_Venus-216425?mode=directlink";
$mozaik_marcos_escultura_url  = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Marcos_da_escultura-209674?mode=directlink";
$mozaik_colunas_gregas_url    = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Tipos_de_colunas_gregas_antigas-146814?mode=directlink";
$mozaik_atelie_da_vinci_url   = "https://us.mozaweb.com/pt/Extra-Cenas_3D-O_atelie_de_Leonardo_da_Vinci_Florenca_seculo_XVI-38597?mode=directlink";
$mozaik_sao_basilio_url       = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Catedral_de_Sao_Basilio_Moscovo_seculo_XVI-170410?mode=directlink";
$mozaik_taj_mahal_url         = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Taj_Mahal_Agra_seculo_XVII-147991?mode=directlink";
$mozaik_machu_picchu_url      = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Machu_Picchu_seculo_XV-147940?mode=directlink";

// ==========================================================
// LISTA DE VÍDEOS E CONTEÚDOS 3D (ARTES)
// ==========================================================
$videos_artes = [
    [
        'titulo' => 'Estatuetas de Vênus',
        'subtitulo' => 'ARTE PRÉ-HISTÓRICA • MOZAIK 3D',
        'video_id' => 'estatuetas_venus_3d',
        'embed_url' => $mozaik_estatuetas_venus_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_estatuetas_venus_url)
    ],
    [
        'titulo' => 'Marcos da Escultura Global',
        'subtitulo' => 'HISTÓRIA DA ESCULTURA • MOZAIK 3D',
        'video_id' => 'marcos_escultura_3d',
        'embed_url' => $mozaik_marcos_escultura_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_marcos_escultura_url)
    ],
    [
        'titulo' => 'Tipos de Colunas Gregas Antigas',
        'subtitulo' => 'ARQUITETURA CLÁSSICA • MOZAIK 3D',
        'video_id' => 'colunas_gregas_3d',
        'embed_url' => $mozaik_colunas_gregas_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_colunas_gregas_url)
    ],
    [
        'titulo' => 'O Ateliê de Leonardo da Vinci (Florença, Séc. XVI)',
        'subtitulo' => 'RENASCIMENTO • MOZAIK 3D',
        'video_id' => 'atelie_da_vinci_3d',
        'embed_url' => $mozaik_atelie_da_vinci_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_atelie_da_vinci_url)
    ],
    [
        'titulo' => 'Catedral de São Basílio (Moscou, Séc. XVI)',
        'subtitulo' => 'ARQUITETURA ORTODOXA E RENASCENTISTA • MOZAIK 3D',
        'video_id' => 'sao_basilio_3d',
        'embed_url' => $mozaik_sao_basilio_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_sao_basilio_url)
    ],
    [
        'titulo' => 'Taj Mahal (Agra, Séc. XVII)',
        'subtitulo' => 'ARQUITETURA MOGOL E MONUMENTAL • MOZAIK 3D',
        'video_id' => 'taj_mahal_3d',
        'embed_url' => $mozaik_taj_mahal_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_taj_mahal_url)
    ],
    [
        'titulo' => 'Machu Picchu (Séc. XV)',
        'subtitulo' => 'ARQUITETURA INCA E URBANISMO • MOZAIK 3D',
        'video_id' => 'machu_picchu_3d',
        'embed_url' => $mozaik_machu_picchu_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_machu_picchu_url)
    ]
];

// Configurações Globais da Página
$titulo_pagina = "Artes & Expressão";
$subtitulo_pagina = "Exposição de Galerias Virtuais e Criação 3D";
$icone_materia = "palette";

// Ícones via render_icon ou Fallback
$header_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-pink-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21a9 9 0 0 1-9-9c0-4.97 4.03-9 9-9s9 4.03 9 9a9 9 0 0 1-9 9Z" class="hidden"/><path d="M7 21a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7Z"/><path d="M11 21a4 4 0 0 0 4-4V9.5a3.5 3.5 0 0 1 7 0V17a4 4 0 0 1-4 4h-7Z"/><circle cx="8" cy="17" r="1" fill="currentColor"/></svg>';
$back_icon   = function_exists('render_icon') ? render_icon('arrow_back', 'w-4 h-4 text-slate-500') : '<span class="material-symbols-outlined text-sm">arrow_back</span>';

ob_start();
?>

<style>
    /* Aplica o fundo suave com gradiente e malha quadriculada */
    html, body, main, #app, #root, #layout-wrapper, .main-content, .content-wrapper, .wrapper {
        background-color: #ebf3f5 !important;
        background-image: 
            radial-gradient(at 90% 10%, rgba(253, 226, 228, 0.6) 0px, transparent 40%),
            radial-gradient(at 10% 20%, rgba(219, 234, 254, 0.7) 0px, transparent 50%),
            linear-gradient(to right, rgba(0, 0, 0, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0, 0, 0, 0.03) 1px, transparent 1px) !important;
        background-size: 100% 100%, 100% 100%, 24px 24px, 24px 24px !important;
        background-attachment: fixed !important;
    }
</style>

<div class="max-w-7xl mx-auto space-y-8 p-4">
    
    <!-- Cabeçalho da Página -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-pink-50 rounded-2xl flex items-center justify-center border border-pink-200 shadow-sm">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold text-pink-600 uppercase tracking-widest mt-0.5"><?php echo $subtitulo_pagina; ?></p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_artes as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-pink-100 overflow-hidden hover:shadow-md transition-all">
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
                            <p class="text-xs font-semibold tracking-wider text-pink-600 uppercase mt-1">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas no desktop) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center bg-pink-50/50 p-6 rounded-2xl border border-pink-100 text-center h-full">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-pink-200 mb-3">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Exposição no Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Aponte a câmera do headset para entrar na galeria virtual e observar detalhes das obras de arte em escala real e profundidade 3D.
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