<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class CountryDTO
{
    public function __construct(
        public readonly array $postalCodeFormat,
        public readonly string $name,
        public readonly string $nameRo,
        public readonly string $isoCode,
        public readonly string $phoneCode,
        public readonly bool $validateAddress,
    ) {
    }

    public static function fromArray(array $data): CountryDTO
    {
        return new CountryDTO(
            postalCodeFormat: $data['postalCodeFormat'],
            name: $data['name'],
            nameRo: $data['nameRo'],
            isoCode: $data['isoCode'],
            phoneCode: $data['phoneCode'],
            validateAddress: $data['validateAddress'],
        );
    }

    public function toArray(): array
    {
        return [
            'postalCodeFormat' => $this->postalCodeFormat,
            'name' => $this->name,
            'nameRo' => $this->nameRo,
            'isoCode' => $this->isoCode,
            'phoneCode' => $this->phoneCode,
            'validateAddress' => $this->validateAddress,
        ];
    }
}
