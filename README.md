# ColeteOnline.ro API PHP Library
PHP library to work with colete-online.ro API using Saloon PHP Framework.

This library requires PHP 8.1 or newer.

## Installation
```bash
composer require ag84ark/colete-online-ro-php
```

## Usage
```php
use Ag84ark\ColeteOnlineRoPhp\ColeteOnline;
use Ag84ark\ColeteOnlineRoPhp\ColeteOnlineApiConnector;


$coleteOnline = new ColeteOnline(
    new ColeteOnlineApiConnector(
        clientId: "your-client-id",
        clientSecret: "your-client-secret",
        staging: false
    )
);
```
## Store authenticator for later user
It is recommended to store the authenticator object for later use to avoid re-authenticating on every request.  
The expiration time of the authenticator is 2 hour.
```php
$authenticator = $coleteOnline->authenticate();
// Or $authenticator = $coleteOnline->getAuthenticator()
// if already authenticated by using any method that requires authentication
$serializeAuth = $authenticator->serialize();
// Store $serializeAuth for later use

// Later
$coleteOnline = new ColeteOnline(
    new ColeteOnlineApiConnector(
        clientId: "your-client-id",
        clientSecret: "your-client-secret",
        staging: false
    ),
    unserialize($serializeAuth)
);

```


## Methods

### Get all available services
```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Service\ServiceItemDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Service\ServiceListResponse $services */
$services = $coleteOnline->getServicesList();
$servicesList = $services->items(); // Array
$servicesListCollection = $services->itemsCollection(); // Illuminate\Support\Collection

$servicesListCollection->each(function (ServiceItemDTO $service) {
    echo $service->name . PHP_EOL;
});
```

### Get user balance
```php
/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\User\UserBalanceResponse $userBalance */
$userBalance = $coleteOnline->getUserBalance();
echo $userBalance->balance()->amount . PHP_EOL;
echo $userBalance->balance()->bonus . PHP_EOL;
```

### Get the AWB
```php
/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
$awbDownload = $coleteOnline->getOrderAwb(123456)->saveBodyToFile('awb.pdf');
// Or
$coleteOnline->getOrderAwbAndSaveToFile(123456, 'awb.pdf');
// Or
$stream = $coleteOnline->getOrderAwbStream(123456);
```

### Get order status
```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Order\OrderStatusHistoryItemDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderStatusResponse $orderStatus */
$orderStatus = $coleteOnline->getOrderStatus(123456);

echo $orderStatus->response()->summary->uniqueId . PHP_EOL; 
echo $orderStatus->response()->summary->awb . PHP_EOL;

echo $orderStatus->response()
        ->getHistoryCollection()
        ->each(function (OrderStatusHistoryItemDTO $history) {
            echo $history->statusTextParts->ro->name . PHP_EOL;  # "Alocata pentru ridicare"
            echo $history->comment->ro . PHP_EOL;  # "Locatie: Bucuresti; "
        });
```

### Search Country
```php

use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\CountryDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCountryResponse $countries */
$countries = $coleteOnline->searchCountry('rom');


$countries->itemsCollection()->each(function (CountryDTO $country) {
    echo $country->name . PHP_EOL;
    echo $country->nameRo . PHP_EOL;
    echo $country->isoCode . PHP_EOL;
});
```

### Search Location

```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\LocationDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchLocationResponse $locations */
$locations = $coleteOnline->searchLocation('ro', 'ghi');

$locations->itemsCollection()->each(function (LocationDTO $location) {
    echo $location->city . PHP_EOL; "Ghimbav"
    echo $location->county . PHP_EOL; "Brasov"
    echo $location->countyCode . PHP_EOL; "BV"
});
```


### Search City

```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\CityDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchCityResponse $cities */

$cities = $coleteOnline->searchCity('RO', 'Ilfov', 'draga');
// Or
$cities = $coleteOnline->searchCity('ro', 'IF', 'draga', true); // use county code

$cities->itemsCollection()->each(function (CityDTO $city) {
    echo $city->localityName . PHP_EOL; "Draganesti"
    echo $city->county . PHP_EOL; "Ilfov"
    echo $city->countyCode . PHP_EOL; "IF"
});
```

### Search Street

