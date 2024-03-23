<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Order;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetOrderAwbRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $uniqueId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/order/awb/'.$this->uniqueId;
    }
}
