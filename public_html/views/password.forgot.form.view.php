<?php
defined('__VERN') or die('Restricted access');

/** @var \ipinga\template $this */
/** @var \ipinga\userTable $loggedInUser defined in project controller */
/** @var \ipinga\defaultHtmlGenerator $h */

$this->subtitle = 'Password Recovery';
$this->include_file('master-notloggedin.view');

$h = $this->html;   // shorthand

$content = '<form action="/password/forgot" method="post">';

$h->field(array(
    'table' => $loggedInUser,
    'field_name' => 'email',
    'label' => 'E-Mail Address',
    'checkpostvars' => true,
    'showhints' => true
));

$content .= $h->output;

$content .= <<<CONTENT
    <br/><br/>
    <button class="button">Retrieve Your Password</button>
</form>
CONTENT;

echo MasterView($this,$content);
