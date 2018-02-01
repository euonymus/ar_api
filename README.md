# MEMO
API feature relys on the method below

    http://www.bravo-kernel.com/2015/04/how-to-build-a-cakephp-3-rest-api-in-minutes/

This application uses CakePHP plugin Crud and JSON Web Tokens' auth.

    Crud: https://github.com/FriendsOfCake/crud
    JWT auth: https://plugins.cakephp.org/p/1764-cakephp-jwt-auth

# Requirement

* PHP7.1+
* composer
* MySQL5.7+


# Prepare the application source

    $ cd /{source_dir_path}
    $ git checkout master
    $ composer install

# Prepare Databae

    Build MySQL database
    Build MySQL user (password is in config/app.php)

# Prepare Tables

    $ cd /{source_dir_path}
    $ bin/cake migrations migrate

# Run local server

    $ cd /{source_dir_path}
    $ bin/cake server
