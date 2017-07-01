Art Project
====
[![Build Status](https://travis-ci.org/spolischook/art.svg?branch=master)](https://travis-ci.org/spolischook/art)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spolischook/art/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/spolischook/art/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/spolischook/art/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/spolischook/art/?branch=master)

Supper pretty and simple blog for artists.

Setup project
-------------

Clone the project, enter the directory and put into console:

```bash
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console server:start
```
