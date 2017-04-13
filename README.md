[![Latest Stable Version](https://poser.pugx.org/lezhnev74/dummy-config-loader/v/stable)](https://packagist.org/packages/lezhnev74/dummy-config-loader)
[![Build Status](https://travis-ci.org/lezhnev74/DummyConfigLoader.svg?branch=master)](https://travis-ci.org/lezhnev74/SimpleDownloader)
[![License](https://poser.pugx.org/lezhnev74/dummy-config-loader/license)](https://packagist.org/packages/lezhnev74/simple-downloader)
[![Total Downloads](https://poser.pugx.org/lezhnev74/dummy-config-loader/downloads)](https://packagist.org/packages/lezhnev74/simple-downloader)

# Usage

```php
$config = new DummyConfigLoader\Config(__DIR__); // this will look for config files in this folder
$value = $config->get('database.default.driver', 'mongodb');
```

You will get `mariadb` as `$value` if you will place file `database.php` in the given folder with contents:

```php
return [
    "default" => [
        "driver" => "mariadb"
    ]
];
```

Otherwise you will get `mongodb`.

First section of any key addresses the file within the directory. One level of recursion allowed. If no such file found in the folder - exception will be thrown.

## Installation

```
composer require lezhnev74/dummy-config-loader
```








