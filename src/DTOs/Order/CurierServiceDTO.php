<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class CurierServiceDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $courierName,
        public readonly string $name,
    ) {
    }

    public static function fromArray(array $data): CurierServiceDTO
    {
        return new CurierServiceDTO(
            id: $data['id'],
            courierName: $data['courierName'],
            name: $data['name'],
        );
    }
}
