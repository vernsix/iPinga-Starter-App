<?php
defined('__VERN') or die('Restricted access');

Class passwordController extends project_controller
{

    public function index()
    {
        die('oops. password.index');
    }

    public function change()
    {
        $this->template->activePanel = 1;
        $this->template->show('password.edit.form');
    }

    public function post_change()
    {
        $v = new \ipinga\validator($_POST, true);
        $v->checkPassword('passwd1', 'Password', 4, 20, true, false);
        $v->checkMatch('passwd1', 'passwd2', 'Passwords');
        if (empty($v->message) == false) {
            $this->template->message = 'Please fix input errors.';
            $this->template->activePanel = 1;
            $this->template->show('password.edit.form');
        } else {
            $this->template->loggedInUser->passwd = $_POST['passwd1'];
            $this->template->loggedInUser->save();
            header('location: /logout');
        }
    }

    public function forgot()
    {
        $this->template->show('password.forgot.form');

    }

    public function post_forgot()
    {

        $u = new \ipinga\userTable('users');
        $u->loadByEmail($_POST['email']);

        if ( $u->saved === true ) {

            $contents = array();
            $contents['u'] = $u->id;
            $contents['t'] = \ipinga\log::$instanceName;

            $link = \ipinga\options::get('website_url'). '/password_reset/'. \ipinga\crypto::printableEncrypt($contents);

            // \services::sendEmail() only knows about token replacements from database and I didn't want to rewrite it
            $body = str_replace( ':link:', $link, \ipinga\options::get('password_email_body') );

            \services::sendEmail(
                array($u->email),
                \ipinga\options::get('password_email_subject'),
                $body,
                $u
            );

            $this->template->show('password_link_on_the_way');

        } else {

            // bad email address
            \ipinga\cookie::add('message_for_next_screen', 'Email address not found');
            header('location: /login');

        }

    }

    public function reset($link)
    {
        $linkData = $this->linkData($link);
        if ($linkData['error']>0) {
            \ipinga\cookie::add('message_for_next_screen', $linkData['message']);
            header('location: /login');
        } else {
            $this->template->user = $linkData['user'];
            $this->template->link = $link;
            $this->template->show('password.reset.form');
        }
    }

    public function reset_new()
    {
        $linkData = $this->linkData($_POST['link']);
        if ($linkData['error'] > 0) {
            \ipinga\cookie::add('message_for_next_screen', $linkData['message']);
            header('location: /login');
        } else {
            $v = new \ipinga\validator($_POST, true);
            $v->checkPassword('passwd1', 'Password', 4, 20, true, false);
            $v->checkMatch('passwd1', 'passwd2', 'Passwords');
            if (empty($v->message) == false) {
                $this->template->message = 'Please fix input errors.';
                $this->template->user = $linkData['user'];
                $this->template->link = $_POST['link'];
                $this->template->show('password.reset.form');
            } else {
                /** @var \ipinga\userTable $u */
                $u = $linkData['user'];
                $u->passwd = $_POST['passwd1'];
                $u->save();
                \ipinga\cookie::add('message_for_next_screen', 'Your password has been changed.  You may now login.');
                header('location: /login');
            }
        }
    }

    public function linkData($link)
    {
        $results = array();

        $contents = \ipinga\crypto::printableDecrypt($link);
        if (is_array($contents)==true) {

            $linkUserId = $contents['u'];
            $linkTime   = (float)$contents['t'];

            $t = \ipinga\options::get('password_link_timeout');
            if (empty($t)==true) {
                $timeout = 10;
            } else {
                $timeout = (float)$t;
            }

            $now = (float)microtime(true);
            $elapsedMinutes = ( $now - $linkTime ) / 60;

            if ($elapsedMinutes>$timeout) {
                $results['error'] = 1;
                $results['message'] = 'Password reset link has expired';
            } else {
                $results['error'] = 0;
                $results['message'] = 'No error.  Link is good.';
                $u = new \ipinga\userTable('users');
                $u->loadById($linkUserId);
                $results['user'] = $u;
            }

        } else {
            $results['error'] = 2;
            $results['message'] = 'Password reset link is invalid';
        }

        return $results;

    }


}
