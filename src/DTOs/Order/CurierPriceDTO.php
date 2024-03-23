<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class CurierPriceDTO
{
    public function __construct(
        public readonly float $total,
        public readonly float $noVat,
    ) {
    }

    public static function fromArray(array $data): CurierPriceDTO
    {
        return new CurierPriceDTO(
            total: $data['total'],
            noVat: $data['noVat'],
        );
    }
}
