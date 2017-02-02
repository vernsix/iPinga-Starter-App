<?php
defined('__VERN') or die('Restricted access');

Class defaultController extends project_controller
{

    public function getItDone()
    {
        $this->template->show('you_bother_me_boy');
    }

    public function error404()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        $this->template->show('error404');
    }

    public function index()
    {
        $this->template->show('default');
    }


}

?>