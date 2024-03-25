<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class OrderPricing
{
    public function __construct(
        protected OrderSender $sender,
        protected OrderRecipient $recipient,
        protected Packages $packages,
        protected CurrierService $service,
        protected ExtraOptions $extraOptions = new ExtraOptions(),
    ) {
    }

    public function toArray(): array
    {
        return [
            'sender' => $this->sender->toArray(),
            'recipient' => $this->recipient->toArray(),
            'packages' => $this->packages->toArray(),
            'service' => $this->service->toArray(),
            'extraOptions' => $this->extraOptions->toArray(),
        ];
    }

    public function getSender(): OrderSender
    {
        return $this->sender;
    }

    public function getRecipient(): OrderRecipient
    {
        return $this->recipient;
    }

    public function getPackages(): Packages
    {
        return $this->packages;
    }

    public function getService(): CurrierService
    {
        return $this->service;
    }

    public function getExtraOptions(): ExtraOptions
    {
        return $this->extraOptions;
    }
}
