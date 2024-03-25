<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class CityDTO
{
    public function __construct(
        public readonly string $localityName,
        public readonly string $county,
        public readonly string $countyCode,
    ) {
    }
}
