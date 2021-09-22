# Bagisto Media Manager
![Packagist Downloads](https://img.shields.io/packagist/dt/ridhima/mediamanager) ![Packagist License](https://img.shields.io/packagist/l/ridhima/mediamanager)

This extension integrates [barryvdh/laravel-elfinder](https://github.com/barryvdh/laravel-elfinder) media manager.

## Requirements
- [Bagisto](https://github.com/bagisto/bagisto)

## Installation

### Install with composer

Require this package with Composer

	composer require ridhima/mediamanager

Add the ServiceProvider to the providers array in **config/app.php**

```php
Ridhima\MediaManager\Providers\MediaManagerServiceProvider::class
```

Run below commands before publishing assets to the public folder:
```
composer dump-autoload
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan storage:link
```

Run below artisan command to download the required assets files to the public folder

	php artisan mediamanager:publish

Remember to publish the assets after each update (or add the command to your post-update-cmd in composer.json)

Run below command to publish config and additional assets files to make it compatible with Bagisto backend theme

	php artisan vendor:publish --provider='Ridhima\MediaManager\Providers\MediaManagerServiceProvider'

Add below lines of code in **config\filesystems.php** to add a new disk.
```
'mediamanager' => [
    'driver' => 'local',
    'root'   => storage_path('app/public/media'),
]
```

In your config/elfinder.php, you can change the default folder, the access callback or define your own roots.
Rest of the configuration details are mentioned in [barryvdh/laravel-elfinder](https://github.com/barryvdh/laravel-elfinder) media manager.

### Install with package folder
1. Unzip all the files to **packages/Ridhima/MediaManager**.
2. Run composer command to download the required package
```
composer require barryvdh/laravel-elfinder:^0.4.7
```
3. Goto composer.json file inside the Bagisto root directory then add the following line under 'psr-4'
```
"Ridhima\\MediaManager\\": "packages/Ridhima/MediaManager/src"
```
4. Goto **config/app.php** file then add the following line under 'webkul packages'
```
Ridhima\MediaManager\Providers\MediaManagerServiceProvider::class
```
5. Run below commands before publishing assets to the public folder:
```
composer dump-autoload
php artisan config:clear
php artisan cache:clear
php artisan storage:link
```
6. Run below artisan command to download the required assets files to the public folder:
```
php artisan mediamanager:publish
```
7. After that run below command to publish config and additional assets files to make it compatible with Bagisto backend theme
```
php artisan vendor:publish --provider='Ridhima\MediaManager\Providers\MediaManagerServiceProvider'
```
8. Add below lines of code in **config\filesystems.php** to add a new disk.
```
'mediamanager' => [
    'driver' => 'local',
    'root'   => storage_path('app/public/media'),
]
```
Now you can manage the static media files from the dedicated section as well as from the editor.