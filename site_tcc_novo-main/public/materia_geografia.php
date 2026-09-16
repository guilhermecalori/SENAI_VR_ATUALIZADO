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
// DEFINIÇÃO DOS LINKS MOZAIK 3D (GEOGRAFIA)
// Organizados sequencialmente: Astronomia -> Estrutura da Terra -> Geologia/Tectônica -> Cartografia/Fusos -> Hidrologia/Clima -> Meio Ambiente
// ==========================================================
$mozaik_sol_url               = "https://us.mozaweb.com/pt/Extra-Cenas_3D-O_Sol-12027?mode=directlink";
$mozaik_formacao_terra_url    = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Formacao_da_Terra_e_da_Lua-209803?mode=directlink";
$mozaik_estrutura_terra_url   = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Estrutura_da_Terra_nivel_intermedio-12026?mode=directlink";
$mozaik_placas_tectonicas_url = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Placas_tectonicas-38639?mode=directlink";
$mozaik_falha_geologica_url   = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Falha_Geologica_intermedio-38641?mode=directlink";
$mozaik_terremoto_url         = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Terramoto-262500?mode=directlink";
$mozaik_coordenadas_url       = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Sistema_de_coordenadas_geograficas-12023?mode=directlink";
$mozaik_fusos_horarios_url    = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Fusos_horarios-47119?mode=directlink";
$mozaik_rios_relevo_url       = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Rios_e_a_formacao_do_relevo-247003?mode=directlink";
$mozaik_ciclones_url          = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Ciclones_tropicais-47086?mode=directlink";
$mozaik_efeito_estufa_url     = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Efeito_de_estufa-47088?mode=directlink";
$mozaik_poluicao_url          = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Poluicao-211545?mode=directlink";

// ==========================================================
// LISTA DE VÍDEOS E CONTEÚDOS 3D (GEOGRAFIA)
// ==========================================================
$videos_geografia = [
    [
        'titulo' => 'O Sol',
        'subtitulo' => 'ASTRONOMIA E SISTEMA SOLAR • MOZAIK 3D',
        'video_id' => 'sol_3d',
        'embed_url' => $mozaik_sol_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_sol_url)
    ],
    [
        'titulo' => 'Formação da Terra e da Lua',
        'subtitulo' => 'ASTRONOMIA E GEOLOGIA HISTÓRICA • MOZAIK 3D',
        'video_id' => 'formacao_terra_lua_3d',
        'embed_url' => $mozaik_formacao_terra_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_formacao_terra_url)
    ],
    [
        'titulo' => 'Estrutura Interna da Terra',
        'subtitulo' => 'GEOCLIMA E GEOMORFOLOGIA • MOZAIK 3D',
        'video_id' => 'estrutura_terra_3d',
        'embed_url' => $mozaik_estrutura_terra_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_estrutura_terra_url)
    ],
    [
        'titulo' => 'Placas Tectónicas',
        'subtitulo' => 'TECTÔNICA DE PLACAS • MOZAIK 3D',
        'video_id' => 'placas_tectonicas_3d',
        'embed_url' => $mozaik_placas_tectonicas_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_placas_tectonicas_url)
    ],
    [
        'titulo' => 'Falhas Geológicas',
        'subtitulo' => 'GEOMORFOLOGIA E TECTÔNICA • MOZAIK 3D',
        'video_id' => 'falha_geologica_3d',
        'embed_url' => $mozaik_falha_geologica_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_falha_geologica_url)
    ],
    [
        'titulo' => 'Terremotos e Abalos Sísmicos',
        'subtitulo' => 'GEODINÂMICA E SISMOLOGIA • MOZAIK 3D',
        'video_id' => 'terremoto_3d',
        'embed_url' => $mozaik_terremoto_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_terremoto_url)
    ],
    [
        'titulo' => 'Sistema de Coordenadas Geográficas',
        'subtitulo' => 'CARTOGRAFIA E ORIENTAÇÃO • MOZAIK 3D',
        'video_id' => 'coordenadas_geograficas_3d',
        'embed_url' => $mozaik_coordenadas_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_coordenadas_url)
    ],
    [
        'titulo' => 'Fusos Horários',
        'subtitulo' => 'CARTOGRAFIA E MOVIMENTOS DA TERRA • MOZAIK 3D',
        'video_id' => 'fusos_horarios_3d',
        'embed_url' => $mozaik_fusos_horarios_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_fusos_horarios_url)
    ],
    [
        'titulo' => 'Rios e a Formação do Relevo',
        'subtitulo' => 'HIDROGRAFIA E EROSÃO • MOZAIK 3D',
        'video_id' => 'rios_relevo_3d',
        'embed_url' => $mozaik_rios_relevo_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_rios_relevo_url)
    ],
    [
        'titulo' => 'Ciclones Tropicais',
        'subtitulo' => 'CLIMATOLOGIA E METEOROLOGIA • MOZAIK 3D',
        'video_id' => 'ciclones_tropicais_3d',
        'embed_url' => $mozaik_ciclones_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_ciclones_url)
    ],
    [
        'titulo' => 'Efeito Estufa',
        'subtitulo' => 'CLIMATOLOGIA E MEIO AMBIENTE • MOZAIK 3D',
        'video_id' => 'efeito_estufa_3d',
        'embed_url' => $mozaik_efeito_estufa_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_efeito_estufa_url)
    ],
    [
        'titulo' => 'Impacto Ambiental e Poluição',
        'subtitulo' => 'GEOGRAFIA AMBIENTAL • MOZAIK 3D',
        'video_id' => 'poluicao_3d',
        'embed_url' => $mozaik_poluicao_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_poluicao_url)
    ]
];

// Configurações Globais da Página
$titulo_pagina = "Geografia Imersiva";
$subtitulo_pagina = "Geopolítica e Análise de Terrenos Globais";
$icone_materia = "public";

// Ícones via render_icon ou Fallback
$header_icon = function_exists('render_icon') ? render_icon($icone_materia, "w-8 h-8 text-lime-600") : '<span class="material-symbols-outlined text-lime-600 text-3xl">public</span>';
$back_icon   = function_exists('render_icon') ? render_icon('arrow_back', 'w-4 h-4 text-slate-500') : '<span class="material-symbols-outlined text-sm">arrow_back</span>';

ob_start();
?>

<div class="max-w-7xl mx-auto space-y-8 p-4">
    
    <!-- Cabeçalho da Página -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-100 pb-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-lime-50 rounded-2xl flex items-center justify-center border border-lime-200 shadow-sm">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold text-lime-600 uppercase tracking-widest mt-0.5"><?php echo $subtitulo_pagina; ?></p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_geografia as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-lime-100 overflow-hidden hover:shadow-md transition-all">
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
                            <p class="text-xs font-semibold tracking-wider text-lime-600 uppercase mt-1">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas no desktop) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center bg-lime-50/50 p-6 rounded-2xl border border-lime-100 text-center h-full">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border border-lime-200 mb-3">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Sincronizar Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Aponte a câmera do headset para observar fenômenos climáticos e formações geográficas em escala real.
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
