#!/bin/bash

composer --no-interaction install

phpenmod xdebug

# This wi
# ll exec the CMD from your Dockerfile, i.e. "npm start"
exec "$@"
