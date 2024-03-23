<?php

namespace Ag84ark\ColeteOnlineRoPhp;

use Saloon\Contracts\OAuthAuthenticator;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;

class ColeteOnlineApiConnector extends Connector
{
    use ClientCredentialsGrant;

    public function __construct(
        protected string $clientId,
        protected string $clientSecret,
        protected bool $staging = false
    ) {
    }

    public function resolveBaseUrl(): string
    {
        if ($this->staging) {
            return 'https://api.colete-online.ro/v1/staging';
        }

        return 'https://api.colete-online.ro/v1';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId($this->clientId)
            ->setClientSecret($this->clientSecret)
            ->setTokenEndpoint('/token')
            ->setRequestModifier(function (Request $request) {
                // Optional: Modify the requests being sent.
            });
    }

    protected function createOAuthAuthenticator(string $accessToken, ?\DateTimeImmutable $expiresAt = null): OAuthAuthenticator
    {
        return new WarehouseAuthenticator($accessToken, $expiresAt);
    }
}
