<?php

namespace Ag84ark\ColeteOnlineRoPhp;

use Ag84ark\ColeteOnlineRoPhp\Requests\Order\CreateOrderRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Order\GetOrderAwbRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Order\OrderPricingRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Order\OrderStatusRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchCityRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchCountryRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchLocationRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchPostalCodeRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\Search\SearchStreetRequest;
use Ag84ark\ColeteOnlineRoPhp\Requests\User\UserBalanceRequest;
use Ag84ark\ColeteOnlineRoPhp\Responses\Order\CreateOrderResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderPricingResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderStatusResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCityResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCountryResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchLocationResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchPostalCodeResponse;
use Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchStreetResponse;
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

    public function __construct(
        protected ColeteOnlineApiConnector $connector,
        protected ?string $accessToken,
    ) {

    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function getAccessTokenExpiresAt(): ?DateTimeImmutable
    {
        return $this->accessTokenExpiresAt;
    }

    /**
     * Use this method to authenticate the client with the API and get the access token.
     */
    public function authenticate(): ?string
    {
        if ($this->accessToken) {
            $this->connector->authenticate(new AccessTokenAuthenticator($this->accessToken));
        } else {
            $authenticator = $this->connector->getAccessToken();
            $this->connector->authenticate($authenticator);
            $this->accessToken = $authenticator->getAccessToken();
            $this->accessTokenExpiresAt = $authenticator->getExpiresAt();
        }

        return $this->accessToken;
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
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
     */
    public function getOrderAwb(GetOrderAwbRequest $request)
    {
        return $this->send($request)->stream();
    }

    /**
     * @return StreamInterface
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getOrderAwbById(string $id)
    {
        return $this->getOrderAwb(new GetOrderAwbRequest(uniqueId: $id));
    }

    /**
     * @return CreateOrderResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function createOrder(CreateOrderRequest $createOrderRequest)
    {
        return $this->send($createOrderRequest);
    }

    /**
     * @return OrderPricingResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getOrderPricing(OrderPricingRequest $orderPricingRequest)
    {
        return $this->send($orderPricingRequest);
    }

    /**
     * @return OrderStatusResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getOrderStatus(OrderStatusRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return OrderStatusResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getOrderStatusById(string $uniqueId)
    {
        return $this->getOrderStatus(new OrderStatusRequest($uniqueId));
    }

    /**
     * @return SearchCountryResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function searchCountry(SearchCountryRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchLocationResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function searchLocation(SearchLocationRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchCityResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function searchCity(SearchCityRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchStreetResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function searchStreet(SearchStreetRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return SearchPostalCodeResponse|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function searchPostaCode(SearchPostalCodeRequest $request)
    {
        return $this->send($request);
    }

    /**
     * @return UserBalanceRequest|Response
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getUserBalance(UserbalanceRequest $request)
    {
        return $this->send($request);
    }
}
