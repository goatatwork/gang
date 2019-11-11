#!/usr/bin/env bash
# 20191108 goat
#

set -e

role=${CONTAINER_ROLE:-cronish}
env=${APP_ENV:-local}

# if [ "$env" == "local" ]; then
#     echo "Environment is 'local'...clear for take off."
# else
#     echo "I am only configured for the 'local' environment..."
# fi

# if [ "$role" == "cronish" ]; then
#     echo "CONTAINER_ROLE is set to 'cronish'...clear for take off."
# else
#     echo "I only work when CONTAINER_ROLE is equal to 'cronish'"
# fi

if [ "$env" == "local" ]; then
    if [ "$role" == "cronish" ]; then

        while [ true ]
        do
          php artisan schedule:run --verbose --no-interaction &
          sleep 60
        done

    else
        echo "env is good but role is jacked"
    fi
else
    echo "I dont know what the fuck is going on."
fi
