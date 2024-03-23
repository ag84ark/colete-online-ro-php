<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class OrderStatusHistoryItemComment
{
    public function __construct(
        public readonly string $ro
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            ro: $data['ro'],
        );
    }
}
