1. docker-compose up -d

## Enable xdebug
Create a `docker-compose.override.yml` file and add the following:

```yaml
services:
  app:
    build:
      args:
        - INSTALL_XDEBUG=yes
    environment:
      PHP_IDE_CONFIG: serverName=PHPSTORM
```

## Shell into app container
`docker-compose exec app sh`

## Testing
`php artisan test`
