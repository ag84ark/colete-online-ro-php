<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Address;

use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCountryResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class AddressListRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = SearchCountryResponse::class;

    public function __construct(
        protected int $page = 1,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/address';
    }

    public function defaultQuery(): array
    {
        return [
            'page' => $this->page,
        ];
    }
}
