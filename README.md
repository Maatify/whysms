# Installation

```shell
composer require maatify/whysms
```

# Usage

### Instance
```php
use Maatify\WhySms\WhySms;

require_once __DIR__ . '/vendor/autoload.php';

$why_sms = new WhySms(__API_TOKEN__, __SENDER_ID__); // WhySms instance
```

### Check Balance
```PHP

$result = $why_sms->->CheckBalance();

print_r($result);
```

### Send SMS Message
```PHP

$result = $why_sms->->SendSms(__PHONE_NUMBER__, __SMS_MESSAGE__);

print_r($result);
```