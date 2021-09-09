# easy-admin

Easy tools for building an administration linked to a relational database

## Contributing

### Installation

```shell
composer install
```

### Testing

```shell
php vendor/bin/phpunit --configuration phpunit.xml.dist
```

### Run server

```shell
php -S "localhost:8080" 
```

You can now access the back office using http://localhost:8080/?lang=fr&page=list&type=civility

## Components

A [list of all available components is available here](./doc/components/index.md).

## I18N

Internationalisation is handled via `lang` files, [more information here](./doc/i18n.md).
