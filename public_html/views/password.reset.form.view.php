<?php
defined('__VERN') or die('Restricted access');

/** @var \ipinga\template $this */
/** @var \ipinga\userTable $loggedInUser defined in project controller */
/** @var \ipinga\defaultHtmlGenerator $h */
/** @var $link string */

$this->subtitle = 'Password Recovery';
$this->include_file('master-notloggedin.view');

$h = $this->html;   // shorthand

$content = <<<CONTENT
<br/>Please enter your new password in the space provided below.<br/><br/>
<form action="/password_reset" method="post">
    <input type="hidden" name="link" id="link" value="$link">
CONTENT;

$h->defaults(array(
    'table' => $loggedInUser,
    'checkpostvars' => true,
    'showhints' => true,
    'label_style' => 'display: inline-block; width: 180px;',
    'clearAtEnd' => true,
    'hint_style' => 'margin-left:192px'
));

$h->field(array(
    'type'=>'password',
    'name' => 'passwd1',
    'field_name' => 'passwd',
    'label' => 'Desired Password *',
    'maxlength' => 50,
    'style' => 'width: 250px;'
));

$h->field(array(
    'type'=>'password',
    'name' => 'passwd2',
    'field_name' => 'passwd',
    'label' => 'Confirm Password *',
    'maxlength' => 50,
    'style' => 'width: 250px;'
));

$content .= $h->output;

$content .= <<<CONTENT
    <br/>
    <button class="button">Reset Password</button>
</form>
CONTENT;

echo MasterView($this,$content);

