<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting('1');
class Admin_comp extends MY_Controller {

    public function __construct() {
        parent::__construct();
		//$this->output->cache (15);
        $this->load->model(array('admin_categories/Category_model','comp/Comp_model'));
        $this->load->library(array('form_validation', 'session'));
        isAdminProtected();
    }

    public function index() {
		$get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Comp_model->getCategoryTreeData_new();
        $data['title'] = 'Manage Libraries';
        _adminLayout('allcomp', $data);
    }

    public function alphaSearch()
    {  
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();    
        $data['title'] = 'Manage Libraries';
        $data_id = $this->uri->segment(3);
        $data['objTree'] = $this->Comp_model->get_categories($data_id);
        _adminLayout('alphasearch',$data);
    }

}