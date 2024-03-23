<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class Contact extends BaseType
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $phone2,
        public string $email,
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'phone2' => $this->phone2,
            'email' => $this->email,
        ];

    }
}
