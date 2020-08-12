<?php

declare(strict_types=1);

namespace App\Services\Mercure;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Token;

class JWTProvider
{
    private string $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function __invoke(): Token
    {
        $signer = new Sha256();

        return (new Builder())
            ->withClaim('mercure', ['publish' => '[*]'])
            ->getToken($signer, new Key($this->secret));
    }
}