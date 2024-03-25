<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Service;

class ServiceItemExtraOptionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly array $requiredFields,
        public readonly array $optionalFields,
    ) {
    }

    public static function fromArray(array $data): ServiceItemExtraOptionDTO
    {
        return new ServiceItemExtraOptionDTO(
            id: $data['id'],
            name: $data['name'],
            requiredFields: $data['requiredFields'],
            optionalFields: $data['optionalFields'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'requiredFields' => $this->requiredFields,
            'optionalFields' => $this->optionalFields,
        ];
    }
}