```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\StreetDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchStreetResponse $streets */

$streets = $coleteOnline->searchStreet('RO', 'Ilfov', 'Draganesti', 'strada');
$streets = $coleteOnline->searchStreet('RO', 'Ilfov', 'Draganesti', 'strada', 300367); // use postal code
// Or
$streets = $coleteOnline->searchStreet('ro', 'IF', 'Draganesti', 'strada', null, true); // don't use postal code
$streets = $coleteOnline->searchStreet('ro', 'IF', 'Draganesti', 'strada', 300367, true); // use county code

$streets->itemsCollection()->each(function (StreetDTO $street) {
    echo $street->name . PHP_EOL; "Piața Avram Iancu"
    echo $street->highlight . PHP_EOL; "true|false|null"
});
```

### Search Postal Code

```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Search\PostalCodeDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Search\SearchPostalCodeResponse $postalCodes */

$postalCodes = $coleteOnline->searchPostalCode('RO', 'Timis', 'Timisoara', 'Piața Avram Iancu');
// Or
$postalCodes = $coleteOnline->searchPostalCode('RO', 'TM', 'Timisoara', 'Piața Avram Iancu', 1, true); // use county code


$postalCodes->itemsCollection()->each(function (PostalCodeDTO $postalCode) {
    echo $postalCode->code . PHP_EOL; "300367"
    echo $postalCode->info . PHP_EOL; "nr. 9-13; 6-T"
    echo $postalCode->street . PHP_EOL; "Piața Avram Iancu"
});
```

### Get Addresses List

```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Address\AddressItemDTO;

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Address\AddressListResponse $addresses */

$addresses = $coleteOnline->getAddressList();

$addresses->itemsCollection()->each(function (AddressItemDTO $addressItem) {
    echo $addressItem->locationId . PHP_EOL; "123456"
    echo $addressItem->shortNamename . PHP_EOL; "Home"
    echo $addressItem->address->street . PHP_EOL; "Piața Avram Iancu"
    echo $addressItem->address->number . PHP_EOL; "13"
    
    echo $addressItem->contact->name . PHP_EOL; "John Doe"
    echo $addressItem->contact->phone . PHP_EOL; "0723456789"
});
```

### Create Order

```php
use Ag84ark\ColeteOnlineRoPhp\Types\Order;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderSender;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderRecipient;
use Ag84ark\ColeteOnlineRoPhp\Types\Contact;
use Ag84ark\ColeteOnlineRoPhp\Types\Address;
use Ag84ark\ColeteOnlineRoPhp\Types\Packages;
use Ag84ark\ColeteOnlineRoPhp\Types\PackageTypeEnum;
use Ag84ark\ColeteOnlineRoPhp\Types\PackageItem;
use Ag84ark\ColeteOnlineRoPhp\Types\CurrierService;
use Ag84ark\ColeteOnlineRoPhp\Types\ServiceSelectionTypeEnum;


$orderSender = OrderSender::create(
            contact: Contact(
                name: 'John Doe',
                phone: '0740000000',
                phone2: '',
                email: 'jonh@exmaple.ro',
            ),
            address: new Address(
                countryCode: 'RO',
                postalCode: '123456',
                city: 'Bucuresti',
                county: 'Bucuresti',
                street: 'Str. Matei Basarab',
                number: '45',
            ),
        );

        $orderRecipient = OrderRecipient::create(
            contact: new Contact(
                name: 'Jane Doe',
                phone: '0742222222',
                phone2: '',
                email: 'jane@example.ro',
            ),
            address: new Address(
                countryCode: 'RO',
                postalCode: '233333',
                city: 'Ploiesti',
                county: 'Prahova',
                additionalInfo: 'Bloc 1, Scara A, Etaj 2, Apartament 3',
            ),
        );
        
        $packages = (new Packages(type: PackageTypeEnum::Box, content: 'Produse'))
                ->addPackageItem(
                    new PackageItem(
                        weight: 2000,
                        height: 10,
                        width: 15,
                        length: 20,
                    ),
                );
        
        $extraOptions = (new ExtraOptions())
            ->addInsurance(1000)
            ->addCashRepayment(1000)
            ->addDeclaredValue(1000)
            ->addOpenAtDelivery()
            ->addSaturdayDelivery()
            ->addStatusChangeNotify("https://example.com/status-change-notify");

        $request = new Order(
            sender: $orderSender,
            recipient: $orderRecipient,
            packages: $packages,
            service: new CurrierService(
                selectionType: ServiceSelectionTypeEnum::BestPrice,
            ),
            extraOptions: $extraOptions
        );

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Order\CreateOrderResponse $createOrder */
$createOrder = $coleteOnline->createOrder($request);

echo $createOrder->response()->uniqueId . PHP_EOL; "123456"
echo $createOrder->response()->awb . PHP_EOL; "ASA123456"
echo $createOrder->response()->curierService->service->id . PHP_EOL; "6"
echo $createOrder->response()->curierService->service->name . PHP_EOL; "Domestic Express"
echo $createOrder->response()->curierService->service->courierName . PHP_EOL; "TNT"
echo $createOrder->response()->curierService->price->total . PHP_EOL; "23.80"
echo $createOrder->response()->curierService->price->noVat . PHP_EOL; "20.00"
```


