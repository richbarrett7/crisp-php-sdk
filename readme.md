# PHP SDK for Crisp.im

## Overview
This was created as a lightweight PHP SDK for Crisp.im.

It does not contain methods foe every API call but is very easy to extend by adding methods to `crispsdk.php` it uses Httpful to make requests to the API and returns an array with quick access to key data and the raw `Httpful\Response` object so you can handle the result however you like.

## Usage

1. First obtain your identifier and key using:

`curl -H "Content-Type: application/json" -X POST -d '{"email":"YOUR_ACCOUNT_EMAIL","password":"YOUR_ACCOUNT_PASSWORD"}' https://api.crisp.chat/v1/user/session/login`

2. Use as follows:

```
use richbarrett\crispsdk\crispsdk;

$identifier = 'YOUR_IDENTIFIER';
$key = 'YOUR_KEY';

$sdk = new crispsdk;
$sdk->authenticate($identifier, $key);

$r = $sdk->listWebsites();
print_r($r);
```

