<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class CreateOrderResponseDTO
{
    public function __construct(
        public readonly OrderCurrierServiceDTO $curierService,
        public readonly string $awb,
        public readonly string $uniqueId,
        public readonly string $estimatedPickupDate,
    ) {
    }

    public static function fromArray(array $data): CreateOrderResponseDTO
    {
        return new CreateOrderResponseDTO(
            curierService: OrderCurrierServiceDTO::fromArray($data['service']),
            awb: $data['awb'],
            uniqueId: $data['uniqueId'],
            estimatedPickupDate: $data['estimatedPickupDate'],
        );
    }
}
