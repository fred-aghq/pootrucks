## Install/Run (local)
1. `cp .env.example .env`
1. `docker-compose up -d`

## Installing/Enabling xdebug (optional/local only)
Keep in mind that xdebug is useful for local dev but causes PHP to run slower.

- Create a `docker-compose.override.yml` file and add the following:

```yaml
services:
  app:
    build:
      args:
        - INSTALL_XDEBUG=yes
    environment:
      PHP_IDE_CONFIG: serverName=PHPSTORM
```

- Then, rebuild and restart the container: `docker-compose up --build -d app`

- Set up path mappings in PHPStorm.

> Valid options for `INSTALL_XDEBUG`: `yes` / `no`

## Shell into app container
`docker-compose exec app sh`

## Testing
`docker-compose exec app php artisan test`
