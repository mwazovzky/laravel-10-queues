# Laravel 10 Playground

## Laravel queues

### Queue driver database

```
php artisan queue:table
php artisan migrate
```

Config queue connection

```
// .env
QUEUE_CONNECTION=database
```

Start queue worker

```
php artisan queue:work
```

or listener (reloads code)

```
php artisan queue:listen
```

### Queue driver redis

Install redis

```
// .env
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Install predis

```
composer require predis/predis
```

```
// config/database
'redis' => [
        'client' => env('REDIS_CLIENT', 'predis'),
],
```

Config redis connection

```
// .env
QUEUE_CONNECTION=redis
```
