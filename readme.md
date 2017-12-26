Clean architecture example in PHP.

# Vendoring

## install

```
composer install
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
