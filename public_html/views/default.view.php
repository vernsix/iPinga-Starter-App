<?php
defined('__VERN') or die('Access prohibited');

/** @var \ipinga\template $this */
/** @var \ipinga\userTable $loggedInUser defined in project controller */
/** @var \ipinga\defaultHtmlGenerator $h */

$this->subtitle = 'Welcome';
$this->include_file('master-loggedin.view');

$content = '<p>Welcome to the startup website.</p>';

echo MasterView($this,$content);
