<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\User;

class UserBalanceDTO
{
    public function __construct(
        public float $amount,
        public float $bonus,
    ) {
    }
}
