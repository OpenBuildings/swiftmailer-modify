Swiftmailer Modify
==================

[![Build Status](https://travis-ci.org/{%repository_name%}.png?branch=master)](https://travis-ci.org/clippings/swiftmailer-modify)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/{%repository_name%}/badges/quality-score.png)](https://scrutinizer-ci.com/g/clippings/swiftmailer-modify/)
[![Code Coverage](https://scrutinizer-ci.com/g/{%repository_name%}/badges/coverage.png)](https://scrutinizer-ci.com/g/clippings/swiftmailer-modify/)
[![Latest Stable Version](https://poser.pugx.org/{%repository_name%}/v/stable.png)](https://packagist.org/packages/clippings/swiftmailer-modify)

Modify all emails before sending

Instalation
-----------

Install via composer

```
composer require clippings/swiftmailer-modify
```

Usage
-----
```

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
