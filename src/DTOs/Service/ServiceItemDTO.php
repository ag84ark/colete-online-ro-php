<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Service;

class ServiceItemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $courierName,
        public readonly string $name,
        public readonly ServiceItemExtraOptionsDTO $extraOptions,
    ) {
    }

    public static function fromArray(array $data): ServiceItemDTO
    {
        return new ServiceItemDTO(
            id: $data['id'],
            courierName: $data['courierName'],
            name: $data['name'],
            extraOptions: ServiceItemExtraOptionsDTO::fromArray($data['extraOptions']),
        );
    }
}
