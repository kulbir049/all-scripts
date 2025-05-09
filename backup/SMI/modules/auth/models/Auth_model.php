<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {
    private $user = 'user';
    public function __construct() {
        parent::__construct();
    }

    /**
     * logout
     * @return array
     * @since 0.1
     * @author Devendra Tiwari
     */


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
            $this->db->where("(user_email = '$useremail' OR user_login_id = '$useremail') AND status = '1'");

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

                $this->db->where("(user_email = '$useremail' OR user_login_id = '$useremail') AND status = '1'");

                $this->db->update($this->user, $update_array);

                return true;
            } else
                return false;
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    /**
     * User Verified
     * @return array
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function userVerified($email) {
        try {
            $this->db->where(array('user_email' => $email, 'mail_verify'=>'0','status'=>'0'));
            $query = $this->db->get($this->user);
            $arr_data = $query->num_rows();
            return (isset($arr_data) && !empty($arr_data) ? true : false);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * logout
     * @return array
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function logout($user_id) {
        try {
            $update_array = array('last_logout' => date('Y-m-d H:i:s'), 'login_status' => 0);
            $this->db->update($this->user, $update_array, array('user_id' => $user_id));
        } catch (Exception $ex) {

        }
    }



}

?>