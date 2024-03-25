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

    public static function fromArray(array $data): LocationDTO
    {
        return new LocationDTO(
            city: $data['city'],
            county: $data['county'],
            countyCode: $data['countyCode'],
        );
    }

    public function toArray(): array
    {
        return [
            'city' => $this->city,
            'county' => $this->county,
            'countyCode' => $this->countyCode,
        ];
    }
}
