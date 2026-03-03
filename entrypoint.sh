#!/bin/sh

php bin/doctrine migrations:migrate --no-interaction && php bin/load-fixtures && apache2-foreground
