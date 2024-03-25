<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Order;

class CurierServiceDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $courierName,
        public readonly string $name,
        public readonly ?string $activationId = null,
    ) {
    }

    public static function fromArray(array $data): CurierServiceDTO
    {
        return new CurierServiceDTO(
            id: $data['id'],
            courierName: $data['courierName'],
            name: $data['name'],
            activationId: $data['activationId'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'courierName' => $this->courierName,
            'name' => $this->name,
            'activationId' => $this->activationId,
        ];
    }
}
