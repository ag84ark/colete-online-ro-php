<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Address;

class AddressDTO
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $postalCode,
        public readonly string $city,
        public readonly string $county,
        public readonly string $street,
        public readonly string $number,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            countryCode: $data['countryCode'],
            postalCode: $data['postalCode'],
            city: $data['city'],
            county: $data['county'],
            street: $data['street'],
            number: $data['number'],
        );
    }

    public function toArray(): array
    {
        return [
            'countryCode' => $this->countryCode,
            'postalCode' => $this->postalCode,
            'city' => $this->city,
            'county' => $this->county,
            'street' => $this->street,
            'number' => $this->number,
        ];
    }
}
