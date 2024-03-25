<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class CityDTO
{
    public function __construct(
        public readonly string $localityName,
        public readonly string $countyName,
        public readonly string $countyCode,
    ) {
    }
}
