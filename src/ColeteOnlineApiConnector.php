<?php

namespace Ag84ark\ColeteOnlineRoPhp;

use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;
use Saloon\Traits\Plugins\AcceptsJson;

class ColeteOnlineApiConnector extends Connector
{
    use AcceptsJson;
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

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId($this->clientId)
            ->setClientSecret($this->clientSecret)
            ->setDefaultScopes(['*'])
            ->setTokenEndpoint('https://auth.colete-online.ro/token')
            ->setRequestModifier(function (Request $request) {
                // Optional: Modify the requests being sent.
            });
    }
}
