# Format

[![Build Status](https://travis-ci.org/matriphe/format.svg?branch=master)](https://travis-ci.org/matriphe/format)
[![Latest Stable Version](https://poser.pugx.org/matriphe/format/v/stable.svg)](https://packagist.org/packages/matriphe/format)
[![Total Downloads](https://poser.pugx.org/matriphe/format/downloads.svg)](https://packagist.org/packages/matriphe/format) 
[![License](https://poser.pugx.org/matriphe/format/license.svg)](https://packagist.org/packages/matriphe/format)

Helpers contains common formatting, such as number, bytes, currency, phone, hash slug, format duration, and remove new line in string. Very handy for formatting things in Laravel.

Under the hood, it wraps some other great packages.

* [Laravel Intl](https://github.com/Propaganistas/Laravel-Intl)
* [Laravel Phone](https://github.com/Propaganistas/Laravel-Phone)
* [Byte Units](https://github.com/gabrielelana/byte-units)
* [Hashids](https://github.com/ivanakimov/hashids.php)

## Compatibility

This latest 2.0 version works with Laravel >= 5.5. For previous version, [check 1.6 version](https://github.com/matriphe/format/tree/1.6.2).

It requires PHP >= 7.0 and and bcmath extension.

## Installation

Open `composer.json` and require this line below.
```json
"matriphe/format": "^2.0"
```
Or you can run this command from your project directory.
```bash
composer require matriphe/format
```

It used Laravel auto package discovery feature.

## Usage

It's really easy to use the functions, by calling the `Format` facade or simply using global functions helpers.

It use internal locale, if you want to change the locale at runtime, just pass a `$locale` in the function.

On this example, we use Indonesia (id) locale as default.

### Format Number
```php
// Using facade
// string Format::number(float $number, int $precision = 0, string $locale = null)
Format::number(1000); // output: '1.000'
Format::number(123456.76, 1); // output: '123.456,8'
Format::number(123456.76, 1, 'en'); // output: '123,456.8'

// Using global function
// string format_number(float $number, int $precision = 0, string $locale = null)
format_number(1000); // output: '1.000'
format_number(123456.76, 1); // output: '123.456,8'
format_number(123456.76, 1, 'en'); // output: '123,456.8'

```

### Format Currency
```php
// Using facade
// string Format::number(float $number, int $precision = 0, string $locale = null)
Format::currency(1000); // output: 'Rp1.000'
Format::currency(123456.76); // output: 'Rp123.457'
Format::currency(123456.76, 'us'); // output: 'US$123.456,76'

// Using global function
// string format_number(float $number, int $precision = 0, string $locale = null)
format_currency(1000); // output: 'Rp1.000'
format_currency(123456.76,); // output: 'Rp123.457'
format_currency(123456.76, 'us'); // output: 'US$123.456,76'

```

### Format Bytes
```php
// Using facade
// string Format::bytes(float $number, int $precision = 1)
Format::bytes(100); // output: '100 B'
Format::bytes(1000); // output: '1 kB'
Format::bytes(2000000000, 0); // output: '2 GB'

// Using global function
// string format_bytes(float $number, int $precision = 1)
format_bytes(100); // output: '100 B'
format_bytes(1000); // output: '1 kB'
format_bytes(2000000000, 0); // output: '2 GB'
```

### Format to Bytes
```php
// Using facade
// int Format::toBytes(string $stringBytes)
Format::toBytes('10k'); // output: 10240
Format::toBytes('10 M'); // output: 10485760
Format::toBytes('10G'); // output: 10737418240

// Using global function
// int format_to_bytes(string $stringBytes)
format_to_bytes('10k'); // output: 10240
format_to_bytes('10 M'); // output: 10485760
format_to_bytes('10G'); // output: 10737418240
```

### Format Phone
```php
// Using facade
// string Format::phone(string $phone, string $country = null)
Format::phone('085786920412'); // output: +6285786920412
Format::phone('+6285786920412'); // output: +6285786920412
Format::phone('(0274) 513-339'); // output: +62274513339
Format::phone('(65) 6655 4433', 'sg'); // output: +6566554433

// Using global function
// string format_phone(string $phone, string $country = null)
format_phone('085786920412'); // output: +6285786920412
format_phone('+6285786920412'); // output: +6285786920412
format_phone('(0274) 513-339'); // output: +62274513339
format_phone('(65) 6655 4433', 'sg'); // output: +6566554433
```

### Format Phone Human
```php
// Using facade
// string Format::phoneHuman(string $phone, string $country = null)
Format::phoneHuman('085786920412'); // output: 0857-8692-0412
Format::phoneHuman('+6285786920412'); // output: 0857-8692-0412
Format::phoneHuman('(0274) 513-339'); // output: (0274) 513339
Format::phoneHuman('+62274513339'); // output: (0274) 513339
Format::phoneHuman('(65) 6655 4433', 'sg'); // output: 6655 4433
Format::phoneHuman('+6566554433', 'sg'); // output: 6655 4433

// Using global function
// string format_phone_human(string $phone, string $country = null)
format_phone_human('085786920412'); // output: 0857-8692-0412
format_phone_human('+6285786920412'); // output: 0857-8692-0412
format_phone_human('(0274) 513-339'); // output: (0274) 513339
format_phone_human('+62274513339'); // output: (0274) 513339
format_phone_human('(65) 6655 4433', 'sg'); // output: 6655 4433
format_phone_human('+6566554433', 'sg'); // output: 6655 4433
```

### Format Phone Carrier
```php
// Using facade
// string Format::carrier(string $phone, string $country = null)
Format::carrier('085786920412'); // output: IM3
Format::carrier('+6281286920412'); // output: Telkomsel

// Using global function
// string format_carrier(string $phone, string $country = null)
format_carrier('085786920412'); // output: IM3
format_carrier('+6281286920412'); // output: Telkomsel
```

### Format DateRange
```php
// Using facade
// string Format::dateRange(string $date1, string $date2 = null, bool $long = true, string $locale = null)
Format::dateRange('2015-03-03'); // output: 3 March 2015
Format::dateRange('2015-03-03', null, true, 'fr'); // output: 3 mars 2015
Format::dateRange('2015-03-03', null, false); // output: 3 Mar 15
Format::dateRange('2015-03-03', null, false, 'fr'); // output: 3 mar 15
Format::dateRange('2015-03-03', '2015-03-03'); // output: 3 March 2015
Format::dateRange('2015-03-03', '2015-03-03', false); // output: 3 Mar 15
Format::dateRange('2015-03-03', '2015-03-05'); // output: 3-5 March 2015
Format::dateRange('2015-03-03', '2015-03-05', true, 'fr'); // output: 3-5 mars 2015
Format::dateRange('2015-03-03', '2015-03-05', false); // output: 3-5 Mar 15
Format::dateRange('2015-03-03', '2015-03-05', false, 'fr'); // output: 3-5 mar 15
Format::dateRange('2015-03-03', '2015-04-05'); // output: 3 March - 5 April 2015
Format::dateRange('2015-03-03', '2015-04-05', true, 'fr'); // output: 3 mars - 5 avril 2015
Format::dateRange('2015-03-03', '2015-04-05', false); // output: 3 Mar - 5 Apr 15
Format::dateRange('2015-03-03', '2015-04-05', false, 'fr'); // output: 3 mar - 5 avr 15
Format::dateRange('2015-03-03', '2016-04-05'); // output: 3 March 2015 - 5 April 2016
Format::dateRange('2015-03-03', '2016-04-05', false); // output: 3 Mar 15 - 5 Apr 16

// Using global function
// string format_date_range(string $date1, string $date2 = null, bool $long = true, string $locale = null)
format_date_range('2015-03-03'); // output: 3 March 2015
format_date_range('2015-03-03', null, true, 'fr'); // output: 3 mars 2015
format_date_range('2015-03-03', null, false); // output: 3 Mar 15
format_date_range('2015-03-03', null, false, 'fr'); // output: 3 mar 15
format_date_range('2015-03-03', '2015-03-03'); // output: 3 March 2015
format_date_range('2015-03-03', '2015-03-03', false); // output: 3 Mar 15
format_date_range('2015-03-03', '2015-03-05'); // output: 3-5 March 2015
format_date_range('2015-03-03', '2015-03-05', true, 'fr'); // output: 3-5 mars 2015
format_date_range('2015-03-03', '2015-03-05', false); // output: 3-5 Mar 15
format_date_range('2015-03-03', '2015-03-05', false, 'fr'); // output: 3-5 mar 15
format_date_range('2015-03-03', '2015-04-05'); // output: 3 March - 5 April 2015
format_date_range('2015-03-03', '2015-04-05', true, 'fr'); // output: 3 mars - 5 avril 2015
format_date_range('2015-03-03', '2015-04-05', false); // output: 3 Mar - 5 Apr 15
format_date_range('2015-03-03', '2015-04-05', false, 'fr'); // output: 3 mar - 5 avr 15
format_date_range('2015-03-03', '2016-04-05'); // output: 3 March 2015 - 5 April 2016
format_date_range('2015-03-03', '2016-04-05', false); // output: 3 Mar 15 - 5 Apr 16
```

### Format Hashed Slug

It's very useful to generate *hashed* URL slug like in URL shortener service. It use UNIX timestamp salt to generate unique ID. You can also set the length and the alphabet for the output.
```php
// Using facade
// string Format::slugHash(int $id, $timestamp = null, string $alphabet = null, int $length = 6)
Format::slugHash(1); // output: 2qOPMd
Format::slugHash(2); // output: jbGm6-
Format::slugHash(3); // output: KMd9q5
Format::slugHash(1, '1984-03-22'); // output: adReK1
Format::slugHash(2, '1984-03-22'); // output: 9bqZ2g
Format::slugHash(3, '1984-03-22'); // output: EPaRND
Format::slugHash(1, '1984-03-22', '1234567890!@#$%^'); // output: $@76@8
Format::slugHash(2, '1984-03-22', '1234567890!@#$%^'); // output: 9%06%7
Format::slugHash(3, '1984-03-22', '1234567890!@#$%^'); // output: @9!%9!
Format::slugHash(1, '1984-03-22', '1234567890!@#$%^', 12); // output: %07$@76@8#6^
Format::slugHash(2, '1984-03-22', '1234567890!@#$%^', 12); // output: ^869%06%7$!0
Format::slugHash(3, '1984-03-22', '1234567890!@#$%^', 12); // output: ^#$@9!%9!067

// Using global function
// string format_slug_hash(int $id, $timestamp = null, string $alphabet = null, int $length = 6)
format_slug_hash(1); // output: 2qOPMd
format_slug_hash(2); // output: jbGm6-
format_slug_hash(3); // output: KMd9q5
format_slug_hash(1, '1984-03-22'); // output: adReK1
format_slug_hash(2, '1984-03-22'); // output: 9bqZ2g
format_slug_hash(3, '1984-03-22'); // output: EPaRND
format_slug_hash(1, '1984-03-22', '1234567890!@#$%^'); // output: $@76@8
format_slug_hash(2, '1984-03-22', '1234567890!@#$%^'); // output: 9%06%7
format_slug_hash(3, '1984-03-22', '1234567890!@#$%^'); // output: @9!%9!
format_slug_hash(1, '1984-03-22', '1234567890!@#$%^', 12); // output: %07$@76@8#6^
format_slug_hash(2, '1984-03-22', '1234567890!@#$%^', 12); // output: ^869%06%7$!0
format_slug_hash(3, '1984-03-22', '1234567890!@#$%^', 12); // output: ^#$@9!%9!067
```

#### Note for *hashed* slug
If you want to save this hashed slug into MySQL, make sure the column is case sensitive. To do this, alter the column with this command.
```sql
ALTER TABLE `table` CHANGE `column_slug` `column_slug` VARCHAR(50) BINARY NOT NULL;
```

### Format Duration

It's very useful to generate duration in days, hours, minutes, and seconds.
```php
// Using facade
// string Format::duration(string $date1, string $date2, string $locale = null)
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:22:22'); // output: 1 hari
Format::duration('2015-05-15 11:22:22', '2015-05-17 11:22:22'); // output: 2 hari
Format::duration('2015-05-15 11:22:22', '2015-05-16 12:22:22'); // output: 1 hari 1 jam
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:22:22'); // output: 1 hari 2 jam
Format::duration('2015-05-15 11:22:22', '2015-05-17 12:22:22'); // output: 2 hari 1 jam
Format::duration('2015-05-15 11:22:22', '2015-05-17 13:22:22'); // output: 2 hari 2 jam
Format::duration('2015-05-15 11:22:22', '2015-05-16 12:23:22'); // output: 1 hari 1 jam 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-16 12:24:22'); // output: 1 hari 1 jam 2 menit
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:23:22'); // output: 1 hari 2 jam 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:23:22'); // output: 1 hari 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:24:22'); // output: 1 hari 2 menit
Format::duration('2015-05-15 11:22:22', '2015-05-17 11:24:22'); // output: 2 hari 2 menit
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:23:25'); // output: 1 hari 2 jam 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:22:25'); // output: 1 hari
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:23'); // output: 1 detik
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:27'); // output: 5 detik
Format::duration('2015-05-15 11:22:22', '2015-05-15 12:22:22'); // output: 1 jam
Format::duration('2015-05-15 11:22:22', '2015-05-15 13:22:22'); // output: 2 jam
Format::duration('2015-05-15 11:22:22', '2015-05-15 12:23:22'); // output: 1 jam 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-15 12:23:26'); // output: 1 jam 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-15 13:23:59'); // output: 2 jam 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:23:22'); // output: 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:24:22'); // output: 2 menit
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:24:46'); // output: 2 menit
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', true); // output: 2 menit 24 detik
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', true); // output: 1 menit
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', true); // output: 1 detik
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', true); // output: 5 detik
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', true); // output: 1 hari 2 jam 1 menit 3 detik
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', true); // output: 1 hari 3 detik

Format::duration('2015-05-15 11:22:22', '2015-05-16 11:22:22', 'en'); // output: 1 day
Format::duration('2015-05-15 11:22:22', '2015-05-17 11:22:22', 'en'); // output: 2 days
Format::duration('2015-05-15 11:22:22', '2015-05-16 12:22:22', 'en'); // output: 1 day 1 hour
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:22:22', 'en'); // output: 1 day 2 hours
Format::duration('2015-05-15 11:22:22', '2015-05-17 12:22:22', 'en'); // output: 2 days 1 hour
Format::duration('2015-05-15 11:22:22', '2015-05-17 13:22:22', 'en'); // output: 2 days 2 hours
Format::duration('2015-05-15 11:22:22', '2015-05-16 12:23:22', 'en'); // output: 1 day 1 hour 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-16 12:24:22', 'en'); // output: 1 day 1 hour 2 minutes
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:23:22', 'en'); // output: 1 day 2 hours 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:23:22', 'en'); // output: 1 day 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:24:22', 'en'); // output: 1 day 2 minutes
Format::duration('2015-05-15 11:22:22', '2015-05-17 11:24:22', 'en'); // output: 2 days 2 minutes
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', 'en'); // output: 1 day 2 hours 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', 'en'); // output: 1 day
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', 'en'); // output: 1 second
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', 'en'); // output: 5 seconds
Format::duration('2015-05-15 11:22:22', '2015-05-15 12:22:22', 'en'); // output: 1 hour
Format::duration('2015-05-15 11:22:22', '2015-05-15 13:22:22', 'en'); // output: 2 hours
Format::duration('2015-05-15 11:22:22', '2015-05-15 12:23:22', 'en'); // output: 1 hour 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-15 12:23:26', 'en'); // output: 1 hour 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-15 13:23:59', 'en'); // output: 2 hours 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', 'en'); // output: 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:24:22', 'en'); // output: 2 minutes
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', 'en'); // output: 2 minutes
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', 'en'); // output: 2 minutes 24 seconds
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', 'en'); // output: 1 minute
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', 'en'); // output: 1 second
Format::duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', 'en'); // output: 5 seconds
Format::duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', 'en'); // output: 1 day 2 hours 1 minute 3 seconds
Format::duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', 'en'); // output: 1 day 3 seconds

// Using global function
// string format_duration(string $date1, string $date2, string $locale = null)
format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:22'); // output: 1 hari
format_duration('2015-05-15 11:22:22', '2015-05-17 11:22:22'); // output: 2 hari
format_duration('2015-05-15 11:22:22', '2015-05-16 12:22:22'); // output: 1 hari 1 jam
format_duration('2015-05-15 11:22:22', '2015-05-16 13:22:22'); // output: 1 hari 2 jam
format_duration('2015-05-15 11:22:22', '2015-05-17 12:22:22'); // output: 2 hari 1 jam
format_duration('2015-05-15 11:22:22', '2015-05-17 13:22:22'); // output: 2 hari 2 jam
format_duration('2015-05-15 11:22:22', '2015-05-16 12:23:22'); // output: 1 hari 1 jam 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-16 12:24:22'); // output: 1 hari 1 jam 2 menit
format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:22'); // output: 1 hari 2 jam 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-16 11:23:22'); // output: 1 hari 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-16 11:24:22'); // output: 1 hari 2 menit
format_duration('2015-05-15 11:22:22', '2015-05-17 11:24:22'); // output: 2 hari 2 menit
format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25'); // output: 1 hari 2 jam 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25'); // output: 1 hari
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23'); // output: 1 detik
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27'); // output: 5 detik
format_duration('2015-05-15 11:22:22', '2015-05-15 12:22:22'); // output: 1 jam
format_duration('2015-05-15 11:22:22', '2015-05-15 13:22:22'); // output: 2 jam
format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:22'); // output: 1 jam 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:26'); // output: 1 jam 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-15 13:23:59'); // output: 2 jam 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22'); // output: 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:22'); // output: 2 menit
format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46'); // output: 2 menit
format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', true); // output: 2 menit 24 detik
format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', true); // output: 1 menit
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', true); // output: 1 detik
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', true); // output: 5 detik
format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', true); // output: 1 hari 2 jam 1 menit 3 detik
format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', true); // output: 1 hari 3 detik

format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:22', 'en'); // output: 1 day
format_duration('2015-05-15 11:22:22', '2015-05-17 11:22:22', 'en'); // output: 2 days
format_duration('2015-05-15 11:22:22', '2015-05-16 12:22:22', 'en'); // output: 1 day 1 hour
format_duration('2015-05-15 11:22:22', '2015-05-16 13:22:22', 'en'); // output: 1 day 2 hours
format_duration('2015-05-15 11:22:22', '2015-05-17 12:22:22', 'en'); // output: 2 days 1 hour
format_duration('2015-05-15 11:22:22', '2015-05-17 13:22:22', 'en'); // output: 2 days 2 hours
format_duration('2015-05-15 11:22:22', '2015-05-16 12:23:22', 'en'); // output: 1 day 1 hour 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-16 12:24:22', 'en'); // output: 1 day 1 hour 2 minutes
format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:22', 'en'); // output: 1 day 2 hours 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-16 11:23:22', 'en'); // output: 1 day 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-16 11:24:22', 'en'); // output: 1 day 2 minutes
format_duration('2015-05-15 11:22:22', '2015-05-17 11:24:22', 'en'); // output: 2 days 2 minutes
format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', 'en'); // output: 1 day 2 hours 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', 'en'); // output: 1 day
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', 'en'); // output: 1 second
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', 'en'); // output: 5 seconds
format_duration('2015-05-15 11:22:22', '2015-05-15 12:22:22', 'en'); // output: 1 hour
format_duration('2015-05-15 11:22:22', '2015-05-15 13:22:22', 'en'); // output: 2 hours
format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:22', 'en'); // output: 1 hour 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:26', 'en'); // output: 1 hour 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-15 13:23:59', 'en'); // output: 2 hours 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', 'en'); // output: 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:22', 'en'); // output: 2 minutes
format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', 'en'); // output: 2 minutes
format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', 'en'); // output: 2 minutes 24 seconds
format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', 'en'); // output: 1 minute
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', 'en'); // output: 1 second
format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', 'en'); // output: 5 seconds
format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', 'en'); // output: 1 day 2 hours 1 minute 3 seconds
format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', 'en'); // output: 1 day 3 seconds
```

### Remove New Line in String

Will remove `\n`, `\r`, and spaces in string to make it in one line.
```php
// Using facade
// string Format::removeNewLine(string $string)
Format::removeNewLine("Hello 
        World"); // output: Hello World
Format::removeNewLine("Hello 
        
        
        World
        
        
        "); // output: Hello World
Format::removeNewLine("Hello        World
        
        
        "); // output: Hello World

// Using global function
// string format_remove_new_line(string $string)
format_remove_new_line("Hello 
        World"); // output: Hello World
format_remove_new_line("Hello 
        
        
        World
        
        
        "); // output: Hello World
format_remove_new_line("Hello        World
        
        
        "); // output: Hello World
```