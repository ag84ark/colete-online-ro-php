<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class StreetDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?bool $highlight = null,
    ) {
    }
}
