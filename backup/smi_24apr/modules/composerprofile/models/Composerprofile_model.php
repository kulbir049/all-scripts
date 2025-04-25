<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Composerprofile_model extends CI_Model {

	private $category_detail = "category_detail";
    public function __construct() {
        parent::__construct();
    }


    public function get_composerprofile_by_id($id)
    {
        //$this->db->where('role_id',2);
        $id = base64_decode($id);
        $this->db->where('cat_id', $id);
        $query = $this->db->get('category_detail');
        // $this->db->last_query();
        //echo get_query(); die();

        return $query->row_array();

    }
    
}

?>