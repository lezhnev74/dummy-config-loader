# Usage

```php
$config = new Config(__DIR__); // this will look for config files in this folder
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

## Installation









