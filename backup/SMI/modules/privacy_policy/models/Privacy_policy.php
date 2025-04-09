<?php

defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(1);

class Privacy_policy_model extends CI_Model
{

    public function __construct()

    {

        parent::__construct();

        $this->load->model(array('viewcart/Main_model'));

    }


    /**
     * Method index() redirects to the Comming Soon area.
     * @access    public
     * @param    Null
     * @return    null
     */

    

}

