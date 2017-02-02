<?php
defined('__VERN') or die('Restricted access');

// a little foghorn leghorn just for laughs!
echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/1jaSoo9hPi4?rel=0" frameborder="0" allowfullscreen></iframe>';

echo '<pre>'. PHP_EOL;
echo '$_GET= '. var_export($_GET,true). PHP_EOL. PHP_EOL;
echo '$_POST= '. var_export($_POST,true). PHP_EOL. PHP_EOL;
echo '$_FILES= '. var_export($_FILES,true). PHP_EOL. PHP_EOL;
echo 'ipinga routes= '. var_export(\ipinga\ipinga::getInstance()->routes,true). PHP_EOL. PHP_EOL;

