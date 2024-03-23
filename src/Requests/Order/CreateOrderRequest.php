<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Order;

use Ag84ark\ColeteOnlineRoPhp\Responses\Order\CreateOrderResponse;
use Ag84ark\ColeteOnlineRoPhp\Types\CurrierService;
use Ag84ark\ColeteOnlineRoPhp\Types\ExtraOptions;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderRecipient;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderSender;
use Ag84ark\ColeteOnlineRoPhp\Types\Packages;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateOrderRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected ?string $response = CreateOrderResponse::class;

    public function __construct(
        protected OrderSender $sender,
        protected OrderRecipient $recipient,
        protected Packages $packages,
        protected CurrierService $service,
        protected ExtraOptions $extraOptions = new ExtraOptions(),
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/order';
    }

    protected function defaultBody(): array
    {
        return [
            'sender' => $this->sender->toArray(),
            'recipient' => $this->recipient->toArray(),
            'packages' => $this->packages->toArray(),
            'service' => $this->service->toArray(),
            'extraOptions' => $this->extraOptions->toArray(),
        ];
    }
}
