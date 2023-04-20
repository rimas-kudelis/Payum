<h2 align="center">Supporting Payum</h2>

Payum is an MIT-licensed open source project with its ongoing development made possible entirely by the support of community and our customers. If you'd like to join them, please consider:

- [Become a sponsor](https://www.patreon.com/makasim)
- [Become our client](http://forma-pro.com/)

---

# Storing gateway configuration

In real-life scenarios, you will likely have to store gateway configuration (such as credentials) in a database or similar persistence layer, exposing it for your app administrators to view and edit.
Payum provides interfaces for such configuration objects and their storage mechanisms, as well as some implementations. These are:

- `Payum\Core\Storage\StorageInterface`: for storage classes
- `Payum\Core\Model\GatewayConfigInterface`: for gateway configuration object classes

Below is an example implementation of such scenario. It uses DoctrineStorage, but you can use a different storage class instead.




## Configure

First we have to create an entity where we store information about a gateway. 
The model must implement `Payum\Core\Model\GatewayConfigInterface`.

_**Note**: In this chapter we use DoctrineStorage._

```php
<?php
namespace Acme\Payment\Entity;

use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Model\GatewayConfig as BaseGatewayConfig;

/**
 * @ORM\Table
 * @ORM\Entity
 */
#[ORM\Entity]
#[ORM\Table]
class GatewayConfig extends BaseGatewayConfig
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer $id
     */
    protected $id;
}
```

Now, we have to create a storage for it and build payum with gateway config storage.

```php
<?php
//config.php

use Payum\Core\Bridge\Doctrine\Storage\DoctrineStorage;
use Payum\Core\PayumBuilder;
use Payum\Core\Payum;
use Payum\Core\Registry\DynamicRegistry;

// $objectManager is an instance of doctrine object manager.

$gatewayConfigStorage = new DoctrineStorage($objectManager, 'Acme\Payment\Entity\GatewayConfig');

/** @var Payum $payum */
$payum = (new PayumBuilder())
    ->addDefaultStorages()
    ->setGatewayConfigStorage($gatewayConfigStorage)

    ->getPayum()
;
```

## Store gateway config

```php
<?php
//create_config.php

include __DIR__.'/config.php';

/** @var \Payum\Core\Storage\StorageInterface $gatewayConfigStorage */

$gatewayConfig = $gatewayConfigStorage->create();
$gatewayConfig->setGatewayName('paypal');
$gatewayConfig->setFactoryName('paypal_express_checkout_nvp');
$gatewayConfig->setConfig(array(
    'username' => 'EDIT ME',
    'password' => 'EDIT ME',
    'signature' => 'EDIT ME',
    'sandbox' => true,
));

$gatewayConfigStorage->update($gatewayConfig);
```

## Use gateway

```php
<?php
// prepare.php

include __DIR__.'/config.php';

/** @var \Payum\Core\Payum $payum */
$gateway = $payum->getGateway('paypal');
```

Back to [index](../index.md).

 
 

