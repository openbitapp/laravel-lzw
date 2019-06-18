# Laravel LZW

[![Latest Version on Packagist](https://img.shields.io/packagist/v/openbitapp/laravel-lzw.svg?style=flat-square)](https://packagist.org/packages/openbitapp/laravel-lzw)
[![Total Downloads](https://img.shields.io/packagist/dt/openbitapp/laravel-lzw.svg?style=flat-square)](https://packagist.org/packages/openbitapp/laravel-lzw)

Lempel–Ziv–Welch (LZW) is a universal lossless data compression algorithm. This package offers support for compressing and decompressing data using LZW.

## Installation

You can install the package via composer:

```bash
composer require openbitapp/laravel-lzw
```

The package registers itself and his facade automatically.

## Usage

You can compress and decompress data using the facade.

``` php
$data = LZW::compress('String data to compress');

$data->toString();
$data->toArray();
$data->toJson();

LZW::decompress($data->toString());
LZW::decompress($data->toArray());
```

### Testing

``` bash
./vendor/bin/phpunit
```

## Credits

- [Rosetta Code](http://rosettacode.org/wiki/LZW_compression#PHP)
- [Andrea Martini](https://github.com/anmartini)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
