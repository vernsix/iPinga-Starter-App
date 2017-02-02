<?php
defined('__VERN') or die('Restricted access');

Class services
{

    // Just another (stronger) password policy.
    public static function checkPassword($password)
    {

        $errmsg = '';
        if (strlen($password) < 8) {
            $errmsg .= '<div>Passwords must be at least 8 characters long.</div>';

        }
        if (preg_match_all('/[[:digit:]]/u', $password) < 1) {
            $errmsg .= '<div>Passwords must have at least 1 digit(s).</div>';

        }
        if (preg_match_all('/[[:lower:]]/u', $password) < 1) {
            $errmsg .= '<div>Passwords must have at least 1 lower case letter(s).</div>';

        }
        if (preg_match_all('/[[:upper:]]/u', $password, $matches) < 1) {
            $errmsg .= '<div>Passwords must have at least 1 upper case letter(s).</div>';

        }
        if (preg_match_all('/[^[:upper:][:lower:][:digit:]]/u', $password, $matches) < 1) {
            $errmsg .= '<div>Passwords must have at least 1 non-alphanumeric character(s).</div>';
        }

        return $errmsg;
    }


    /**
     * @param $recipients array
     * @param $subject string
     * @param $body string
     */
    public static function sendEmail( $recipients, $subject, $body )
    {
        \ipinga\email::$host = \ipinga\options::get('email_host');
        \ipinga\email::$port = (int)\ipinga\options::get('email_port');

        \ipinga\log::debug( 'option email_auth = [' . \ipinga\options::get('email_auth') . ']');
        if ( strtolower(\ipinga\options::get('email_auth')) == 'yes' ) {
            \ipinga\email::$auth = true;
            \ipinga\email::$username = \ipinga\options::get('email_username');
            \ipinga\email::$password = \ipinga\options::get('email_password');
        } else {
            \ipinga\email::$auth = false;
            \ipinga\email::$username = '';
            \ipinga\email::$password = '';
        }

        \ipinga\email::$localhost = \ipinga\options::get('email_localhost');
        \ipinga\email::$timeout = (int)\ipinga\options::get('email_timeout');
        \ipinga\email::$debug = false;

        \ipinga\email::$from = \ipinga\options::get('email_from');
        \ipinga\email::$recipients = $recipients;
        // \ipinga\email::$bcc[] = 'vernsix@gmail.com';
        \ipinga\email::$subject = $subject;
        \ipinga\email::$textBody = $body;
        // \ipinga\email::$htmlBody = '';

        $success = \ipinga\email::send();

        if ($success===true) {
            \ipinga\log::info('(services.sendEmail) success!');
        } else {
            \ipinga\log::warning('(services.sendEmail) failed to send email to '. var_export($recipients,true));
        }

    }


}
