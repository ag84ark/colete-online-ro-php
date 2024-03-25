<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class OrderStatusHistoryItemStatusTextPart
{
    public function __construct(
        public readonly string $name,
        public readonly string $reason,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            reason: $data['reason'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'reason' => $this->reason,
        ];
    }
}
