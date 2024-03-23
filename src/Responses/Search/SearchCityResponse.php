<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Search;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\CityDTO;
use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\PaginationDTO;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;

class SearchCityResponse extends Response
{
    /**
     * @return array|CityDTO[]
     *
     * @throws JsonException
     */
    public function items(): array
    {
        $data = $this->json();

        if (! is_array($data) || ! isset($data['data'])) {
            return [];
        }

        $items = [];
        foreach ($data['data'] as $item) {
            $items[] = new CityDTO(
                city: $item['city'],
                county: $item['county'],
                countyCode: $item['countyCode'],
            );
        }

        return $items;
    }

    /**
     * @return Collection<CityDTO>
     *
     * @throws JsonException
     */
    public function itemsCollection(): Collection
    {
        return Collection::make($this->items()) ?? Collection::make([]);
    }

    /**
     * @throws JsonException
     */
    public function pagination(): ?PaginationDTO
    {
        $data = $this->json();

        if (! is_array($data) || ! isset($data['pagination'])) {
            return null;
        }

        $data = $data['pagination'];

        return new PaginationDTO(
            totalItems: $data['totalItems'],
            currentPage: $data['currentPage'],
            totalPages: $data['totalPages'],
        );

    }
}
