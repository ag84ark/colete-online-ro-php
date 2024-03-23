<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Order;

use Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderStatusResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class OrderStatusRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = OrderStatusResponse::class;

    public function __construct(
        protected string $uniqueId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/order/status/'.$this->uniqueId;
    }
}
