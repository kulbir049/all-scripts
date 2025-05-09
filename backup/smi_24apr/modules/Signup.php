<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Signup extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array('Signup_model','viewcart/Main_model'));
		// $this->load->library('session');
    }
    public function index()
    {
    $data['membership'] = $this->Main_model->tablename_sin_col('member_ship', 'status', '1');
    $data['meta_title'] ="Sign Up";
	$data['meta_description'] = "meta_description";
	$data['meta_tag'] = "meta_tag";
	$data['canonical_url'] = "canonical_url";
	//dd($data);
    _frontLayout('sign-up',$data);
    }
	
	public function paypal()
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
    $data['membership'] = $this->Main_model->tablename_sin_col('member_ship', 'status', '1');
    $data['meta_title'] ="Sign Up";
	$data['meta_description'] = "meta_description";
	$data['meta_tag'] = "meta_tag";
	$data['canonical_url'] = "canonical_url";
	
	$post = $this->input->get();
	//dd($post);
	//dd($_REQUEST);die;
	
	//$transpost['payer_email']=$post['payer_email'];
	//$transpost['payer_id']=$post['payer_id'];
	//$transpost['payer_status']=$post['payer_status'];
	//$transpost['first_name']=$post['first_name'];
	//$transpost['last_name']=$post['last_name'];
	//$transpost['address_name']=$post['address_name'];
	//$transpost['address_street']=$post['address_street'];
	//$transpost['address_city']=$post['address_city'];
	//$transpost['address_state']=$post['address_state'];
	//$transpost['address_country_code']=$post['address_country_code'];
	//$transpost['address_zip']=$post['address_zip'];
	//$transpost['residence_country']=$post['residence_country'];
	$transpost['txn_id']=$post['tx'];
	//$transpost['mc_fee']=$post['mc_fee'];
	//$transpost['mc_gross']=$post['mc_gross'];
	//$transpost['protection_eligibility']=$post['protection_eligibility'];
	//$transpost['payment_fee']=$post['payment_fee'];
	//$transpost['payment_gross']=$post['payment_gross'];
	$transpost['payment_status']=$post['st'];
	//$transpost['payment_type']=$post['payment_type'];
	//$transpost['item_name']=$post['item_name'];
	//$transpost['quantity']=$post['quantity'];
	//$transpost['txn_type']=$post['txn_type'];
	//$transpost['payment_date']=$post['payment_date'];
	//$transpost['business']=$post['business'];
	//$transpost['receiver_id']=$post['receiver_id'];
	//$transpost['notify_version']=$post['notify_version'];
	//$transpost['verify_sign']=$post['verify_sign'];
	$transpost['amt']=$post['amt'];
	$transpost['cc']=$post['cc'];
	$transpost['item_name']=@$post['item_name'];
	$transpost['item_number']=$post['item_number'];
	$transpost['sig']=@$post['sig'];
	$tempData = $this->session->userdata();
	$transpost['user_id']=$tempData["user_id"];
	if($transpost['payment_status']=="Completed")
	{
	$transid = $this->Signup_model->transactionDetails($transpost);
	unset($tempData["user_id"]);
	unset($tempData["__ci_last_regenerate"]);
	if (isset($tempData["member_id"]) && !empty($tempData["member_id"])) {
			unset($tempData["member_id"]);
			}
	$tempData["status"]=1;
	//dd($tempData);
		if($transid)
		{
		$tempid=$this->Signup_model->userRegistration($tempData);
			if($tempid)
			{
			$tempData = $this->session->userdata();
			if (isset($tempData["member_id"]) && !empty($tempData["member_id"])) {
			$this->Signup_model->updateMemStatus($tempid,$tempData["member_id"]);
			unset($tempData["member_id"]);
			}
			$this->Signup_model->updateTranstab($tempid,$transid);
			$tempData = $this->session->userdata();
			$this->Signup_model->del_temp_user_row($tempData["user_id"]);	
			}
		}
	$data['transaction_data']=$transpost;
	$this->session->sess_destroy();
	//die;
	}
	else
	{
		if (isset($tempData) && !empty($tempData)) {
		$this->Signup_model->del_temp_user_row($tempData["user_id"]);
		if (isset($tempData["member_id"]) && !empty($tempData["member_id"])) {
			$this->Signup_model->del_temp_member_row($tempData["member_id"]);
		}
		$this->session->sess_destroy();
		}
	}

	
    //dd($transpost); die;
	
	//dd($data);
    _frontLayout('thanku',$data);
    }
	
	public function payment_cancel()
    {
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

    public function register() {

        try {

             if ($this->form_validation->run($this, 'signup_form')) {
				
				$otp = codeOTP(6);
                $post = $this->input->post();
				//dd($post);
				//die;
                $userpost['user_name']=$post['user_name'];
				$userpost['user_lname']=$post['user_lname'];
				$userpost['mobile_no']=$post['mobile_no'];
				$userpost['user_login_id']=$post['user_login_id'];
				$userpost['user_email']=$post['user_email'];
				$userpost['location']=$post['location'];
				$userpost['city']=$post['city'];					
				$userpost['state']=$post['state'];
				$userpost['country']=$post['country'];	
				$userpost['zipcode']=$post['zipcode'];
				$userpost['language']=$post['language'];
				if($post['auto_renew']=="")
				{
				$userpost['auto_renew']='0';	
				}
				else
				{
				$userpost['auto_renew']=$post['auto_renew'];
				}
                $userpost['contact_code'] = $otp;
                $userpost['user_password'] = md5($post['user_password']);
				$userpost['role_id'] = $post['role_id'];
				$userpost['status'] = '0';
                unset($post['con_password']);
				//dd($post);
				//die;
				if($post['plan_id']=="1")
				{
				$memberpost['plan_name']=$post['plan_name'];
				$memberpost['plan_id']=$post['plan_id'];
				$memberpost['days']=$post['days'];
				$memberpost['price']=$post['price'];
				$memberpost['expiry_date']='0000-00-00 00:00:00';
				$memberpost['no_renewal']=1;
				$memberpost['user_email']=$post['user_email'];
				}
				else
				{
				$memberpost['plan_name']=$post['plan_name'];
				$memberpost['plan_id']=$post['plan_id'];
				$memberpost['days']=$post['days'];
				$memberpost['price']=$post['price'];
				$memberpost['expiry_date']=date('Y-m-d', strtotime('+'.$post['days']."days"));
				$memberpost['no_renewal']=1;
				$memberpost['user_email']=$post['user_email'];
				}
				//dd($memberpost);
				//die;
				$mem_id=$this->Signup_model->userMebership($memberpost);
				//echo $mem_id;
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
				$id = $this->Signup_model->userTempRegistration($userpost);
				//echo $id;
				$tempUserData = $this->Main_model->getdata_tablename_id('user_temp', 'user_id', "$id");
				//dd($tempUserData);
				//$user_email = $tempUserData['user_email'];
				//echo $user_email;
				//die;
				//$userData = array('user_id'=>"$user_email");
				//dd($data);die;
				$this->session->set_userdata($tempUserData);
				$tempData = $this->session->userdata();
				//dd($tempData);die;
				if($post['plan_id']=="1")
				{
				redirect('signup/paypal', $data);
				}
				elseif($userpost['auto_renew']=="0")
				{
				redirect('signup/paypal', $data);	
				}
				else
				{
				redirect('signup/paypal_auto_renew', $data);	
				}
				 //_frontLayout('paypal',$data);
				//die;

				
				$email_data['from'] = ADMIN_EMAIL;
				$email_data['to'] = $post['user_email'];
				$email_data['sender_name'] = TITLE;
				$email_data['name'] = $post['user_name'];
				$email_data['template'] = 'user-reg';
				$email_data['subject'] = 'New Standard Memeber Registration ' . TITLE;
				sendEmail($email_data);
				// Send transactionDetails to User
				$email_trdata['from'] = ADMIN_EMAIL;
				$email_trdata['to'] = ADMIN_SMIEMAIL;
				$email_trdata['sender_name'] = TITLE;
				//$email_trdata['name'] = ADMIN;
				$email_data['name'] = $post['user_name'];
				$email_data['email'] = $post['user_email'];
				$email_trdata['template'] = 'user-adminreg';
				$email_trdata['subject'] = 'New Standard Memeber Registration ' . TITLE;
				sendEmail($email_trdata);
				
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
}
