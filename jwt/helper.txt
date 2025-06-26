<?php
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}

function create_jwt($payload, $secret = 'secret') {
    $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    $header_enc = base64url_encode(json_encode($header));
    $payload_enc = base64url_encode(json_encode($payload));
    $signature = hash_hmac('sha256', "$header_enc.$payload_enc", $secret, true);
    $signature_enc = base64url_encode($signature);
    return "$header_enc.$payload_enc.$signature_enc";
}

function verify_jwt($jwt, $secret = 'secret') {
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) return false;

    list($header_enc, $payload_enc, $signature_enc) = $parts;
    $valid_signature = base64url_encode(hash_hmac('sha256', "$header_enc.$payload_enc", $secret, true));
    
    if ($signature_enc !== $valid_signature) return false;

    $payload = json_decode(base64url_decode($payload_enc), true);
    return $payload;
}
?>
