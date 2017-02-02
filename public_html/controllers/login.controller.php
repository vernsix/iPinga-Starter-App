<?php
defined('__VERN') or die('Restricted access');


Class loginController extends \project_controller {

    public function index()
    {
        $this->template->show('login.form');
    }

    public function post()
    {
        $v = new \ipinga\validator($_POST,true);
        $v->checkEmail('email', 'E-Mail Address', true);
        $v->checkPassword('passwd', 'Password', 4, 20, true, false);

        if (empty($v->message) == false) {
            $this->template->message = 'Please fix input errors.';
            $this->template->show('login.form');
        } else {


            if (\ipinga\acl::authenticate($_POST['email'],$_POST['passwd']) == true) {

                // user provided good credentials
                \ipinga\ipinga::getInstance()->manager->update( \ipinga\acl::$userTable->id );
                header('location: /');

            } else {

                // user blew it
                $this->template->message_for_next_screen = 'Login Failed: Either your email address or password is incorrect.';
                $this->template->show('login.form');

            }
        }
    }




}

