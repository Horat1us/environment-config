# Environment Config
[![Latest Stable Version](https://poser.pugx.org/horat1us/environment-config/v/stable.png)](https://packagist.org/packages/horat1us/environment-config)
[![Total Downloads](https://poser.pugx.org/horat1us/environment-config/downloads.png)](https://packagist.org/packages/horat1us/environment-config)
[![Build Status](https://travis-ci.org/Horat1us/environment-config.svg?branch=master)](https://travis-ci.org/horat1us/environment-config)
[![codecov](https://codecov.io/gh/horat1us/environment-config/branch/master/graph/badge.svg)](https://codecov.io/gh/horat1us/environment-config)

Simple class to provide config using `getenv` function with prefix.

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

// \DomainException will be thrown because no default value provided
$config->getName(); 
```

## Author
- [Alexander Letnikow](mailto:reclamme@gmail.com)

## License
[MIT](./LICENSE)
