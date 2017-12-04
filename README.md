Segpay payment package
==============================================================

Installation
---
You can install the package via composer:

```bash
composer require stojankukrika/segpay-payment
```

If you are using Laravel in a version < 5.5, the service provider must be registered as a next step:

```php
// config/app.php
'providers' => [
    ...
   stojankukrika\SegpayPayment\SegpayPaymentServiceProvider
];
```

After that run migration to make payment table to log payments

```bash
$ php artisan migrate
```

#### Configuration

Add in your .env file variables:
```
- SEGPAY_PACKAGE
- SEGPAY_USER_ID
- SEGPAY_USER_ACCESS_KEY
- SEGPAY_URL_ID
```
set it values from mp.segpay.com and publish this provider using:
```bash
$ php artisan vendor:publish --provider=stojankukrika\SegpayPayment\SegpayPaymentServiceProvider
```

#### Important note
- Before testing Payment API do not forget to to your account need to be approved from segpay
- Test valid card '4444333322221111' with any expiration date and ccv
- Test declined card '4444444444445555' with any expiration date and ccv

###Usage
Firstable you initialize SegpayPayment class then call some method, like this:
```
$segpay = new SegpayPayment();
$response = $segpay->generateSignupPaymentPage($param1, $param2....);
```  
you need to redirect user to response page, and when customer pay, you will get payment notification (segpay send it to your payment page - define it in responses in Merchant panel).

Here is list fo methods:
[Segpay apiFunctionList](APIFunctionList.md).


Changelog
---
- 1.0 - initial version


License
---
The MIT License (MIT). Please see [License File](LICENSE) for more information.