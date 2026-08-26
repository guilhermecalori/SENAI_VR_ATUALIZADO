<?php
header('Content-Type: application/json');

// 1. CHAVE E ENTRADA
$apiKey = 'AIzaSyD4u8EZL4G6EcMfePcqv-smuW5U3Q1bHFg';
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['response' => 'Mensagem vazia.']);
    exit;
}

// 2. O formato de dados mais básico que existe (Universal)
$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => $userMessage]
            ]
        ]
    ]
];

// 3. URL SEM VERSÃO ESPECÍFICA (O Google decide a melhor)
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$result = json_decode($response, true);
curl_close($ch);

// 4. VERIFICAÇÃO FINAL
if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    $aiText = $result['candidates'][0]['content']['parts'][0]['text'];
} else {
    // Se der erro, vamos mostrar o erro REAL do Google para você me falar o que é
    $aiText = "Erro técnico: " . ($result['error']['message'] ?? 'Resposta inesperada do servidor.');
}

echo json_encode(['response' => $aiText]);