<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Search;

use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchLocationResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchLocationRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = SearchLocationResponse::class;

    public function __construct(
        protected readonly string $countryCode,
        protected readonly string $needle,
        protected readonly ?int $page,
        protected readonly ?int $limit = 20
    ) {
        $this->validateParameters();
    }

    public function resolveEndpoint(): string
    {
        return '/search/location/'.$this->countryCode.'/'.$this->needle;
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'format' => 'objectFull',
            'limit' => $this->limit,
            'page' => $this->page,
        ]);
    }

    private function validateParameters(): void
    {
        if (strlen($this->countryCode) !== 2) {
            throw new \InvalidArgumentException('Country code must have 2 characters.');
        }
        if (empty($this->needle)) {
            throw new \InvalidArgumentException('Needle must not be empty.');
        }
    }
}
