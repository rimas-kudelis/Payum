<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

# Notify scripts.

## Notify safe

You can use this script if a gateway allows setting notification url per payment, like PayPal.

```php
<?php
//notify.php

include __DIR__.'/config.php';

use Payum\Core\Reply\HttpResponse;
use Payum\Core\Request\Notify;

$token = $payum->getHttpRequestVerifier()->verify($_REQUEST);
$gateway = $payum->getGateway($token->getGatewayName());

if ($reply = $gateway->execute(new Notify($token), true)) {
    if ($reply instanceof HttpResponse) {
        foreach ($reply->getHeaders() as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }
        
        http_response_code($reply->getStatusCode());
        
        echo $reply->getContent();
        
        die();
    }

    throw new LogicException('Unsupported reply', null, $reply);
}

http_response_code(204);
echo '';
```

## Notify unsafe

You have to use this script if a gateway does not allow setting notification url per payment, like Be2Bill.

```php
<?php
//notify-unsafe.php

include __DIR__.'/config.php';

use Payum\Core\Reply\HttpResponse;
use Payum\Core\Request\Notify;

$gateway = $this->getPayum()->getGateway($_REQUEST['gateway']);

if ($reply = $gateway->execute(new Notify(null), true)) {
    if ($reply instanceof HttpResponse) {
        foreach ($reply->getHeaders() as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }
        
        http_response_code($reply->getStatusCode());
        
        echo $reply->getContent();
        
        die();
    }

    throw new LogicException('Unsupported reply', null, $reply);
}

http_response_code(204);
echo '';
```

Back to [examples](index.md).
Back to [index](../index.md).


