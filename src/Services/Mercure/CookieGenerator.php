<?php

declare(strict_types=1);

namespace App\Services\Mercure;

use App\Entity\Channel;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;

class CookieGenerator
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function __invoke(Channel $channel): string
    {
        $signer = new Sha256();
        return (new Builder())
            ->withClaim('mercure', ['subscribe' => [sprintf('http://astrochat.com/channel/%s', $channel->getId())]])
            ->getToken($signer, new Key($this->key))
            ->__toString()
        ;
    }
}
