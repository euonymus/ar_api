# MEMO
API feature relys on the method below

    http://www.bravo-kernel.com/2015/04/how-to-build-a-cakephp-3-rest-api-in-minutes/

This uses vendor application Crud

    https://github.com/FriendsOfCake/crud

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
