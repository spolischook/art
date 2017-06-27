#!/usr/bin/env bash

STEP=$1

case $STEP in
    before_install)
    ;;
    install)
        composer install
    ;;
    before_script)
    ;;
    script)
        bin/phpcs ./src --standard=PSR2 --extensions=php -p
    ;;
    after_success)
    ;;
    after_failure)
    ;;
    after_script)
    ;;
esac
