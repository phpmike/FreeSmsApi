MvFreeSmsApi
==================

This API is for sending notification to your Free Mobile (Require Free Mobile account with api key)

Install
-------

```bash
composer.phar require mv/free-sms-api
```

Examples
--------

```php
use Mv\FreeSmsApi\Sms\Sender;

$sender = new Sender('Your Free user id', 'Your Free user api key');
$sender->addMessage('This library is great to send SMS to my account!');
$sender->send(); // Send all messages that are not already sent!
```

Be carreful, this throw "Mv\FreeSmsApi\Exception\FailedException" when something went wrong.

See also bundle for Symfony2

Enjoy it!

To be continued...