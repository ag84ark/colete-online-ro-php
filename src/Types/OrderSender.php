<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

class OrderSender extends BaseType
{
    protected ?int $addressId = null;

    protected ?Address $address = null;

    protected ?Contact $contact = null;

    protected ?ValidationStrategyEnum $validationStrategy = null;

    protected function __construct(
        ?int $addressId = null,
        ?Address $address = null,
        ?Contact $contact = null,
        ?ValidationStrategyEnum $validationStrategy = null
    ) {
        $this->addressId = $addressId;
        $this->address = $address;
        $this->contact = $contact;
        $this->validationStrategy = $validationStrategy;
    }

    public static function createEmpty(): OrderSender
    {
        return new self();
    }

    public static function create(
        ?Contact $contact = null,
        ?Address $address = null,
        ?ValidationStrategyEnum $validationStrategy = null
    ): OrderSender {
        return new self(
            address: $address,
            contact: $contact,
            validationStrategy: $validationStrategy
        );
    }

    public static function forExistingSender(
        int $addressId,
    ): OrderSender {
        return new self(
            addressId: $addressId,
        );
    }

    public function toArray(): array
    {
        if ($this->addressId) {
            return [
                'addressId' => $this->addressId,
            ];
        }

        $data = [];

        if ($this->address) {
            $data['address'] = $this->address->toArray();
        }

        if ($this->contact) {
            $data['contact'] = $this->contact->toArray();
        }

        if ($this->validationStrategy) {
            $data['validationStrategy'] = $this->validationStrategy->value;
        }

        return $data;
    }

    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function getValidationStrategy(): ?ValidationStrategyEnum
    {
        return $this->validationStrategy;
    }

    public function setAddressId(int $addressId): OrderSender
    {
        $this->addressId = $addressId;

        return $this;
    }

    public function setAddress(Address $address): OrderSender
    {
        $this->address = $address;

        return $this;
    }

    public function setContact(Contact $contact): OrderSender
    {
        $this->contact = $contact;

        return $this;
    }

    public function setValidationStrategy(ValidationStrategyEnum $validationStrategy): OrderSender
    {
        $this->validationStrategy = $validationStrategy;

        return $this;
    }
}
