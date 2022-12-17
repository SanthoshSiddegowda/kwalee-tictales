# Kwalee - Tictales
---
The goal of tictales is to create and share the best stories through an interactive story experience. 

### Requirements
---
Only things needed are  `docker` and `composer` to be installed and enabled.

### Installation
---
Before Starting we need to configure few steps as mentioed. copy the env files.run this command in your project root:
```sh
cp .env.example .env
```
Generate application key for laravel
```sh
php artisan key:generate
```

The best and easiest way to install is using the Composer package manager. To do so, run this command in your project root:

```sh
composer install
```

Once done, we need to set up the laravel sail to the project

```sh
php artisan sail:install
```
Afert installation, we need to run this below command in terminal

```sh
./vendor/bin/sail up
```
> Note: In case of any query please refer this link attached [Laravel sail](https://laravel.com/docs/9.x/sail)

### Tech Documention
---
Please refer this for the database and api docs
https://evening-gorilla-928.notion.site/Kwalee-Tictales-3c3ef38a40014c7e9deb97c72576bf92
