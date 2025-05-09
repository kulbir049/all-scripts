<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Composerprofile extends MY_Controller
{
    private $user_id;
    public function __construct()
    {
        parent::__construct();
  //       isHomeProtected();
        $this->load->model(array('viewcart/Main_model', 'Composerprofile_model','admin_categories/Category_model'));
		// $this->user_id = $this->session->userdata('user_id');
  //       if (empty($this->session->userdata('user_id'))) {
  //           redirect(BASE_PATH);
  //       }
    }

    
    public function index()
    {
        // $data['meta_title'] ="View Composer Detail";
        // $id=$this->uri->segment(2);
        // dd($id); die();
        // $data['detail'] = $this->Composerprofile_model->get_composerprofile_by_id($id);
        _frontLayout('composerprofile',$data);
    }

    public function cid($id=false)
    {
        $data['meta_title'] ="View Composer Detail";
        $id=$this->uri->segment(3);
        $pid = base64_decode($id);
        $data['objTree'] = $this->Category_model->getRecordById($pid);
        $data['detail'] = $this->Composerprofile_model->get_composerprofile_by_id($id);
        //dd($data['objTree']); die();
        _frontLayout('composerprofile',$data);
    }

	
}
