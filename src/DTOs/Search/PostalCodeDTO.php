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

    public static function fromArray(array $data): PostalCodeDTO
    {
        return new PostalCodeDTO(
            code: $data['code'],
            info: $data['info'],
            street: $data['street'],
        );
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'info' => $this->info,
            'street' => $this->street,
        ];
    }
}
