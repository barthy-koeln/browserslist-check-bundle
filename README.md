# Browserslist Check Bundle

This bundle parses `.browserslistrc` files for a config called `modern`.
It then provides a php service and a twig method to compare the
user-agent string against this config.

The goal is to determine whether the browser requesting a response is
"modern" in relation to JavaScript and CSS functionality.

You can use it to serve different front-end builds and save precious
bandwidth for modern browsers by serving less polyfills, vendor prefixes
and whatever else is handled by the `.broserslistrc`.

## Installing

```shell script
composer require barthy-koeln/browserslist-check-bundle
```

## Config

Your `.browserslistrc` file should look like this:

```
[modern]
Chrome >= 84
Firefox >= 80
Safari >= 13.1
Opera >= 70
Edge >= 85
iOS >= 12.4
Samsung >= 12
ChromeAndroid >= 85

[legacy]
>1%
last 2 versions
not dead
```

Important notes:
* The `[modern]` config must be at the top
* The constraints within that build must only map browser names with
  minimum versions using the `>=` operator. Browsers with versions higher
  or equal are "modern".

## Usage

```twig
<script src="/build/{{ is_modern_browser() ? 'modern' : 'legacy' }}.js" type="application/javascript"></script>
```

```php
<?php

use BarthyKoeln\BrowserslistCheckBundle\DependencyInjection\BrowserslistCheck;

public function someControllerAction(BrowserslistCheck $browserslistCheck)
{
    $isModern = $browserslistCheck->isModern();
    $isModern = $browserslistCheck->isModern('Explorer', 9); // pls no
}
```

The user agent parsing will not happen until you call the `isModern`
method without any arguments.
