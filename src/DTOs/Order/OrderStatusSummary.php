<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class OrderStatusSummary
{
    public function __construct(
        public readonly string $uniqueId,
        public readonly string $awb,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            uniqueId: $data['uniqueId'],
            awb: $data['awb'],
        );
    }

    public function toArray(): array
    {
        return [
            'uniqueId' => $this->uniqueId,
            'awb' => $this->awb,
        ];
    }
}
