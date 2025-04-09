<?php

defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(1);

class Packages extends MY_Controller
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

		$data['package'] = $this->Main_model->getdata_tablename_id('cms_page', 'id', '8');
		$data['banner'] = $this->Main_model->getTabdata_tablename_id('banner', 'b_type','3','status','1');
        $data['meta_title'] =$data['package']['meta_title'];
        $data['meta_description'] = $data['package']['meta_description'];
        $data['meta_tag'] = $data['package']['meta_tag'];
        $data['canonical_url'] = $data['package']['canonical_url'];
		//dd($data);
        _frontLayout('packages', $data);


    }

}

