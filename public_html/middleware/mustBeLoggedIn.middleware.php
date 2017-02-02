<?php

Class mustBeLoggedInMiddleware extends \ipinga\middleware {

    public function call()
    {
        $mgr = \ipinga\ipinga::getInstance()->manager;
        $mgr->userIsLoggedIn(true);        // determine if the user is logged in or not
        // die('<pre>'. var_export($mgr,true));
        return $mgr->isLoggedIn;

    }
}

?>