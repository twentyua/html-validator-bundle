Html validator bundle
=====================

Installing
------------

```
composer require "twentyua/html-validator-bundle"
```

Add the bundle to your **AppKernel.php**:

```
new \TwentyUa\HtmlValidatorBundle\TwentyUaHtmlValidatorBundle(),
```

Configuration
------------

Not additional configuration is needed.


Usage
--------

```
$container->get('twentyua_htmlvalidator.validator')->isMarkupValid($html);
```