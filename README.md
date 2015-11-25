Html validator bundle
=====================

Installing
------------

```
composer require "twentyua/html-validator-bundle"
```

Configuration
------------

Not additional configuration is needed.


Usage
--------

```
    $container->get('twentyua_htmlvalidator.validator').isMarkupValid($html);
```