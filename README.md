## Symfony4 application

The project use symfony 4 as a PHP framework.

## Get started

##### Clone the project

    $ git clone https://github.com/dhvarela/sf4-storm
    $ cd sf4-storm

##### Pass the composer

    $ composer install

Now you need to config your .env file with your database credentials

Eg: 

    DATABASE_URL=mysql://root:pass@127.0.0.1:3306/sf4storm
    
##### Load fixtures
 
    $ php bin/console doctrine:fixtures:load

##### Run the server
 
    $ php bin/console server:run

 
#### Launch the Symfony application!

You can simply launch the application in 
http://localhost:8000

