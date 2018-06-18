# victoropsnotifier
PHP module to send notification messages to VictorOps via the REST integration.


## Installing

Via [Composer][1]

```
composer require signiant/victoropsnotifier
composer update
```

## Usage

### Example of basic usage with suplied classes

```
<?php
require_once 'vendor/autoload.php';

use Signiant\VictorOps\Notifier;
use Signiant\VictorOps\Messages\CustomMessage;

// Only the message level is mandatory
$voMsg = new Signiant\VictorOps\Messages\CustomMessage('INFO');

$voConfig = ['endpoint_url' => 'YOUR_VO_REST_ENDPOINT', 'routing_key' => 'YOUR_VO_ROUTING_KEY'];
$voEndpoint = new Signiant\VictorOps\Notifier($voConfig);
$voEndpoint->send(voMsg);
```

### Customise the message

The supplied CustomMessage class details the optional parameters that can be sent as part of the request. These
parameters allow you to customise the message.

1. Entity ID
2. Entity Display Name
3. State Message
4. ACK Message
5. ACK Author
6. Entity Is Host Setting

```
<?php

use Signiant\VictorOps\Messages\CustomMessage;

$voMsg = new CustomMessage('INFO');

$voMsg->stateMessage('Hello VictorOps');

$voMsg->entityId('system123');

$voMsg->entityDisplayName('HAL 9000');


```

[1]: https://getcomposer.org/
