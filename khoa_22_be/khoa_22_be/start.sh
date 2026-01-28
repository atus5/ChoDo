#!/bin/sh
set -e

echo "Starting Laravel application..."

# Wait for database to be ready
sleep 5

# Check if migrations table exists and has entries
if php artisan migrate:status > /dev/null 2>&1; then
    echo "Database already setup, skipping migrations..."
else
    echo "Database empty, running migrations and seeds..."
    php artisan migrate --force --seed
fi

echo "Server starting on 0.0.0.0:8000"
exec php artisan serve --host=0.0.0.0 --port=8000
