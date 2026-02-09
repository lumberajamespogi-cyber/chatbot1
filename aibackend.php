<?php
session_start();

header('Content-Type: application/json');

$apiKey = "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";

$input = json_decode(file_get_contents("php://input"), true);
$message = $input["message"] ?? "";

if (empty($message)) {
    echo json_encode(["output" => "No message received"]);
    exit;
}

$payload = json_encode([
    "model" => "openai/gpt-oss-20b:free",
    "messages" => [
        [
            "role" => "user",
            "content" => $message
        ]
    ]
]);

$ch = curl_init("https://openrouter.ai/api/v1/chat/completions");

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["output" => "Request Error: " . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

$data = json_decode($response, true);

if (!is_array($data)) {
    echo json_encode(["output" => "API Error: Invalid response from server"]);
    exit;
}

if (isset($data['error'])) {
    $errorMsg = $data['error']['message'] ?? 'Unknown API error';
    echo json_encode(["output" => "API Error: " . $errorMsg]);
    exit;
}

$output = $data["choices"][0]["message"]["content"] ?? "No response from API";

echo json_encode(["output" => $output]);

?>