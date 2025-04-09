<?php

defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(1);

class Contact extends MY_Controller
{

    public function __construct()

    {

        parent::__construct();

        $this->load->model(array('viewcart/Main_model','admin_seo_management/Folder_seo_model'));

    }


    /**
     * Method index() redirects to the Comming Soon area.
     * @access    public
     * @param    Null
     * @return    null
     */

    public function index()

    {
$page_url = rtrim(current_url(),"/");
        $data['meta_details'] = $this->Folder_seo_model->getCmsBy_url($page_url);


        
        $data['contacr_details'] = $this->Main_model->getdata_tablename_id('contact_address', 'id', '1');
       
        _frontLayout('contact-us', $data);
    }
	
	    public function contacts() {

		try {

            if ($this->form_validation->run($this, 'contact_email')) {
           
                $post = $this->input->post();
                //dd($post); die;
				$this->Main_model->data_insert('contact',$post);
				///////
					// Send mail to User
					$email_data['from'] = ADMIN_EMAIL;
					$email_data['to'] = $post['email'];
					$email_data['sender_name'] = TITLE;
					$email_data['name'] = $post['fname'];
					$email_data['message'] = $post['message'];
					$email_data['template'] = 'contact-email';
					$email_data['subject'] = 'Contact request successfully intiated from ' . TITLE;
					sendEmail($email_data);
					//die;
					// Send transactionDetails to User
					//$email_trdata['from'] = ADMIN_EMAIL;
					//$email_trdata['to'] = $post['user_email'];
					//$email_trdata['sender_name'] = TITLE;
					//$email_trdata['name'] = $post['user_name'];
					//$email_trdata['tran_id'] = $paymentResponse['transaction_id'];
					//$email_trdata['amount'] = $paymentResponse['amount'];
					//$email_trdata['template'] = 'trans-email';
					//$email_trdata['subject'] = 'Membership Payment ' . TITLE;
					//sendEmail($email_trdata);
				///////
					
					$data['msg'] = 'Thanks for writing Us,We will conacting soon!!';
					$data['error_type'] = 'success';
					$this->session->set_flashdata('flash_msg_type', 'success');
					$this->session->set_flashdata('flash_msg_text', $data['msg']);
					redirect('contact');
					} else {
                $data['errorMsg'] = validation_errors();
				$data['contacr_details'] = $this->Main_model->getdata_tablename_id('contact_address', 'id', '1');
				$data['meta_title'] =$data['contacr_details']['meta_title'];
				$data['meta_description'] = $data['contacr_details']['meta_description'];
				$data['meta_tag'] = $data['contacr_details']['meta_keyword'];
				$data['canonical_url'] = $data['contacr_details']['canonical_url'];
                _frontLayout('contact-us', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
            
        } 

        public function subscription() {

        try {

            if ($this->form_validation->run($this, 'subscription')) {
           
                $post = $this->input->post();
                //dd($post); die;
                $this->Main_model->data_insert('subscription',$post);
                    $email_data['from'] = ADMIN_EMAIL;
                    $email_data['to'] = $post['email'];
                    $email_data['logo']=_frontLogo()['site_logo'];
                    $email_data['template'] = 'subscription';
                    $email_data['subject'] = 'Subscription Email From ' . TITLE;
                    //dd($email_data); die;
                    sendEmail($email_data);

                    
                    
                    $data['msg'] = 'Thanks for your Subscription!!';
                    $data['error_type'] = 'success';
                    $this->session->set_flashdata('flash_msg_type', 'success');
                    $this->session->set_flashdata('flash_msg_text', $data['msg']);
                    redirect('contact');
                    } else {
                $data['errorMsg'] = validation_errors();
                _frontLayout('contact-us', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
            
        } 
    }

	



