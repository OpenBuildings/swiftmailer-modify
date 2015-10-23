Swiftmailer Modify
==================

[![Build Status](https://travis-ci.org/clippings/swiftmailer-modify.svg?branch=master)](https://travis-ci.org/clippings/swiftmailer-modify)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/clippings/swiftmailer-modify/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/clippings/swiftmailer-modify/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/clippings/swiftmailer-modify/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/clippings/swiftmailer-modify/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/{%repository_name%}/v/stable.png)](https://packagist.org/packages/clippings/swiftmailer-modify)

Modify all emails before sending

Installation
------------

Install via composer

```
composer require clippings/swiftmailer-modify
```

Usage
-----

```php
if ($environment === 'testing') {
    $mailer->registerPLugin(new ModifyPlugin(function(Swift_Message $message) {
        $message->setSubject('[Test] '.$message->getSubject());
    }));
}
```

License
-------

Copyright (c) 2015, Clippings Ltd. Developed by Ivan Kerin

Under BSD-3-Clause license, read LICENSE file.
