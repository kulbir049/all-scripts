<?php

defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(1);

class Privacy_policy extends MY_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->model(array('viewcart/Main_model','admin_seo_management/Folder_seo_model'));

    }


    /**
     * Method index() redirects to the Comming Soon area.
     * @access    public
     * @param    Null
     * @return    null
     */

    public function index()

    {

        $data['privacy_details'] = $this->Main_model->getdata_tablename_id('cms_page', 'id', '4');
        
                      $page_url = rtrim(current_url(),"/");
        $data['meta_details'] = $this->Folder_seo_model->getCmsBy_url($page_url);
        
        _frontLayout('privacy_policy', $data);


    }

}

