<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
require_once APPPATH . "third_party/google-api-php-client-2.0.0/vendor/autoload.php"; // Google Client Library path

class Auth extends MY_Controller {

     public function __construct() {
        parent::__construct();
        $this->load->config('google');
         $this->load->model("Auth_model", "auth");
         $this->load->helper('cookie');
    }

    public function login() {
        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));
        $client->addScope($this->config->item('google_scopes'));

        $authUrl = $client->createAuthUrl();
        redirect($authUrl);
    }

    public function callback() {
        $client = new Google_Client();
        $client->setClientId($this->config->item('google_client_id'));
        $client->setClientSecret($this->config->item('google_client_secret'));
        $client->setRedirectUri($this->config->item('google_redirect_uri'));

        if ($this->input->get('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));
            $client->setAccessToken($token);

            $oauth2 = new Google_Service_Oauth2($client);
            $userInfo = $oauth2->userinfo->get();

            //manage login
if($userInfo){
            if ($this->auth->userExists($userInfo->email)) {
                foreach($this->session->userdata as $key=>$c){
                    $ar=["__ci_last_regenerate","admin_name","admin_image","admin_email","admin_mobile","admin_role_id","userRole_data","admin_id","auth","token_id","last_login","login_status"];
                    $ar=["__ci_last_regenerate"];
                    if(!in_array($key,$ar)){
                        $this->session->unset_userdata($key);
                    }
                }

                if($this->session->has_userdata('expiry_time')){
                    $this->session->unset_userdata('expiry_time');
                }
                //echo "jit";die;
                if($this->auth->userType==3){
                    $data=(array) $this->auth->get_plan_details($this->auth->userId);
                    if(strtotime('now')>strtotime($data['expiry_date'])){
                        $this->session->set_userdata("popup",0);
                        $this->db->update("user",["email_status"=>0,"role_id"=>"2","popup_status"=>"1"],["user_id"=>$this->auth->userId]);
                    }
                }else{
                    $this->db->update("user",["email_status"=>0],["user_id"=>$this->auth->userId]);
                }
                //	print_r($this->auth);die;
                if($this->auth->popup_status==1){

                    if($this->auth->popup_time>2){

                    }else{
                        $this->session->set_userdata("popup",0);
                        // die;
                    }
                }

                $this->auth->userExists($userInfo->email);
                $userdata = array(
                    'user_name' => $this->auth->userName,
                    'user_email' => $this->auth->userEmail,
                    'user_login_id' => $this->auth->userLoginId,
                    'user_mobile' => $this->auth->userMobile,
                    'user_type' => $this->auth->userType,
                    'user_id' => $this->auth->userId,
                    'token_id' => $this->auth->tokenId,
                    'last_login' => $this->auth->lastLogin,
                    'login_status' => $this->auth->loginStatus,
                    'popup_time'=>$this->auth->popup_time,
                    'popup_status'=>$this->auth->popup_status,
                    'auth' => TRUE
                );
                $plan_details= (array) $this->auth->get_plan_details($this->auth->userId);

                $userdata_new=array_merge($userdata,$plan_details);
//print_r($userdata_new);die;
                if(isset($rem) && !empty($rem) &&($rem=='1')){

                    //set_cookie($cookie);
                    $hour = time() + 3600 * 24 * 30;
                    set_cookie('email',$userInfo->email,$hour);
                    set_cookie('pwd',$userInfo->user_password,$hour);
                    set_cookie('rem',$rem,$hour);
                }else{
                    delete_cookie('email');
                    delete_cookie('pwd');
                    delete_cookie('rem');
                }
                $this->session->set_userdata($userdata_new);
               // if($user_id!=''){//////Auto login
                   // redirect(site_url('personal_library'));
               // }else{
                    //   echo "<pre>"; print_r($this->session->userdata);die;
                    redirect(site_url('home'));

             //   }
                exit;
            } else {

                $this->session->set_flashdata('flash_msg_type', 'danger');
                $this->session->set_flashdata('flash_msg_text', 'Please enter valid credentials or Signup.');
                redirect(site_url() . "login");
                exit;
            }
        } else {
            $data['errorMsg'] = validation_errors();
            _frontLayout('login', $data);

        }


           // end login


            // Example: Store user info in session
            $this->session->set_userdata([
                'email' => $userInfo->email,
                'name' => $userInfo->name,
                'picture' => $userInfo->picture,
            ]);

            // Redirect to a desired page after login
            redirect('dashboard');
        } else {
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata(['email', 'name', 'picture']);
        redirect('auth/login');
    }
}
