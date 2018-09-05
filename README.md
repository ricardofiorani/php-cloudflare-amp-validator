# PHP Cloudflare AMP Validator

## About
This an PHP Library that wraps the [Cloudflare AMP validation API](https://blog.cloudflare.com/amp-validator-api/).

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