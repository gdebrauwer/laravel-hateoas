# Changelog

All notable changes to `laravel-hateoas` will be documented in this file

## 1.8.0 - 2022-02-13

- Add Laravel 9 support ([#34](https://github.com/gdebrauwer/laravel-hateoas/pull/34))

## 1.7.0 - 2021-11-28

- Add PHP 8.1 support ([#33](https://github.com/gdebrauwer/laravel-hateoas/pull/33))

## 1.6.1 - 2021-07-24

- Support Eloquent models in "Models" directory ([#32](https://github.com/gdebrauwer/laravel-hateoas/pull/32))

## 1.6.0 - 2021-01-06

- Add PHP 8 support ([#30](https://github.com/gdebrauwer/laravel-hateoas/pull/30))

## 1.5.0 - 2020-09-09

- Add Laravel 8 support, and drop Laravel 6 support ([#27](https://github.com/gdebrauwer/laravel-hateoas/pull/27))

## 1.4.0 - 2020-03-03

- Add Laravel 7 support, bump minimum PHP version to 7.3 and drop Laravel 5.8 support ([#26](https://github.com/gdebrauwer/laravel-hateoas/pull/26))

## 1.3.0 - 2019-09-22

- Change `links()` method of `HasLinks` trait to allow extra arguments array to be passed via first parameter ([#21](https://github.com/gdebrauwer/laravel-hateoas/pull/21))
- Allow `formatLinksUsing()` method to accept either a formatter classname or callback ([#20](https://github.com/gdebrauwer/laravel-hateoas/pull/20))
- Throw custom exceptions if `Link` object can not be used ([#18](https://github.com/gdebrauwer/laravel-hateoas/pull/18))

## 1.2.1 - 2019-09-05

- Update Travis setup to run tests for every supported Laravel version ([#15](https://github.com/gdebrauwer/laravel-hateoas/pull/15))
- Add v4 of orchestra/testbench ([#14](https://github.com/gdebrauwer/laravel-hateoas/pull/14))

## 1.2.0 - 2019-09-02

- Add support for Laravel 6 ([#13](https://github.com/gdebrauwer/laravel-hateoas/pull/13))

## 1.1.2 - 2019-08-28

- Fix return statement in docblock of `HasLinks` trait ([#12](https://github.com/gdebrauwer/laravel-hateoas/pull/12))

## 1.1.1 - 2019-08-25

- Update docblock of `Hateoas` facade to include public methods of `HateoasManager` class ([#11](https://github.com/gdebrauwer/laravel-hateoas/pull/11))

## 1.1.0 - 2019-08-24

- Customize formatting of links using callback ([#10](https://github.com/gdebrauwer/laravel-hateoas/pull/10))
- Customize HATEOAS class discovery using callback ([#8](https://github.com/gdebrauwer/laravel-hateoas/pull/8))

## 1.0.2 - 2019-08-20

- Use empty `LinkCollection` if HATEOAS class triggers exception ([#5](https://github.com/gdebrauwer/laravel-hateoas/pull/5))

## 1.0.1 - 2019-08-18

- Allow constructor dependency injection on HATEOAS classes ([#3](https://github.com/gdebrauwer/laravel-hateoas/pull/3))

## 1.0.0 - 2019-08-17

- Initial release
