<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use Stringable;

abstract class BaseType implements Arrayable, Jsonable, JsonSerializable, Stringable
{
    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toArray(), $options);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function __toString(): string
    {
        return $this->toJson();
    }
}
