<?php

namespace RingoverSDK\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;

class ValidationWebhookEvent
{
    public function isValidRequestWithJWT(ServerRequestInterface $request, string $secret): bool
    {
        $webhookSignature = $request->getHeader('x-ringover-webhook-signature')[0] ?? null;
        if (empty($webhookSignature)) {
            throw new InvalidArgumentException('Missing x-ringover-webhook-signature header');
        }

        $key = new Key($secret, 'HS512');
        JWT::decode($webhookSignature, $key);

        return true;
    }

    public function isValidRequestWithApiKey(ServerRequestInterface $request, string $apiKey): bool
    {
        $authorizationHeader = $request->getHeader('authorization')[0] ?? null;
        $xApiKey = $request->getHeader('x-ringover-webhook-signature')[0] ?? null;

        if (!isset($authorizationHeader) && !isset($xApiKey)) {
            throw new InvalidArgumentException('Missing api key');
        }

        if (isset($authorizationHeader) && strpos($authorizationHeader, 'Bearer ') !== 0) {
            throw new InvalidArgumentException('Invalid authorization header');
        } elseif (isset($authorizationHeader)) {
            $isValidApiKey = $authorizationHeader === 'Bearer ' . base64_encode($apiKey);
        } else {
            $isValidApiKey = $xApiKey === $apiKey;
        }

        return $isValidApiKey;
    }
}
