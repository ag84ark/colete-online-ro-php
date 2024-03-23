<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Order;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Order\CreateOrderResponseDTO;
use Saloon\Http\Response;

class CreateOrderResponse extends Response
{
    /**
     * @throws \JsonException
     */
    public function response(): CreateOrderResponseDTO
    {
        $data = $this->json();

        return CreateOrderResponseDTO::fromArray($data);
    }
}
