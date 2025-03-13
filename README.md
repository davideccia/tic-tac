# TicTac

![Tic Tac](https://media.tenor.com/DMuNMD0aEggAAAAM/samuel-l-jackson.gif)

An expirations management tool for your Laravel models.

> [!WARNING] 
> This package is still in development, usage in production is not recommended.

## Installation

```bash
composer require davideccia/tic-tac
```

## Usage

### Model setup
Implent the `Expirable` interface in your model:

```php
use Davideccia\TicTac\Contracts\Expirable;

class WhateverCanExpire extends Model implements Expirable
{
    // ...
}
```
Then add the InteractsWithExpirations trait to your model:

```php
use Davideccia\TicTac\Contracts\Expirable;
use Davideccia\TicTac\Traits\InteractsWithExpirations;

class WhateverCanExpire extends Model implements Expirable
{
    use InteractsWithExpirations;
}
```

### Adding expirations

You can use the helper

```php
tic_tac()
    ->for($whateverCanExpire)
    ->dueDate(Carbon::now()->addDays(7))
    ->alertDate(Carbon::now()->addDays(14))
    ->save();
```

Or the `TicTac` facade:

```php
TicTac::for($whateverCanExpire)
    ->dueDate(Carbon::now()->addDays(7))
    ->alertDate(Carbon::now()->addDays(14))
    ->save();
```
