<?php

defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(1);

class Solutions extends MY_Controller
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

    public function index()

    {

        $data['solutions'] = $this->Main_model->getdata_tablename_id('benefit_cms', 'id', '4');
		$data['sol_tab'] = $this->Main_model->getTabdata_tablename_id('benefit_tabcontent', 'benefit_id','4','status','1');
        $data['meta_title'] =$data['solutions']['meta_title'];
        $data['meta_description'] = $data['solutions']['meta_description'];
        $data['meta_tag'] = $data['solutions']['meta_tag'];
        $data['canonical_url'] = $data['solutions']['canonical_url'];
		//dd($data);
        _frontLayout('solutions', $data);


    }

}

