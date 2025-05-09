<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting('0');
class Admin_banner extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Banner_model','admin_dashboard/Homeview','admin_categories/Category_model'));
        $this->load->library(array('form_validation','session'));
        $this->load->helper(array('form', 'url'));
        //print_r($_SESSION);die;
        isAdminProtected();

    }
    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Most Popular Composers', '/admin/banner');
        $data['title'] = 'Manage Home';
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['banner'] = $this->Banner_model->getAllBanner();
		$data['all_data']=$this->Homeview->getAllBenefit();
		$data['all_data_member']=$this->Homeview->getAllMemberships();
		//dd($data);
		_adminLayout('banner', $data);
    }

    /**
     * add
     * @return Add Banner
     * @since 0.1
     * @author DHS
     */
    public function add()
    {
        try {
            $data['title'] = 'Manage Home';
            $data['action'] = 'add';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Composers', '/admin/banner');
            $this->breadcrumbs->push('Add', '/admin/banner/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['getlastBanner_position'] = $this->Banner_model->getlastBanner_position();
            if (isPostBack()) {
                //echo "Onn"; die;
                if ($this->form_validation->run($this, 'admin_banner')) {
                    //echo "TEST"; die;
                    $post = $this->input->post();
                    unset($post['submits']);
                    unset($post['old_image']);
                    $files = $_FILES;
                    /////////Generate directory if not exist
                    $dir = FCPATH . 'assets/uploads/composers_image';
                    generateDir($dir);
                    $img_data = UploadImage($files, './assets/uploads/composers_image', 'image', null);
                    if ($img_data) {
                        $post['image'] = $img_data['file_name'];
                        $this->Banner_model->storeBanner($post);
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Banner added successfully!!');
                        redirect(site_url('admin/banner'));
                    } else {
                         $this->session->set_flashdata('flash_msg_type', 'error');
                          $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('add-banner', $data);

                    }

                    //_adminLayout('add-banner', $data);
                } else {

                    _adminLayout('add-banner', $data);
                }
            } else {

                _adminLayout('add-banner', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * Edit
     * @return Edit Banner
     * @since 0.1
     * @author DHS
     */
    public function edit($id = false, $redirect_type='',$folder_id='')
    {

        try {
        $data['getlastBanner_position'] = $this->Banner_model->getlastBanner_position();

             $id = base64_decode($id);
             $folder_id = base64_decode($folder_id);
            $data['title'] = 'Manage Home';
            $data['action'] = 'edit/'.base64_encode($id);
            if($redirect_type!=''){
            $data['action'].= '/'.$redirect_type;
            }
            if($folder_id>0){
            $data['action'].= '/'.base64_encode($folder_id);
            }
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Banner', '/admin/banner');
            $this->breadcrumbs->push('Edit', '/admin/banner/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            
            if (isPostBack()) {

                if ($this->form_validation->run($this, 'admin_banner')) {
                    $post = $this->input->post();
                    
                     if($folder_id!=""){
                        $cat=(object)$this->Category_model->getDirIdBy_main_id($folder_id);
                        if($cat){
                            if($cat->folder_user_id){
                                $post['id']=$cat->folder_user_id;
                                $newid=$post['id'];
                            }
                        }
                     }
                   //  echo "<pre>";print_r($post);die;
                    unset($post['submits']);
                    ////////////////Image unlink from server//////////////
                    //print_r($_FILES['image']['name']);die;
                    if (!empty($_FILES['image']['name'])) {
                        $path = FCPATH . 'assets/uploads/composers_image/' . $post['old_image'];
                        if (!empty($post['old_image'])) {
                            if (file_exists($path)) {
                                unlink($path);
                            }
                        }
                        $files = $_FILES;
                        /////////Generate directory if not exist
                        $dir = FCPATH . 'assets/uploads/composers_image';
                        // generateDir($dir);
                        // $img_data = UploadImage($files, './assets/uploads/composers_image', 'image', null);
                        // if ($img_data) {
                        //     $post['image'] = $img_data['file_name'];
                        //     unset($post['old_image']);
                        // }
                             $single_image=strtotime('now').'_'.$_FILES['image']['name'];
                             $single_temp=$_FILES['image']['tmp_name'];
                             move_uploaded_file($single_temp, $dir.'/'.$single_image);
                              $post['image'] = $single_image;
                            unset($post['old_image']);



                    }
//******************update Position index start here***********************************

       function update_next_posiotion($next_posiotion,$profile_id){
        $CI = & get_instance();
        $save_position['position_index']=$next_posiotion;
        $save_position['id']=$profile_id;
                 $data_by_position=$CI->Banner_model->getAllBanner_by_position($next_posiotion);
                 $CI->Banner_model->updateBanner($save_position);
                    if(count($data_by_position)>0){
                        $posiotion=$data_by_position[0]['position_index']+1;
                        $profile_id=$data_by_position[0]['id'];
                          update_next_posiotion($posiotion,$profile_id);
                    }
       }

$data_by_position=$this->Banner_model->getAllBanner_by_position($post['position_index']);
if(count($data_by_position)>0){
    $posiotion=$post['position_index'];
   
    
      $profile_id=$post['id'];
      update_next_posiotion($posiotion,$profile_id);
}


//******************update Position index End  here***********************************
if($id>0){
   // echo "<pre>";print_r($post);die;
$this->Banner_model->updateBanner($post);
$composer_id=$id;
}
else if($newid>0){
    
$this->Banner_model->updateBanner($post);
$composer_id=$newid;
}
else{
    unset($post['id']);
    unset($post['old_image']);
$composer_id=$this->Banner_model->storeBanner($post);
}

//echo $folder_id;die;

                    if ($composer_id>0) {
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Composer update successfully!!');
                        if($folder_id>0){
                            $_SESSION['destination_last_id']=$folder_id;
                            $post_save['folder_user_id']=$composer_id;
                                    $this->Category_model->updateRecord($folder_id, $post_save);
                                if( $redirect_type =='cm'){
                                   redirect('/admin_categories/admin_comp'); 
                                   $this->session->unset_userdata('common');
                                }
                                if( $redirect_type =='mc'){
                                   redirect('/admin_categories'); 
                                   $this->session->unset_userdata('common');
                                }
                                if( $redirect_type =='sm'){
                                   redirect('/admin_categories/admin_school_music'); 
                                   $this->session->unset_userdata('common');
                                }
                                if( $redirect_type =='pa'){
                                   redirect('/admin_categories/admin_public_archive'); 
                                   $this->session->unset_userdata('common');
                                }
                                if( $redirect_type =='cp'){
                                   redirect('/admin_categories/admin_captured_music'); 
                                   $this->session->unset_userdata('common');
                                }
                                if( $redirect_type =='ms'){
                                   redirect('/admin_categories/admin_music_sale'); 
                                   $this->session->unset_userdata('common');
                                }
                                if( $redirect_type =='sd'){
                                   redirect('/admin_categories/admin_s_d'); 
                                   $this->session->unset_userdata('common');
                                }
                        }else{
                        redirect(site_url('admin/banner'));
                        }
                        //_adminLayout('brands');
                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('add-banner', $data);
                    }
                } else {
                    $data['obj_data'] = (object)$this->Banner_model->getBannerById($this->input->post('id'));
                    _adminLayout('add-banner', $data);
                    //redirect('admin_brand/edit/'.base64_encode($this->input->post('id')));
                }
            } else {
                //dd($this->Brand_model->getBrandById($id));
                $data['obj_data'] = (object)$this->Banner_model->getBannerById($id);
                if($data['obj_data']){
                    if($folder_id!=""){
                        $cat=(object)$this->Category_model->getDirIdBy_main_id($folder_id);
                        if($cat){
                            
                            $data['obj_data'] = (object)$this->Banner_model->getBannerById($cat->folder_user_id);
                        }
                    }
                }
               //echo "<pre>";print_r($data);print_r($cat);die;
                _adminLayout('add-banner', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * Delete
     * @return Delete Record
     * @since 0.1
     * @author DHS
     */
    public function deleteRecord()
    {
        $id = $this->input->post('id');
        if (isset($id) && !empty($id)) {
            $getAllImages = $this->Banner_model->getBannerById($id);
            if (isset($getAllImages) && !empty($getAllImages) && is_array($getAllImages) && count($getAllImages) > 0) {
                $ImgArr = [];
                $ImgArr['path'] = FCPATH . '/assets/uploads/composers_image/';
                $ImgArr['id'] = '';
                $ImgArr['image_name'] = $getAllImages['image'];
                if ($getAllImages['image'] != '') {
                    unLinkImage($ImgArr);
                }
            }

            $this->Banner_model->deleteRecord($id);
        }
    }
    public function delete_note()
    {
        $post=$this->input->post();
        //print_r($post);
        $music_id = $this->input->post('music_id');
        $note_id = $this->input->post('note_id');
        if ($music_id>0) {
            

            $this->Banner_model->update_deleteRecord($note_id);
            $this->Banner_model->update_music_library($music_id);
$_SESSION['destination_last_id']=$music_id;
$dynamic_flag = trim($post['back_url']);
                        if( $dynamic_flag =='cm'){
                           echo 'admin_categories/admin_comp'; 
                        }
                        if( $dynamic_flag =='mc'){
                           echo 'admin_categories'; 
                        }
                        if( $dynamic_flag =='sm'){
                           echo 'admin_categories/admin_school_music'; 
                        }
                        if( $dynamic_flag =='pa'){
                           echo 'admin_categories/admin_public_archive'; 
                        }
                        if( $dynamic_flag =='cp'){
                           echo 'admin_categories/admin_captured_music'; 
                        }
                        if( $dynamic_flag =='ms'){
                           echo 'admin_categories/admin_music_sale'; 
                        }
                        if( $dynamic_flag =='sd'){
                           echo 'admin_categories/admin_s_d'; 
                        }


        }
    }


    /**
     * change
     * @return change Status
     * @since 0.1
     * @author DHS
     */
    public function changeStatus()
    {
        $id = $this->input->post('id');
        $sts = $this->input->post('sts');
        echo $this->Banner_model->changeStatus($id, $sts);
    }


    /**
     * callback function
     * @return file value and type check during validation
     * @since 0.1
     * @author DHS
     */
    public function file_check($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        }/*else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }*/
    }


}


