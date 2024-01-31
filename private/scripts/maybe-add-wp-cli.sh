#!/usr/bin/env bash

if [ ! -e /usr/local/bin/wp ]; then
  curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
  chmod +x wp-cli.phar
  mv -n wp-cli.phar /usr/local/bin/wp
fi
