<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class PackageItem extends BaseType
{
    public function __construct(
        protected float $weight,
        protected ?float $height,
        protected ?float $width,
        protected ?float $length,
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
