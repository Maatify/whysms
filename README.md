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



#
### Check Balance
```PHP

$result = $why_sms->->CheckBalance();

print_r($result);
```
#### Response Example :
##### Success Example
>       Array
>       (
>           [success] => 1
>           [remaining_unit] => 7
>           [expired_on] => 1st Jun 33, 7:16 PM
>       )

##### Error Example
>
>       Array
>       (
>           [success] =>
>           [error] => (err-Maatify\WhySms\Request::Curl) cURL Error (22): The requested URL returned error: 401 Unauthorized
>       )

#

### Send SMS Message
```PHP

$result = $why_sms->SendSms(__PHONE_NUMBER__, __SMS_MESSAGE__);

print_r($result);
```
#### Response Example :
##### Success Example
>       Array
>       (
>           [success] => 1
>           [details] => Your message was successfully delivered
>           [uid] => 64c7392312ecb
>           [to] => __PHONE_NUMBER__
>           [from] => __SMS_MESSAGE__
>           [message] => Welcome to first test from why sms
>           [status] => Delivered
>           [cost] => 1
>       )

##### Error Example
>
>       Array
>       (
>           [success] =>
>           [error] => (err-Maatify\WhySms\Request::Curl) cURL Error (22): The requested URL returned error: 404 Not Found
>       )








