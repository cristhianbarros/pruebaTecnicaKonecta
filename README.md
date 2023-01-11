<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Prueba Técnica Laravel

La siguiente prueba se realizó utilizando el Framework de Laravel, para la instalación del proyecto es necesario contar con:

- Ambiente Local (XAMP) Opcional.
- Composer.
- Git.

El proyecto cuenta con una base de datos local en sqlite, dado el caso que necesiten crear la base de datos en MySQL u otro Motor de Base de Datos es necesario modificar el .env, descomentar o eliminar el # desde la línea 12 a la 16 y cambiar el parámetro DB_CONNECTION=sqlite por DB_CONNECTION=mysql y luego especificar los respectivos datos de conexión.


## Instalación

- git clone https://github.com/cristhianbarros/pruebaTecnicaKonecta.git
- cd ./pruebaTecnicaKonecta/
- composer install && cp .env-example .env && php artisan key:generate && php artisan migrate --seed && php artisan serve

## Consultas SQL

-- Producto con Mayor Stock
SELECT * FROM `products` ORDER BY stock DESC LIMIT 1;

-- Producto con Mayor Ventas
SELECT p.id, p.nombre, SUM(cantidad) FROM `transactions` t JOIN products p ON t.product_id = p.id GROUP BY p.id ORDER BY 3 DESC LIMIT 1;