### Get Order Pricing

```php
use Ag84ark\ColeteOnlineRoPhp\DTOs\Order\OrderCurrierServiceDTO;

use Ag84ark\ColeteOnlineRoPhp\Types\OrderPricing;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderSender;
use Ag84ark\ColeteOnlineRoPhp\Types\OrderRecipient;
use Ag84ark\ColeteOnlineRoPhp\Types\Contact;
use Ag84ark\ColeteOnlineRoPhp\Types\Address;
use Ag84ark\ColeteOnlineRoPhp\Types\Packages;
use Ag84ark\ColeteOnlineRoPhp\Types\PackageTypeEnum;
use Ag84ark\ColeteOnlineRoPhp\Types\PackageItem;
use Ag84ark\ColeteOnlineRoPhp\Types\CurrierService;
use Ag84ark\ColeteOnlineRoPhp\Types\ServiceSelectionTypeEnum;
use Ag84ark\ColeteOnlineRoPhp\Types\ExtraOptions;


$orderSender = OrderSender::create(
            contact: Contact(
                name: 'John Doe',
                phone: '0740000000',
                phone2: '',
                email: 'jonh@exmaple.ro',
            ),
            address: new Address(
                countryCode: 'RO',
                postalCode: '123456',
                city: 'Bucuresti',
                county: 'Bucuresti',
                street: 'Str. Matei Basarab',
                number: '45',
            ),
        );

        $orderRecipient = OrderRecipient::create(
            contact: new Contact(
                name: 'Jane Doe',
                phone: '0742222222',
                phone2: '',
                email: 'jane@example.ro',
            ),
            address: new Address(
                countryCode: 'RO',
                postalCode: '233333',
                city: 'Ploiesti',
                county: 'Prahova',
                additionalInfo: 'Bloc 1, Scara A, Etaj 2, Apartament 3',
            ),
        );
        
        $extraOptions = (new ExtraOptions())
            ->addInsurance(1000)
            ->addCashRepayment(1000)
            ->addDeclaredValue(1000)
            ->addOpenAtDelivery()
            ->addSaturdayDelivery()
            ->addStatusChangeNotify("https://example.com/status-change-notify");

        $request = new OrderPricing(
            sender: $orderSender,
            recipient: $orderRecipient,
            packages: (new Packages(type: PackageTypeEnum::Box, content: 'Produse'))
                ->addPackageItem(
                    new PackageItem(
                        weight: 2000,
                        height: 10,
                        width: 15,
                        length: 20,
                    ),
                ),
            service: new CurrierService(
                selectionType: ServiceSelectionTypeEnum::BestPrice,
            ),
            extraOptions: $extraOptions
        );

/** @var \Ag84ark\ColeteOnlineRoPhp\ColeteOnline $coleteOnline */
/** @var \Ag84ark\ColeteOnlineRoPhp\Responses\Order\OrderPricingResponse $orderPricing */
$orderPricing = $coleteOnline->getOrderPricing($request);

echo $orderPricing->response()->selected->service->id . PHP_EOL; "6"
echo $orderPricing->response()->selected->service->name . PHP_EOL; "Domestic Express"
echo $orderPricing->response()->selected->service->courierName . PHP_EOL; "TNT"
echo $orderPricing->response()->selected->price->total . PHP_EOL; "23.80"
echo $orderPricing->response()->selected->price->noVat . PHP_EOL; "20.00"

$orderPricing->response()->getCurriersList()->each(function (OrderCurrierServiceDTO $currier) {
    echo $currier->service->id . PHP_EOL; "6"
    echo $currier->service->name . PHP_EOL; "Domestic Express"
    echo $currier->service->courierName . PHP_EOL; "TNT"
    echo $currier->price->total . PHP_EOL; "23.80"
    echo $currier->price->noVat . PHP_EOL; "20.00"
});
```

