# lumen-glide

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Easily integrate Glide with the Lumen micro-framework.

## Install

Via Composer

``` bash
$ composer require rojtjo/lumen-glide
```

## Configuration
Configuration can be done in multiple ways.

### First method
Copy the config file from `{package_dir}/config/glide.php` to `config/glide` and update it with your own values. 

### Second method
Update the container bindings.
``` php
// Example configure GridFS.
$app->bind('glide.source', function($app) {
    $gridFS = ...
    return new League\Flysystem\Filesystem(
        new League\Flysystem\GridFS\GridFSAdapter($gridFS)
    );
});
```

## Usage

Register the service provider.
``` php
// bootstrap/app.php
$app->register(Rojtjo\LumenGlide\GlideServiceProvider::class);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email me@rojvroemen.com instead of using the issue tracker.

## Credits

- [Roj Vroemen][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/Rojtjo/lumen-glide.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Rojtjo/lumen-glide/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Rojtjo/lumen-glide.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Rojtjo/lumen-glide.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Rojtjo/lumen-glide.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/Rojtjo/lumen-glide
[link-travis]: https://travis-ci.org/Rojtjo/lumen-glide
[link-scrutinizer]: https://scrutinizer-ci.com/g/Rojtjo/lumen-glide/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Rojtjo/lumen-glide
[link-downloads]: https://packagist.org/packages/Rojtjo/lumen-glide
[link-author]: https://github.com/Rojtjo
[link-contributors]: ../../contributors
