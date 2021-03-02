```
composer install
```
```
cp .env.example .env #if you don't have .env yet
```
```
php artisan config:clear
php artisan migrate --seed
```
Set to your cron (don't forget to set path to artisan)
```
* * * * * php /path/to/artisan schedule:run >>/dev/null 2>&1
```