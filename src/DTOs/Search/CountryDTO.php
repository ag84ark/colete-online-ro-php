<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class CountryDTO
{
    public function __construct(
        protected readonly array $postalCodeFormat,
        protected readonly string $name,
        protected readonly string $nameRo,
        protected readonly string $isoCode,
        protected readonly string $phoneCode,
        protected readonly bool $validateAddress,

    ) {
    }
}
