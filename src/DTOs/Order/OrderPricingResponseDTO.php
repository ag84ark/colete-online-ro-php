<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class OrderPricingResponseDTO
{
    /**
     * @param  array<OrderCurrierServiceDTO>  $list
     */
    protected function __construct(
        public readonly OrderCurrierServiceDTO $selected,
        public readonly array $list
    ) {
    }

    public static function fromArray(array $data): OrderPricingResponseDTO
    {
        return new OrderPricingResponseDTO(
            selected: OrderCurrierServiceDTO::fromArray($data['selected']),
            list: array_map(
                fn ($item) => OrderCurrierServiceDTO::fromArray($item),
                $data['list']
            )
        );
    }
}
