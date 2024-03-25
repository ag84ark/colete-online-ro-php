<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Address;

class AddressItemDTO
{
    public function __construct(
        public readonly int $locationId,
        public readonly ?string $shortName,
        public readonly ContactDTO $contact,
        public readonly AddressDTO $address,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            locationId: $data['locationId'],
            shortName: $data['shortName'] ?? null,
            contact: ContactDTO::fromArray($data['contact']),
            address: AddressDTO::fromArray($data['address']),
        );
    }
}
