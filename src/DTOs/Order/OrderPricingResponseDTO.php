<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

use Illuminate\Support\Collection;

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

    public function toArray(): array
    {
        return [
            'selected' => $this->selected->toArray(),
            'list' => array_map(
                fn ($item) => $item->toArray(),
                $this->list
            ),
        ];
    }

    /**
     * @return OrderCurrierServiceDTO[]|Collection<OrderCurrierServiceDTO>
     */
    public function getCurriersList()
    {
        return Collection::make($this->list) ?? Collection::make([]);

    }
}
