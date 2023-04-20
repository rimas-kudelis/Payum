<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

## Installation

The preferred way to install the library is using [composer](http://getcomposer.org/).
Run `composer require` to add dependencies to _composer.json_:

```bash
php composer.phar require payum/offline php-http/guzzle7-adapter
```

Both package names here are examples.
The first one, `payum/offline` is a Payum gateway for offline payments.
You can for example change it to `payum/paypal-express-checkout-nvp` or `payum/stripe`.
Look at the list of [supported gateways](supported-gateways.md) to find out what you can use (please note that this list might be incomplete).

Meanwhile, `php-http/guzzle7-adapter` is an implementation of an [HTTPlug](http://httplug.io/) adapter.
You can use any of [these adapters](https://packagist.org/providers/php-http/client-implementation), or even write your own instead.

_**Note**: You can also require `payum/payum` if you want to install all official gateways at once (not recommended)._

_**Note**: If you are working with one of the supported frameworks, for which integration packages exist, we suggest installing that integration package instead. It should require `payum/core` (as well as any other depencencies) automatically._
