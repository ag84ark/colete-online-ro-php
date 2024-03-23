<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Service;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Service\ServiceItemDTO;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;

class ServiceListResponse extends Response
{
    /**
     * @return array|ServiceItemDTO[]
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
            $items[] = ServiceItemDTO::fromArray($item);
        }

        return $items;
    }

    /**
     * @return Collection<ServiceItemDTO>
     *
     * @throws JsonException
     */
    public function itemsCollection(): Collection
    {
        return Collection::make($this->items()) ?? Collection::make([]);
    }
}
