<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Search;

use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCountryResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchCountryRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = SearchCountryResponse::class;

    public function __construct(
        protected readonly string $needle
    ) {
        $this->validateParameters();
    }

    public function resolveEndpoint(): string
    {
        return '/search/country/'.$this->needle;
    }

    private function validateParameters(): void
    {
        if (empty($this->needle)) {
            throw new \InvalidArgumentException('Needle must not be empty.');
        }
    }
}
