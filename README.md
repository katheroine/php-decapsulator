# Decapsulator

<!-- ![example workflow](https://github.com/ExOrg/php-decapsulator/actions/workflows/php.yml/badge.svg) -->

Decapsulating objects wrapper. Allows easy access to non-public properties and methods.

## Getting Started

### Prerequisities

* [PHP](https://www.php.net/) 8.1 - 8.3
* [Git](https://git-scm.com/) 2.25.1+
* [Composer](https://getcomposer.org/) 2.6.0+

The instruction assumes using the Linux operating system or compatible tools for other operating systems.

### Installation

#### php8.*-cli, Git and Composer required

The recommended way to install DataCoder into the source code of the project is to handle it as code dependency by [Composer](http://getcomposer.org). [Git](https://git-scm.com/) is needed to fetch packages from version control repositories.

The *php8.\*-cli* is needed for installing Composer.

#### DataCoder installation

Add to your **composer.json** file appropriate entry by running the following command
```bash
composer require exorg/decapsulator
```
If it's project set-up stage and no one dependency have been installed yet, run
```bash
composer install
```
If another dependencies have been intalled previously, run
```bash
composer update
```

## Usage

The simplest way to autoload all needed files in executable file is attaching *autoload.php* file generated by Composer (after running `composer install` or `composer update` command) like in following example

```php
require_once (__DIR__ . '/vendor/autoload.php');
```

**Class of the fixture that will be decapsulated**

```php

declare(strict_types=1);

class DemoClass
{
    /**
     * Public static property.
     *
     * @var mixed
     */
    public static $publicStaticProperty;

    /**
     * Protected static property.
     *
     * @var mixed
     */
    protected static $protectedStaticProperty;

    /**
     * Private static property.
     *
     * @var mixed
     */
    private static $privateStaticProperty;

    /**
     * Public property.
     *
     * @var mixed
     */
    public $publicProperty;

    /**
     * Protected property.
     *
     * @var mixed
     */
    protected $protectedProperty;

    /**
     * Private property.
     *
     * @var mixed
     */
    private $privateProperty;

    /**
     * Public static method with no arguments.
     *
     * @return string
     */
    public static function publicStaticMethodWithNoArguments()
    {
        return 'public:static:no-arguments';
    }

    /**
     * Protected static method with no arguments.
     *
     * @return string
     */
    protected static function protectedStaticMethodWithNoArguments()
    {
        return 'protected:static:no-arguments';
    }

    /**
     * Private static method with no arguments.
     *
     * @return string
     */
    private static function privateStaticMethodWithNoArguments()
    {
        return 'private:static:no-arguments';
    }

    /**
     * Public static method with arguments.
     *
     * @param mixed $argument1
     * @param mixed $argument2
     *
     * @return string
     */
    public static function publicStaticMethodWithArguments($argument1, $argument2)
    {
        return 'public:static:arguments:' . $argument1 . '+' . $argument2;
    }

    /**
     * Protected static method with arguments.
     *
     * @param mixed $argument1
     * @param mixed $argument2
     *
     * @return string
     */
    protected static function protectedStaticMethodWithArguments($argument1, $argument2)
    {
        return 'protected:static:arguments:' . $argument1 . '+' . $argument2;
    }

    /**
     * Private static method with arguments.
     *
     * @param mixed $argument1
     * @param mixed $argument2
     *
     * @return string
     */
    private static function privateStaticMethodWithArguments($argument1, $argument2)
    {
        return 'private:static:arguments:' . $argument1 . '+' . $argument2;
    }

    /**
     * Public method with no arguments.
     *
     * @return string
     */
    public function publicMethodWithNoArguments()
    {
        return 'public:no-arguments';
    }

    /**
     * Protected method with no arguments.
     *
     * @return string
     */
    protected function protectedMethodWithNoArguments()
    {
        return 'protected:no-arguments';
    }

    /**
     * Private method with no arguments.
     *
     * @return string
     */
    private function privateMethodWithNoArguments()
    {
        return 'private:no-arguments';
    }

    /**
     * Public method with arguments.
     *
     * @param mixed $argument1
     * @param mixed $argument2
     *
     * @return string
     */
    public function publicMethodWithArguments($argument1, $argument2)
    {
        return 'public:arguments:' . $argument1 . '+' . $argument2;
    }

    /**
     * Protected method with arguments.
     *
     * @param mixed $argument1
     * @param mixed $argument2
     *
     * @return string
     */
    protected function protectedMethodWithArguments($argument1, $argument2)
    {
        return 'protected:arguments:' . $argument1 . '+' . $argument2;
    }

    /**
     * Private method with arguments.
     *
     * @param mixed $argument1
     * @param mixed $argument2
     *
     * @return string
     */
    private function privateMethodWithArguments($argument1, $argument2)
    {
        return 'private:arguments:' . $argument1 . '+' . $argument2;
    }
}

```

### Properties decapsulation

Static class properties are accessed from the class instance the same way as non-static.

```php

require_once (__DIR__ . '/../vendor/autoload.php');
require_once (__DIR__ . '/DemoClass.php');

use ExOrg\Decapsulator\ObjectDecapsulator;

$object = new DemoClass();
$decapsulatedObject = ObjectDecapsulator::buildForObject($object);

$decapsulatedObject->privateStaticProperty = 2;
print('Private static property: ' . $decapsulatedObject->privateStaticProperty . PHP_EOL);

$decapsulatedObject->protectedStaticProperty = 4;
print('Protected static property: ' . $decapsulatedObject->protectedStaticProperty . PHP_EOL);

$decapsulatedObject->publicStaticProperty = 8;
print('Public static property: ' . $decapsulatedObject->publicStaticProperty . PHP_EOL);

$decapsulatedObject->privateProperty = 16;
print('Private property: ' . $decapsulatedObject->privateProperty . PHP_EOL);

$decapsulatedObject->protectedProperty = 32;
print('Protected property: ' . $decapsulatedObject->protectedProperty . PHP_EOL);

$decapsulatedObject->publicProperty = 64;
print('Public property: ' . $decapsulatedObject->publicProperty . PHP_EOL);

```

---
```bash
Private static property: 2
Protected static property: 4
Public static property: 8
Private property: 16
Protected property: 32
Public property: 64
```

### Methods decapsulation

**Example file snippet**

Static class methods are accessed from the class instance the same way as non-static.

```php

require_once (__DIR__ . '/../vendor/autoload.php');
require_once (__DIR__ . '/DemoClass.php');

use ExOrg\Decapsulator\ObjectDecapsulator;

$object = new DemoClass();
$decapsulatedObject = ObjectDecapsulator::buildForObject($object);

$result = $decapsulatedObject->privateStaticMethodWithNoArguments();
print('Private static method with no arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->protectedStaticMethodWithNoArguments();
print('Protected static method with no arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->publicStaticMethodWithNoArguments();
print('Public static method with no arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->privateStaticMethodWithArguments('rose', 'orange');
print('Private static method with arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->protectedStaticMethodWithArguments('violet', 'apple');
print('Protected static method with arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->publicStaticMethodWithArguments('orchid', 'plum');
print('Public static method with arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->privateMethodWithNoArguments();
print('Private method with no arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->protectedMethodWithNoArguments();
print('Protected method with no arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->publicMethodWithNoArguments();
print('Public method with no arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->privateMethodWithArguments('daisy', 'lemon');
print('Private method with arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->protectedMethodWithArguments('myosote', 'pear');
print('Protected method with arguments result: ' . $result . PHP_EOL);

$result = $decapsulatedObject->publicMethodWithArguments('dandelion', 'peach');
print('Public method with arguments result: ' . $result . PHP_EOL);

```

---
```bash
Private static method with no arguments result: private:static:no-arguments
Protected static method with no arguments result: protected:static:no-arguments
Public static method with no arguments result: public:static:no-arguments
Private static method with arguments result: private:static:arguments:rose+orange
Protected static method with arguments result: protected:static:arguments:violet+apple
Public static method with arguments result: public:static:arguments:orchid+plum
Private method with no arguments result: private:no-arguments
Protected method with no arguments result: protected:no-arguments
Public method with no arguments result: public:no-arguments
Private method with arguments result: private:arguments:daisy+lemon
Protected method with arguments result: protected:arguments:myosote+pear
Public method with arguments result: public:arguments:dandelion+peach
```

## Tests

### Unit tests

This project has unit tests, which has been built with [PHPUnit](https://phpunit.de/) framework and run on Linux operating system.

To run tests, write the following command in your command line inside the main DataCoder project directory

```bash
vendor/bin/phpunit tests/
```

or use a Composer script

```bash
composer test
```

### Code style tests

This code follows [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-12](http://www.php-fig.org/psr/psr-12/) standards.

To run tests for code style write the following command in your command line inside the main DataCoder project directory

```bash
vendor/bin/phpcs tests/ src/
```

or use a Composer script

```bash
composer sniff
```

You can also use a Composer script for running both tests and check code style

```bash
composer check
```

## Built with

* [Linux Mint](https://www.linuxmint.com/)
* [Visual Studio Code](https://code.visualstudio.com/)
* [Remarkable](https://remarkableapp.github.io/)
* [PHPUnit](https://phpunit.de/)
* [PHPCodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [Composer](https://getcomposer.org/)
* [Git](https://git-scm.com/)
* [GitHub](https://github.com/)

## Versioning

This project is versioning according to [SemVer](http://semver.org/)  versioning standars. All available [releases](https://github.com/ExOrg/php-data-coder/releases) are [tagged](https://github.com/ExOrg/php-data-coder/tags).

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on the code of conduct, and the process for submitting pull requests.

## Author

* **Katarzyna Krasińska** - [katheroine](https://github.com/katheroine), [ExOrg](https://github.com/ExOrg)


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

