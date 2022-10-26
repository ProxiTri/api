# Instructions à suivre pour tester

## 1. Reconstruire la base de données _TEST_

```bash
php bin/console doctrine:database:drop --force --env=test
php bin/console doctrine:database:create --env=test
php bin/console doctrine:schema:update --force --env=test
```

## 2. Effectuer un load des Fixtures

```bash
php bin/console doctrine:fixtures:load --env=test
```

## 3. Lancer les tests

```bash
php bin/phpunit
```