<?php
defined('__VERN') or die('Restricted access');

Class vernController extends project_controller
{

    public function index()
    {
        die('vern/index killed it!');
    }

    public function dummy()
    {
        \ipinga\log::emergency(var_export($_POST,true));
    }

    public function showinfo()
    {
        die( phpinfo() );
    }

    public function echoPost()
    {
        $this->json = $_POST;
        $this->SendJSON();
    }

}