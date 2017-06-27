#!/usr/bin/env bash

STEP=$1

case $STEP in
    before_install)
        export DISPLAY=:99.0
        sh -e /etc/init.d/xvfb start
        curl -L https://selenium-release.storage.googleapis.com/3.4/selenium-server-standalone-3.4.0.jar -o $HOME/bin/selenium.jar
        #  chrome driver
        curl -L http://chromedriver.storage.googleapis.com/2.29/chromedriver_linux64.zip -o $HOME/bin/chromedriver_linux64.zip
        unzip $HOME/bin/chromedriver_linux64.zip -d $HOME/bin/
        #  geckodriver
        #  curl -L https://github.com/mozilla/geckodriver/releases/download/v0.17.0/geckodriver-v0.17.0-linux64.tar.gz -o   $HOME/bin/geckodriver-v0.17.0-linux64.tar.gz
        #  tar -xzf $HOME/bin/geckodriver-v0.17.0-linux64.tar.gz -C $HOME/bin
        #  run selenium with chromedriver
        java -Dwebdriver.gecko.driver=$HOME/bin/chromedriver -jar $HOME/bin/selenium.jar -log /tmp/webdriver.log > /tmp/webdriver_output.log 2>&1 &
        #  run selenium with geckodriver
        #  java -Dwebdriver.gecko.driver=$HOME/bin/geckodriver -jar $HOME/bin/selenium.jar -log /tmp/webdriver.log > /tmp/webdriver_output.log 2>&1 &
    ;;
    install)
        composer install
        $TRAVIS_BUILD_DIR/.travis/nginx/install-nginx.sh
        $TRAVIS_BUILD_DIR/bin/console doctrine:database:create
        $TRAVIS_BUILD_DIR/bin/console doctrine:schema:create
        curl -X GET "http://localhost:8080/app.php/admin/dashboard"|tail -n 200
    ;;
    before_script)
    ;;
    script)
        bin/behat -p selenium2 -vvv
    ;;
    after_success)
    ;;
    after_failure)
        cat /tmp/webdriver.log
        cat /tmp/webdriver_output.log
        cat $TRAVIS_BUILD_DIR/var/logs/prod.log
    ;;
    after_script)
    ;;
esac
