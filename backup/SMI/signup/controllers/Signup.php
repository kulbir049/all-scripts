<?php
error_reporting(1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Signup_model','viewcart/Main_model', 'admin_seo_management/Folder_seo_model'));
		// $this->load->library('session');
		$this->clear_cache();
    }
    public function index()
    {
    $data['membership'] = $this->Main_model->tablename_sin_col('member_ship', 'status', '1');
        $data['pricing_details'] = $this->Main_model->getdata_tablename_id('cms_page', 'id', '1');
   

        $page_url = rtrim(current_url(),"/");
        $data['meta_details'] = $this->Folder_seo_model->getCmsBy_url($page_url);
        
	//dd($data);
    _frontLayout('sign-up',$data);
    }
	
	public function paypal()
    {

$member_ship=$this->session->userdata('member_id');
    $data['membership'] = $this->Main_model->getdata_tablename_id('subscribe_membership_plan', 'id', $member_ship);
    $data['tempData'] = $this->Main_model->getdata_tablename_id('user_temp', 'user_id', $data['membership']['user_id']);

        $records = $this->Main_model->getdata_tablename_id('admin_specialcode', 'id', $data['tempData']['special_code']);
        $data['coupon'] = !empty($records) ? $records : null;
   // print_r($data['tempData']);
    $data['meta_title'] ="Sign Up";
	$data['meta_description'] = "meta_description";
	$data['meta_tag'] = "meta_tag";
	$data['canonical_url'] = "canonical_url";
	//$data['getId'] = $this->Signup_model->getUserId();
	//$data['user_id'] = $data['getId'][0]['user_id'];
	//$data['user_name'] = $data['getId'][0]['user_name']; 
	//$data['user_lname'] = $data['getId'][0]['user_lname'];
	//$data['user_email'] = $data['getId'][0]['user_email'];
	//$data['location'] = $data['getId'][0]['location'];
	//$data['city'] = $data['getId'][0]['city'];
	//$data['zipcode'] = $data['getId'][0]['zipcode'];
	//$data['userdataId'] =  $data['user_id'];    
    //$this->session->set_userdata($data['userdataId']);
	//dd($data['userdataId']); 
    //die;
	 
    _frontLayout('paypal',$data);
    
    }
	
	public function paypal_auto_renew()
    {
    $data['membership'] = $this->Main_model->tablename_sin_col('member_ship', 'status', '1');
    $data['meta_title'] ="Sign Up";
	$data['meta_description'] = "meta_description";
	$data['meta_tag'] = "meta_tag";
	$data['canonical_url'] = "canonical_url";
	//$data['getId'] = $this->Signup_model->getUserId();
	//$data['user_id'] = $data['getId'][0]['user_id'];
	//$data['user_name'] = $data['getId'][0]['user_name']; 
	//$data['user_lname'] = $data['getId'][0]['user_lname'];
	//$data['user_email'] = $data['getId'][0]['user_email'];
	//$data['location'] = $data['getId'][0]['location'];
	//$data['city'] = $data['getId'][0]['city'];
	//$data['zipcode'] = $data['getId'][0]['zipcode'];
	//$data['userdataId'] =  $data['user_id'];    
    //$this->session->set_userdata($data['userdataId']);
	//dd($data['userdataId']); 
    //die;
	 
    _frontLayout('paypal_auto_renew',$data);
    
    }

	public function payment_success()
    {
        //echo "<pre>";print_r($_SESSION);die;
    $member_ship=$this->session->userdata('member_id');
    $data['membership'] = $this->Main_model->getdata_tablename_id('subscribe_membership_plan', 'id', $member_ship);
    $data['tempData'] = $this->Main_model->getdata_tablename_id('user_temp', 'user_id', $data['membership']['user_id']);



    $data['meta_title'] ="Sign Up";
	$data['meta_description'] = "meta_description";
	$data['meta_tag'] = "meta_tag";
	$data['canonical_url'] = "canonical_url";
	
	$post = $this->input->get();
	
	$transpost['txn_id']=$post['tx'];
	
	$transpost['payment_status']=$post['st'];

	$transpost['amt']=$data['membership']['price'];
	$transpost['txn_id']=strtotime('now');
	$transpost['item_name']=$data['membership']['plan_name'];
	$transpost['item_number']=$data['membership']['plan_name'];
	$transpost['user_id']=$data['membership']['user_id'];
        $transpost['payment_date']=strtotime('now');
if($transpost['amt']==''){
	       redirect(base_url().'login');
die;
}

    $transpost['payment_status']="Completed";//****************static
	
	$transid = $this->Signup_model->transactionDetails($transpost);
	unset($data['tempData']['phone_no']);
	unset($data['tempData']['phone_ext']);
	unset($data['tempData']['fax']);
	unset($data['tempData']['location']);
	unset($data['tempData']['unit']);
	unset($data['tempData']['province']);
	unset($data['tempData']['doing_business']);
	unset($data['tempData']['image']);
	unset($data['tempData']['mail_verify']);
	unset($data['tempData']['mail_code']);
	unset($data['tempData']['contact_verify']);
	unset($data['tempData']['contact_code']);
	unset($data['tempData']['created_by']);
	unset($data['tempData']['updated_by']);
	$data['tempData']['status']=1;

	$this->load->library('email'); 
	$this->email->from(ADMIN_EMAIL, 'Sheet Music International');
	$this->email->to($data['tempData']['user_email']);
	$this->email->subject('Welcome Sheet Music International');
	$message="Dear ".$data['tempData']['user_login_id'].",
	<br/><br/>

	Thanks for create a new account on Sheet Music International. Please check the following details and login.
	<br/>
	".base_url()."login
	<br/>
	<br/>
	Email:".$data['tempData']['user_email']."
	<br/>
	Password:".base64_decode($data['tempData']['user_password'])."
	<br/>
	<br/>
	Thanks/Ragards<br/>
	Sheet Music International<br/>
	".base_url();
	$this->email->message($message);

    $this->email->send(); 



			$tempid=$this->Signup_model->userRegistration($data['tempData']);
         $this->Signup_model->userExists($data['tempData']['user_login_id']);

                    $userdata = array(
                        'user_name' => $this->Signup_model->userName,
                        'user_email' => $this->Signup_model->userEmail,
                        'user_login_id' => $this->Signup_model->userLoginId,
                        'user_mobile' => $this->Signup_model->userMobile,
                        'user_type' => $this->Signup_model->userType,
                        'user_id' => $this->Signup_model->userId,
                        'token_id' => $this->Signup_model->tokenId,
                        'last_login' => $this->Signup_model->lastLogin,
                        'login_status' => $this->Signup_model->loginStatus,
                        'popup_time'=>$this->Signup_model->popup_time,
                        'popup_status'=>$this->Signup_model->popup_status,
                        'auth' => TRUE
                    );
                     $plan_details= (array) $this->Signup_model->get_plan_details($this->Signup_model->userId);
// echo "<pre>";print_r($plan_details);die;
                  $userdata_new=array_merge($userdata,$plan_details);
                   $this->session->set_userdata($userdata_new);
	//$this->session->sess_destroy();
	//die;
	 
    //dd($transpost); die;
	
	//dd($data);
			redirect(base_url());die; 
    //_frontLayout('thanku',$data);
    }
	
	function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
	public function payment_cancel()
    {   //echo "<pre>";print_r($_SESSION);die;
    $data['membership'] = $this->Main_model->tablename_sin_col('member_ship', 'status', '1');
    $data['meta_title'] ="Sign Up";
	$data['meta_description'] = "meta_description";
	$data['meta_tag'] = "meta_tag";
	$data['canonical_url'] = "canonical_url";
	//dd($data);
	//$post = $this->input->post();
	$tempData = $this->session->userdata();
	//dd($tempData);
	if (isset($tempData) && !empty($tempData)) {
	$this->Signup_model->del_temp_user_row($tempData["user_id"]);
	if (isset($tempData["member_id"]) && !empty($tempData["member_id"])) {
			$this->Signup_model->del_temp_member_row($tempData["member_id"]);
		}
	$this->session->sess_destroy();
	}
	//dd($post);die;                
    _frontLayout('cancel',$data);
    }

    public function thankyou() {
    	redirect(base_url());die; 
    	//_frontLayout('thanku',$data);
    }
    public function register() {
    	
        $data['membership'] = $this->Main_model->tablename_sin_col('member_ship', 'status', '1');
        $data['pricing_details'] = $this->Main_model->getdata_tablename_id('cms_page', 'id', '1');
        try {

             if ($this->form_validation->run($this, 'signup_form')) {

                 //$otp = codeOTP(6);
                 $post = $this->input->post();


                 $userpost['user_name'] = $post['user_name'];
                 $userpost['user_lname'] = $post['user_lname'];
                 $userpost['mobile_no'] = $post['mobile_no'];
                 $userpost['user_login_id'] = $post['user_login_id'];
                 $userpost['user_email'] = $post['user_email'];
                 $userpost['location'] = $post['location'];
                 $userpost['city'] = $post['city'];
                 $userpost['state'] = $post['state'];
                 $userpost['country'] = $post['country'];
                 $userpost['zipcode'] = $post['zipcode'];
                 $userpost['language'] = $post['language'];
                 $userpost['special_code'] = $post['special_code_id'];
                 if ($post['auto_renew'] == "") {
                     $userpost['auto_renew'] = '0';
                 } else {
                     $userpost['auto_renew'] = $post['auto_renew'];
                 }


                 //$userpost['contact_code'] = $otp;
                 $userpost['user_password'] = base64_encode($post['user_password']);
                 $userpost['user_spwd'] = base64_encode($post['user_password']);
                 // if($post['role_id']==4){
                 //  $post['role_id']=3;
                 //  $userpost['role_id'] = 3;
                 //  }else{
                 $userpost['role_id'] = $post['role_id'];
                 //  }

                 $userpost['status'] = 1;
                 unset($post['con_password']);

                 $id = $this->Signup_model->userTempRegistration($userpost);
                 //print_r($id);die;
                 $tempid = $id;

                 if ($post['role_id'] == 3) {
                     $plan_name = 'Premium Membership';
                     $days = 365;
                     $expiry_date = date('Y-m-d', strtotime('+365 days'));
                     $role_id = $post['role_id'];
                 } elseif ($post['role_id'] == 4) {
                     $plan_name = 'Monthly Membership';
                     $days = 30;
                     $expiry_date = date('Y-m-d', strtotime('+30 days'));
                     $role_id = 4;
                 } else {
                     $plan_name = 'Standard Membership';
                     $days = 'free';
                     $expiry_date = date('Y-m-d', strtotime('+700 days'));
                     $role_id = $post['role_id'];
                 }


                 //$memberpost['plan_id']=$post['role_id'];
                 $memberpost['plan_id'] = $role_id;
                 $memberpost['plan_name'] = $plan_name;
                 $memberpost['days'] = $days;
                 if ($post['special_code_id']){

                     $records = $this->Main_model->getdata_tablename_id('admin_specialcode', 'id', $post['special_code_id']);

if(!empty($records)){
    if($post['role_id']==4){
        $memberpost['price']=$post['price'];
    }else{
        $memberpost['price']=$post['price']-$records['price'];
        $memberpost['special_code_id']= $post['special_code_id'];
    }
}else{
    $memberpost['price']=$post['price'];
}

             }else{

                 $memberpost['price']=$post['price'];
             }




				$memberpost['expiry_date']=$expiry_date;
             if ($post['role_id']==4) {
                 $memberpost['no_renewal'] = 0;
                 $memberpost['no_renewal_monthly'] = 1;
             }else{
                 $memberpost['no_renewal'] = 1;
                 $memberpost['no_renewal_monthly'] = 0;
             }
				$memberpost['user_email']=$post['user_email'];
				$memberpost['user_id']=$id;
				$memberpost['created_on']=date('Y-m-d h:i:s');
			
				
				$mem_id=$this->Signup_model->userMebership($memberpost);
				// echo $mem_id;
				// dd($mem_id);
				// die;
				if($mem_id)
				{
				$memberData = array('member_id'=>"$mem_id");
				//dd($memberData);
				//die;
				$this->session->set_userdata($memberData);
				}
				//$tempData = $this->session->userdata();
				//dd($tempData);
				//die;
				//echo $id;
				$tempUserData = $this->Main_model->getdata_tablename_id('user_temp', 'user_id', $id);

				//$user_email = $tempUserData['user_email'];
				//echo $user_email;
				//die;
				//$userData = array('user_id'=>"$user_email");
				//dd($data);die;

                 //alam
                $data['coupon'] = !empty($records) ? $records : null;
                 $data['tempData']=$tempUserData;//new line
			//	$this->session->set_userdata($tempUserData); //working
				//$tempData = $this->session->userdata(); //working

//end
				//dd($tempData);die;
				// if($post['plan_id']=="1")
				// {
                // print_r($data['coupon']);
                // die('ss');
				if($post['price']>0){
                    if ($post['special_code_id']) {
                        if ($post['price'] == $records['price']) {
                            $this->freeplanuser();
                        } else {
                            redirect('signup/paypal', $data);
                        }
                    }else{
                        redirect('signup/paypal', $data);
                    }
			}else{
			$data['tempData'] = $this->Main_model->getdata_tablename_id('user_temp', 'user_id', $tempid);
			unset($data['tempData']['phone_no']);
			unset($data['tempData']['phone_ext']);
			unset($data['tempData']['fax']);
			unset($data['tempData']['location']);
			unset($data['tempData']['unit']);
			unset($data['tempData']['province']);
			unset($data['tempData']['doing_business']);
			unset($data['tempData']['image']);
			unset($data['tempData']['mail_verify']);
			unset($data['tempData']['mail_code']);
			unset($data['tempData']['contact_verify']);
			unset($data['tempData']['contact_code']);
			unset($data['tempData']['created_by']);
			unset($data['tempData']['updated_by']);
			$tempid=$this->Signup_model->userRegistration($data['tempData']);
			
			
			
		//	$tempid=$this->Signup_model->userRegistration($data['tempData']);
          $this->Signup_model->userExists($data['tempData']['user_login_id']);

                    $userdata = array(
                        'user_name' => $this->Signup_model->userName,
                        'user_email' => $this->Signup_model->userEmail,
                        'user_login_id' => $this->Signup_model->userLoginId,
                        'user_mobile' => $this->Signup_model->userMobile,
                        'user_type' => $this->Signup_model->userType,
                        'user_id' => $this->Signup_model->userId,
                        'token_id' => $this->Signup_model->tokenId,
                        'last_login' => $this->Signup_model->lastLogin,
                        'login_status' => $this->Signup_model->loginStatus,
                        'popup_time'=>$this->Signup_model->popup_time,
                        'popup_status'=>$this->Signup_model->popup_status,
                        'auth' => TRUE
                    );
                     $plan_details= (array) $this->Signup_model->get_plan_details($this->Signup_model->userId);
// echo "<pre>";print_r($plan_details);die;
                  $userdata_new=array_merge($userdata,$plan_details);
                   $this->session->set_userdata($userdata_new);
               redirect('signup/thankyou'); die;
			}
				// }
				// elseif($userpost['auto_renew']=="0")
				// {
				// redirect('signup/paypal', $data);	
				// }
				// else
				// {
				// redirect('signup/paypal_auto_renew', $data);	
				// }
				 //_frontLayout('paypal',$data);
				//die;

				
			
				
				$data['msg'] = 'Registered successfully with ' . $post['user_email'] . '!!';
				$data['error_type'] = 'success';
				$this->session->set_flashdata('flash_msg_type', 'success');
				$this->session->set_flashdata('flash_msg_text', $data['msg']);
				redirect('signup', $data);
                
            } else {
				$data['msg'] = 'Either Email or Username Already exist!!';
				$this->session->set_flashdata('flash_msg_type', 'danger');
				$this->session->set_flashdata('flash_msg_text', $data['msg']);
				
                $data['errorMsg'] = validation_errors();
				$data['terms'] = $this->Main_model->getdata_tablename_id('cms_page', 'id', '9');
				$data['membership'] = $this->Main_model->getdata_tablename_two_id('member_ship', 'id', '1','status','1');
                _frontLayout('sign-up',$data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


    public function freeplanuser()
    {
        //echo "<pre>";print_r($_SESSION);die;
        $member_ship=$this->session->userdata('member_id');
        $data['membership'] = $this->Main_model->getdata_tablename_id('subscribe_membership_plan', 'id', $member_ship);
        $data['tempData'] = $this->Main_model->getdata_tablename_id('user_temp', 'user_id', $data['membership']['user_id']);



        $data['meta_title'] ="Sign Up";
        $data['meta_description'] = "meta_description";
        $data['meta_tag'] = "meta_tag";
        $data['canonical_url'] = "canonical_url";

        $post = $this->input->get();

        $transpost['txn_id']='free';

     //   $transpost['payment_status']=$post['st'];

        $transpost['amt']=$data['membership']['price'];
        $transpost['txn_id']=strtotime('now');
        $transpost['item_name']=$data['membership']['plan_name'];
        $transpost['item_number']=$data['membership']['plan_name'];
        $transpost['user_id']=$data['membership']['user_id'];
        $transpost['payment_date']=strtotime('now');
        if($transpost['amt']=='' && $data['membership']['special_code_id']==0){
            redirect(base_url().'login');
            die;
        }

        $transpost['payment_status']="Completed";//****************static

        $transid = $this->Signup_model->transactionDetails($transpost);
        unset($data['tempData']['phone_no']);
        unset($data['tempData']['phone_ext']);
        unset($data['tempData']['fax']);
        unset($data['tempData']['location']);
        unset($data['tempData']['unit']);
        unset($data['tempData']['province']);
        unset($data['tempData']['doing_business']);
        unset($data['tempData']['image']);
        unset($data['tempData']['mail_verify']);
        unset($data['tempData']['mail_code']);
        unset($data['tempData']['contact_verify']);
        unset($data['tempData']['contact_code']);
        unset($data['tempData']['created_by']);
        unset($data['tempData']['updated_by']);
        $data['tempData']['status']=1;

        $this->load->library('email');
        $this->email->from(ADMIN_EMAIL, 'Sheet Music International');
        $this->email->to($data['tempData']['user_email']);
        $this->email->subject('Welcome Sheet Music International');
        $message="Dear ".$data['tempData']['user_login_id'].",
	<br/><br/>

	Thanks for create a new account on Sheet Music International. Please check the following details and login.
	<br/>
	".base_url()."login
	<br/>
	<br/>
	Email:".$data['tempData']['user_email']."
	<br/>
	Password:".base64_decode($data['tempData']['user_password'])."
	<br/>
	<br/>
	Thanks/Ragards<br/>
	Sheet Music International<br/>
	".base_url();
        $this->email->message($message);

        $this->email->send();



        $tempid=$this->Signup_model->userRegistration($data['tempData']);
        $this->Signup_model->userExists($data['tempData']['user_login_id']);

        $userdata = array(
            'user_name' => $this->Signup_model->userName,
            'user_email' => $this->Signup_model->userEmail,
            'user_login_id' => $this->Signup_model->userLoginId,
            'user_mobile' => $this->Signup_model->userMobile,
            'user_type' => $this->Signup_model->userType,
            'user_id' => $this->Signup_model->userId,
            'token_id' => $this->Signup_model->tokenId,
            'last_login' => $this->Signup_model->lastLogin,
            'login_status' => $this->Signup_model->loginStatus,
            'popup_time'=>$this->Signup_model->popup_time,
            'popup_status'=>$this->Signup_model->popup_status,
            'auth' => TRUE
        );
        $plan_details= (array) $this->Signup_model->get_plan_details($this->Signup_model->userId);
// echo "<pre>";print_r($plan_details);die;
        $userdata_new=array_merge($userdata,$plan_details);
        $this->session->set_userdata($userdata_new);
        //$this->session->sess_destroy();
        //die;

        //dd($transpost); die;

        //dd($data);
        redirect(base_url());die;
        //_frontLayout('thanku',$data);
    }
	public function verify_code() {
		// Load input helper if not already autoloaded
		$code = $this->input->post('code');
	
		// Response template
		$response = [
			'success' => false,
			'message' => 'Invalid request.'
		];
	
		if (!empty($code)) {
			// Validate the code (replace with your actual logic)

		//	$records = $this->Main_model->getdata_tablename_id('admin_specialcode', 'title', $code);
			$records = $this->Main_model->getdata_tablename_two_col('admin_specialcode', 'title', $code,'status','Active');

			if (!empty($records)) { // Example validation
				$response['success'] = true;
				$response['message'] = 'Code is valid.';
				$response['data'] = $records;
			} else {
				$response['message'] = 'Code is invalid.';
			}
		} else {
			$response['message'] = 'No code provided.';
		}
	
		// Send JSON response
		echo json_encode($response);
		exit;
	}
	
}

