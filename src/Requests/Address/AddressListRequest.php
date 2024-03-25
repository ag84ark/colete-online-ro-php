<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Address;

use Ag84ark\ColeteOnlineRoPhp\Responses\Address\AddressListResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class AddressListRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = AddressListResponse::class;

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
