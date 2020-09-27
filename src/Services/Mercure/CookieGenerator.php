<?php

declare(strict_types=1);

namespace App\Services\Mercure;

use App\Entity\Channel;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class CookieGenerator
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function generate(): string
    {
        $signer = new Sha256();
        return (new Builder())
            ->withClaim('mercure', ['subscribe' => ['http://astrochat.com/message/1']])
            ->getToken($signer, new Key($this->key))
            ->__toString();
    }
}