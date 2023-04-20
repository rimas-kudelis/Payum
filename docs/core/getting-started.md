<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

# Getting started

Here we describe basic steps required by all supported gateways.
We are going to set up models, storages, a security layer and so on.
All of these will be used later.

_**Note**: If you are working with one of the supported frameworks, for which integration packages exist, check out the relevant bundle's documentation instead._

## Installation

The preferred way to install the library is using [composer](http://getcomposer.org/).
Run `composer require` to add dependencies to _composer.json_:

```bash
php composer.phar require payum/offline php-http/guzzle7-adapter
```

Both package names here are examples.
The first one, `payum/offline` is a Payum extension for offline payments.
You can for example change it to `payum/paypal-express-checkout-nvp` or `payum/stripe`.
Look at the list of [supported gateways](supported-gateways.md) to find out what you can use (please note that this list might be incomplete).

Meanwhile, `php-http/guzzle7-adapter` is an implementation of an [HTTPlug](http://httplug.io/) adapter.
You can use any of [these adapters](https://packagist.org/providers/php-http/client-implementation), or even write your own instead.

_**Note**: You can also require `payum/payum` if you want to install all official gateways at once (not recommended)._

## Usage

Before we configure Payum, let's look at the example flow diagram below.
This flow is similar for most gateways, so once you are familiar with it, any other gateways could be added easily.

![How Payum works](http://www.websequencediagrams.com/cgi-bin/cdraw?lz=cGFydGljaXBhbnQgcGF5cGFsLmNvbQoACwxVc2VyAAQNcHJlcGFyZS5waHAAHA1jYXB0dQAFE2RvbgAnBgpVc2VyLT4ANQs6AEUIIGEgcGF5bWVudAoAVAstLT4rAEsLOgBbCCB0b2tlbgoKAGcLLS0-AIE2CjogcmVxdWVzdCBhdXRoZW50aWNhdGlvbgoAgVkKLS0-AE0NZ2l2ZSBjb250cm9sIGJhY2sATg8tAIE-CDoAgUsFAHsHAIFTCC0-VXNlcjogc2hvdwCBQQggcmVzdWx0Cg&s=default)

As you can see we have to create some php files: `config.php`, `prepare.php`, `capture.php` and `done.php`.

In addition to these files, you'll often want to create a `notify.php` script and use it to accept and process callback notifications from your payment gateway. 

At the end of this process you will have the complete solution,
and it will be [much easier to add](paypal/express-checkout/getting-started.md) other gateways.

Let's start with `config.php`:

### config.php

Here we can put our gateways and storages. Also, we can configure security components.
The `config.php` file has to be included by all the remaining files.

```php
<?php
//config.php

use Payum\Core\Model\Payment;
use Payum\Core\Payum;
use Payum\Core\PayumBuilder;

// Base URI can be set to `null` to auto-discover it
// If you have trouble generating the right token URLs
// then set the base URI to your needs 
$tokenBaseUri = 'https://127.0.0.1:8080/';
$paymentClass = Payment::class;

/** @var Payum $payum */
$payum = (new PayumBuilder())
    // Add default storages for Payment Tokens, Payments, Payouts etc. 
    // Default is FilesystemStorage, which stores to `sys_get_temp_dir()`.
    ->addDefaultStorages()
    // Set the token factory to create all tokens needed during the payment flow,
    // such as capture, after pay or even notify tokens.
    // This whole call is unnecessary if you don't want to specify $tokenBaseUri explicitly.
    ->setTokenFactory(function($tokenStorage, $storageRegistry) use ($tokenBaseUri) {
        return new TokenFactory($tokenStorage, $storageRegistry, $tokenBaseUri);
    })
    // Register your gateway
    ->addGateway('myGateway', [
        'factory' => 'offline',
    ])
    ->getPayum()
;
```

There are several [storages](storages.md) available.
Consider using something other than the default `FilesystemStorage` in production.

### prepare.php

Let's assume that you already all order information at hand.
The Prepare script create a capture token and delegate the job to the [capture.php](examples/capture-script.md) script.

An example of a script which does this in provided the [dedicated chapter](examples/prepare-script.md).

### capture.php

Once the payment is prepared, the user is redirected to `capture.php`, which initiates the "capture payment" process.

More info and an example of the capture script is provided in the [dedicated chapter](examples/capture-script.md).

### done.php

After the capture script has done its job you will be redirected to [done.php](examples/done-script.md).
The [capture.php](examples/capture-script.md) script always redirects you to `done.php` no matter if the payment was successful or not.
In `done.php` we check payment status, update the model, dispatch events and so on.

To find out more about the done script, check out the [dedicated chapter](examples/done-script.md) about it.

### notify.php

If your payment gateway uses web callbacks (a.k.a webhooks) to notify you about payment status changes, you'll want to create a notify.php script as well. You can read about it in the [dedicated chapter](examples/notify-script.md) 

Back to [index](index.md).
