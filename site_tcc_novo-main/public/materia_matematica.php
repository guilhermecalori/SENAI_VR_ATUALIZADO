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
// DEFINIÇÃO DOS LINKS MOZAIK 3D (MATEMÁTICA)
// ==========================================================
$mozaik_geometria_url     = "https://us.mozaweb.com/pt/Extra-Cenas_3D-O_perimetro_a_area_a_superficie_e_o_volume-272584?mode=directlink";
$mozaik_prod_notaveis_url = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Produtos_notaveis-147927?mode=directlink";
$mozaik_cartesianas_url   = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Sistema_de_coordenadas_cartesianas_tridimensionais-147929?mode=directlink";
$mozaik_cilindricos_url   = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Solidos_cilindricos-38572?mode=directlink";
$mozaik_platonicos_url    = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Solidos_platonicos-129697?mode=directlink";
$mozaik_tetraedro_url     = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Volume_de_um_tetraedro-147931?mode=directlink";
$mozaik_esferas_url       = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Volume_das_esferas_demonstracao-129690?mode=directlink";

// ==========================================================
// LISTA DE VÍDEOS E CONTEÚDOS 3D (MATEMÁTICA)
// ==========================================================
$videos_matematica = [
    [
        'titulo' => 'Perímetro, Área, Superfície e Volume',
        'subtitulo' => 'GEOMETRIA ESPACIAL • MOZAIK 3D',
        'video_id' => 'geometria_medidas_3d',
        'embed_url' => $mozaik_geometria_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_geometria_url)
    ],
    [
        'titulo' => 'Produtos Notáveis (Demonstração Geométrica)',
        'subtitulo' => 'ÁLGEBRA & GEOMETRIA • MOZAIK 3D',
        'video_id' => 'produtos_notaveis_3d',
        'embed_url' => $mozaik_prod_notaveis_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_prod_notaveis_url)
    ],
    [
        'titulo' => 'Sistema de Coordenadas Cartesianas Tridimensionais',
        'subtitulo' => 'GEOMETRIA ANALÍTICA 3D • MOZAIK 3D',
        'video_id' => 'cartesianas_3d',
        'embed_url' => $mozaik_cartesianas_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_cartesianas_url)
    ],
    [
        'titulo' => 'Sólidos Cilíndricos',
        'subtitulo' => 'GEOMETRIA ESPACIAL • MOZAIK 3D',
        'video_id' => 'solidos_cilindricos_3d',
        'embed_url' => $mozaik_cilindricos_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_cilindricos_url)
    ],
    [
        'titulo' => 'Sólidos Platônicos (Poliedros Regulares)',
        'subtitulo' => 'GEOMETRIA & POLIEDROS • MOZAIK 3D',
        'video_id' => 'solidos_platonicos_3d',
        'embed_url' => $mozaik_platonicos_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_platonicos_url)
    ],
    [
        'titulo' => 'Cálculo do Volume de um Tetraedro',
        'subtitulo' => 'GEOMETRIA ESPACIAL • MOZAIK 3D',
        'video_id' => 'volume_tetraedro_3d',
        'embed_url' => $mozaik_tetraedro_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_tetraedro_url)
    ],
    [
        'titulo' => 'Demonstração do Volume de Esferas',
        'subtitulo' => 'GEOMETRIA ESPACIAL • MOZAIK 3D',
        'video_id' => 'volume_esferas_3d',
        'embed_url' => $mozaik_esferas_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_esferas_url)
    ]
];

// Configurações Globais da Página
$titulo_pagina = "Matemática Espacial";
$subtitulo_pagina = "Exploração de Geometria e Sólidos 3D";
$icone_materia = "calculate";

// Ícones via render_icon ou Fallback SVG
$header_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2"/><line x1="8" x2="16" y1="6" y2="6"/><line x1="16" x2="16" y1="14" y2="18"/><path d="M16 10h.01"/><path d="M12 10h.01"/><path d="M8 10h.01"/><path d="M12 14h.01"/><path d="M8 14h.01"/><path d="M12 18h.01"/><path d="M8 18h.01"/></svg>';
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
            <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center border border-purple-200 shadow-sm">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold text-purple-600 uppercase tracking-widest mt-0.5"><?php echo $subtitulo_pagina; ?></p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_matematica as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-purple-100 overflow-hidden hover:shadow-md transition-all">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 items-center">
                    
                    <!-- Coluna do Vídeo / Iframe (8 colunas no desktop) -->
                    <div class="lg:col-span-8">
                        
                        <!-- Barra de Atalhos para Login e Criar Conta Mozaik -->
                        <div class="flex flex-wrap items-center justify-between bg-slate-50 p-3 rounded-xl border border-slate-200 mb-3 gap-2 text-xs">
                            <span class="font-medium text-slate-600">Não consegue fazer login no quadro abaixo?</span>
                            <div class="flex items-center gap-2">
                                <a href="https://www.mozaweb.com/pt_BR/signup" target="_blank" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-all shadow-sm">
                                    Criar Conta Grátis
                                </a>
                                <a href="https://www.mozaweb.com/pt_BR/" target="_blank" class="px-3 py-1.5 bg-slate-700 hover:bg-slate-800 text-white font-semibold rounded-lg transition-all shadow-sm">
                                    Conecte-se
                                </a>
                                <a href="<?php echo $video['embed_url']; ?>" target="_blank" class="px-3 py-1.5 border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold rounded-lg transition-all">
                                    Abrir Aula em Nova Aba ↗
                                </a>
                            </div>
                        </div>

                        <!-- Container do Player -->
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
                            <p class="text-xs font-semibold tracking-wider text-purple-600 uppercase mt-1">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas no desktop) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center bg-purple-50/50 p-6 rounded-2xl border border-purple-100 text-center h-full">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-purple-200 mb-3">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Sincronizar Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Aponte a câmera do headset para visualizar teoremas e formas geométricas em escala real.
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