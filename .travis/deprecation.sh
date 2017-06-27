#!/usr/bin/env bash

STEP=$1

case $STEP in
    before_install)
    ;;
    install)
    ;;
    before_script)
    ;;
    script)
        git clone https://github.com/sensiolabs-de/deprecation-detector.git $TRAVIS_BUILD_DIR/deprecation-detector
        cd $TRAVIS_BUILD_DIR/deprecation-detector
        composer install
        ./bin/deprecation-detector check $TRAVIS_BUILD_DIR/src $TRAVIS_BUILD_DIR/composer.lock --fail
    ;;
    after_success)
    ;;
    after_failure)
    ;;
    after_script)
    ;;
esac
