<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class PackageItem extends BaseType
{
    public function __construct(
        protected int $weight,
        protected ?int $height,
        protected ?int $width,
        protected ?int $length,
    ) {
    }

    public function toArray(): array
    {
        return [
            'weight' => $this->weight,
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length,
        ];
    }
}
