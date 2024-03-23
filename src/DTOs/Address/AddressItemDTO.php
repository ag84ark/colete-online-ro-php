<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Address;

class AddressItemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ContactDTO $contact,
        public readonly AddressDTO $address,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            contact: ContactDTO::fromArray($data['contact']),
            address: AddressDTO::fromArray($data['address']),
        );
    }
}
