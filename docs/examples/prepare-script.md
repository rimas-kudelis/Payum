<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

# Prepare script

This script builds the payment request, creates a capture token and delegates further job to the [capture.php](capture-script.md) script.
Here's an offline gateway example:

```php
<?php
// prepare.php

include __DIR__.'/config.php';

use Payum\Core\Model\Payment;

$gatewayName = 'myGateway';

/** @var \Payum\Core\Payum $payum */
$storage = $payum->getStorage($paymentClass);

/** @var Payment $payment */
$payment = $storage->create();
$payment->setNumber(uniqid());
$payment->setCurrencyCode('EUR');
$payment->setTotalAmount(123); // 1.23 EUR
$payment->setDescription('A description');
$payment->setClientId('myClientId');
$payment->setClientEmail('foo@example.com');

$payment->setDetails([
  // Put here any fields in the format expected by the gateway.
  // For example if you use PayPal Express Checkout you can define a description of the first item:
  // 'L_PAYMENTREQUEST_0_DESC0' => 'A desc',
]);

$storage->update($payment);

$tokenFactory = $payum->getTokenFactory();
$captureToken = $tokenFactory->createCaptureToken($gatewayName, $payment, 'done.php');

header("Location: " . $captureToken->getTargetUrl());
```

_**Note**: There are similar examples of the `prepare.php` file for other [supported gateways](supported-gateways.md)._

Back to [examples](index.md).
Back to [index](../index.md).
