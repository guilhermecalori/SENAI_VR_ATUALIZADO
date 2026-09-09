<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}

if (file_exists(__DIR__ . '/layout.php')) {
    require_once __DIR__ . '/layout.php';
} else {
    require_once __DIR__ . '/../layout.php';
}

// Mapeamento das Matérias com Nomes Oficiais de Ícones do Material Symbols
$materias = [
    [
        'nome' => 'Biologia', 
        'icon' => 'biotech', 
        'desc' => 'Células, anatomia e ecossistemas em 3D.', 
        'link' => 'materia_biologia.php',
        'cor'  => '#10b981', // Emerald
        'bg'   => '#ecfdf5'
    ],
    [
        'nome' => 'Português', 
        'icon' => 'auto_stories', 
        'desc' => 'Literatura e gramática aplicada imersiva.', 
        'link' => 'materia_portugues.php',
        'cor'  => '#2563eb', // Blue
        'bg'   => '#eff6ff'
    ],
    [
        'nome' => 'Matemática', 
        'icon' => 'calculate', 
        'desc' => 'Geometria espacial e cálculos visualizados.', 
        'link' => 'materia_matematica.php',
        'cor'  => '#9333ea', // Purple
        'bg'   => '#faf5ff'
    ],
    [
        'nome' => 'Física', 
        'icon' => 'precision_manufacturing', 
        'desc' => 'Simulações de leis da física e mecânica.', 
        'link' => 'materia_fisica.php',
        'cor'  => '#ea580c', // Orange
        'bg'   => '#fff7ed'
    ],
    [
        'nome' => 'Química', 
        'icon' => 'science', // Ícone oficial verificado do Google Material
        'desc' => 'Laboratório de reações e estruturas atômicas.', 
        'link' => 'materia_quimica.php',
        'cor'  => '#0891b2', // Cyan
        'bg'   => '#ecfeff'
    ],
    [
        'nome' => 'História', 
        'icon' => 'history', 
        'desc' => 'Viagens no tempo para grandes eventos.', 
        'link' => 'materia_historia.php',
        'cor'  => '#e11d48', // Rose
        'bg'   => '#fff1f2'
    ],
    [
        'nome' => 'Geografia', 
        'icon' => 'public', 
        'desc' => 'Geopolítica e análise de terrenos globais.', 
        'link' => 'materia_geografia.php',
        'cor'  => '#65a30d', // Lime
        'bg'   => '#f7fee7'
    ],
    [
        'nome' => 'Inglês', 
        'icon' => 'translate', 
        'desc' => 'Prática de conversação em cenários reais.', 
        'link' => 'materia_ingles.php',
        'cor'  => '#4f46e5', // Indigo
        'bg'   => '#eef2ff'
    ],
    [
        'nome' => 'Sociologia', 
        'icon' => 'groups', 
        'desc' => 'Estudo das estruturas sociais e interação humana.', 
        'link' => 'materia_sociologia.php',
        'cor'  => '#d97706', // Amber
        'bg'   => '#fffbeb'
    ],
    [
        'nome' => 'Filosofia', 
        'icon' => 'psychology', 
        'desc' => 'O pensamento humano e grandes dilemas éticos.', 
        'link' => 'materia_filosofia.php',
        'cor'  => '#7c3aed', // Violet
        'bg'   => '#f5f3ff'
    ],
    [
        'nome' => 'Artes', 
        'icon' => 'palette', 
        'desc' => 'Exposição de galerias virtuais e criação 3D.', 
        'link' => 'materia_artes.php',
        'cor'  => '#db2777', // Pink
        'bg'   => '#fdf2f8'
    ],
];

ob_start();
?>

<!-- Garantia do carregamento correto da fonte de ícones -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" />

<style>
    /* Estilos e Efeitos nos Cards */
    .card-materia {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-materia:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
    }

    /* Animação da Barra de Progresso/Decorativa no Rodapé */
    .card-materia .bar-fill {
        width: 20%;
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-materia:hover .bar-fill {
        width: 100% !important;
    }

    /* Botão de Seta no Hover */
    .card-materia:hover .btn-cta-arrow {
        transform: translate(2px, -2px) rotate(5deg);
        background-color: var(--theme-color);
        color: #ffffff !important;
    }

    /* Trava rigorosa para evitar vazamento de nome do ícone caso falhe o carregamento */
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        overflow: hidden;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
    }
</style>

<div class="p-6 md:p-8 animate-in fade-in duration-500 bg-transparent min-h-[calc(100vh-80px)]">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <!-- HEADER DA PÁGINA -->
        <header class="mb-4">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight mb-1">Módulos de Aprendizado</h1>
            <p class="text-slate-500 text-sm">Selecione uma disciplina para iniciar a experiência em realidade virtual.</p>
        </header>

        <!-- GRID DE MATÉRIAS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pb-6">
            <?php foreach ($materias as $m): ?>
                <a href="<?php echo $m['link']; ?>" 
                   class="card-materia glass group p-6 rounded-2xl border border-slate-200/80 bg-white shadow-sm flex flex-col justify-between"
                   style="--theme-color: <?php echo $m['cor']; ?>;">
                    <div>
                        <!-- Topo do Card com Ícone e Botão CTA -->
                        <div class="flex justify-between items-center mb-5">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-transform duration-300 group-hover:scale-110 shadow-sm overflow-hidden shrink-0"
                                 style="background-color: <?php echo $m['bg']; ?>; color: <?php echo $m['cor']; ?>;">
                                <span class="material-symbols-outlined text-2xl select-none"><?php echo $m['icon']; ?></span>
                            </div>
                            
                            <!-- Botão da Seta -->
                            <div class="btn-cta-arrow w-8 h-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 transition-all duration-300">
                                <span class="material-symbols-outlined text-base select-none">arrow_outward</span>
                            </div>
                        </div>
                        
                        <!-- Título e Descrição -->
                        <h3 class="text-lg font-bold text-slate-800 mb-2 tracking-tight group-hover:text-slate-900 transition-colors">
                            <?php echo $m['nome']; ?>
                        </h3>
                        <p class="text-slate-500 text-xs leading-relaxed mb-6">
                            <?php echo $m['desc']; ?>
                        </p>
                    </div>
                    
                    <!-- Barra de Progresso Animada -->
                    <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden shrink-0 mt-auto">
                        <div class="bar-fill h-full rounded-full" style="background-color: <?php echo $m['cor']; ?>;"></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php
$conteudo = ob_get_clean();
renderizar_pagina("Módulos de Aprendizado", $conteudo);
?>