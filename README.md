# Laravel 10 Playground

## Laravel queues

### Queue driver database

```
php artisan queue:table
php artisan migrate
```

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
