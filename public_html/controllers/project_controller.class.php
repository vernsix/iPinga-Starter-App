<?php
defined('__VERN') or die('Restricted access');


Abstract class project_controller extends \ipinga\controller
{

    public function __construct()
    {
        parent::__construct();

        \ipinga\acl::$userTableName = 'users';
        \ipinga\acl::$usernameFieldName = 'email';

        $mgr = \ipinga\ipinga::getInstance()->manager;
        $mgr->userIsLoggedIn(false);        // determine if the user is logged in or not

        $u = new \ipinga\table('users');
        if ($mgr->isLoggedIn==true) {
            $u->loadById($mgr->loggedInDetails['USER_ID']);
            $mgr->update($u->id);
        }

        $this->template->loggedInUser = $u; // will be a bunch of null data if the user isn't logged in
        $this->template->manager = $mgr;
        $this->template->title = \ipinga\options::get('website_title');
        $this->template->logo_url = \ipinga\options::get('logo_url');
        $this->template->html->legacy = false;

        if (\ipinga\cookie::keyExists('message_for_next_screen')==true) {
            $this->template->message_for_next_screen = \ipinga\cookie::keyValue('message_for_next_screen');
            \ipinga\cookie::drop('message_for_next_screen');
        }

        $this->template->activePanel = 0;
//        $this->template->skin = \ipinga\options::get('skin');

    }

}

