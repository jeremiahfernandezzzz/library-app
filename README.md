First, make sure you have git, php & composer installed,
then paste the ff onto your terminal:

```
git clone https://github.com/jeremiahfernandezzzz/library-app
cd library-app
composer create-project
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console server:run
```

then, go to http://localhost:8000
