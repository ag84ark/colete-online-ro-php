<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\Search;

use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\PostalCodeDTO;
use Illuminate\Support\Collection;
use JsonException;
use Saloon\Http\Response;

class SearchPostalCodeResponse extends Response
{
    /**
     * @return array|PostalCodeDTO[]
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
        foreach ($data['codes'] as $item) {
            $items[] = new PostalCodeDTO(
                code: $item['code'],
                info: $item['info'],
                street: $item['street'],
            );
        }

        return $items;
    }

    /**
     * @return Collection<PostalCodeDTO>
     *
     * @throws JsonException
     */
    public function itemsCollection(): Collection
    {
        return Collection::make($this->items()) ?? Collection::make([]);
    }
}
