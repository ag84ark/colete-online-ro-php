<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Search;

use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchPostalCodeResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class SearchPostalCodeRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = SearchPostalCodeResponse::class;

    public function __construct(
        protected readonly string $countryCode,
        protected readonly string $county,
        protected readonly string $city,
        protected readonly string $street,
        protected readonly int $validateStreet = 1,
        protected readonly ?bool $isCountyCode = null,
        protected readonly ?int $limit = 20,
    ) {
        $this->validateParameters();
    }

    public function resolveEndpoint(): string
    {
        return '/search/postal-code/'.$this->countryCode.'/'.$this->city.'/'.$this->county.'/'.$this->street;
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'isCountyCode' => ! is_null($this->isCountyCode) ? (int) $this->isCountyCode : null,
            'limit' => $this->limit,
            'validateStreet' => $this->validateStreet,
        ]);
    }

    private function validateParameters(): void
    {
        if (strlen($this->countryCode) !== 2) {
            throw new \InvalidArgumentException('Country code must have 2 characters.');
        }
        if (strlen($this->county) < 2) {
            throw new \InvalidArgumentException('County must have at least 2 characters.');
        }
        if (strlen($this->city) < 2) {
            throw new \InvalidArgumentException('City must have at least 2 characters.');
        }
        if (strlen($this->street) < 2) {
            throw new \InvalidArgumentException('Street must have at least 2 characters.');
        }
        if ($this->validateStreet < 0 || $this->validateStreet > 2) {
            throw new \InvalidArgumentException('Validate street must be 0, 1 or 2.');
        }
    }
}
