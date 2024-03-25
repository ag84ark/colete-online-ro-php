<?php

namespace Ag84ark\ColeteOnlineRoPhp;

use Ag84ark\ColeteOnlineRoPhp\Requests\Address\AddressListRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Order\CreateOrderRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Order\GetOrderAwbRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Order\OrderPricingRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Order\OrderStatusRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchCityRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchCountryRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchLocationRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchPostalCodeRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchStreetRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Service\ServiceListRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\User\UserBalanceRequest;
use Ag84ark\ColeteOnlineRoPhp\Responses\Address\AddressListResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Order\CreateOrderResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderPricingResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderStatusResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCityResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCountryResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchLocationResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchPostalCodeResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchStreetResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Service\ServiceListResponse;
use Ag84ark\ColeteOnlineRoPhp\Types\Order;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderPricing;
use DateTimeImmutable;
use Psr\Http\Message\StreamInterface;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Auth\AccessTokenAuthenticator;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ColeteOnline
{
    protected ?DateTimeImmutable $accessTokenExpiresAt = null;

    protected ?string $accessToken = null;

    /**
     * The $authenticator can be used if it was stored and can be used to authenticate the client with the API.
     */
    public function __construct(
        protected ColeteOnlineApiConnector $connector,
        protected ?AccessTokenAuthenticator $authenticator = null,
    ) {

    }

    /**
     * Use this method to authenticate the client with the API and get the AccessTokenAuthenticator that can
     * be serialized and stored for later use.
     */
    public function authenticate(): AccessTokenAuthenticator
    {

        if ($this->authenticator !== null && $this->authenticator->hasNotExpired()) {
            $this->connector->authenticate($this->authenticator);
            $this->accessToken = $this->authenticator->getAccessToken();
            $this->accessTokenExpiresAt = $this->authenticator->getExpiresAt();

            return $this->authenticator;
        }

        $this->authenticator = $this->connector->getAccessToken();
        $this->connector->authenticate($this->authenticator);
        $this->accessToken = $this->authenticator->getAccessToken();
        $this->accessTokenExpiresAt = $this->authenticator->getExpiresAt();

        return $this->authenticator;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function getAccessTokenExpiresAt(): ?DateTimeImmutable
    {
        return $this->accessTokenExpiresAt;
    }

    public function getAuthenticator(): ?AccessTokenAuthenticator
    {
        return $this->authenticator;
    }

    /**
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    protected function send(Request $request)
    {
        $this->authenticate();

        return $this->connector->send($request);
    }

    /**
     * @return StreamInterface
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderAwbStream(string $id)
    {
        return $this->getOrderAwb($id)->stream();
    }

    /**
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderAwb(string $id)
    {
        return $this->getOrderAwbFromRequest(new GetOrderAwbRequest(uniqueId: $id));
    }

    /**
     * @return null
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderAwbAndSaveToFile(string $id, mixed $resourceOrPath)
    {
        $this->getOrderAwb($id)->saveBodyToFile($resourceOrPath);

        return null;
    }

    /**
     * @return Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderAwbFromRequest(GetOrderAwbRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return CreateOrderResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function createOrder(Order $order)
    {
        $request = new CreateOrderRequest(
            sender: $order->getSender(),
            recipient: $order->getRecipient(),
            packages: $order->getPackages(),
            service: $order->getService(),
            extraOptions: $order->getExtraOptions(),
        );

        return $this->createOrderFromRequest($request);
    }

    /**
     * @return CreateOrderResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function createOrderFromRequest(CreateOrderRequest $createOrderRequest)
    {
        return $this->send($createOrderRequest);
    }

    /**
     * @return OrderPricingResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderPricing(OrderPricing $orderPricing)
    {
        $request = new OrderPricingRequest(
            sender: $orderPricing->getSender(),
            recipient: $orderPricing->getRecipient(),
            packages: $orderPricing->getPackages(),
            service: $orderPricing->getService(),
            extraOptions: $orderPricing->getExtraOptions(),
        );

        return $this->getOrderPricingFromRequest($request);
    }

    /**
     * @return OrderPricingResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderPricingFromRequest(OrderPricingRequest $orderPricingRequest)
    {
        return $this->send($orderPricingRequest);
    }

    /**
     * @return OrderStatusResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderStatus(string $id)
    {
        return $this->getOrderStatusFromRequest(new OrderStatusRequest($id));
    }

    /**
     * @return OrderStatusResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getOrderStatusFromRequest(OrderStatusRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchCountryResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchCountry(string $country)
    {
        return $this->searchCountryFromRequest(new SearchCountryRequest($country));
    }

    /**
     * @return SearchCountryResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchCountryFromRequest(SearchCountryRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchLocationResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchLocation(string $countryCode, string $needle, ?int $page = null, ?int $limit = 20)
    {
        $request = new SearchLocationRequest(
            countryCode: $countryCode,
            needle: $needle,
            page: $page,
            limit: $limit,
        );

        return $this->searchLocationFromRequest($request);
    }

    /**
     * @return SearchLocationResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchLocationFromRequest(SearchLocationRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchCityResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchCity(string $countryCode, string $county, string $needle, ?bool $isCountyCode = null, ?int $page = null, ?int $limit = 20)
    {
        $request = new SearchCityRequest(
            countryCode: $countryCode,
            county: $county,
            needle: $needle,
            isCountyCode: $isCountyCode,
            page: $page,
            limit: $limit,
        );

        return $this->searchCityFromRequest($request);
    }

    /**
     * @return SearchCityResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchCityFromRequest(SearchCityRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchStreetResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchStreet(
        string $countryCode,
        string $city,
        string $county,
        string $needle,
        ?string $postalCode = null,
        ?bool $isCountyCode = null,
        ?int $page = null,
        ?int $limit = 20,
    ) {
        $request = new SearchStreetRequest(
            countryCode: $countryCode,
            city: $city,
            county: $county,
            needle: $needle,
            postalCode: $postalCode,
            isCountyCode: $isCountyCode,
            page: $page,
            limit: $limit
        );

        return $this->searchStreetFromRequest($request);
    }

    /**
     * @return SearchStreetResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchStreetFromRequest(SearchStreetRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchPostalCodeResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchPostalCode(
        string $countryCode,
        string $county,
        string $city,
        string $street,
        int $validateStreet = 1,
        ?bool $isCountyCode = null,
        ?int $limit = 20,
    ) {
        $request = new SearchPostalCodeRequest(
            countryCode: $countryCode,
            county: $county,
            city: $city,
            street: $street,
            validateStreet: $validateStreet,
            isCountyCode: $isCountyCode,
            limit: $limit
        );

        return $this->searchPostalCodeFromRequest($request);
    }

    /**
     * @return SearchPostalCodeResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function searchPostalCodeFromRequest(SearchPostalCodeRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return UserBalanceRequest|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getUserBalance()
    {
        return $this->send(new UserbalanceRequest);
    }

    /**
     * @return ServiceListResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getServicesList()
    {
        return $this->send(new ServiceListRequest());
    }

    /**
     * @return AddressListResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getAddressList()
    {
        return $this->send(new AddressListRequest());
    }
}
