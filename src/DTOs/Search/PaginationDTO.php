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

    public static function fromArray(array $data): PaginationDTO
    {
        return new PaginationDTO(
            totalItems: $data['totalItems'],
            currentPage: $data['currentPage'],
            totalPages: $data['totalPages'],
        );
    }

    public function toArray(): array
    {
        return [
            'totalItems' => $this->totalItems,
            'currentPage' => $this->currentPage,
            'totalPages' => $this->totalPages,
        ];
    }
}
