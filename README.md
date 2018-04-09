
Students
=======

$ git clone https://github.com/peppmost/ms-be-test.git .<br>
$ composer install<br>
$ php ./bin/console assetic:dump --env=prod --no-debug<br>

<b>Test</b>

$ php ./bin/console doctrine:database:create --env=test --if-not-exists && php ./bin/console doctrine:schema:drop --force --env=test && php ./bin/console doctrine:schema:create --env=test && php ./bin/console doctrine:schema:update --force --env=test && php ./bin/console doctrine:fixtures:load --env=test --no-interaction
$ ./vendor/bin/phpunit