<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class Address extends BaseType
{
    public function __construct(
        public string $countryCode = '',
        public string $postalCode = '',
        public string $city = '',
        public string $county = '',
        public string $street = '',
        public string $number = '',
        public string $block = '',
        public string $entrance = '',
        public string $floor = '',
        public string $apartment = '',
        public string $intercom = '',
        public string $landmark = '',
        public string $additionalInfo = '',
    ) {
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
            'block' => $this->block,
            'entrance' => $this->entrance,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
            'intercom' => $this->intercom,
            'landmark' => $this->landmark,
            'additionalInfo' => $this->additionalInfo,
        ];
    }
}
