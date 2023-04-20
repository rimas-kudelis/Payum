<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

# Capture script.

This is the script which does all the job related to capturing payments. 
It may show a credit card form, an iframe or redirect a user to gateway side.
Each capture URL is completely unique for each purchase, and once we're done the URL is invalidated and no longer accessible.
When the capture is done a user is redirected to after URL, in our case it is [done script](done-script.md).

## Secured script.

```php
<?php
//capture.php

include __DIR__.'/config.php';

use Payum\Core\Reply\HttpResponse;
use Payum\Core\Request\Capture;

$token = $payum->getHttpRequestVerifier()->verify($_REQUEST);
$gateway = $payum->getGateway($token->getGatewayName());

if ($reply = $gateway->execute(new Capture($token), true)) {
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

if (false == isset($_REQUEST['noinvalidate'])) {
    $payum->getHttpRequestVerifier()->invalidate($token);
}

header("Location: ".$token->getAfterUrl());
```


_**Note**: If you've got the "Unsupported reply" you have to add an if condition for that reply. Inside the If statement you have to convert the reply to http response._




This is how you can create a capture url.

```php
<?php

include __DIR__.'/config.php';

$token = $payum->getTokenFactory()->createCaptureToken($gatewayName, $details, 'afterCaptureUrl');

header("Location: ".$token->getTargetUrl());
```

Back to [examples](index.md).
Back to [index](../index.md).
