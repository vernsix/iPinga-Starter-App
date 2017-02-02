<?php

// uncomment the next three lines for wicked error display/tracking
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

if (isset($_SERVER['WEBSITE_ENVIRONMENT'])==true) {
    require_once $_SERVER['WEBSITE_ENVIRONMENT']. '-config.php';
} else {
    require_once 'config.php';
}

// just a little added security to make sure someone doesn't call views, etc manually
define('__VERN', true);

$iPinga = new \ipinga\ipinga(
    array_merge(
        array(
            'manager.expired_url' => '/login',
            'manager.ip_changed_url' => '/login',
            'manager.login_url' => '/login',
            'manager.max_minutes' => 10
        ),
        config()
    )
);

// if we are using an options table, this is handy...
// if (isset($_SERVER['WEBSITE_ENVIRONMENT'])==true) {
//     \ipinga\options::$environment = $_SERVER['WEBSITE_ENVIRONMENT'];
// }

// define all the routes...

$iPinga->addGetRoute('login', 'login', 'index', null, '1');
$iPinga->addPostRoute('login', 'login', 'post', null, '2');

$iPinga->addGetRoute('password/change', 'password', 'change', 'mustBeLoggedIn', '3');
$iPinga->addPostRoute('password/change', 'password', 'post_change', 'mustBeLoggedIn', '4');

$iPinga->addGetRoute('password/forgot', 'password', 'forgot', null, '5');
$iPinga->addPostRoute('password/forgot', 'password', 'post_forgot', null, '6');

$iPinga->addGetRoute('password_reset/$1', 'password', 'reset', null, '7');
$iPinga->addPostRoute('password_reset', 'password', 'reset_new', null, '8');

$iPinga->addGetRoute('logout', 'logout', 'index', null, '9');
$iPinga->addPostRoute('logout', 'logout', 'index', null, '9');

$iPinga->addGetRoute('', 'default', 'index', 'mustBeLoggedIn', '10');

$iPinga->defaultRoute('default', 'error404');

\ipinga\log::setThreshold( 0 ); // log everything

$iPinga->run();
