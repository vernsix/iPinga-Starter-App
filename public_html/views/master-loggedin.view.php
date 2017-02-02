<?php
defined('__VERN') or die('Restricted access');

/**
 * @var $template \ipinga\template
 * @var $content string
 *
 * This template expects...
 *
 * @var $template->user \ipinga\table
 * @var $template->message string
 * @var $template->manager \ipinga\manager
 * @var $template->loggedInUser \ipinga\userTable
 * @var $template->title string
 * @var $template->message_for_next_screen string
 * @var $template->skin string
 * @var $template->logo_url string
 * @var $template->subtitle string
 * @return string
 */

function MasterView($template,$content)
{

// ================= ERROR MESSAGE PANEL =================
    if ((isset($message) == true) && (empty($message) == false)) {
        $errorPanel = <<<PANEL

            \$("#error-message").html($template->message);
            \$("#error-panel").removeClass("hidden");

PANEL;
    } else {
        $errorPanel = '';
    }


// ================= RIBBONS =================
    $ribbonTop = <<<RIBBONTOP

    <div class="github-fork-ribbon-wrapper right">
        <div class="github-fork-ribbon">
            <a href="http://hospicesource.net">Semaphore</a>
        </div>
    </div>
    <div class="github-fork-ribbon-wrapper left">
        <div class="github-fork-ribbon">
            <a href="http://hospicesource.net">Semaphore</a>
        </div>
    </div>

RIBBONTOP;

    $ribbonBottom = <<<RIBBONBOTTOM

    <div class="github-fork-ribbon-wrapper right-bottom">
        <div class="github-fork-ribbon">
            <a href="http://iPinga.com">Testing</a>
        </div>
    </div>
    <div class="github-fork-ribbon-wrapper left-bottom">
        <div class="github-fork-ribbon">
            <a href="http://iPinga.com">Testing</a>
        </div>
    </div>

RIBBONBOTTOM;


// ================= top banner =================
$topBanner = <<<topbanner
    
    <div id="top-banner">
        <div class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" style="padding: .5em;  position: relative;">
            <div style="float: left;">
                <a href="/"><img src="$template->logo_url"></a>
            </div>
            
            <div style="font-size: 80%; position: absolute; right: 1em; bottom: 1em;">
            
topbanner;

    if ($template->manager->isLoggedIn == true) {

        // heredocs get stupid with magic methods sometimes
        $firstName = $template->loggedInUser->first_name;
        $lastName = $template->loggedInUser->last_name;

        $topBanner .= <<<topbanner
            You are logged in as $firstName $lastName&nbsp;&nbsp;<a href="/logout">Logout</a>
topbanner;
    } else {
        $topBanner .= 'You are not currently logged in';
    }

$topBanner .= <<<topbanner
    
            </div>
            <div class="clear"></div>
        </div>
    </div>  <!-- top banner -->

topbanner;


// ================= A message being passed from somewhere else that needs to be displayed? =================
// notice I couldn't use the magic getter function for the call to isset
    if (isset($template->vars['message_for_next_screen']) == true) {
        $errorMsg = <<<MSG
        <p class="message">$template->message_for_next_screen</p>
MSG;
    } else {
        $errorMsg = '';
    }



// ================= left rail =================
$leftRail = <<<leftrail

<div id="layout-left-rail">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#accordion").accordion({
                'header': 'h3',
                'autoHeight': false,
                'animation': 'easyslide'
leftrail;

    // I dislike that isset() doesn't respect the getter function so have to use vars[] here...
    if (isset($template->vars['activePanel'])==true) {
        $leftRail .= <<<leftrail
                , 'active': $template->activePanel 
leftrail;
    }

$leftRail .= <<<leftrail
    
            });
        });
    </script>
    
    <ul id="accordion">
        <li>
            <h3><a>Main Menu</a></h3>
            <ul>
                <li><a href="/">Home</a></li>
            </ul>
        </li>
        <li>
            <h3><a>Account</a></h3>
            <ul>
                <li><a href="/password/change">Change Password</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </li>
    </ul>

</div>    
leftrail;


    $html = <<<HTML

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

    <title>$template->title</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery UI styles -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/$template->skin/jquery-ui.css" id="theme">
    
    <!-- use the following to load custom themeroller skins -->
    <!-- <link rel="stylesheet" href="/jquery-ui-1.11.4.custom/jquery-ui.css" id="theme"> -->

    <!-- Vern's style -->
    <link type="text/css" rel="stylesheet" href="/css/style.css?version=3"/>

    <!-- main jquery js library -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- jqueryui js library -->
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    
    <!-- use the following to load custom themeroller skins -->
    <!-- <script src="/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function () {
            $(".button").button();
            $errorPanel
        });
    </script>

    <link rel="stylesheet" href="/css/gh-fork-ribbon.css">

</head>

<body>

$ribbonTop

<div id="layout-container">

    $topBanner
    
    $leftRail

    <div id="layout-content">
        <div class="ui-widget ui-widget-content ui-corner-all pad10 min-height-400 margin_bot10">    
    
            <h2>$template->subtitle</h2>
            <div class="clear"></div>

            <div id="errorPanelWrapper" style="margin-left: 10px; margin-right: 10px;">
               <div id="error-panel-wrapper">
                    <div class="clear"></div>
                    <div id="error-panel" class="hidden ui-widget ui-state-highlight ui-corner-all">
                        <span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                        <span id="error-message"></span>
                    </div>
               </div>
            </div>

            $errorMsg
                    
<!-- content block - start -->
$content
<!-- content block - end -->
                    
            <div class="clear"></div>

        </div>  <!-- ui-widget -->  

    </div> <!-- layout-content -->
    
    <div class="clear"></div>

    <div id="bottom-banner">
        <div class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all small-text"
             style="padding: .5em; text-align:center;">
            <div style="text-align: center;">
                &copy; 2015-<?= date("Y"); ?> by Hospice Source LLC. All rights reserved.
            </div>
        </div>
    </div>
    <br/><br/>

    $ribbonBottom

</div>
</body>

</html>
HTML;


    return $html;
}

