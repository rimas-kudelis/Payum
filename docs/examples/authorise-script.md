<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

# Authorise script.

This is the script which does all the job related to payments authorization. 
It may show a credit card form, an iframe or redirect a user to gateway side. 
The action provides some basic security features. It is completely unique for each payment, and once we done the url invalidated.
When the authorization is done a user is redirected to after url, in our case it is [done script](done-script.md).

```php
<?php
//authorise.php

include __DIR__.'/config.php';

use Payum\Core\Reply\HttpResponse;
use Payum\Core\Request\Authorize;

$token = $payum->getHttpRequestVerifier()->verify($_REQUEST);
$gateway = $payum->getGateway($token->getGatewayName());

if ($reply = $gateway->execute(new Authorize($token), true)) {
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

This is how you can create a authorize url.

Back to [examples](index.md).
Back to [index](../index.md).
