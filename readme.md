# Background Information

The foundation project created with CodeIgniter 3.0. It integrates the Doctrine ORM and also integrated Symfony Dependency Injection Component for providing access to service container.

## Setup

1. Download the repository or clone.
2. Run `composer update` command in terminal from project's root directory.
3. Adjust the database parameters and other config variables. Copy the `config.php.inc` and `database.php.inc`, then replace .inc extension.
4.Test module is setup at `blog\post` , point your browser at `http://localhost/ci-hmvc-doctrine/index.php/blog/post`.

## Using Doctrine

This projects by default has been configured to use doctrine so, you can call `$this->doctrine->em` to get instance of entity manager and entity classes must be at `modules/module_name/models/` folder.

You can access the console command from `bin/console`, explore and you will see the command to generate database tables from the entity class.

## Registering Services

To register service inside modules, use `modules/module_name/services/services.yml` directory and do as of demo or go through Symfony dependency component.
And, you can access container as `$this->container->get('service_name')` from the controller class.


`Happy Coding and built great apps with CodeIgniter.`