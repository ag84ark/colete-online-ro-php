<?php

namespace Ag84ark\ColeteOnlineRoPhp\Responses\User;

use Ag84ark\ColeteOnlineRoPhp\DTOs\User\UserBalanceDTO;
use JsonException;
use Saloon\Http\Response;

class UserBalanceResponse extends Response
{
    /**
     * @throws JsonException
     */
    public function balance(): UserBalanceDTO
    {
        $data = $this->json();

        return new UserBalanceDTO(
            amount: $data['amount'],
            bonus: $data['bonus'],
        );
    }

    /**
     * @throws JsonException
     */
    public function item(): UserBalanceDTO
    {
        return $this->balance();
    }
}
