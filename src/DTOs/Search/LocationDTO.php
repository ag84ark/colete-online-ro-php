<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class LocationDTO
{
    public function __construct(
        public readonly string $city,
        public readonly string $county,
        public readonly string $countyCode,
    ) {
    }
}
