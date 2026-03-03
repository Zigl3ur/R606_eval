#!/bin/sh

php bin/doctrine migrations:migrate --no-interaction && apache2-foreground
