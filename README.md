# Format

[![Build Status](https://travis-ci.org/matriphe/format.svg?branch=master)](https://travis-ci.org/matriphe/format)
[![Latest Stable Version](https://poser.pugx.org/matriphe/format/v/stable.svg)](https://packagist.org/packages/matriphe/format)
[![Total Downloads](https://poser.pugx.org/matriphe/format/downloads.svg)](https://packagist.org/packages/matriphe/format) 
[![Latest Unstable Version](https://poser.pugx.org/matriphe/format/v/unstable.svg)](https://packagist.org/packages/matriphe/format) 
[![License](https://poser.pugx.org/matriphe/format/license.svg)](https://packagist.org/packages/matriphe/format)

Helpers contains common formatting, such as number, bytes, and phone. Very handy for formatting things in Laravel.

## Installation

Open `composer.json` and require this line below.
```json
"matriphe/format": "dev-master"
```
Or you can run this command from your project directory.
```bash
composer require matriphe/format
```

### Laravel Installation

Open the `app/config/app.php` and add this line in `providers` section.
```php
'Matriphe\Format\FormatServiceProvider'
```
Still in `app/config/app.php`, add this line in `alias` section.
```php
'Format' => 'Matriphe\Format\Facades\FormatFacade'
```

## Usage

It's really easy to use the functions.

### Format Number
```php
// (string) Format::number((float) $number, (int) $precision = 0, (string) $decimal = ',', (string) $thousand = '.')
Format::number(1000); // output: '1.000'
Format::number(123456.76,1); // output: '123.456,8'
Format::number(123456.76,1,",","."); // output: '123,456.8'
```

### Format Bytes
```php
// (string) Format::bytes((float) $number, (int) $precision = 1)
Format::bytes(100); // output: '100 B'
Format::bytes(1000); // output: '1,0 kB'
Format::bytes(2000000000,0); // output: '2 GB'
```

### Format to Bytes
```php
// (int) Format::toBytes((string) $stringBytes)
Format::toBytes('10k'); // output: 10240
Format::toBytes('10 M'); // output: 10485760
Format::toBytes('10G'); // output: 10737418240
```

### Format Phone
```php
// (string) Format::phone((string) $phone)
Format::phone('085786920412'); // output: '+6285786920412'
Format::phone('+6285786920412'); // output: +6285786920412
Format::phone('(0274) 513-339'); // output: +62274513339
Format::phone('3-7801 2611','+60'); // output: +60378012611
```