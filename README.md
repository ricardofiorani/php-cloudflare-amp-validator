# NOT WORKING ANYMORE / FEATURE DISABLED BY CLOUDFLARE
As Cloudflare announced on https://blog.cloudflare.com/amp-validator-api/, their AMP validator is no longer available.

Well, it was nice while it lasted :)


# PHP Cloudflare AMP Validator
[![Build Status](https://api.travis-ci.org/ricardofiorani/php-cloudflare-amp-validator.svg?branch=master)](http://travis-ci.org/ricardofiorani/php-cloudflare-amp-validator)
[![Minimum PHP Version](https://img.shields.io/packagist/php-v/ricardofiorani/php-cloudflare-amp-validator.svg)](https://php.net/)
[![License](https://poser.pugx.org/ricardofiorani/php-cloudflare-amp-validator/license.png)](https://packagist.org/packages/ricardofiorani/php-cloudflare-amp-validator)
[![Total Downloads](https://poser.pugx.org/ricardofiorani/php-cloudflare-amp-validator/d/total.png)](https://packagist.org/packages/ricardofiorani/php-cloudflare-amp-validator)
[![Coding Standards](https://img.shields.io/badge/cs-PSR--4-yellow.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/?branch=master)

PHP Cloudflare AMP Validator is a PHP Library that wraps the [Cloudflare AMP validation API](https://blog.cloudflare.com/amp-validator-api/).

## Requirements
- PHP >=7.1
- A PSR-18 HttpClient


## Install

Via Composer

``` bash
$ composer require ricardofiorani/php-cloudflare-amp-validator
```

## Usage
``` php
use \RicardoFiorani\Validator\Validator;

$httpClient = new \Your\Psr18\HttpClient();
$requestFactory = new \Your\PSR-17\RequestFactoryInterface; 
$validator = new Validator($httpClient, $requestFactory);
//or you can use the default request factory by ignoring the second parameter 
$validator = new Validator($httpClient);
var_dump($validator->validateUrl('https://amp.mywebsite.com')->isValid());

$content = $yourHtmlRenderer->render();
var_dump($validator->validateContent($content)->isValid());

```

## Testing

``` bash
$ composer test
```

## Credits
- [Ricardo Fiorani](https://github.com/ricardofiorani)
- [All Contributors](https://github.com/ricardofiorani/php-cloudflare-amp-validator/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
