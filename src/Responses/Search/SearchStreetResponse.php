<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Search;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\StreetDTO;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;

class SearchStreetResponse extends Response
{
    /**
     * @return array|StreetDTO[]
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
        foreach ($data['values'] as $item) {
            $items[] = new StreetDTO(
                name: $item['name'],
                highlight: $item['highlight'] ?? null,
            );
        }

        return $items;
    }

    /**
     * @return Collection<StreetDTO>
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
    public function count(): ?int
    {
        $data = $this->json();

        return $data['count'] ?? null;

    }
}
