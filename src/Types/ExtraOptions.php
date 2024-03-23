<?php

namespace Ag84ark\ColeteOnlineRoPhp\Types;

use DateTime;

class ExtraOptions extends BaseType
{
    protected array $extraOptions = [];

    /**
     * If this extra option is used, a post request will be made for every order status change to the provided url.
     *
     * An additional key value can be used, and every request to the url will contain this key for extra security.
     */
    public function addStatusChangeNotify(string $url, ?string $secretKey = null): self
    {
        $this->extraOptions[] = [
            'id' => 1,
            'url' => $url,
            'secretKey' => $secretKey,
        ];

        return $this;
    }

    /**
     * If this extra option is used, only services which provide the open at delivery options will be used. If a
     * service from the selection services ids list does not provide this option, it will be skipped.
     */
    public function addOpenAtDelivery(): self
    {
        $this->extraOptions[] = [
            'id' => 2,
        ];

        return $this;
    }

    /**
     * If this extra option is used, if the selected service has saturday delivery, it will be used.
     *
     * This option has an optional parameter, isMandatory which indicates that only services that have the saturday
     * delivery option available should be used, however it is not guaranteed that the delivery will be made on a
     * saturday, only that the services which do not provide the option will be skipped.
     */
    public function addSaturdayDelivery(?bool $isMandatory = false): self
    {
        $this->extraOptions[] = [
            'id' => 3,
            'isMandatory' => $isMandatory,
        ];

        return $this;
    }

    /**
     * If this extra option is used, the delivery will be insured for the provided amount.
     */
    public function addInsurance(float $amount): self
    {
        $this->extraOptions[] = [
            'id' => 4,
            'amount' => $amount,
        ];

        return $this;

    }

    /**
     * If this extra option is used, the delivery will have the cash on delivery extra option that indicates that the
     * amount value should be requested on delivery and it should be transferred to the provided accountHolderName and
     * bankAccount.
     */
    public function addAccountRepayment(float $amount, ?string $accountHolderName = null, ?string $bankAccount = null): self
    {
        $this->extraOptions[] = array_filter([
            'id' => 5,
            'amount' => $amount,
            'accountHolderName' => $accountHolderName,
            'bankAccount' => $bankAccount,
        ]);

        return $this;
    }

    /**
     * If this extra option is used, the delivery will have the cash on delivery extra option that indicates that the
     * amount value should be requested on delivery, and it should be delivered back to the sender in an envelope.
     */
    public function addCashRepayment(float $amount): self
    {
        $this->extraOptions[] = [
            'id' => 6,
            'amount' => $amount,
        ];

        return $this;
    }

    /**
     * This option is mandatory for international transports that do not have insurance or account repayment.
     * If insurance, account repayment or cash repayment is provided, this option is forbidden.
     */
    public function addDeclaredValue(float $amount): self
    {
        $this->extraOptions[] = [
            'id' => 7,
            'amount' => $amount,
        ];

        return $this;
    }

    /**
     * This option can be used to indicate the day and the interval of the pick-up. The given interval is sent to the
     * courier, but it is not guaranteed that it will be followed.
     *
     * The format of the date is YYYY-MM-DD and the format for the time is HH:mm.
     *
     * The date can be maximum 4 days from the nearest available date. Nearest available date is calculated by
     * searching the closest day of the week (monday-friday) that is not a public holiday.
     */
    public function addScheduledPickUp(?DateTime $date = null, ?DateTime $fromTime = null, ?DateTime $toTime = null): self
    {
        $this->extraOptions[] = array_filter([
            'id' => 8,
            'date' => $date?->format('Y-m-d'),
            'fromTime' => $fromTime?->format('H:i'),
            'toTime' => $toTime?->format('H:i'),
        ]);

        return $this;
    }

    /**
     * This option can be used to add a custom client reference to the order
     *
     * The reference can be any string with maximum 50 characters
     */
    public function addClientReference(string $clientReference): self
    {
        if (strlen($clientReference) > 50) {
            throw new \InvalidArgumentException('The reference must be at most 50 characters long.');
        }

        $this->extraOptions[] = [
            'id' => 9,
            'clientReference' => $clientReference,
        ];

        return $this;
    }

    /**
     * This option can be used to convert the repayment/insurance and/or price in a different currency.
     *
     * This is only for displaying the data, in the end the values will be converted to RON.
     */
    public function addBaseCurrency(string $baseCurrency, string $priceCurrency): self
    {
        if (strlen($baseCurrency) !== 3 || strlen($priceCurrency) !== 3) {
            throw new \InvalidArgumentException('The currency codes must be 3 characters long.');
        }

        $this->extraOptions[] = [
            'id' => 10,
            'baseCurrency' => $baseCurrency,
            'priceCurrency' => $priceCurrency,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return $this->extraOptions;
    }
}
