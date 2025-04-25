<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{
    private $banner = "banner";
    private $home_setting = "home_setting";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * banner
     * @return array
     * @since 0.1
     * @author DHS
     */

    public function get_plan_details($user_id) {
        $select_field = array('plan_id', 'plan_name', 'price as plan_price', 'days as plan_days','expiry_date');
            $this->db->select($select_field);
            $this->db->from('subscribe_membership_plan');
            
            $this->db->where("user_id",$user_id);
              $this->db->order_by("expiry_date", "desc");

            $res = $this->db->get()->row_object();
            return $res;
    }
    public function banner($limit='')
    {

        try {

            $this->db->select('*');
        $this->db->order_by('position_index', 'ASC');
        if($limit>0){
        $this->db->limit(42);
        }
            if($profile_id>0){
            $this->db->where('id', $profile_id);
            }
            $this->db->where(array('b_type' => '2', 'status' => '1'));
            $this->db->from($this->banner);
            $arr_data = $this->db->get()->result_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
        
    }
    public function banner_details($profile_id)
    {

            $this->db->select('*');
            $this->db->order_by("id", "ASC");
            if($profile_id>0){
            $this->db->where('id', $profile_id);
            }
            $this->db->from($this->banner);
            $arr_data = $this->db->get()->result_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
       
   
        
    }



    /**
     * Home_Section1
     * @return array
     * @since 0.1
     * @author DHS
     */
	public function Home_Section1()
    {

        try {

            $this->db->select('id,title,description,image');
            $this->db->order_by("id", "DESC");
			$array = array('type' => 'Section1', 'status' => '1');
            $this->db->where($array);
            $this->db->from($this->home_setting);
            $arr_data = $this->db->get()->result_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
        
    }
	
	 /**
     * Home_Section2
     * @return array
     * @since 0.1
     * @author DHS
     */
	public function Home_Section2()
    {

        try {

            $this->db->select('id,title,subtitle,description,image');
			$array = array('type' => 'Section2', 'status' => '1');
            $this->db->where($array);
            $this->db->from($this->home_setting);
            $arr_data = $this->db->get()->row_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
        
    }
	/**
     * Home_Section4
     * @return array
     * @since 0.1
     * @author DHS
     */
	public function Home_Section4()
    {

        try {

            $this->db->select('id,title,description,image');
			$array = array('type' => 'Section4', 'status' => '1');
            $this->db->where($array);
            $this->db->from($this->home_setting);
            $arr_data = $this->db->get()->row_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
        
    }
	/**
     * Home_Section5Home_Section5_Bottom
     * @return array
     * @since 0.1
     * @author DHS
     */
	public function Home_Section5()
    {

        try {
            $this->db->select('title,subtitle,description');
			$array = array('type' => 'Section5', 'status' => '1');
            $this->db->where($array);
            $this->db->from($this->home_setting);
			$this->db->limit(2);
            $arr_data = $this->db->get()->result_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
        
    }
	/**
     * Home_Section5_Bottom
     * @return array
     * @since 0.1
     * @author DHS
     */
	public function Home_Section5_Bottom()
    {

        try {
            $this->db->select('description');
			$array = array('type' => 'Section5', 'status' => '1');
            $this->db->where($array);
            $this->db->from($this->home_setting);
			$this->db->limit(1,2);
            $arr_data = $this->db->get()->row_object();
			
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
        
    }
	/**
     * Home_Section6
     * @return array
     * @since 0.1
     * @author DHS
     */
	public function Home_Section6()
    {

        try {
            $this->db->select('title,subtitle,description');
			$array = array('type' => 'Section6', 'status' => '1');
            $this->db->where($array);
            $this->db->from($this->home_setting);
            $arr_data = $this->db->get()->row_object();
			
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
        
    }

    public function get_homecomposerprofile_by_id($id)
    {
        //$this->db->where('role_id',2);
        $id = base64_decode($id);
        $this->db->where('id', $id);
        $query = $this->db->get('banner');
        // $this->db->last_query();
        //echo get_query(); die();

        return $query->row_array();

    }

}
?>