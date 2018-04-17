#!/bin/bash/
php artisan view:clear;
php artisan cache:clear;
php artisan route:cache;
php artisan serve --port 8016;
