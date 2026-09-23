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
// DEFINIÇÃO DOS LINKS MOZAIK 3D E VÍDEOS
// ==========================================================
$mozaik_modelo_atomico_url = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Desenvolvimento_do_modelo_atomico-123106?mode=directlink";
$mozaik_rutherford_url     = "https://us.mozaweb.com/pt/Extra-Cenas_3D-A_experiencia_de_Rutherford-210231?mode=directlink";
$mozaik_campainha_url      = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Campainha_eletrica-204264?mode=directlink";
$mozaik_altifalante_url    = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Como_funciona_o_altifalante-208566?mode=directlink";
$mozaik_geradores_url      = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Geradores_e_motores_eletricos-216860?mode=directlink";
$mozaik_ondas_url          = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Tipos_de_ondas-291105?mode=directlink";

// ==========================================================
// LISTA DE VÍDEOS E CONTEÚDOS 3D (FÍSICA)
// ==========================================================
$videos_fisica = [
    [
        'titulo' => 'Desenvolvimento do Modelo Atômico',
        'subtitulo' => 'FÍSICA MODERNA E ATÔMICA • MOZAIK 3D',
        'video_id' => 'modelo_atomico_3d',
        'embed_url' => $mozaik_modelo_atomico_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_modelo_atomico_url)
    ],
    [
        'titulo' => 'A Experiência de Rutherford',
        'subtitulo' => 'FÍSICA MODERNA E NUCLEAR • MOZAIK 3D',
        'video_id' => 'experiencia_rutherford_3d',
        'embed_url' => $mozaik_rutherford_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_rutherford_url)
    ],
    [
        'titulo' => 'Campainha Elétrica',
        'subtitulo' => 'ELETROMAGNETISMO • MOZAIK 3D',
        'video_id' => 'campainha_eletrica_3d',
        'embed_url' => $mozaik_campainha_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_campainha_url)
    ],
    [
        'titulo' => 'Como Funciona o Alto-Falante',
        'subtitulo' => 'ELETROMAGNETISMO E ACÚSTICA • MOZAIK 3D',
        'video_id' => 'altifalante_3d',
        'embed_url' => $mozaik_altifalante_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_altifalante_url)
    ],
    [
        'titulo' => 'Geradores e Motores Elétricos',
        'subtitulo' => 'ELETROMAGNETISMO E ENERGIA • MOZAIK 3D',
        'video_id' => 'geradores_motores_3d',
        'embed_url' => $mozaik_geradores_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_geradores_url)
    ],
    [
        'titulo' => 'Tipos de Ondas',
        'subtitulo' => 'ONDULATÓRIA • MOZAIK 3D',
        'video_id' => 'tipos_de_ondas_3d',
        'embed_url' => $mozaik_ondas_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_ondas_url)
    ]
];

// Configurações Globais da Página
$titulo_pagina = "Física & Mecânica";
$subtitulo_pagina = "Simulação de Leis e Forças Cinéticas";
$icone_materia = "precision_manufacturing";

// Ícones via render_icon ou Fallback
$header_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.38a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>';
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
            <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center border border-orange-200 shadow-sm">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold text-orange-600 uppercase tracking-widest mt-0.5"><?php echo $subtitulo_pagina; ?></p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_fisica as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-orange-100 overflow-hidden hover:shadow-md transition-all">
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
                            <p class="text-xs font-semibold tracking-wider text-orange-600 uppercase mt-1">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas no desktop) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center bg-orange-50/50 p-6 rounded-2xl border border-orange-100 text-center h-full">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-orange-200 mb-3">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Sincronizar Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Aponte a câmera do headset para visualizar a dinâmica das partículas e forças gravitacionais.
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