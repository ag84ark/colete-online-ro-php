<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Address;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Address\AddressItemDTO;
use Ag84ark\ColeteOnlineRoPhp\DTOs\Address\PaginationDTO;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;

class AddressListResponse extends Response
{
    /**
     * @return array|AddressItemDTO[]
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
            $items[] = AddressItemDTO::fromArray($item);
        }

        return $items;
    }

    /**
     * @return Collection<AddressItemDTO>
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

        return PaginationDTO::fromArray($data['pagination']);

    }
}
