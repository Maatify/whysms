[![Current version](https://img.shields.io/packagist/v/maatify/whysms)][pkg]
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/maatify/whysms)][pkg]
[![Monthly Downloads](https://img.shields.io/packagist/dm/maatify/whysms)][pkg-stats]
[![Total Downloads](https://img.shields.io/packagist/dt/maatify/whysms)][pkg-stats]
[![Stars](https://img.shields.io/packagist/stars/maatify/whysms)](https://github.com/maatify/whysms/stargazers)

[pkg]: <https://packagist.org/packages/maatify/whysms>
[pkg-stats]: <https://packagist.org/packages/maatify/whysms/stats>
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