Package is under development!

# Alpaca
Simple CMS System based on Laravel Framework.

Requirements:
* Laravel Framework
* Bootstrap 4
* VueJs

## Why a new CMS system again?

I'm just frustrated with the system that's on the market.

**Wordpress**: Security issues (security updates), Hook system for modules is a real challenge  
**Drupal8**: Slow, Cache, Complex (Field data attributes)   
**OctoberCMS**: Pages will saved as a file, PHP Code is complex, Twig template system

https://trends.google.de/trends/explore?q=Wordpress,Drupal,typo3,joomla,octobercms

## Installation

Install [laravel](https://laravel.com/docs/5.5/installation#installing-laravel)
```bash
laravel new blog
```

Install *alpaca* and dependecies
```bash
composer require alcodo/alpaca
yarn
```

Start create tables
```bash
php artisan migrate
```

Remove welcome route from
 ```
routes/web.php
 
Route::get('/', function () {
    return view('welcome');
});
 ```

Create laravel basic login and registration auth
```bash
php artisan make:auth
```

Export the template
```bash
php artisan vendor:publish --provider Alpaca\AlpacaServiceProvider
```

Add to your User model the permission trait:
```php
use Alpaca\Traits\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Permission;
    ...
```

Try to login with
```
email: admin@alpaca.com
password: alpaca
```

*TODO*
