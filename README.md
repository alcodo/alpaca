Package is under development!

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></a></p>

<p align="center">
<a href="https://travis-ci.org/alcodo/alpaca"><img src="https://travis-ci.org/alcodo/alpaca.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/alcodo/alpaca"><img src="https://poser.pugx.org/alcodo/alpaca/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/alcodo/alpaca/framework"><img src="https://poser.pugx.org/alcodo/alpaca/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/alcodo/alpaca/framework"><img src="https://poser.pugx.org/alcodo/alpaca/license.svg" alt="License"></a>
</p>

# Alpaca
Simple CMS System based on Laravel Framework.

Requirements:
* [Laravel Framework](https://github.com/laravel/laravel) ([Doc](https://laravel.com/docs/5.6))
* [Vue.js](https://github.com/vuejs/vue) ([Doc](https://vuejs.org/v2/guide/))
* [Bootstrap 4](https://github.com/twbs/bootstrap) ([Doc](https://getbootstrap.com/docs/4.0/))
* [BootstrapVue](https://github.com/bootstrap-vue/bootstrap-vue) ([Doc](https://bootstrap-vue.js.org/docs))
* [EmailChecker](https://github.com/MattKetmo/EmailChecker))

## Why a new CMS system again?

I'm just frustrated with the system that's on the market.

**Wordpress**: Security issues (security updates), Hook system for modules is a real challenge  
**Drupal8**: Slow, Cache, Complex (Field data attributes)   
**OctoberCMS**: Pages will saved as a file, PHP Code is complex, Twig template system

https://trends.google.de/trends/explore?q=Wordpress,Drupal,typo3,joomla,octobercms

## Installation

### Package
Install [laravel](https://laravel.com/docs/5.5/installation#installing-laravel)
```bash
laravel new blog
```

Install *alpaca* and dependecies
```bash
composer require alcodo/alpaca
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
 
### Template 

Export the template:
```bash
php artisan vendor:publish --provider Alpaca\AlpacaServiceProvider

Add in resources/assets/js/app.js:
require('../../../vendor/alcodo/alpaca/resources/js/alpaca.js');

Add in resources/assets/sass/app.scss:
@import 'vendor/alcodo/alpaca/resources/sass/alpaca.scss';
```

Icons:
```bash
mkdir -p public/assets/icons
cp node_modules/trumbowyg/dist/ui/icons.svg public/assets/icons/
```

Add alpaca npm dependencies:
```bash
npm install file:./vendor/alcodo/alpaca/resources/js --save-dev
yarn or with npm install
```

### Extend auth logic
Create laravel basic login and registration auth
```bash
php artisan make:auth
```

Copy translated auth blade template files. This files are automatic integrated with alpaca:
```bash
cp -r vendor/alcodo/alpaca/resources/views/auth/ resources/views/auth/
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

Try to login with:
```
email: admin@alpaca.com
password: alpaca
```

### Optional
Add translation files for your language:
```bash
art alpaca:publish_transaltion de
```

## Projects which alpaca uses

* [artesaos/seotools](https://github.com/artesaos/seotools)
* [laracasts/flash](https://github.com/laracasts/flash)
* [msurguy/honeypot](https://github.com/msurguy/honeypot)
* [cocur/slugify](https://github.com/cocur/slugify)
* [caouecs/Laravel-lang](https://github.com/caouecs/Laravel-lang)
* [orchestra/testbench](https://github.com/orchestra/testbench)
