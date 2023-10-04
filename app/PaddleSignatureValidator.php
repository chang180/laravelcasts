<?php

namespace App;

use Illuminate\Http\Request;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

class PaddleSignatureValidator implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        // Your Paddle 'Public Key'
        $publicPaddleKey = openssl_get_publickey(config('services.paddle.public-key'));

        // Get the p_signature parameter & base64 decode it.
        $signature = base64_decode($request->get('p_signature'));

        // Get the fields sent in the request, and remove the p_signature parameter
        $requestFields = $request->all();;
        unset($requestFields['p_signature']);

        // ksort() and serialize the fields
        ksort($requestFields);
        foreach ($requestFields as $k => $v) {
            if (!in_array(gettype($v), array('object', 'array'))) {
                $requestFields[$k] = "$v";
            }
        }
        $data = serialize($requestFields);

        // Verify the signature
        return (bool) openssl_verify($data, $signature, $publicPaddleKey, OPENSSL_ALGO_SHA1);
    }
}
