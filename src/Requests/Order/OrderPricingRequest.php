<?php

namespace Ag84ark\ColeteOnlineRoPhp\Requests\Order;

use Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderPricingResponse;
use Ag84ark\ColeteOnlineRoPhp\Types\CurrierService;
use Ag84ark\ColeteOnlineRoPhp\Types\ExtraOptions;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderRecipient;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderSender;
use Ag84ark\ColeteOnlineRoPhp\Types\Packages;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * The request to this endpoint should be made with the same body of the /order endpoint, the only difference being
 * that this will not create the order and will only return the price and the selected service name. It will also
 * return the list of all services that matched the selection.
 */
class OrderPricingRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected ?string $response = OrderPricingResponse::class;

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
        return '/order/price';
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
