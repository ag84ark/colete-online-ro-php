<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Search;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\LocationDTO;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;

class SearchLocationResponse extends Response
{
    /**
     * @return array|LocationDTO[]
     *
     * @throws JsonException
     */
    public function items(): array
    {
        $data = $this->json();

        if (! is_array($data) || ! array_key_exists('names', $data)) {
            return [];
        }

        $items = [];
        foreach ($data['names'] as $item) {
            $items[] = new LocationDTO(
                city: $item['city'],
                county: $item['county'],
                countyCode: $item['countyCode'],
            );
        }

        return $items;
    }

    /**
     * @return Collection<LocationDTO>
     *
     * @throws JsonException
     */
    public function itemsCollection(): Collection
    {
        return Collection::make($this->items()) ?? Collection::make([]);
    }
}
