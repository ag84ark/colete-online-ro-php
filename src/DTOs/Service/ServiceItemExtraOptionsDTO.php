<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Service;

class ServiceItemExtraOptionsDTO
{
    /**
     * @param  array<ServiceItemExtraOptionDTO>  $extraOptions
     */
    protected function __construct(
        public readonly array $extraOptions
    ) {
    }

    public static function fromArray(array $data): ServiceItemExtraOptionsDTO
    {
        $extraOptions = [];
        foreach ($data as $extraOption) {
            $extraOptions[] = ServiceItemExtraOptionDTO::fromArray($extraOption);
        }

        return new ServiceItemExtraOptionsDTO(
            extraOptions: $extraOptions
        );
    }
}
