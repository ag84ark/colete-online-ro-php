<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\Search;

class PaginationDTO
{
    public function __construct(
        public readonly int $totalItems,
        public readonly int $currentPage,
        public readonly int $totalPages,
    ) {
    }
}
