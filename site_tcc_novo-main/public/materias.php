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

// Mapeamento das matérias com SVGs Inline garantidos
$materias = [
    [
        'nome' => 'Biologia', 
        'svg'  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>', 
        'desc' => 'Células, anatomia e ecossistemas em 3D.', 
        'link' => 'materia_biologia.php',
        'cor'  => '#10b981', // Emerald
        'bg'   => '#ecfdf5'
    ],
    [
        'nome' => 'Matemática', 
        'svg'  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>', 
        'desc' => 'Geometria espacial e cálculos visualizados.', 
        'link' => 'materia_matematica.php',
        'cor'  => '#9333ea', // Purple
        'bg'   => '#faf5ff'
    ],
    [
        'nome' => 'Física', 
        'svg'  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>', 
        'desc' => 'Simulações de leis da física e mecânica.', 
        'link' => 'materia_fisica.php',
        'cor'  => '#ea580c', // Orange
        'bg'   => '#fff7ed'
    ],
    [
        'nome' => 'Química', 
        'svg'  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>', 
        'desc' => 'Laboratório de reações e estruturas atômicas.', 
        'link' => 'materia_quimica.php',
        'cor'  => '#0891b2', // Cyan
        'bg'   => '#ecfeff'
    ],
    [
        'nome' => 'História', 
        'svg'  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>', 
        'desc' => 'Viagens no tempo para grandes eventos.', 
        'link' => 'materia_historia.php',
        'cor'  => '#e11d48', // Rose
        'bg'   => '#fff1f2'
    ],
    [
        'nome' => 'Geografia', 
        'svg'  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V11a2 2 0 012-2h1.055M11 20.055V18a2 2 0 012-2h3.055M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>', 
        'desc' => 'Geopolítica e análise de terrenos globais.', 
        'link' => 'materia_geografia.php',
        'cor'  => '#65a30d', // Lime
        'bg'   => '#f7fee7'
    ],
    [
        'nome' => 'Artes', 
        'svg'  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>', 
        'desc' => 'Exposição de galerias virtuais e criação 3D.', 
        'link' => 'materia_artes.php',
        'cor'  => '#db2777', // Pink
        'bg'   => '#fdf2f8'
    ],
];

// SVG da seta superior direita
$svg_seta = '<svg class="w-4 h-4 text-slate-400 group-hover:text-slate-700 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>';

ob_start();
?>

<!-- Link para o CSS global -->
<link rel="stylesheet" href="../css/style.css">

<!-- Estrutura visual de fundo com luzes e malha -->
<div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
    <div class="absolute inset-0 grid-faint-interno"></div>
    <div class="absolute -top-20 -left-20 w-[400px] h-[400px] bg-cyan-400/15 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-slate-400/15 blur-[140px] rounded-full"></div>
</div>

<style>
    .card-materia .bar-fill {
        width: 25%;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-materia:hover .bar-fill {
        width: 100% !important;
    }
</style>

<div class="p-6 md:p-8 animate-in fade-in duration-700 relative z-10">
    <div class="max-w-6xl mx-auto space-y-8">
        
        <header class="mb-2">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Módulos de Aprendizado</h1>
            <p class="text-slate-500 text-sm">Selecione uma disciplina para iniciar a experiência em realidade virtual.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($materias as $m): ?>
                <a href="<?php echo $m['link']; ?>" 
                   class="card-materia group p-6 rounded-2xl border border-slate-200/80 bg-white/90 backdrop-blur-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-5">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300 shadow-xs"
                                 style="background-color: <?php echo $m['bg']; ?>; color: <?php echo $m['cor']; ?>;">
                                <?php echo $m['svg']; ?>
                            </div>
                            <div class="pt-1">
                                <?php echo $svg_seta; ?>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-bold text-slate-800 mb-2 tracking-tight"><?php echo $m['nome']; ?></h3>
                        <p class="text-slate-500 text-xs leading-relaxed mb-6">
                            <?php echo $m['desc']; ?>
                        </p>
                    </div>
                    
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