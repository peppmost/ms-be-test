
Students
=======

```sh
$ git clone https://github.com/peppmost/ms-be-test.git .
$ composer install
$ php ./bin/console assetic:dump --env=prod --no-debug
```
<b>Test</b>

```sh
$ php ./bin/console doctrine:database:create --env=test --if-not-exists && php ./bin/console doctrine:schema:drop --force --env=test && php ./bin/console doctrine:schema:create --env=test && php ./bin/console doctrine:schema:update --force --env=test && php ./bin/console doctrine:fixtures:load --env=test --no-interaction
$ ./vendor/bin/phpunit
```

![Alt text](https://image.ibb.co/fBvGsH/Istantanea_09042018_16_44_38.png "Lista Studenti")

![Alt text](https://image.ibb.co/cDgpCH/Istantanea_09042018_16_45_14.png "Nuovo Studente")

![Alt text](https://image.ibb.co/hbZ9CH/Istantanea_09042018_16_45_52.png "Modifica Studente")
