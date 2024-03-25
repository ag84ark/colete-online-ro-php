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
}
