# PHP Cloudflare AMP Validator
[![Build Status](https://api.travis-ci.org/ricardofiorani/php-cloudflare-amp-validator.svg?branch=master)](http://travis-ci.org/ricardofiorani/php-cloudflare-amp-validator)
[![Minimum PHP Version](http://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/ricardofiorani/php-cloudflare-amp-validator/license.png)](https://packagist.org/packages/ricardofiorani/php-cloudflare-amp-validator)
[![Total Downloads](https://poser.pugx.org/ricardofiorani/php-cloudflare-amp-validator/d/total.png)](https://packagist.org/packages/ricardofiorani/php-cloudflare-amp-validator)
[![Coding Standards](https://img.shields.io/badge/cs-PSR--4-yellow.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ricardofiorani/php-cloudflare-amp-validator/?branch=master)

PHP Cloudflare AMP Validator is a PHP Library that wraps the [Cloudflare AMP validation API](https://blog.cloudflare.com/amp-validator-api/).

## Install

Via Composer

``` bash
$ composer require ricardofiorani/php-cloudflare-amp-validator
```

## Usage
``` php
use \RicardoFiorani\Validator\Validator;

$validator = new Validator();
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