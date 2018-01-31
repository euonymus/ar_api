# MEMO
API feature fully relys on the method below
http://www.bravo-kernel.com/2015/04/how-to-build-a-cakephp-3-rest-api-in-minutes/


# Requirement

* PHP
* composer
* MySQL


# Prepare the application source

    $ cd /{source_dir_path}
    $ git checkout master
    $ rm -fr vendor/j7mbo
    $ composer install

※vendor/j7mbo/twitter-api-php が上手くgit管理できないため

# Prepare Databae

    Build MySQL database named 'twinavitopics'
    Build MySQL user named 'twinavitopics' (password is in config/app.php)

# Prepare Tables

    $ cd /{source_dir_path}
    $ bin/cake migrations migrate

# Prepare Table Datas

    $ mysql -utwinavitopics -p{password} twinavitopics < /{source_dir_path}/vendor/twinavi/data/init_twusers.sql
    $ mysql -utwinavitopics -p{password} twinavitopics < /{source_dir_path}/vendor/twinavi/data/init_word_patterns.sql
    $ mysql -utwinavitopics -p{password} twinavitopics < /{source_dir_path}/vendor/twinavi/data/init_tn_authors.sql


# Run local server

    $ cd /{source_dir_path}
    $ bin/cake server
