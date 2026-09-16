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

// Mapeamento usando Hexadecimal/RGB para garantir exibição perfeita sem falhas de Tailwind
$materias = [
    [
        'nome' => 'Biologia', 
        'icon' => 'science', 
        'desc' => 'Células, anatomia e ecossistemas em 3D.', 
        'link' => 'materia_biologia.php',
        'cor'  => '#10b981', // Emerald
        'bg'   => '#ecfdf5'
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
        'icon' => 'science', 
        'desc' => 'Laboratório de reações e estruturas atômicas.', 
        'link' => 'materia_quimica.php',
        'cor'  => '#0891b2', // Cyan (Garantido!)
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

<style>
    /* Estilo para garantir a animação suave do preenchimento da barra */
    .card-materia .bar-fill {
        width: 25%;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-materia:hover .bar-fill {
        width: 100% !important;
    }
</style>

<div class="p-6 md:p-8 animate-in fade-in duration-700 bg-transparent">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <header class="mb-2">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight mb-2">Módulos de Aprendizado</h1>
            <p class="text-slate-500 text-sm">Selecione uma disciplina para iniciar a experiência em realidade virtual.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($materias as $m): ?>
                <?php 
                    $materia_icon = function_exists('render_icon') 
                        ? render_icon($m['icon'], "w-5 h-5") 
                        : "<span class='material-symbols-outlined text-xl'>{$m['icon']}</span>";
                    
                    $arrow_icon = function_exists('render_icon') 
                        ? render_icon('arrow_outward', "w-4 h-4 text-slate-400 group-hover:text-slate-700 transition-colors duration-300") 
                        : "<span class='material-symbols-outlined text-slate-400 group-hover:text-slate-700 transition-colors duration-300 text-sm'>arrow_outward</span>";
                ?>
                
                <a href="<?php echo $m['link']; ?>" 
                   class="card-materia glass group p-6 rounded-2xl border border-slate-200 bg-white hover:shadow-md transition-all duration-300 flex flex-col justify-between"
                   style="--theme-color: <?php echo $m['cor']; ?>;">
                    <div>
                        <div class="flex justify-between items-start mb-5">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300"
                                 style="background-color: <?php echo $m['bg']; ?>; color: <?php echo $m['cor']; ?>;">
                                <?php echo $materia_icon; ?>
                            </div>
                            <div class="pt-1">
                                <?php echo $arrow_icon; ?>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-bold text-slate-800 mb-2 tracking-tight"><?php echo $m['nome']; ?></h3>
                        <p class="text-slate-500 text-xs leading-relaxed mb-6">
                            <?php echo $m['desc']; ?>
                        </p>
                    </div>
                    
                    <!-- Barra de Progresso/Animação no Hover -->
                    <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden shrink-0 mt-auto">
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
