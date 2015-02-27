Elao Talks
==========

Elao talks website

## Installation:

Install dependencies and build the `parameters.yml` file:
(you will be asked to provide the Youtube API key)

    composer install

Create the database:

    bin/console doctrine:database:create
    bin/console doctrine:schema:update --force

Import the videos from Youtube channel:

    bin/console import:videos

Build assets:

    gulp
