# API Interview App

This is a simple app that provides an API to enter and fetch todos

## Prerequisites

You will need the following things properly installed on your computer

- [Git](https://git-scm.com)
- [Docker](https://docs.docker.com/install/)
- [Composer](https://getcomposer.org)

## Installation

- `git clone <repository-url> this repository`
- `cd api-interview`
- `composer install`

## Running / Development

- `cd docker ; docker-compose up`
- Ensure the database is up to date `bin/console doctrine:migrations:migrate`
- The API endpoints will be available at http://localhost:8080
- Try an endpoint `curl http://localhost:8080/todos --header 'Accept: application/vnd.api+json'`
- Interact with the symfony console `bin/console`

## Running Tests

- Linting `vendor/bin/phpcs`
- Static analysis `vendor/bin/phpstan analyse src`
- Unit tests `vendor/bin/phpspec run`
- Acceptance tests `vendor/bin/behat`
  - _note:_ Ensure the test database is created and migrated before running behat
  - `bin/console doctrine:database:create --env test --if-not-exists`
  - `bin/console doctrine:migrations:migrate --env test --no-interaction`

## Further Reading / Useful Links

- [Symfony](https://symfony.com)
- [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html)
- [phpspec](https://www.phpspec.net/en/stable/)
- [Behat](https://docs.behat.org/en/latest/)
