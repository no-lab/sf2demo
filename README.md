# Symfony demo


## Install

- Clone repo
- Install dependencies via composer
- Edit parameters.yml
- Run doctrine migration

    > php app/console doctrine:database:create

    > php app/console doctrine:schema:update --force


## TODO:

- FrontOffice:
    - Add a flash message after successfully created a new invoice
    - Repopulate form 'create new invoice'
    - Fix required on select2 fields
    - Validate form: Create invoice
- BackOffice:
    - Email time tester: Avoid unnecessary ajax call
    - Handle path to 'calendar.ics' correctly
- EmailPlanner:
    - Handle timezone
    - Add more tests
- Extra:
    - config travis-ci


## Tests:

> phpunit -c app/ src/BackOfficeBundle/Tests/Utils/
