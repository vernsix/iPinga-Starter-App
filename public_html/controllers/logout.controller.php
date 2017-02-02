<?php
defined('__VERN') or die('Restricted access');


Class logoutController extends \project_controller
{

    /**
     * This is the method that handles the form post for login
     */
    public function index()
    {
        \ipinga\ipinga::getInstance()->manager->logout();
        header('location: /');
    }


}