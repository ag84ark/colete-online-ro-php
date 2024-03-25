<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class StreetDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?bool $highlight = null,
    ) {
    }

    public static function fromArray(array $data): StreetDTO
    {
        return new StreetDTO(
            name: $data['name'],
            highlight: $data['highlight'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'highlight' => $this->highlight,
        ];
    }
}
