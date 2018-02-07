# HTML5 Definitions for HTML Purifier

[![Build Status](https://travis-ci.org/xemlock/htmlpurifier-html5.svg?branch=master)](https://travis-ci.org/xemlock/htmlpurifier-html5)

This library provides HTML5 element definitions for [HTMLPurifier](http://htmlpurifier.org/).

## Installation

Install with [Composer](https://getcomposer.org/) by running the following command:

```
composer require xemlock/htmlpurifier-html5
```

## Usage

The most basic usage is similar to the original HTML Purifier. Create a HTML5-compatible config
using `HTMLPurifier_HTML5Config::createDefault()` factory method, and then pass it to an `HTMLPurifier` instance:

```php
$config = HTMLPurifier_HTML5Config::createDefault();
$purifier = new HTMLPurifier($config);
$clean_html5 = $purifier->purify($dirty_html5);
```

To modify the config you can either instantiate the config with a configuration array passed to
`HTMLPurifier_HTML5Config::create()`, or by calling `set` method on an already existing config instance.

For example, to allow `IFRAME`s with Youtube videos you can do the following:

```php
$config = HTMLPurifier_HTML5Config::create(array(
  'HTML.SafeIframe' => true,
  'URI.SafeIframeRegexp' => '%^//www\.youtube\.com/embed/%',
));
```

or equivalently:

```php
$config = HTMLPurifier_HTML5Config::createDefault();
$config->set('HTML.SafeIframe', true);
$config->set('URI.SafeIframeRegexp', '#^//www\.youtube\.com/embed/#');
```

## License

The MIT License (MIT). See the LICENSE file.
