<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Order;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Order\OrderPricingResponseDTO;
use Saloon\Http\Response;

class OrderPricingResponse extends Response
{
    /**
     * @throws \JsonException
     */
    public function response(): OrderPricingResponseDTO
    {
        $data = $this->json();

        return OrderPricingResponseDTO::fromArray($data);
    }
}
