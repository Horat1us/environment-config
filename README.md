# Environment Config
[![Latest Stable Version](https://poser.pugx.org/horat1us/environment-config/v/stable.png)](https://packagist.org/packages/horat1us/environment-config)
[![Total Downloads](https://poser.pugx.org/horat1us/environment-config/downloads.png)](https://packagist.org/packages/horat1us/environment-config)
[![codecov](https://codecov.io/gh/horat1us/environment-config/branch/master/graph/badge.svg)](https://codecov.io/gh/horat1us/environment-config)
[![Test & Lint](https://github.com/Horat1us/environment-config/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/Horat1us/environment-config/actions/workflows/php.yml)

Simple class to provide config using `getenv` function with prefix.

Compatibility: tested on PHP 7.1, PHP 8.1

[Changelog](./CHANGELOG.md)

## Installation
Using composer:
```bash
composer require horat1us/environment-config
```

## Usage
Implement your own config class:
```php
<?php

namespace App;

use Horat1us\Environment;

class Config extends Environment\Config {
    public function getTimeout(): int
    {
        return $this->getEnv($key = 'APP_TIMEOUT', $default = 10);
    }
    
    public function getSlow(): string
    {
        // default can be instance of \Closure or callable array, like [$this, 'calculate']
        return $this->getEnv($key = 'APP_KEY', $default = function(): string {
            return 'some-string'; // slow operation, may be fetching from DB 
        });
    }
    
    public function getNullValue(): ?string
    {
        /**
          * if you want to return null instead of throwing exceptio
          * if no environment variable found
          */
        return $this->getEnv('KEY', [$this, 'null']);  
    }
    
    public function getName(): string {
        return $this->getEnv($key = 'APP_NAME');
    }
}
```

then use it:
```php
<?php

use App;

$config = new App\Config("PREFIX_");
$config->getTimeout(); // 10

putenv("PREFIX_APP_TIMEOUT=5");
$config->getTimeout(); // 5

$config->getSlow(); // some-string

// MissingEnvironmentException will be thrown because no default value provided
$config->getName(); 
```

### MagicTrait
You can define your config keys/methods using [MagicTrait](./src/MagicTrait.php):
```php
<?php

use Horat1us\Environment;

class Config {
    use Environment\MagicTrait {
        getEnvironment as public getHost;
    }
    
    protected function getEnvironmentKeyPrefix(): string {
        return 'TEST_';
    }
}

$config = new Config;
$config->getHost(); // TEST_HOST environment key will be used to get value
```
*Note: your environment getters should be named with prefix get and have camel case name*

## Author
- [Alexander Letnikow](mailto:reclamme@gmail.com)

## License
[MIT](./LICENSE)
