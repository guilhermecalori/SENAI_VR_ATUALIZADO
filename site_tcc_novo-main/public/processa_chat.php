<?php
// Configurações de erro para debugar (Remova em produção)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1. COLOQUE SUA CHAVE AQUI
$apiKey = "SUA_CHAVE_AQUI"; 

$mensagemUsuario = $_POST['mensagem'] ?? '';

if (empty($mensagemUsuario)) {
    echo "Diga algo para que eu possa ajudar!";
    exit();
}

// 2. PROMPT DE SISTEMA (Personalidade da IA)
$prompt = "Você é o Chat Neural do projeto Spatial Core (SENAI). 
Responda como uma IA avançada. Ajude com Meta Quest 3S e matérias.
Dê respostas úteis e diretas em português. 
Pergunta: " . $mensagemUsuario;

$data = [
    "contents" => [["parts" => [["text" => $prompt]]]]
];

// 3. CHAMADA CURL
$ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Importante para rodar no Localhost/XAMPP
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$result = json_decode($response, true);

// 4. RETORNO DA RESPOSTA
if ($httpCode == 200 && isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    echo $result['candidates'][0]['content']['parts'][0]['text'];
} else {
    // Se der erro, ele mostra o que aconteceu
    echo "Houve um problema na central neural (Código: $httpCode). Verifique se sua chave de API é válida.";
}
?>