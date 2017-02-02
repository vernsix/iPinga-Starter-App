<?php
defined('__VERN') or die('Access prohibited');

/** @var \ipinga\template $this */
/** @var \ipinga\userTable $loggedInUser defined in project controller */
/** @var \ipinga\defaultHtmlGenerator $h */

$this->subtitle = 'Error #404 - Page Not Found!';
$this->include_file('master-notloggedin.view');

if (isset($_GET['rt']) == true) {
    $rt = $_GET['rt'];
} else {
    $rt = 'None';
}

$content = <<<html
    <h2>OOPS!  404 Not Found - test</h2>
    <p>Well, this is down right embarrassing.</p>
    <p>Requested route: $rt</p>
    <div class="clear"></div>

html;

echo MasterView($this, $content);


