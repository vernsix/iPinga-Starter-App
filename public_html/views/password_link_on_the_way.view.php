<?php
defined('__VERN') or die('Restricted access');

/** @var \ipinga\template $this */
/** @var \ipinga\userTable $loggedInUser defined in project controller */
/** @var \ipinga\defaultHtmlGenerator $h */

$this->subtitle = 'Password Recovery';
$this->include_file('master-notloggedin.view');

$content = <<<CONTENT
    <div style="margin: 5px auto; text-align: center">
        <br/>
        <h2>Please check your email for a link to reset your password</h2>
        <br/>
    </div>
CONTENT;

echo MasterView($this,$content);