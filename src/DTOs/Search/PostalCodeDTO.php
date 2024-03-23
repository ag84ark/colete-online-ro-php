<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class PostalCodeDTO
{
    public function __construct(
        public readonly string $code,
        public readonly string $info,
        public readonly string $street,
    ) {
    }
}
