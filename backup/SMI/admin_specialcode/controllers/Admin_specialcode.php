<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_specialcode extends MY_Controller

{



    public function __construct()

    {

        parent::__construct();

        $this->load->model(array('specialcode_model', 'admin_dashboard/Homeview', 'admin_user/Usermodal'));

        $this->load->library(array('form_validation', 'session'));

        $this->load->helper(array('form', 'url'));

        isAdminProtected();
    }



    public function index()

    {

        $data['specialcodelist'] = $this->specialcode_model->getAllspecialcode();

        $data['title'] = 'specialcode';

        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');

        $this->breadcrumbs->push('specialcode', '/admin/specialcode');

        $data['breadcrumb'] = $this->breadcrumbs->show();
        _adminLayout('specialcode', $data);
    }

    public function show($id)

    {

        $data['specialcodelist'] = $this->specialcode_model->getspecialcodeById(base64_decode($id));
        $all_user = $this->Usermodal->get_all_user_list();
        foreach ($all_user as $valueData) {
            $data['all_user_email'][] = $valueData->user_email;
            if ($valueData->role_id == 2) {
                $data['standard_user_email'][] = $valueData->user_email;
            }
            if ($valueData->role_id == 3) {
                $data['premium_user_email'][] = $valueData->user_email;
            }
        }

        $data['title'] = 'specialcode';

        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');

        $this->breadcrumbs->push('specialcode', '/admin/specialcode');

        $data['breadcrumb'] = $this->breadcrumbs->show();
        _adminLayout('show', $data);
    }

    public function sendMail($id)

    {
        $userType = $_GET['type'];
        $get_user_detail = array();
        if ($userType == 'allUser') {
            $role_id = '';
            $get_user_detail = $this->Usermodal->get_all_user_list();
        }
        if ($userType == 'standardUser') {
            $role_id = 2;
            $get_user_detail = $this->Usermodal->get_all_user_list($role_id);
        }
        if ($userType == 'premiumUser') {
            $role_id = 3;
            $get_user_detail = $this->Usermodal->get_all_user_list($role_id);
        }

        $specialcodelist = $this->specialcode_model->getspecialcodeById(base64_decode($id));
        foreach ($get_user_detail as $key => $valueData) {

            if (isset($valueData->user_email) && $valueData->user_email != '') {
                $value = $valueData->user_email;
                $verify_subscriber = specialcode_subscribe($value, base64_decode($id), $valueData->role_id);
            }
        }

        $this->session->set_flashdata('flash_msg_type', 'success');
        //  if($single>0){
        $this->session->set_flashdata('flash_msg_text', 'Mail Sent successfully!');
        // }else{
        // $this->session->set_flashdata('flash_msg_text', 'Mail Sent successfully to all following users list.');
        // }
        redirect(base_url() . 'admin_specialcode');
        die;
    }

    public function sendMailOnEmails()

    {

        $email_id = extract_email_addresses($_POST['email_address']);

        $specialcodelist = $this->specialcode_model->getspecialcodeById($_POST['newslatterID']);


        foreach ($email_id as $key => $value) {
            $verify_subscriber = specialcode_subscribe($value, $_POST['newslatterID']);
            //dd($verify_subscriber);die;



        }

        //}


        $this->session->set_flashdata('flash_msg_type', 'success');
        //  if($single>0){
        $this->session->set_flashdata('flash_msg_text', 'Mail Sent successfully!');
        // }else{
        // $this->session->set_flashdata('flash_msg_text', 'Mail Sent successfully to all following users list.');
        // }
        redirect(base_url() . 'admin_specialcode');
        //die;



    }



    /**

     * add

     * @return Add specialcode

     * @since 0.1

     * @author Devendra Tiwari

     */



    public function add()

    {

        try {

            $data['title'] = 'Special code';

            $data['action'] = 'add';

            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');

            $this->breadcrumbs->push('specialcode', '/admin_specialcode');

            $this->breadcrumbs->push('Add', '/admin_specialcode/add');

            $data['breadcrumb'] = $this->breadcrumbs->show();

            if (isPostBack()) {

                //echo "Onn"; die;

                if ($this->form_validation->run($this, 'admin_specialcode')) {

                    //echo "TEST"; die;

                    $post = $this->input->post();

                    unset($post['submits']);


                    $files = $_FILES;

                    /////////Generate directory if not exist

                    $dir = FCPATH . 'assets/uploads/specialcode';

                    generateDir($dir);

                    //  echo ;die;
                    ////////////////////////////
                   

                    if ($post) {


                        $this->specialcode_model->storespecialcode($post);

                        $this->session->set_flashdata('flash_msg_type', 'success');

                        $this->session->set_flashdata('flash_msg_text', 'specialcode added successfully!!');

                        redirect(site_url('admin_specialcode'));
                    } else {

                        $this->session->set_flashdata('flash_msg_type', 'error');

                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');

                        _adminLayout('add-specialcode', $data);
                    }



                    //_adminLayout('add-banner', $data);

                } else {



                    _adminLayout('add-specialcode', $data);
                }
            } else {



                _adminLayout('add-specialcode', $data);
            }
        } catch (Exception $ex) {

            var_dump($ex->getMessage());
        }
    }





    /**

     * Edit

     * @return Edit specialcode

     * @since 0.1

     * @author Devendra Tiwari

     */

    public function edit($id = false)

    {

        try {



            $id = base64_decode($id);

            $uri = $this->uri->segment(4);



            // if($uri == "MTE="){

            //    $data['title'] = 'Manage FAQS'; 

            // }

            //$data['title'] = 'Manage About';

            $data['action'] = 'edit';

            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');

            // $this->breadcrumbs->push('specialcode', '/admin/specialcode');

            $this->breadcrumbs->push('Edit', '/admin_specialcode/edit');

            $data['breadcrumb'] = $this->breadcrumbs->show();

            $data['all_data'] = $this->Homeview->getAllBenefit();

            $data['all_data_member'] = $this->Homeview->getAllMemberships();

            if (isPostBack()) {



                if ($this->form_validation->run($this, 'admin_specialcode')) {

                    $post = $this->input->post();

                    unset($post['submits']);

                    ////////////////Image unlink from server//////////////

                    $dir = FCPATH . 'assets/uploads/specialcode';

                    generateDir($dir);

                    //  echo ;die;
                    ////////////////////////////
                 

                    if ($this->specialcode_model->updatespecialcode($post)) {

                        $this->session->set_flashdata('flash_msg_type', 'success');

                        $this->session->set_flashdata('flash_msg_text', 'specialcode update successfully!!');

                        redirect(site_url('admin_specialcode'));

                        //redirect(site_url('admin/specialcode'));

                        //_adminLayout('brands');

                    } else {

                        $this->session->set_flashdata('flash_msg_type', 'error');

                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');

                        _adminLayout('add-specialcode', $data);
                    }
                } else {

                    $data['obj_data'] = (object)$this->specialcode_model->getspecialcodeById($this->input->post('id'));
                    $data['title'] = 'Manage ' . $data['obj_data']->page;
                    _adminLayout('add-specialcode', $data);
                }
            } else {

                $data['obj_data'] = (object)$this->specialcode_model->getspecialcodeById($id);
                $data['title'] = 'Manage specialcode';

                //dd($data);

                _adminLayout('add-specialcode', $data);
            }
        } catch (Exception $ex) {

            var_dump($ex->getMessage());
        }
    }





    /**

     * Delete

     * @return Delete Record

     * @since 0.1

     * @author Devendra Tiwari

     */

    public function deleteRecord()

    {

        $id = $this->input->post('id');

        if (isset($id) && !empty($id)) {

            $this->specialcode_model->deleteRecord($id);
        }
    }





    /**

     * change

     * @return change Status

     * @since 0.1

     * @author Devendra Tiwari

     */

    public function changeStatus()

    {

        $id = $this->input->post('id');

        $sts = $this->input->post('sts');

        echo $this->specialcode_model->changeStatus($id, $sts);
    }





    public function get_dir_size()
    {
        $dir = FCPATH;


        $size = 0;
        $files = glob($dir . '*');
        foreach ($files as $path) {
            is_file($path) && $size += filesize($path);
            is_dir($path)  && $size += get_dir_size($path);
        }
        dd($size);
    }
}
