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

    public static function fromArray(array $data): CityDTO
    {
        return new CityDTO(
            localityName: $data['localityName'],
            countyName: $data['countyName'],
            countyCode: $data['countyCode'],
        );
    }

    public function toArray(): array
    {
        return [
            'localityName' => $this->localityName,
            'countyName' => $this->countyName,
            'countyCode' => $this->countyCode,
        ];
    }
}
