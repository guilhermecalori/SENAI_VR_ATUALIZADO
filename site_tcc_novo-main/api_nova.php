<?php
// 1. Configurações de cabeçalho e erros
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

// Reportar erros para um arquivo de log (ajuda a descobrir por que não funciona)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

function respond(array $payload, int $statusCode = 200): void {
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

// 2. Chave da API e Endpoint
$apiKey = 'AIzaSyBVg7D-IPf6v26ToK2FcBJ3XyHGu2PqkFY';
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-8b:generateContent?key=" . $apiKey;

// 3. Captura do Input
$raw = file_get_contents('php://input');
$input = json_decode($raw, true);

if (!$input || !isset($input['message'])) {
    respond(['response' => 'Erro: Nenhuma mensagem recebida no back-end.'], 400);
}

$userMessage = trim($input['message']);

// 4. Instrução de Sistema (Personalidade do SENAI VR)
$sysPrompt = "Você é o Core, a IA do sistema SENAI VR. 
Sua personalidade é técnica, direta e futurista. 
Conhecimento principal: Meta Quest 3S (limpeza, ajustes de correia, segurança do guardião e IPD).
Regra: Responda em português, use negrito para termos importantes e seja conciso.";

$data = [
    'contents' => [
        [
            'role' => 'user', // O Gemini entende melhor quando definimos os papéis
            'parts' => [
                ['text' => "Instrução de Sistema: " . $sysPrompt],
                ['text' => "Pergunta do Aluno: " . $userMessage]
            ]
        ]
    ]
];

// 5. Execução cURL com tratamento de falhas
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Importante para funcionar no Windows/XAMPP
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 15); // Espera no máximo 15 segundos

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// 6. Tratamento da Resposta
if ($response === false) {
    error_log("Erro cURL: " . $curlError);
    respond(['response' => 'Erro de conexão com o núcleo neural: ' . $curlError], 502);
}

$result = json_decode($response, true);

if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    $text = $result['candidates'][0]['content']['parts'][0]['text'];
    respond(['response' => $text]);
} else {
    error_log("Resposta inválida do Google: " . $response);
    $msgErro = $result['error']['message'] ?? 'Erro desconhecido na API do Google.';
    respond(['response' => 'Aviso: ' . $msgErro], 502);
}