<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Search;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\LocationsDTO;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;

class SearchLocationResponse extends Response
{
    /**
     * @return array|LocationsDTO[]
     *
     * @throws JsonException
     */
    public function items(): array
    {
        $data = $this->json();

        if (! is_array($data)) {
            return [];
        }

        $items = [];
        foreach ($data as $item) {
            $items[] = new LocationsDTO(
                city: $item['city'],
                county: $item['county'],
                countyCode: $item['countyCode'],
            );
        }

        return $items;
    }

    /**
     * @return Collection<LocationsDTO>
     *
     * @throws JsonException
     */
    public function itemsCollection(): Collection
    {
        return Collection::make($this->items()) ?? Collection::make([]);
    }
}
