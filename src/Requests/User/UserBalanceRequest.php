<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\User;

use Ag84ark\ColeteOnlineRoPhp\Responses\User\UserBalanceResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class UserBalanceRequest extends Request
{
    protected Method $method = Method::GET;

    protected ?string $response = UserBalanceResponse::class;

    public function __construct(
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/user/balance';
    }
}
