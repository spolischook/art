#!/usr/bin/env bash

if [ ! -d $HOME/travis_phantomjs ]; then
    mkdir $HOME/travis_phantomjs;
    wget https://assets.membergetmember.co/software/phantomjs-2.1.1-linux-x86_64.tar.bz2 \
        -O $HOME/travis_phantomjs/phantomjs-2.1.1-linux-x86_64.tar.bz2;
    tar -xvf $HOME/travis_phantomjs/phantomjs-2.1.1-linux-x86_64.tar.bz2 -C $HOME/travis_phantomjs;
fi

$HOME/travis_phantomjs/phantomjs-2.1.1-linux-x86_64/bin/phantomjs --webdriver=8643 --ignore-ssl-errors=true --disk-cache=true > /dev/null 2>&1 &
sed -i -e 's/^      base_url:.*$/      base_url: "http:\/\/localhost:8080\/app.php"/g' $TRAVIS_BUILD_DIR/behat.yml
