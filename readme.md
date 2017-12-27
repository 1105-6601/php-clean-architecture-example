Clean architecture example in PHP.

# Vendoring

## install

```
composer install
```

# Migration

## Execute

```
php vendor/bin/phinx init
vim phinx.yml
```

For example

```
environments:
    default_migration_table: phinxlog
    default_database: development
    development:
        adapter: mysql
        host: localhost
        name: clean_arch_example_php
        user: root
        pass: admin
        port: 3306
        charset: utf8mb4
```

then

```
php vendor/bin/phinx migrate
```

if, you need to rollback

```
php vendor/bin/phinx rollback
```

## Sample seed

```
php vendor/bin/phinx seed:run
```

# How to use

```
cp .env.default .env
```

## Webroot (Document Root)

`.` or `src/Infrastructure/Ui/Webroot/`

```
curl localhost/v1/hello/1
```

## CLI

```
cd src/Infrastructure/Ui/Command
php cmd.php -say-hello 1
```

# TODO

- Support `QUERY_LOG` flag
