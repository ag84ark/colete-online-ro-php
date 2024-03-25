<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

use Illuminate\Support\Collection;

class OrderStatusResponseDTO
{
    public function __construct(
        public readonly OrderStatusSummary $summary,
        public readonly array $history,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            summary: OrderStatusSummary::fromArray($data['summary']),
            history: array_map(
                fn ($historyItem) => OrderStatusHistoryItemDTO::fromArray($historyItem),
                $data['history']
            ),
        );
    }

    /**
     * @return OrderStatusHistoryItemDTO[]|Collection<OrderStatusHistoryItemDTO>
     */
    public function getHistoryCollection()
    {
        return Collection::make($this->history);

    }
}
