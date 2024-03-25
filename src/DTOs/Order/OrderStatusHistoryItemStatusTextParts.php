<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class OrderStatusHistoryItemStatusTextParts
{
    public function __construct(
        public readonly OrderStatusHistoryItemStatusTextPart $ro
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            ro: OrderStatusHistoryItemStatusTextPart::fromArray($data['ro']),
        );
    }

    public function toArray(): array
    {
        return [
            'ro' => $this->ro->toArray(),
        ];
    }
}
