#!/usr/bin/env bash

#create or update db
# /waitfor faded-db:3306 -t 90

# php /app/bin/doctrine.php migrations:migrate --no-interaction --allow-no-migration

# start apache
apache2-foreground
