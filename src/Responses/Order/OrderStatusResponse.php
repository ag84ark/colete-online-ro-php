<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Order;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Order\OrderStatusResponseDTO;
use JsonException;
use Saloon\Http\Response;

class OrderStatusResponse extends Response
{
    /**
     * @throws JsonException
     */
    public function response(): OrderStatusResponseDTO
    {
        $data = $this->json();

        return OrderStatusResponseDTO::fromArray($data);
    }
}
