<?php
defined('__VERN') or die('Restricted access');

/** @var \ipinga\template $this */
/** @var \ipinga\userTable $loggedInUser defined in project controller */
/** @var \ipinga\defaultHtmlGenerator $h */

$this->subtitle = 'Please Login';
$this->include_file('master-notloggedin.view');

$h = $this->html;   // shorthand

$content = '<form action="/login" method="post">'. PHP_EOL;

$h->field(array(
    'table' => $loggedInUser,
    'field_name' => 'email',
    'label' => 'E-Mail Address',
    'checkpostvars' => true,
    'showhints' => true
));

$h->field(array(
    'table' => $loggedInUser,
    'field_name' => 'passwd',
    'label' => 'Password',
    'type' => 'password',
    'checkpostvars' => true,
    'showhints' => true
));

$content .= $h->output;

$content .= <<<CONTENT

    <br/>
    <a href="/password/forgot" class="small-text">Forgot Password? Click Here</a><br/>
    <br/><br/>

    <button class="button">Login</button>

</form>

CONTENT;

echo MasterView($this,$content);