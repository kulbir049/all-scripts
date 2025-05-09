<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Signup_model extends CI_Model {

    private $user_temp = "user_temp";
	private $user = "user";
	private $subscribe = "subscribe_membership_plan";
	private $transaction = "transaction";

    public function __construct() {
        parent::__construct();
    }

    /**
     * Registration
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function userTempRegistration($array) {
        try {
            $this->db->insert($this->user_temp, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * transactionDetails
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function transactionDetails($array) {
        try {
            $this->db->insert($this->transaction, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * transactionDetails
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function del_temp_user_row($user_id) {
        try {
            $this -> db -> where('user_id', $user_id);
			$this -> db -> delete('user_temp');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * transactionDetails
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function del_temp_member_row($user_id) {
        try {
            $this -> db -> where('id', $user_id);
			$this -> db -> delete('subscribe_membership_plan');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * vendorRegistration
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function userRegistration($array) {
            $this->db->insert($this->user, $array);
            return $this->db->insert_id();
        
    }
	
	/**
     * updateMobileStatus
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function updateTranstab($id,$transid) {

        try {
			//echo $id;
			//echo "<br>";
			//echo $transid;
			//die;
            $data = array();
            $this->db->set('user_id', $id);
            $this->db->where('id', $transid);
            $arr_update = $this->db->update($this->transaction, $data);
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	/**
     * updateMemberStatus
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function updateMemStatus($id,$transid) {

        try {
            $data = array('user_id'=>$id);
            $this->db->set('user_id', "$id", false);
            $this->db->where('id', $transid);
            $arr_update = $this->db->update($this->subscribe, $data);
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * userMebership
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function userMebership($array) {
        try {
            $this->db->insert($this->subscribe, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	  public function get_plan_details($user_id) {
        $select_field = array('plan_id', 'plan_name', 'price as plan_price', 'days as plan_days','expiry_date');
            $this->db->select($select_field);
            $this->db->from('subscribe_membership_plan');
            
            $this->db->where("user_id",$user_id);
              $this->db->order_by("id", "desc");

            $res = $this->db->get()->row_object();
            return $res;
    }
    
    public function userExists($useremail) {
        try {
           // $password = hash("sha256", $password);
            //$password = md5($password);
            $select_field = array('user_id', 'user_login_id', 'user_name', 'user_email', 'mobile_no',  'role_id', 'last_login', 'login_status','status','popup_time','popup_status');
            $this->db->select($select_field);
            $this->db->from($this->user);
            //$where = "('user_email' = '$useremail' OR 'user_login_id' = '$useremail')";	
            //$where = "user_email='$useremail' OR user_login_id='$useremail'";
            //$this->db->where('user_email', $useremail);
            //$this->db->where($where);
             //$this->db->where("(user_email = $useremail OR user_login_id = $useremail)");
            //  $this->db->where('user_email' , $useremail OR 'user_login_id' , $useremail);
            // $this->db->where('status',1);
            // $this->db->where('user_password', $password);
            $this->db->where("(user_email = '$useremail' OR user_login_id = '$useremail')  AND status = '1'");

            $res = $this->db->get()->row_object();
            //echo get_query();die;
            if (isset($res) && !empty($res) && is_object($res)) {
                $this->userName = $res->user_name;
                $this->userEmail = $res->user_email;
                $this->userLoginId = $res->user_login_id;
                $this->userMobile = $res->mobile_no;
                $this->userType = $res->role_id;
                $this->userId = $res->user_id;
                $this->tokenId = md5($res->user_id);
                $this->lastLogin = $res->last_login;
                //$this->loginStatus = $res->login_status;
                $this->popup_time=$res->popup_time;
                $this->popup_status=$res->popup_status;
				$this->loginStatus = (int)1;
                $update_array = array('last_login' => date('Y-m-d H:i:s'), 'login_status' => '1');

            $this->db->where("(user_email = '$useremail' OR user_login_id = '$useremail')  AND status = '1'");

                 $this->db->update($this->user, $update_array);

                return true;
            } else
                return false;
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

}

?>