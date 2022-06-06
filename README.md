# Browserslist Check Bundle

This bundle parses `.browserslistrc` files for a config called `modern`.
It then provides a php service and a twig method to compare the
user-agent string against this config.

It uses a great, light and fast [user agent parsing library](https://github.com/donatj/PhpUserAgent)
by [@donatj](https://github.com/donatj).

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
Chrome >= 97
Edge >= 97
Firefox >= 91
Safari >= 14.1
Opera >= 82
iOS >= 14.5
Samsung >= 15
ChromeAndroid >= 100
FirefoxAndroid >= 98
Android >= 99

[legacy]
defaults
ie 11
safari >= 13
iOS >= 13
```

Important notes:

* The `[modern]` config must be at the top
* The constraints within that build must only map browser names with
  minimum versions using the `>=` operator. Browsers with versions higher
  or equal are "modern".

## Caching The Browser Configuration

Your `.browserslistrc` file will be parsed and inlined as a PHP array when Symfony builds its cache.

## Crawlers & Bots

This bundle recognizes a few evergreen crawlers capable of handling JavaScript and handles them as their browser
counterpart (e.g. Chrome for Googlebot and Edge for Bingbot).

## Simple Usage

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

## Advanced Symfony, Webpack Encore, and Asset Management Usage

**file:** `config/packages/assets.yaml`

```yaml
framework:
  assets:
    packages:
      modern:
        json_manifest_path: '%kernel.project_dir%/public/build/modern/manifest.json'
      legacy:
        json_manifest_path: '%kernel.project_dir%/public/build/legacy/manifest.json'
```

**file:** `config/packages/webpack_encore.yaml`

```yaml
webpack_encore:
  output_path: false

  builds:
    modern: '%kernel.project_dir%/public/build/modern/'
    legacy: '%kernel.project_dir%/public/build/legacy/'

  # enable this in config/packages/prod
  #cache: false
```

**file:** `config/packages/prod/webpack_encore.yaml`

```yaml
webpack_encore:
  cache: true
```

**file:** `webpack.config.js`

```javascript
const Encore = require('@symfony/webpack-encore')
const buildType = process.env.BROWSERSLIST_ENV
const isModern = buildType === 'modern'

Encore
  // [...]

  .setOutputPath(`public/build/${buildType}/`)
  .setPublicPath(`/build/${buildType}`)
  .setManifestKeyPrefix(`build/${buildType}`)

  // [...]

  // Not required, but ie10 & ie11 have some trouble with data-uris
  .configureImageRule({
    type: isModern ? 'asset' : 'asset/resource',
    maxSize: isModern ? 8 * 1024 : undefined,
    filename: 'images/[name].[contenthash][ext]'
  })

// [...]
```

**file:** `package.json`

```json
{
  /* [...] */
  "scripts": {
    "dev": "BROWSERSLIST_ENV=modern encore dev",
    "watch": "BROWSERSLIST_ENV=modern encore dev --watch",
    "build_modern": "BROWSERSLIST_ENV=modern encore production",
    "build_legacy": "BROWSERSLIST_ENV=legacy encore production",
    "build": "yarn build_modern && yarn build_legacy"
  }
  /* [...] */
}
```

**file:** Any base twig template

```twig
{% set buildType = is_modern_browser() ? 'modern' : 'legacy' %}

{% block stylesheets %}
    {{ encore_entry_link_tags('css/header', null, buildType) }}
{% endblock %}

{% block javascripts %}
    {{ encore_entry_link_tags('css/main', null, buildType) }}
    
    {% for file in encore_entry_js_files('js/main', buildType) %}
        <script defer
                src="{{ file }}"
                type="application/javascript"
        ></script>
    {% endfor %}
{% endblock %}
```
