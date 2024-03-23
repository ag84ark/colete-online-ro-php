<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Search;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\CountryDTO;
use Illuminate\Support\Collection;
use Saloon\Http\Response;

class SearchCountryResponse extends Response
{
    /**
     * @return array|CountryDTO[]
     *
     * @throws \JsonException
     */
    public function items(): array
    {
        $data = $this->json();

        if (! is_array($data)) {
            return [];
        }

        $items = [];
        foreach ($data as $item) {
            $items[] = new CountryDTO(
                postalCodeFormat: $item['postalCodeFormat'],
                name: $item['name'],
                nameRo: $item['nameRo'],
                isoCode: $item['isoCode'],
                phoneCode: $item['phoneCode'],
                validateAddress: $item['validateAddress'],
            );
        }

        return $items;
    }

    /**
     * @return Collection<CountryDTO>
     *
     * @throws \JsonException
     */
    public function itemsCollection(): Collection
    {
        return Collection::make($this->items()) ?? Collection::make([]);
    }
}
