shopvam
=================
[![Laravel 5](https://img.shields.io/badge/Laravel-5-orange.svg?style=flat-square)](http://laravel.com)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

Пакет простого приложения Laravel 5 (каталог товаров)

  
Установка
------------------
C помощью Composer

```
composer require trunow/shopvam:1.0
```

После этого выполните в консоли команду публикации нужных ресурсов:

```
php artisan vendor:publish --provider="Trunow\Shopvam\ShopvamServiceProvider"
```


Разрешения
-------------

В файле `config\shopvam.php` находится массив настроек разрешений по типу пользователей (admin, manager)


Демо
-------------

https://shopvam.trunow.ru
