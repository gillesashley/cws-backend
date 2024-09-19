#!/bin/sh

echo "Enter:"
echo "*1 for bare metal,"
echo "*2 for docker,"
echo "*0 to do nothing:"
read choice

case $choice in
    1)
        echo "Running on bare metal"
        # Add your bare metal commands here
        php artisan serve
        ;;
    2)
        echo "Running on Docker"
        # Add your Docker commands here
        npm run dev:dc

        ;;
    0)
        echo "Doing nothing"
        ;;
    *)
        echo "Invalid choice"
        ;;
esac
