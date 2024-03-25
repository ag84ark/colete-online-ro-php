<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Service;

use Ag84ark\ColeteOnlineRoPhp\Responses\Service\ServiceListResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ServiceListRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = ServiceListResponse::class;

    public function __construct(
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/service/list';
    }
}
