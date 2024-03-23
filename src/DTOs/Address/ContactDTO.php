<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Address;

class ContactDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $phone,
        public readonly string $company,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            company: $data['company'],
        );
    }
}
