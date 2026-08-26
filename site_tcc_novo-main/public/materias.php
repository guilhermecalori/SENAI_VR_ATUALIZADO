<?php
session_start();
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../login.php");
    exit();
}
require_once '../layout.php';

$materias = [
    ['nome' => 'Biologia', 'icon' => 'science', 'cor' => 'emerald', 'desc' => 'Células, anatomia e ecossistemas em 3D.', 'link' => 'materia_biologia.php'],
    ['nome' => 'Português', 'icon' => 'auto_stories', 'cor' => 'blue', 'desc' => 'Literatura e gramática aplicada imersiva.', 'link' => 'materia_portugues.php'],
    ['nome' => 'Matemática', 'icon' => 'calculate', 'cor' => 'purple', 'desc' => 'Geometria espacial e cálculos visualizados.', 'link' => 'materia_matematica.php'],
    ['nome' => 'Física', 'icon' => 'precision_manufacturing', 'cor' => 'orange', 'desc' => 'Simulações de leis da física e mecânica.', 'link' => 'materia_fisica.php'],
    ['nome' => 'Química', 'icon' => 'science', 'cor' => 'cyan', 'desc' => 'Laboratório de reações e estruturas atômicas.', 'link' => 'materia_quimica.php'],
    ['nome' => 'História', 'icon' => 'history', 'cor' => 'rose', 'desc' => 'Viagens no tempo para grandes eventos.', 'link' => 'materia_historia.php'],
    ['nome' => 'Geografia', 'icon' => 'public', 'cor' => 'lime', 'desc' => 'Geopolítica e análise de terrenos globais.', 'link' => 'materia_geografia.php'],
    ['nome' => 'Inglês', 'icon' => 'translate', 'cor' => 'indigo', 'desc' => 'Prática de conversação em cenários reais.', 'link' => 'materia_ingles.php'],
    ['nome' => 'Sociologia', 'icon' => 'groups', 'cor' => 'amber', 'desc' => 'Estudo das estruturas sociais e interação humana.', 'link' => 'materia_sociologia.php'],
    ['nome' => 'Filosofia', 'icon' => 'psychology_alt', 'cor' => 'violet', 'desc' => 'O pensamento humano e grandes dilemas éticos.', 'link' => 'materia_filosofia.php'],
    ['nome' => 'Artes', 'icon' => 'palette', 'cor' => 'pink', 'desc' => 'Exposição de galerias virtuais e criação 3D.', 'link' => 'materia_artes.php'],
];

$conteudo = "
<div class='p-6 md:p-8 animate-in fade-in duration-700 bg-transparent'>
    <div class='max-w-6xl mx-auto space-y-8'>
        
        <header class='mb-2'>
            <h1 class='text-3xl font-bold text-slate-900 tracking-tight mb-2'>Módulos de Aprendizado</h1>
            <p class='text-slate-500 text-sm'>Selecione uma disciplina para iniciar a experiência em realidade virtual.</p>
        </header>

        <div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6'>";

foreach ($materias as $m) {
    $materia_icon = render_icon($m['icon'], "w-5 h-5 text-{$m['cor']}-600");
    $arrow_icon = render_icon('arrow_outward', "w-4 h-4 text-slate-400 group-hover:text-{$m['cor']}-600 transition-colors duration-300");

    $conteudo .= "
            <a href='{$m['link']}' class='glass group p-6 rounded-2xl border border-slate-200 bg-white hover:border-{$m['cor']}-300 hover:shadow-md transition-all duration-300 flex flex-col justify-between'>
                <div>
                    <div class='flex justify-between items-start mb-5'>
                        <div class='w-11 h-11 bg-{$m['cor']}-50 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300'>
                            {$materia_icon}
                        </div>
                        <div class='pt-1'>
                            {$arrow_icon}
                        </div>
                    </div>
                    
                    <h3 class='text-lg font-bold text-slate-800 mb-2 tracking-tight'>{$m['nome']}</h3>
                    <p class='text-slate-500 text-xs leading-relaxed mb-6'>
                        {$m['desc']}
                    </p>
                </div>
                
                <div class='h-1 w-full bg-slate-100 rounded-full overflow-hidden shrink-0 mt-auto'>
                    <div class='h-full bg-{$m['cor']}-500 w-1/4 group-hover:w-full transition-all duration-700 ease-out'></div>
                </div>
            </a>";
}

$conteudo .= "
        </div>
    </div>
</div>


";

renderizar_pagina("Matérias", $conteudo);
?>
