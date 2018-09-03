# PHP Cloudflare AMP Validator


## Install

Via Composer

``` bash
$ composer require ricardofiorani/php-cloudflare-amp-validator
```

## Usage
TBD
``` php
use \RicardoFiorani\Validator\Validator;

$validator = new Validator();
var_dump($validator->validateUrl('https://amp.mywebsite.com')->isValid());
```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Credits

- [Ricardo Fiorani](https://github.com/ricardofiorani)
- [All Contributors](https://github.com/ricardofiorani/php-cloudflare-amp-validator/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.