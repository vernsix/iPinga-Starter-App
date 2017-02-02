<?php
defined('__VERN') or die('Restricted access');

/** @var \ipinga\template $this */
/** @var \ipinga\userTable $loggedInUser defined in project controller */
/** @var \ipinga\defaultHtmlGenerator $h */

$this->subtitle = 'Change Password';
$this->activePanel = 1;
$this->include_file('master-loggedin.view');

$h = $this->html;   // shorthand

$content = <<<content
    <form action="/password/change" method="post">
        <fieldset class="border1 ui-corner-all">
            <legend>New Password?</legend>
content;

$h->defaults(array(
    'table' => $loggedInUser,
    'checkpostvars' => true,
    'showhints' => true,
    'label_style' => 'display: inline-block; width: 180px;',
    'clearAtEnd' => true,
    'hint_style' => 'margin-left:192px'
));

$h->field(array(
    'type' => 'password',
    'name' => 'passwd1',
    'field_name' => 'passwd',
    'label' => 'Desired Password *',
    'maxlength' => 50,
    'style' => 'width: 325px;'
));

$h->field(array(
    'type' => 'password',
    'name' => 'passwd2',
    'field_name' => 'passwd',
    'label' => 'Confirm Password *',
    'maxlength' => 50,
    'style' => 'width: 325px;'
));

$content .= $h->output;

$content .= <<<content

        </fieldset>
        <div class="clear"></div>
        <div class="margin-t10">
            <button class="button">Change Password</button>
        </div>
    </form>

content;

echo MasterView($this,$content);