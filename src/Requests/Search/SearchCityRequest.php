<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Search;

use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCityResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchCityRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = SearchCityResponse::class;

    public function __construct(
        protected readonly string $countryCode,
        protected readonly string $county,
        protected readonly string $needle,
        protected readonly ?bool $isCountyCode = null,
        protected readonly ?int $page = null,
        protected readonly ?int $limit = 20,
    ) {
        $this->validateParameters();
    }

    public function resolveEndpoint(): string
    {
        return '/search/city/'.$this->countryCode.'/'.$this->county.'/'.$this->needle;
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'isCountyCode' => (int) $this->isCountyCode,
            'page' => $this->page,
            'limit' => $this->limit,
        ]);
    }

    private function validateParameters(): void
    {
        if (strlen($this->countryCode) !== 2) {
            throw new \InvalidArgumentException('Country code must have 2 characters.');
        }
        if (empty($this->county)) {
            throw new \InvalidArgumentException('County must not be empty.');
        }
        if (empty($this->needle)) {
            throw new \InvalidArgumentException('Needle must not be empty.');
        }
    }
}
