# Installation

Добавить в kernel

    Evrinoma\DtoBundle\EvrinomaDtoBundle::class => ['all' => true],

Добавить в composer

    composer config repositories.dto vcs https://github.com/evrinoma/DtoBundle.git

# Configuration

    dto:
        services:
          identity - переопределение сервиса identity, поумолчанию используется class,
            class - индетификация dto по параметру class
            md5 - индетификация dto по параметру md5(class)
            либо - произвольный alias на свой сервис 

## Notice

показать проблемы кода

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --verbose --diff --dry-run
```

применить исправления

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php
```

## Тесты

```bash
COMPOSER_NO_DEV=0 composer install
/usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap tests/bootstrap.php --configuration phpunit.xml.dist tests --teamcity

```

## Thanks

## Done

## License
    PROPRIETARY