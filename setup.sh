#!/bin/bash

echo "-----------------------------------------"
echo "   YIPL Library Management API Setup    "
echo "-----------------------------------------"

if ! command -v php &> /dev/null
then
    echo "PHP not found! Please install PHP to proceed."
    exit 1
fi

if ! command -v composer &> /dev/null
then
    echo "Composer not found! Please install Composer to proceed."
    exit 1
fi

if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env
else
    echo ".env file already exists. Skipping..."
fi


echo "Installing dependencies..."
composer install

echo "Creating a db file..."
touch database/database.sqlite
echo "Generating app key..."
php artisan key:generate
echo "Migrating database and seeding data..."
php artisan migrate --seed
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
echo "-----------------------------------------"
echo "Setup complete!"
echo "Run the development server with:"
echo "  php artisan serve"
echo "Visit: http://127.0.0.1:8000"
echo "-----------------------------------------"
