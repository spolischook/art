#!/usr/bin/env bash

STEP=$1

case $STEP in
    before_install)
        wget https://phar.phpunit.de/phpunit.phar
        chmod +x phpunit.phar
        php phpunit.phar --version
    ;;
    install)
        composer install
    ;;
    before_script)
    ;;
    script)
        php phpunit.phar --testsuite=unit --coverage-clover=coverage.clover
    ;;
    after_success)
    ;;
    after_failure)
    ;;
    after_script)
        wget https://scrutinizer-ci.com/ocular.phar
        php ocular.phar code-coverage:upload --format=php-clover coverage.clover
    ;;
esac
