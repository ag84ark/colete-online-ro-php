<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class OrderCurrierServiceDTO
{
    public function __construct(
        public readonly CurierServiceDTO $service,
        public readonly CurierPriceDTO $price,
    ) {
    }

    public static function fromArray(array $data): OrderCurrierServiceDTO
    {
        return new OrderCurrierServiceDTO(
            service: CurierServiceDTO::fromArray($data['service']),
            price: CurierPriceDTO::fromArray($data['price']),
        );
    }

    public function toArray(): array
    {
        return [
            'service' => $this->service->toArray(),
            'price' => $this->price->toArray(),
        ];
    }
}
