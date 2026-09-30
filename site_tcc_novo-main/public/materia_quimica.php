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
$mozaik_mudancas_estado_url = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Mudancas_de_estado-46030?mode=directlink";
$mozaik_reacao_cadeia_url    = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Reacao_em_cadeia-123105?mode=directlink";
$mozaik_ligacoes_benzeno_url= "https://us.mozaweb.com/pt/Extra-Cenas_3D-Ligacoes_covalentes_nas_moleculas_de_benzeno-123110?mode=directlink";
$mozaik_evaporacao_url      = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Evaporacao_e_ebulicao-368841?mode=directlink";
$mozaik_eter_dietilico_url  = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Eter_dietilico_eter_C_H_O-3934?mode=directlink";
$mozaik_metil_buteno_url    = "https://us.mozaweb.com/pt/Extra-Cenas_3D-3_metil_1_buteno_C_H-3935?mode=directlink";
$mozaik_acido_benzoico_url  = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Acido_benzoico_C_H_COOH-3936?mode=directlink";
$mozaik_propano_url         = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Propano_C_H-3954?mode=directlink";
$mozaik_benzeno_url         = "https://us.mozaweb.com/pt/Extra-Cenas_3D-Benzeno_C_H-3969?mode=directlink";

// ==========================================================
// LISTA DE VÍDEOS E CONTEÚDOS 3D (QUÍMICA)
// ==========================================================
$videos_quimica = [
    [
        'titulo' => 'Mudanças de Estado Físico da Matéria',
        'subtitulo' => 'ESTADOS DA MATÉRIA • MOZAIK 3D',
        'video_id' => 'mudancas_estado_3d',
        'embed_url' => $mozaik_mudancas_estado_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_mudancas_estado_url)
    ],
    [
        'titulo' => 'Evaporação e Ebullição',
        'subtitulo' => 'FÍSICO-QUÍMICA • MOZAIK 3D',
        'video_id' => 'evaporacao_ebulicao_3d',
        'embed_url' => $mozaik_evaporacao_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_evaporacao_url)
    ],
    [
        'titulo' => 'Reação em Cadeia Nuclear',
        'subtitulo' => 'QUÍMICA NUCLEAR • MOZAIK 3D',
        'video_id' => 'reacao_cadeia_3d',
        'embed_url' => $mozaik_reacao_cadeia_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_reacao_cadeia_url)
    ],
    [
        'titulo' => 'Ligações Covalentes no Benzeno',
        'subtitulo' => 'QUÍMICA ORGÂNICA • MOZAIK 3D',
        'video_id' => 'ligacoes_benzeno_3d',
        'embed_url' => $mozaik_ligacoes_benzeno_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_ligacoes_benzeno_url)
    ],
    
    [
        'titulo' => 'Éter Dietílico (C₄H₁₀O)',
        'subtitulo' => 'ESTRUTURA MOLECULAR • MOZAIK 3D',
        'video_id' => 'eter_dietilico_3d',
        'embed_url' => $mozaik_eter_dietilico_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_eter_dietilico_url)
    ],
    [
        'titulo' => '3-Metil-1-Buteno (C₅H₁₀)',
        'subtitulo' => 'HIDROCARBONETOS • MOZAIK 3D',
        'video_id' => 'metil_buteno_3d',
        'embed_url' => $mozaik_metil_buteno_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_metil_buteno_url)
    ],
    [
        'titulo' => 'Ácido Benzoico (C₆H₅COOH)',
        'subtitulo' => 'FUNÇÕES ORGÂNICAS • MOZAIK 3D',
        'video_id' => 'acido_benzoico_3d',
        'embed_url' => $mozaik_acido_benzoico_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_acido_benzoico_url)
    ],
    [
        'titulo' => 'Propano (C₃H₈)',
        'subtitulo' => 'ALCANOS • MOZAIK 3D',
        'video_id' => 'propano_3d',
        'embed_url' => $mozaik_propano_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_propano_url)
    ],
    [
        'titulo' => 'Benzeno (C₆H₆)',
        'subtitulo' => 'COMPOSTOS AROMÁTICOS • MOZAIK 3D',
        'video_id' => 'benzeno_3d',
        'embed_url' => $mozaik_benzeno_url,
        'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($mozaik_benzeno_url)
    ]
];

// Configurações Globais da Página
$titulo_pagina = "Química Molecular";
$subtitulo_pagina = "Laboratório de Reações e Estruturas Atômicas";
$icone_materia = "science";

// Definição manual da cor Cyan hexadecimal (#0891b2) para evitar fallbacks para preto
$cor_cyan = "#0891b2";
$cor_cyan_light = "#ecfeff";
$cor_cyan_border = "#cff4fc";

// Ícones via render_icon ou Fallback
$header_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-cyan-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31L4.75 20.29A1 1 0 0 0 5.6 21.7h12.8a1 1 0 0 0 .85-1.41L14 9.31V2"/><path d="M8.5 2h7"/><path d="M7 16h10"/></svg>';
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
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center border shadow-sm"
                 style="background-color: <?php echo $cor_cyan_light; ?>; border-color: <?php echo $cor_cyan_border; ?>; color: <?php echo $cor_cyan; ?>;">
                <?php echo $header_icon; ?>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900"><?php echo $titulo_pagina; ?></h1>
                <p class="text-xs font-bold uppercase tracking-widest mt-0.5" style="color: <?php echo $cor_cyan; ?>;">
                    <?php echo $subtitulo_pagina; ?>
                </p>
            </div>
        </div>

        <a href="materias.php" class="px-5 py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition-all text-sm font-bold text-slate-600 flex items-center gap-2 shadow-sm">
            <?php echo $back_icon; ?> Voltar
        </a>
    </header>

    <!-- Lista / Grid de Cards de Vídeo -->
    <div class="grid grid-cols-1 gap-8">
        <?php foreach ($videos_quimica as $video): ?>
            <div class="bg-white rounded-3xl shadow-sm border overflow-hidden hover:shadow-md transition-all"
                 style="border-color: <?php echo $cor_cyan_border; ?>;">
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
                            <p class="text-xs font-semibold tracking-wider uppercase mt-1" style="color: <?php echo $cor_cyan; ?>;">
                                <?php echo $video['subtitulo']; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna do QR Code (4 colunas no desktop) -->
                    <div class="lg:col-span-4 flex flex-col items-center justify-center p-6 rounded-2xl border text-center h-full"
                         style="background-color: <?php echo $cor_cyan_light; ?>; border-color: <?php echo $cor_cyan_border; ?>;">
                        <div class="bg-white p-3 rounded-2xl shadow-sm border mb-3" style="border-color: <?php echo $cor_cyan_border; ?>;">
                            <img src="<?php echo $video['qr_code_url']; ?>" alt="QR Code Meta Quest" class="w-36 h-36 object-contain">
                        </div>
                        <h3 class="text-sm font-bold text-slate-800">Sincronizar Meta Quest</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            Sincronize o headset para visualizar a tabela periódica interativa e ligações covalentes.
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