<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$authInfo = $this->session->all_userdata(); dd($authInfo);
    if ($this->session->userdata('user_type')==1){
            redirect(site_url() . "admin/dashboard");
        }
        $this->load->model(array('viewcart/Main_model', 'Home_model','admin_categories/Category_model', 'composerprofile/Composerprofile_model', 'admin_seo_management/Folder_seo_model','admin_newsletter/Newsletter_join_model','admin_newsletter/Newsletter_model'));


if($this->session->userdata('user_id')>0){
              $plan_details= (array) $this->Home_model->get_plan_details($this->session->userdata('user_id'));
              //print_r($plan_details);die;
              $this->session->set_userdata('expiry_date',$plan_details['expiry_date']);

}


    }
    /**
     * Method index() redirects to the Home area.
     * @access    public
     * @param    Null
     * @return    null
     */
    public function index()
    {
        //$page_url=current_url();
        $page_url = rtrim(base_url(),"/");
        $data['meta_details'] = $this->Folder_seo_model->getCmsBy_url($page_url);
     //  echo "<pre>";print_r($this->session->userdata);die;
//print_r($seo);die;
		$data['banner']=$this->Home_model->banner(42);
		//$data['Home_Section1']=$this->Home_model->Home_Section1();
		$data['Home_Section2']=$this->Home_model->Home_Section2();
		$data['Home_Section4']=$this->Home_model->Home_Section4();
		//$data['Home_Section5']=$this->Home_model->Home_Section5();
		//$data['Section5_bottom']=$this->Home_model->Home_Section5_Bottom();
		$data['Home_Section6']=$this->Home_model->Home_Section6();
        _frontLayout('home', $data);
    }

    public function profile_details()
    {
         $page_url = rtrim(current_url(),"/");
        $data['meta_details'] = $this->Folder_seo_model->getCmsBy_url($page_url);
//print_r($data['meta_details']);
        
         $id=$this->uri->segment(3); 
         $pid=$this->uri->segment(3); 
                 $meta_tags = $this->Main_model->getdata_tablename_id('banner', 'id', $id);
                 $data['meta_details']['meta_title']=$meta_tags['meta_title'];
                 $data['meta_details']['meta_keyword']=$meta_tags['meta_keyword'];
                 $data['meta_details']['meta_desc']=$meta_tags['meta_desc'];
//print_r($meta_tags);

       $profile_details = $this->Home_model->banner_details($pid);
       
     //  echo "<pre>";print_r($profile_details);die;
       $data['detail'] = $profile_details[0];
        $data['objTree'] = $this->Category_model->profile_details_tree($pid);
        //print_r($data['objTree']);
        
         $this->session->set_userdata('permission_type','public');
        // $data['title'] = 'All Composers';
         $data['cate_type']='mastercomposer';
         $data['parent_id_root']=1;
        
        
        _frontLayout('composerprofile',$data);

    }
    public function allcomposerprofile()
    {
         $page_url = rtrim(current_url(),"/");
        $data['meta_details'] = $this->Folder_seo_model->getCmsBy_url($page_url);
         

            $data['banner']=$this->Home_model->banner();

        _frontLayout('allcomposerprofile',$data);

    }
    public function notfound()
    {
         $page_url = rtrim(current_url(),"/");
        $data['meta_details'] = $this->Folder_seo_model->getCmsBy_url($page_url);
        

        _frontLayout('notfound_404',$data);

    }
        
    
      function delete_all_user_2_years(){
        $data['title'] = '2 Years Expired Account List';
        $data['add_button'] = 2;
        $data['limit_days']=2*365;
        $since_date=date('Y-m-d',strtotime("-".$data['limit_days']." days"));
        $ten_days_date=date('Y-m-d',strtotime("-10 days"));
        
      //  echo $ten_days_date."<br>";
        $this->db->order_by('user_id', 'DESC');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where("email_status",1);
        $this->db->where("mail_reminder_date <",$ten_days_date);
        $this->db->where("DATE_FORMAT(last_login,'%Y-%m-%d') <", date('Y-m-d',strtotime($since_date)));
        $this->db->where("STR_TO_DATE(created_on,'%Y-%m-%d') <", date('Y-m-d 00:00:00',strtotime($since_date)));
        //  $this->db->limit(1);
        $obj_data = $this->db->get()->result_object();
        //   echo $this->db->last_query(); die;
        $obj_data=(isset($obj_data) && !empty($obj_data) ? $obj_data : '');
       
    //    echo "<pre>";print_r($obj_data);die;
        
         foreach ($obj_data as $value) {
            
             $this->db->query("DELETE FROM `user` WHERE `user_id` = '".$value->user_id."'");
         }
        
        
      }
    
      function show_all_user_2_years(){
        $data['title'] = '2 Years Expired Account List';
        $data['add_button'] = 2;
        $data['limit_days']=2*365;
        $since_date=date('Y-m-d',strtotime("-".$data['limit_days']." days"));
           // $time = strtotime("-2 year", time());
          // $since_date = date("Y-m-d", $time);
       // print_r($date);die;
       // print_r($since_date);
        $this->db->order_by('user_id', 'DESC');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where("email_status",0);
        $this->db->where("DATE_FORMAT(last_login,'%Y-%m-%d') <", date('Y-m-d',strtotime($since_date)));
        $this->db->where("STR_TO_DATE(created_on,'%Y-%m-%d') <", date('Y-m-d 00:00:00',strtotime($since_date)));
      //  $this->db->limit(1);
        $obj_data = $this->db->get()->result_object();
           //echo $this->db->last_query(); die;
        $obj_data=(isset($obj_data) && !empty($obj_data) ? $obj_data : '');
       
     //  echo "<pre>";print_r($obj_data);die;
        
        
        
        foreach ($obj_data as $value) {
            
             $this->db->where('user_id', $value->user_id);
            $query = $this->db->get('user');
            $get_user_detail= $query->row_array();
              //  print_r($get_user_detail);
             //   die;
                        // $get_user_detail=$this->Usermodal->get_user($value->user_id);
            if($get_user_detail['role_id']==2){
            $message_body="Notice:-  Your account with Sheet Music International is scheduled to be deleted because it has been a year since anyone has logged into the account.  
            <br/>
            <br/>
            If you wish to keep this account please log into your account within 30 days of this e-mail to prevent system from deleting it.  
            ";
            }elseif($get_user_detail['role_id']==3){
            $message_body="Notice:  It is time to renew your premium membership to Sheet Music International.  To renew your account please <a href='https://sheetmusicinternational.com/renew_membership'> click here </a>.  
            <br/>
            <br/>
            Please continue to support the music community with your premium membership.  
            <br/>
            <br/>
            If you choose not to renew your premium account your account will automatically be converted to a standard account.";
            
            }
            
            $save_data['mail_reminder_date']=date('Y-m-d');
            $save_data['login_status']=0;
            $save_data['email_status']=1;
          //  $this->Usermodal->update_user($save_data,$get_user_detail['user_id']);
            
             $this->db->where('user_id', $get_user_detail['user_id']);
              $query=$this->db->update('user', $save_data);
            
            
                  $last_mail_reminder_date=date('m',strtotime($get_user_detail['mail_reminder_date'])); 
                   $since_date=date(ADMIN_DATE_FORMAT,strtotime($get_user_detail['last_login']));
                   $year=date('Y',strtotime($get_user_detail['last_login']));
                   if($year<2000){
                    $since_date='00-00-0000';
                   }
            $this->load->library('email'); 
            $this->email->from('no-reply@sheetmusicinternational.com', 'Sheet Music International');
            $this->email->to($get_user_detail['user_email']);
            $this->email->subject('Notice: Un-used login account.');
            $message="Dear ".$get_user_detail['user_login_id'].",
            <br/><br/>
            
            Your account not login Since <strong>".$since_date."</strong>.
            <br/>
            <br/>
            ".$message_body."
            
            <br/>
            <br/>
            Thanks/Ragards<br/>
            Sheet Music International<br/>
            ".base_url();
            $this->email->message($message);
            
               var_dump($this->email->send()); //die;
        }
       
    }
	
	
	    public function submitQuery() {
        try {
            if ($this->form_validation->run($this, 'home_email')) {
                $post = $this->input->post();
				$this->Main_model->data_insert('contact',$post);
			 
					$email_data['from'] = $post['email'];
					$email_data['to'] = ADMIN_EMAIL ;
					$email_data['logo']=_frontLogo()['site_logo'];
					$email_data['sender_name'] = $post['fname'];
					$email_data['email']=$post['email'];
					$email_data['message']=$post['message'];
					$email_data['template'] = 'enquiry';
					$email_data['subject'] = 'New Enqiury Email From ' . TITLE;
					sendEmail($email_data);
					
					$data['msg'] = 'Thanks for writing Us,We will conacting soon!!';
					$data['error_type'] = 'success';
					$this->session->set_flashdata('flash_msg_type', 'success');
					$this->session->set_flashdata('flash_msg_text', $data['msg']);
					redirect('home');
            } else {
                $data['errorMsg'] = validation_errors();
				$data['seo'] = $this->Main_model->getdata_tablename_id('home_seo', 'id', '1');
				$data['meta_title'] =$data['seo']['meta_title'];
				$data['meta_description'] = $data['seo']['meta_description'];
				$data['meta_tag'] = $data['seo']['meta_keyword'];
				$data['canonical_url'] = $data['seo']['canonical_url'];
				$data['banner']=$this->Home_model->banner();
				//$data['Home_Section1']=$this->Home_model->Home_Section1();
				$data['Home_Section2']=$this->Home_model->Home_Section2();
				$data['Home_Section4']=$this->Home_model->Home_Section4();
				//$data['Home_Section5']=$this->Home_model->Home_Section5();
				//$data['Section5_bottom']=$this->Home_model->Home_Section5_Bottom();
				$data['Home_Section6']=$this->Home_model->Home_Section6();
                _frontLayout('home', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
    function updateuserrole(){
        if($this->session->has_userdata("user_id")){
            $data=$this->db->update("user",["role_id"=>"2"],["user_id"=>$this->session->userdata("user_id")]);
           
            $this->session->set_userdata("user_type","2");
            return redirect('/');
        }else{
            return redirect('/');
        }
        
    }
    
    function newsletter_unsubscribe($email){
       
        newsletter_unsubscribe(base64_decode($email));
        $data=array();
                _frontLayout('newsletter_unsubscribe',$data);

    }
    function newsletterHTML(){
       
        $data=array();
                _frontLayout('newsletterHTML',$data);

    }
    function newsletter_subscribe(){
       
            echo   newsletter_subscribe_user($this->input->post('email'));die;


    }



      function newsletterCronjob(){
           
        
        
           $queryResult  =$this->Newsletter_join_model->getUnsentNewsletter();

       foreach ($queryResult as $key => $value) {
        $newsletterlist = $this->Newsletter_model->getnewsletterById($value['newsletter_id']);

             $this->load->library('email');
                $config_email['mailtype'] = 'html';
                $this->email->initialize($config_email);
            $this->email->from('no-reply@sheetmusicinternational.com', 'Sheet Music International');
            $this->email->to($value['email']);
             $this->email->set_mailtype("html");
            $newsletterlist['emailID']=$value['email'];
            $this->email->subject($newsletterlist['subject']);
            $message_body= $this->load->view('email_template/newsletter', $newsletterlist, true);
            //$newsletterlist['content_text'];

            $this->email->message($message_body);

               if($this->email->send()){
                $savedata['email']=$value['email'];
                $savedata['cronjob_status']=1;
                $this->Newsletter_join_model->updatenewsletter($savedata);
               }
               
             }
       
       
    }


    public function set_language()
    {
        $language = $this->input->post('language');
        if ($language) {
            $this->session->set_userdata('language', $language);
            echo json_encode(['status' => 'success', 'language' => $language]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Language not provided']);
        }
    }
}