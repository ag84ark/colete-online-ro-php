<?php

namespace Ag84ark\ColeteOnlineRoPhp\DTOs\User;

class UserBalanceDTO
{
    public function __construct(
        public float $amount,
        public float $bonus,
    ) {
    }

    public static function fromArray(array $data): UserBalanceDTO
    {
        return new UserBalanceDTO(
            amount: $data['amount'],
            bonus: $data['bonus'],
        );
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'bonus' => $this->bonus,
        ];
    }
}
