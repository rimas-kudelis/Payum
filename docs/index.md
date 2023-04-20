<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

# Introduction

Payum is a payment processing library for PHP. It provides a simple and flexible way to integrate various payment gateways into your application. By hiding the specifics of various payment gateways, methods and protocols and providing unified interfaces, it allows you to easily switch between them or add new ones without modifying your application's code.

The basic flow of a payment in Payum is as follows:

1. A customer initiates a payment.
2. Your application creates a Payment object and populates it with the necessary information, such as the amount and the customer's information.
3. Your application sends the Payment object to Payum for processing, along with information about the desired payment gateway and any additional options or parameters.
4. Payum (with the help of a gateway-specific API adapters) communicates with the payment gateway to perform the transaction and returns the result to your application.
5. Your application can then check the status of the payment and take appropriate action, such as updating the customer's order or displaying an error message.

Payum provides several ready-made integrations with different payment gateways, as well as packages which aid in using it with different PHP frameworks, thus this documentation is split into several topic-oriented chapters.

## Getting started

* [Installation](core/installation.md)
  * [Getting started](core/getting-started.md)
  * [Architecture](core/the-architecture.md)
  * [Storages](core/storages.md)
* [Configuration](core/configuration.md)
* [Creating a payment](core/payment-creation.md)
* [Capturing a payment](core/payment-capture.md)
* [Getting payment status](core/payment-status.md)
* [Instant payment notification](core/instant-payment-notification.md)

## Building your own gateway

* [Develop gateway with payum](develop/develop-gateway-with-payum.md)
* [Capture](develop/capture.md)
* [Authorize](develop/authorize.md)
* [Convert](develop/convert.md)
* [Get status](develop/get-status.md)
* [Notify](develop/notify.md)
* [Sync](develop/sync.md)
* [Refund](develop/refund.md)
* [Cancel](develop/cancel.md)
* [Payout](develop/payout.md)
* [Obtain credit-card](develop/obtain-credit-card.md)
* [Get currency](develop/get-currency.md)
* [Get current HTTP request](develop/get-http-request.md)
* [Payum Token](develop/token.md)
* [Payum Reply](develop/reply.md)

## Advanced topics

### Security with Payum

* [Encrypting gateway configs stored in database](core/encrypting-gateway-configs-stored-in-database.md)
* [Masking credit card number](core/masking-credit-card-number.md)
* [Working with sensitive information](core/working-with-sensitive-information.md)

### Internals

* [Logger](core/logger.md)
* [Debugging](core/debugging.md)
* [ISO4217. Currency details](core/iso4217-or-currency-details.md)
* [Common issues](core/common-issues.md)

## Used with Payum

* [Supported gateways](core/supported-gateways.md)
* [Frameworks and e-commerce integration](core/frameworks-and-e-commerce-integration.md)
* [Payum vs Omnipay](core/payum-vs-omnipay.md)
* [How to contribute from sub repository](core/how-to-contribute-from-subrepository.md)

## Payment gateway integrations

* [Offline payments](offline/getting-started.md)
* [Authorize.net AIM](authorize-net/aim/getting-started.md)
* [Be2Bill Direct](be2bill/direct.md)
* [Be2Bill Offsite](be2bill/offsite.md)
* [Klarna Checkout](klarna/checkout/getting-started.md)
* [Klarna Invoice](klarna/invoice/getting-started.md)
* [Payex](payex/getting-started.md)
* [PayPal Express Checkout](paypal/express-checkout/getting-started.md)
  * [Authorize order](paypal/express-checkout/authorize-order.md)
  * [Confirm order step](paypal/express-checkout/confirm-order-step.md)
  * [Recurring payments basics](paypal/express-checkout/recurring-payments-basics.md)
  * [Cancel recurring payment](paypal/express-checkout/cancel-recurring-payment.md)
  * [Authorize token custom query parameters](paypal/express-checkout/authorize-token-custom-query-parameters.md)
* [PayPal Pro Checkout](paypal/pro-checkout/getting-started.md)
* [PayPal Pro Hosted](paypal/pro-hosted/getting-started.md)
* [PayPal Masspay](paypal/masspay/getting-started.md)
* [PayPal Rest](paypal/rest/getting-started.md)
  * [Credit card purchase](paypal/rest/credit-card-purchase.md)
* [PayPal IPN](paypal/ipn/getting-started.md)
* [Sofort](sofort/getting-started.md)
  * [Disable notifications](sofort/disable-notifications.md)
* [Stripe.js](stripe/js.md)
  * [Checkout](stripe/checkout.md)
  * [Direct](stripe/direct.md)
  * [Raw capture](stripe/raw-capture.md)
  * [Store Card and use later](stripe/store-card-and-use-later.md)
  * [Subscription billing](stripe/subscription-billing.md)

## PHP framework integrations

### Symfony. Payum Bundle
* [Getting started. Capture](symfony/getting-started.md)
* [Authorize](symfony/authorize.md)
* [Refund](symfony/refund.md)
* [Storages](symfony/storages.md)
* [Done action](symfony/purchase-done-action.md)
* [Configure payment in backend](symfony/configure-payment-in-backend.md)
* [Encrypt gateway configs stored in database](symfony/encrypt-gateway-configs-stored-in-database.md)
* [Custom action usage](symfony/custom-action-usage.md)
* [Custom api usage](symfony/custom-api-usage.md)
* [Custom purchase examples](symfony/custom-purchase-examples.md)
* [Sandbox](symfony/sandbox.md)
* [Console commands](symfony/console-commands.md)
* [Debugging](symfony/debugging.md)
* [The event dispatcher extension](symfony/event-dispatcher.md)
* [Configuration reference](symfony/configuration-reference.md)
* [Container tags](symfony/container-tags.md)
* [ISO4217. Currency details](symfony/iso4217-or-currency-details.md)

### Laravel. Payum Package
* [Getting started](laravel/getting-started.md)
* [Examples](laravel/examples.md)
* [Eloquent storage](laravel/eloquent-storage.md)
* [Payment done controller](laravel/payment-done-controller.md)
* [Store gateway config in database](laravel/store-gateway-config-in-database.md)
* [Blade templates](laravel/blade-templating.md)

### Symfony. JMS Payment Bridge
* [Getting started. Capture](jms-payment-bridge/getting-started.md)

### [Zend. Payum Module (External)](https://github.com/Payum/PayumModule)

### [Yii. Payum Extension (External)](https://github.com/Payum/PayumYiiExtension)

### [Omnipay Bridge (External)](https://github.com/Payum/OmnipayBridge)

### [Payum Server (External)](https://github.com/Payum/PayumServer)
