# flex_recipes_api
This is a small php symfony flex based api back end. Using PHP Symfony based Flex as MVC and used Docker to install and run the application.

__Language :__ English 

# PHP Technical Task
Suggested recipes for lunch API

## User Story
As a User I would like to make a request to an API that will determine from a set of recipes what I can have for lunch today based on the contents of my fridge, so that I quickly decide what I’ll be having.

__Acceptance Criteria__
- Given that I have made a request to the `/lunch` endpoint I should receive a `JSON` response of the recipes 
that I can prepare based on the availability of ingredients in my fridge.
- Given that an ingredient is past its `use-by` date (inclusive), I should not receive recipes containing this ingredient.
- Given that an ingredient is past its `best-before` date (inclusive), but is still within its `use-by` date (inclusive), any recipe containing the oldest (less fresh) ingredient should placed at the bottom of the response object.

__Additional Criteria__
- The application SHOULD contains unit / integration tests (e.g. `PHPUnit`).
- The application MUST be completed using an `OOP` approach.
- The application MUST be `PSR` compliant.
- Any dependencies MUST be installed using `Composer` (no need to commit dependencies, the
composer.lock file will be sufficient).
- Use `PHP5.6` or `PHP7`.
- Any installation, build steps, testing and usage instructions MUST be provided in a `README.md` file in the root of the application.

## Framework
Use the `Symfony micro framework` Flex (https://symfony.com/doc/current/setup.html) to create the application API. 

## Application Data
For the purpose of this task, the application should simply read data from 2 x JSON files. The contents for these files can be found [here](src/App/Ingredient/data.json) and [here](src/App/Recipe/data.json).

## How to install
`git pull {repoaddress}`

## How to test
`cd code` from root folder
`sudo ./bin/phpunit`

## How to run
`sudo docker-compose up`

### at browser or at REST API client
http://localhost/api/lunch/{best-before}/{use-by}
eg. http://localhost/api/lunch/2019-03-07/2019-03-10

## issue regarding permission if any
`sudo chmod -R 775 code`
