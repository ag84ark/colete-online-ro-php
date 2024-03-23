<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class LocationsDTO
{
    public function __construct(
        public readonly string $city,
        public readonly string $county,
        public readonly string $countyCode,
    ) {
    }
}
