<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Search;

use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchStreetResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchStreetRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = SearchStreetResponse::class;

    public function __construct(
        protected readonly string $countryCode,
        protected readonly string $city,
        protected readonly string $county,
        protected readonly string $needle,
        protected readonly ?string $postalCode = null,
        protected readonly ?bool $isCountyCode = null,
        protected readonly ?int $page = null,
        protected readonly ?int $limit = 20,
    ) {
        $this->validateParameters();
    }

    public function resolveEndpoint(): string
    {
        return '/search/street/'.$this->countryCode.'/'.$this->city.'/'.$this->county.'/'.$this->needle;
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'isCountyCode' => (int) $this->isCountyCode,
            'postalCode' => $this->postalCode,
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
        if (empty($this->city)) {
            throw new \InvalidArgumentException('City must not be empty.');
        }
        if (empty($this->needle)) {
            throw new \InvalidArgumentException('Needle must not be empty.');
        }
    }
}
