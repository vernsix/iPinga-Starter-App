<?php
/*
 *
 * This is a example of the configuration file, that you must create.  You can set any of the iPinga config options
 * here, but at a minimum you should set mysql.user, mysql.password, mysql.database and logfile
 *
 * Under normal circumstances, you will want to rename this file to config.php or environment-config.php if you are
 * using environments.  The word "environment" should be replaced with whatever name you are using for your environment
 *
 */
function config()
{
    return array(
        'mysql.user' => 'database_user',
        'mysql.password' => 'database_password',
        'mysql.database' => 'database_name',
        'logfile' => '/var/www/html/logfile.php'
    );
}

?>