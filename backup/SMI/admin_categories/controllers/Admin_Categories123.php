<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting('1');
class Admin_categories extends MY_Controller {
    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->load->model(array('Category_model','mastercomposer/Mastercomposer_model','comp/Comp_model','admin_user/Usermodal'));
        $this->load->library(array('form_validation', 'session'));
        //$this->load->helper(array('form', 'url'));
        isAdminProtected();

// $all_parent_url = $this->Category_model->getall_parent_url();
// if(count($all_parent_url)>0){
// foreach ($all_parent_url as $key => $value) {
//     $parent_url = $this->Category_model->getDirNamesById($value->parent_id);
// $genrate_url=$parent_url.'/'.$value->name;
//     $genrate_url_array=array_unique(array_filter(explode('/',$genrate_url)));
//     $update_parent_url['parent_url']=implode('/',$genrate_url_array);
//     $file_path['file_path']=implode('/',$genrate_url_array);
//     $this->Category_model->updateRecord($value->id, $update_parent_url);
//     $this->Category_model->updateRecord_file($value->id, $file_path);//*********change id to 'cat_id' in model befor update
// }
// }




    }
    public function index() {

        $data['parent_id']=1;
        $data['redirect_type']='mc';
		$get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_new($data['parent_id']);
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
    public function ajax_root_folder_index() {

        $data['parent_id']=$this->input->post('parent_id');
        $data['redirect_type']=$this->input->post('redirect_type');//'mc';
        $alphaSearch_keyword=$this->input->post('alphaSearch_keyword');//'mc';
        if($data['parent_id']==132){
            $data['cate_type']='comp';
        }else{
            $data['cate_type']='';
        }
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        if($alphaSearch_keyword==''){
        $folders = $this->Category_model->getCategoryTreeData_new_root($data['parent_id']);
        }else{
        $folders = $this->Category_model->getCategoryTreeData_alphaSearch($data['parent_id'],$alphaSearch_keyword,$data['cate_type']);
        }
$data['objTree']['folders']=$folders;
$data['objTree']['files']=array();
        echo  json_encode($data['objTree']);die;

        //dd($data['objTree']); die;
        // $data['title'] = 'Manage Libraries';
        // return $this->load->view('ajax_root_folder', $data);
    }
    public function admin_comp() {
        $data['parent_id']=132;
        $data['redirect_type']='cm';
        $data['cate_type']='comp';
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_new($data['parent_id'],$data['cate_type']);
        // $data['objTree_1'] = $this->Category_model->getCategoryTreeData_new(1,'test');
        // $data['objTree_2'] = $this->Category_model->getCategoryTreeData_new(132,'test');
        // echo count($data['objTree_1']);
        // echo "<br/>";
        // echo count($data['objTree_2']); 
        //die;
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
    public function admin_school_music() {
        $data['parent_id']=1321;
        $data['redirect_type']='sm';
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_new($data['parent_id']);
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
    public function admin_public_archive() {
        $data['parent_id']=12522;
        $data['redirect_type']='pa';
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_new($data['parent_id']);
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
    public function admin_captured_music() {
        $data['parent_id']=12619;
        $data['redirect_type']='cp';
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_new($data['parent_id']);
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
    public function admin_music_sale() {
        $data['parent_id']=13763;
        $data['redirect_type']='ms';
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_new($data['parent_id']);
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
    public function admin_s_d() {
        $data['parent_id']=14155;
        $data['redirect_type']='sd';
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_new($data['parent_id']);
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
public function alphaSearch($parent_id,$keyword,$redirect_type)
    {   
        $data['parent_id']=$parent_id;
        $data['redirect_type']=$redirect_type;
        $data['alphaSearch_keyword']=$keyword;
        if($redirect_type=='cm'){
        $data['cate_type']='comp';
        }
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Category_model->getCategoryTreeData_alphaSearch($parent_id,trim(strtolower($keyword)),$data['cate_type']);
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('categories', $data);
    }
public function child_data_tree()
    { 
                $parent_id=$this->input->post('parent_id');
            $category_title=$this->input->post('category_title');
            $data['objTree'] = $this->Category_model->tree_html_name($parent_id,$category_title);
            $data['parent_id_tree'] = $parent_id;
            $data['move_copy_approve'] = 'yes';
        return $this->load->view('ajax_child_tree',$data);
        die;
}

     public function ajax_root_folder_index_gaurav() {

        $data['parent_id']=$this->input->post('parent_id');
        $data['redirect_type']=$this->input->post('redirect_type');//'mc';
        $alphaSearch_keyword=$this->input->post('alphaSearch_keyword');//'mc';
        $keywords=$this->input->post('keywords');
        if($data['parent_id']==132){
            $data['cate_type']='comp';
        }else{
            $data['cate_type']='';
        }
        $get = $this->input->get();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('delete_status!=', 2);
        if($alphaSearch_keyword){
            if($alphaSearch_keyword!='all'){
               $this->db->where("name LIKE '$alphaSearch_keyword%'");
            }
        }
        if($this->input->post('keywords')){
             $this->db->where("name LIKE '%".$this->input->post('keywords')."%'");
        }
        $this->db->order_by("name", "asc");
        if($data['cate_type']=='comp'){
        $this->db->where('(`parent_id` = 1 OR `parent_id` = 132)');
        }else{
        $this->db->where('parent_id', $data['parent_id']);
        }
        $start=$this->input->post("start");
        $limit=100;
       
        $this->db->limit($limit, $start);

        $parent = $this->db->get(); 
        $folders = $parent->result();
        
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('delete_status!=', 2);
        if($alphaSearch_keyword){
            if($alphaSearch_keyword!='all'){
              $this->db->where("name LIKE '$alphaSearch_keyword%'");
            }
        }
        if($keywords){
             $this->db->where("name LIKE '%$keywords%'");
        }
        $this->db->order_by("name", "asc");
        if($data['cate_type']=='comp'){
        $this->db->where('(`parent_id` = 1 OR `parent_id` = 132)');
        }else{
        $this->db->where('parent_id', $data['parent_id']);
        }
       
        $count = ($this->db->get()->num_rows()); 
        
        
         $next=$start+$limit;
        
       // echo $this->db->last_query();die;
        $data['objTree']['folders']=$folders;
        $data['objTree']['files']=array();
        if($count<$next){
            $next='';
        }
        $data['objTree']['next_data']=$next;
        $data['objTree']['count']=$count-$next;
        //echo "<pre>";print_r($data);die;
        echo  json_encode($data['objTree']);die;
       
    }
public function child_data_tree1()
    { 
                $parent_id=$this->input->post('parent_id');
            $category_title=$this->input->post('category_title');
            $data['objTree'] = $this->Category_model->tree_html_name($parent_id,$category_title);
            $data['parent_id_tree'] = $parent_id;
            $data['move_copy_approve'] = 'yes';
        return $this->load->view('ajax_child_tree1',$data);
        die;
}
public function verify_folder_existing()
    { 
                $parent_id=$this->input->post('category_id');
            $moving_folder_name=$this->input->post('moving_folder_name');
            $type=$this->input->post('type');
            if($type=='file'){
             $data['objTree'] = $this->Category_model->verify_single_file($parent_id,$moving_folder_name);
            }else{
             $data['objTree'] = $this->Category_model->verify_folder_existing($parent_id,$moving_folder_name);
            }
           echo count($data['objTree']);
        die;
}
public function bookmark_individual_user($id)
    { $data=array();
             $data['folder_id']= $id;

if($this->input->post()){
$post=$this->input->post();
unset($post['submits']);
$user_detail=$post['user_detail'];

 // $user_id=str_replace(")","",$user_detail[1]);
 // $user_email= $user_detail[0];

//print_r($user_detail);die;
if(base64_decode($id)>0){
    foreach ($user_detail as $key => $user_id_value) {
      
        $data['title'] = 'All Cpmposers';
        $data['objTree'] = $this->Category_model->getRecordById(base64_decode($id));
//print_r($data['objTree']);die;
        $cat_id = $data['objTree']->id;
        $parent_id = $data['objTree']->parent_id;
        $plArray['cat_id'] = $cat_id;
        $plArray['bookmark_id'] = $cat_id;
        $plArray['parent_id'] = 2;
        $plArray['user_id'] = $user_id_value;
        $plArray['rename_folder'] = $data['objTree']->name;
        $plArray['temp_rename_folder'] = $data['objTree']->name;

        $data['pl_Array'] = $this->Category_model->storePersonalLibrary($plArray);
        }
    }
                    $_SESSION['destination_last_id']=base64_decode($id);  

$this->session->set_flashdata('flash_msg_type', 'success');
    $this->session->set_flashdata('flash_msg_text', 'Composer bookmarked in personal library Successfully!');
                        //_adminLayout('add-categories', $data);
                        
                        $dynamic_flag = $post['back_url'];
                        if( $dynamic_flag =='cm'){
                           redirect('/admin_categories/admin_comp'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='mc'){
                           redirect('/admin_categories'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='sm'){
                           redirect('/admin_categories/admin_school_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='pa'){
                           redirect('/admin_categories/admin_public_archive'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='cp'){
                           redirect('/admin_categories/admin_captured_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='ms'){
                           redirect('/admin_categories/admin_music_sale'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='sd'){
                           redirect('/admin_categories/admin_s_d'); 
                           $this->session->unset_userdata('common');
                        }





}

        $data['get_all_user_list']= $this->Usermodal->get_all_user_list();
        _adminLayout('bookmark_individual_user', $data);
       // die;
}
public function ajax_child_data()
    { 
    $parent_url_array=array();   
        $parent_id=$this->input->post('parent_id');
//         $parent_url=base64_decode($this->input->post('parent_url'));
// //***********************Parent url update*********************************************
//         	        $category_name = $this->Category_model->getCategory_name($parent_id);
// if($parent_url!=''){
// 	$parent_url_array=array_filter(explode('/',$parent_url));
// }

// if (!in_array($category_name[0]->name, $parent_url_array)){
// $parent_url .='/';
//         	        $array['parent_url']=$parent_url.trim($category_name[0]->name);
//                     $file_path['file_path']=$parent_url.trim($category_name[0]->name);
//         	       $this->Category_model->updateRecord($parent_id, $array);
//                    $this->Category_model->updateRecord_file_ajax($parent_id, $file_path);//*********change id to 'cat_id' in model befor update
//  }else{ //******************only file path will update
   
//                     $file_path['file_path']=$category_name[0]->parent_url;
//                    $this->Category_model->updateRecord_file_ajax($parent_id, $file_path);//*********change id to 'cat_id' in model befor update
//  }       	       
// //***********************Parent url update end here*********************************************
        $data['redirect_type']=$this->input->post('redirect_type');
            $folders = $this->Category_model->getCategoryTreeData_ajax($parent_id);
            $data['parent_id_tree'] = $parent_id;
              $files = $this->Category_model->getImagesById($parent_id);
$data['objTree']['folders']=$folders;
$data['objTree']['files']=$files;
            echo json_encode($data['objTree']);die;
        // return $this->load->view('ajax_child_tree',$data);
        // die;
    }

    public function rename_folder()
    {  


       $type= $this->input->post('type');
          if($type=='folder'){
                      $p_detail=$this->Category_model->getCategory_name($this->input->post('id'));
                $folder_path = $this->Category_model->getDirNamesById($this->input->post('id'));
                $parent_folder_path = $this->Category_model->getDirNamesById($p_detail[0]->parent_id);
                //$this->Category_model->getCategory_name($this->input->post('id'));
                $parent_details = $this->Category_model->getCategory_name($p_detail[0]->parent_id);

                //$new_name=str_replace(' ', '-', trim($this->input->post('new_name')));
                $new_name=trim($this->input->post('new_name'));
                $old_folder_name=$this->input->post('old_folder_name');
                $new_url=$parent_folder_path.'/'.$new_name;
                // $parent_array=explode('/', $parent_details[0]->parent_url);
                // end($parent_array);
                // $key = key($parent_array);
                
//***********check folder already exist or not
                $exiting_data = $this->Category_model->verify_folder_rename($p_detail[0]->parent_id,$this->input->post('id'),$new_name);
                if(count($exiting_data)>0){
                // echo "<pre>";
                //print_r($exiting_data);
                echo 0;
                die;
}
                
//***********check folder already exist or not end





                // $parent_array=implode('/', $parent_array);
                $save['parent_url']=$new_url;
                $save['name']=$new_name;

                 $dir_old = FCPATH . "assets/uploads/Sheet-Music/".$folder_path;
                  $dir_new = FCPATH . "assets/uploads/Sheet-Music/".$new_url;
                rename($dir_old,$dir_new);/////************rename is php default function

                  $file_update['file_path']=$new_url;
                $this->Category_model->updateRecord_file_ajax($this->input->post('id'),$file_update);

                  $save['rename_folder']= $new_name;
                  $save['name']= $new_name;
                  $where['id']= $this->input->post('id');
                  $table_name="categories";
              }else{
                  $save['rename_file']= $this->input->post('new_name');
                  $where['id']= $this->input->post('id');
                  $table_name="category_image";
 //******************FILE rename************                 
 $post=$this->input->post();
 $parent_id=$post['parent_id'];
 $save['image']=$post['new_name'];
$parent_url=$this->Category_model->getDirNamesById($parent_id);//$this->Category_model->getCategory_name($post['parent_id']);
$save['file_path']=$parent_url;
$dir_old = FCPATH . "assets/uploads/Sheet-Music/".$parent_url.'/'.$post['old_folder_name'];
 $dir_new = FCPATH . "assets/uploads/Sheet-Music/".$parent_url.'/'.$post['new_name'];
 rename($dir_old,$dir_new);
 //******************FILE rename************
              }
        if($where['id']>0 && ($save['rename_file']!='' || $save['rename_folder']!='')){
         $this->Category_model->update_folder_data($table_name,$where,$save);
        }



echo 1;
die;
    }

    ///added on 24 dec for file path updation////

     public function rename_file_path()
    {  
       //$type= $this->input->post('type');
          

                $parent_details1 = $this->Category_model->getDirNamesById(17012);
                //print_r($parent_details1);
        //         // $parent_array=explode('/', $parent_details[0]->parent_url);
        //         // end($parent_array);
        //         // $key = key($parent_array);
                
        //         // $parent_array=implode('/', $parent_array);
        //         $save['parent_url']=$new_url;
        //         $save['name']=$new_name;

        //         $dir_old = FCPATH . "assets/uploads/Sheet-Music/".$parent_details1[0]->parent_url;
        //          $dir_new = FCPATH . "assets/uploads/Sheet-Music/".$new_url;
        //         rename($dir_old,$dir_new);/////************rename is php default function

        //           $file_update['file_path']=$new_url;
        //         $this->Category_model->updateRecord_file_ajax($this->input->post('id'),$file_update);

        //           $save['rename_folder']= $new_name;
        //           $where['id']= $this->input->post('id');
        //           $table_name="categories";
             
        // if($where['id']>0 && ($save['rename_file']!='' || $save['rename_folder']!='')){
        //  $this->Category_model->update_folder_data($table_name,$where,$save);
        // }




die;
    }

    ////file path updation ends here////
     public function custom_text()
    {  
          $type= $this->input->post('type');
          if($type=='folder'){
                  $save['custom_text']= $this->input->post('new_custom_text');
                  $where['id']= $this->input->post('id');
                  $table_name="categories";
              }else{
                  $save['custom_text']= $this->input->post('new_custom_text');
                  $where['id']= $this->input->post('id');
                  $table_name="category_image";
              }
        if($where['id']>0){
        $this->Category_model->update_folder_data($table_name,$where,$save);
        }
die;
    }
     public function keyword_text()
    {  
          $type= $this->input->post('type');
          if($type=='folder'){
                  $save['keyword']= $this->input->post('new_keyword_text');
                  $where['id']= $this->input->post('id');
                  $table_name="categories";
              }else{
                  $save['keyword_text']= $this->input->post('new_keyword_text');
                  $where['id']= $this->input->post('id');
                  $table_name="category_image";
              }
        if($where['id']>0){
        $this->Category_model->update_folder_data($table_name,$where,$save);
        }
die;
    }

        public function indexRadio() {
        // $get = $this->input->get();
        //echo "lk";
        $post = $this->input->post();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Master Composers', '/admin/category');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['objTree'] = $this->Mastercomposer_model->getCategoryTreeData();
        //dd($data['objTree']); die;
        $data['title'] = 'Manage Libraries';
        _adminLayout('move-directory', $data);
    }   	
	/**
     * add
     * @return Delete Category
     * @since 0.1
     * @author DHS
     */
   //  public function delete_directory($id = false) {
        
			// $id = base64_decode($this->input->post('delete_id'));
			// /////start delete function	
   //        if($id>0){
			// function deleteFolder($id) {
			// $result = array();
			// $CI = & get_instance();
			// $cat_ids = $CI->load->Category_model->getassCategoryData($id);
			// 	if(!empty($cat_ids)){
			// 	foreach($cat_ids as $value)
			// 	{
			// 	$result[]=$value;
			// 	deleteFolder($value['id']);
			// 	}
			// 	if(!empty($result)){
			// 		foreach($result as $delvalue)
			// 		{
			// 		$CI = & get_instance();
			// 		$cat_ids = $CI->load->Category_model->deleteRecord($delvalue[id]);
			// 		$cat_image_ids = $CI->load->Category_model->relatedcatImageDelete($delvalue[id]);
			// 		}	
			// 	}
			// 	}
			// }
			// deleteFolder($id);
			// $add_dir_path = $this->Category_model->getDirNamesById($id);
			// $dst = FCPATH . "assets/uploads/Sheet-Music/".$add_dir_path;
			// if(isset($add_dir_path))
			// {
			// function rrmdir($dir) {
			// 	if (is_dir($dir)) {
			// 		$files = scandir($dir);
			// 		foreach ($files as $file)
			// 			if ($file != "." && $file != "..") rrmdir("$dir/$file");
			// 		rmdir($dir);
			// 	}
			// 	else if (file_exists($dir)) unlink($dir);
			// }						
			// rrmdir($dst);
			// }
   //      }//***********IF condition end herer*************************
			// $cat_ids = $this->Category_model->deleteRecord($id);
			// $this->session->set_flashdata('flash_msg_type', 'success');
			// $this->session->set_flashdata('flash_msg_text', 'Directory successfully deleted!!');
			// redirect(site_url('/admin_categories'));     
        
   //  }
     public function permanent_delete_file() {
        
            $id = $this->input->post('delete_id');
            $CI = & get_instance();
          $cat_image_ids = $CI->load->Category_model->relatedcatImageDelete_single($id);

       }     
     public function permanent_delete_category() {
        
            $id = $this->input->post('delete_id');
            if($id>0){
            /////start delete function  
            // function deleteFolder($id) {
            // $result = array();
            // $CI = & get_instance();
            // $cat_ids = $CI->load->Category_model->getassCategoryData($id);
            //     if(!empty($cat_ids)){
            //     foreach($cat_ids as $value)
            //     {
            //     $result[]=$value;
            //     deleteFolder($value['id']);
            //     }
            //     if(!empty($result)){
            //         foreach($result as $delvalue)
            //         {
            //         $CI = & get_instance();
            //         $cat_ids = $CI->load->Category_model->deleteRecord($delvalue[id]);
            //         $cat_image_ids = $CI->load->Category_model->relatedcatImageDelete($delvalue[id]);
            //         }   
            //     }
            //     }
            // }
            // deleteFolder($id);
            $delete_status=2;
            $add_dir_path = $this->Category_model->update_del_status($id,$delete_status);
            $add_dir_path = $this->Category_model->getDirNamesById($id);
            $dst = FCPATH . "assets/uploads/Sheet-Music/".$add_dir_path;
            // if(isset($add_dir_path))
            // {
            // function rrmdir($dir) {
            //     if (is_dir($dir)) {
            //         $files = scandir($dir);
            //         foreach ($files as $file)
            //             if ($file != "." && $file != "..") rrmdir("$dir/$file");
            //         rmdir($dir);
            //     }
            //     else if (file_exists($dir)) unlink($dir);
            // }                       
            // rrmdir($dst);
            // }
            //$cat_ids = $this->Category_model->deleteRecord($id);
       }

           }
    
    /**
     * add
     * @return Add Category
     * @since 0.1
     * @author DHS
     */
    public function add() {
        try {
            $data['title'] = 'Add Directory';
            $data['action'] = 'add';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Add', '/admin/category/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            $data['sd']= $this->uri->segment(4);
            $data['cd']= $this->uri->segment(4);
            $data['smd']= $this->uri->segment(4);
            $data['pub']= $this->uri->segment(4);
            $data['cpm']= $this->uri->segment(4);
            $data['mfs']= $this->uri->segment(4);
            $data['tsd']= $this->uri->segment(4);
           // dd($data); die;

             $msd = $data['sd'];
             //dd($msd); die;
            // $ccd = $data['cd'];
//$this->session->set_userdata('common', $msd);
            // $arraydata = array(
            //     'common'  => $msd,
                
                
            // );

// dd($this->session->userdata('common')); die;




            //dd($arraydata); die();
            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_category')) {
                    $post = $this->input->post();
                    $this->session->set_userdata('common', $post['common']);
                    //dd($post); die();
                    unset($post['common']);
                    unset($post['action_taken']);
                    unset($post['submits']);
                    $insert_id = $this->Category_model->storeCategory($post);
                    if (isset($insert_id) && !empty($insert_id)) {
                        $files = $_FILES;
                        $cpt = count($_FILES['image']['name']);
                        /////////Generate directory if not exist
                        $dir = FCPATH . 'assets/uploads/category_images';
                        generateDir($dir);
                        for ($i = 0; $i < $cpt; $i++) {
                            $img_data = UploadImage($files, './assets/uploads/category_images', 'image', $i);
                            if ($img_data) {
                                $arr_data['cat_id'] = $insert_id;
                                $arr_data['image'] = $img_data['file_name'];
                                $post['icon'] = $img_data['file_name'];
                                if ($i == 0) {
                                    $this->Category_model->updateRecord($insert_id, $post);
                                }
                                $this->Category_model->storeImage($arr_data);
                            }
                        }
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Composer created successfully!!');
                        //_adminLayout('add-categories', $data);
                        
                        $dynamic_flag = $this->session->userdata('common');
                        if( $dynamic_flag =='cm'){
                           redirect('/admin_categories/admin_comp'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='mc'){
                           redirect('/admin_categories'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='sm'){
                           redirect('/admin_categories/admin_school_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='pa'){
                           redirect('/admin_categories/admin_public_archive'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='cp'){
                           redirect('/admin_categories/admin_captured_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='ms'){
                           redirect('/admin_categories/admin_music_sale'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='sd'){
                           redirect('/admin_categories/admin_s_d'); 
                           $this->session->unset_userdata('common');
                        }

                    }
                } else {
                    _adminLayout('add-categories', $data);
                }
            } else {
                _adminLayout('add-categories', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    // AddSubDirectory
 
        /**
     * add
     * @return Add Category
     * @since 0.1
     * @author DHS
     */
    public function addSubDir($id = false) {
        try {
        // dd('tk'); die;
            $data['title'] = 'Add Sub Directory';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Add', '/admin/category/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            $data['sd']= $this->uri->segment(4);
            $data['cd']= $this->uri->segment(4);
            $data['smd']= $this->uri->segment(4);
            $data['pub']= $this->uri->segment(4);
            $data['cpm']= $this->uri->segment(4);
            $data['mfs']= $this->uri->segment(4);
            $data['tsd']= $this->uri->segment(4);
            $data['back_url']= $this->uri->segment(4);
            $data['id'] = base64_decode($id);
            //dd($data['sd']); die;
           
$r_type=$this->uri->segment(4);
             $msd = $data['sd'];
             //dd($msd); die;
            // $ccd = $data['cd'];
//$this->session->set_userdata('common', $msd);
            // $arraydata = array(
            //     'common'  => $msd,
                
                
            // );

// dd($this->session->userdata('common')); die;




            //dd($arraydata); die();
            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_category')) {
                    $post = $this->input->post();
                     if($this->uri->segment(5)!=''){
            $post['searchkeyword']= 1;
             }else{
            $post['searchkeyword']= 0;
                }
           // dd($post); die();

                    $this->session->set_userdata('common', $post['common']);
                    //dd($post); die();
                    unset($post['common']);
                    unset($post['action_taken']);
                    unset($post['submits']);
                    $insert_id = $this->Category_model->storeCategory($post);
                    // after add search keyword next step should be add program note
                    if($post['searchkeyword']==1){
                     redirect(base_url().'/admin_banner/edit/MA==/'.$r_type.'/'.base64_encode($insert_id));
                     die;
                    }
                    $destination_ids = $this->Category_model->get_destination_ids($insert_id);
                $destination_ids[]=$insert_id;
                $this->session->set_userdata('destination_ids', $destination_ids);
                $_SESSION['destination_last_id']=$insert_id;  
                    if (isset($insert_id) && !empty($insert_id)) {
                        $files = $_FILES;
                        $cpt = count($_FILES['image']['name']);
                        /////////Generate directory if not exist
                        $dir = FCPATH . 'assets/uploads/category_images';
                        generateDir($dir);
                        for ($i = 0; $i < $cpt; $i++) {
                            $img_data = UploadImage($files, './assets/uploads/category_images', 'image', $i);
                            if ($img_data) {
                                $arr_data['cat_id'] = $insert_id;
                                $arr_data['image'] = $img_data['file_name'];
                                $post['icon'] = $img_data['file_name'];
                                if ($i == 0) {
                                    $this->Category_model->updateRecord($insert_id, $post);
                                }
                                $this->Category_model->storeImage($arr_data);
                            }
                        }
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Composer created successfully!!');
                        //_adminLayout('add-categories', $data);
                        
                        $dynamic_flag = $this->session->userdata('common');
                        if($data['back_url'] =='cm'){
                           redirect('/admin_categories/admin_comp'); 
                           $this->session->unset_userdata('common');
                        }
                        if($data['back_url'] =='mc'){
                           redirect('/admin_categories'); 
                           $this->session->unset_userdata('common');
                        }
                        if($data['back_url'] =='sm'){
                           redirect('/admin_categories/admin_school_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if($data['back_url'] =='pa'){
                           redirect('/admin_categories/admin_public_archive'); 
                           $this->session->unset_userdata('common');
                        }
                        if($data['back_url'] =='cp'){
                           redirect('/admin_categories/admin_captured_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if($data['back_url'] =='ms'){
                           redirect('/admin_categories/admin_music_sale'); 
                           $this->session->unset_userdata('common');
                        }
                        if($data['back_url'] =='sd'){
                           redirect('/admin_categories/admin_s_d'); 
                           $this->session->unset_userdata('common');
                        }

                    }
                } else {
                    _adminLayout('add-subdir', $data);
                }
            } else {
                _adminLayout('add-subdir', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }   


    // end AddSubDirectory


	/**
     * add
     * @return Add Category
     * @since 0.1
     * @author DHS
     */
    public function add_single_file() {
        try {
            $data['title'] = 'Upload Directory';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Upload', '/admin/category/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            $redirect_page= $this->input->post('back_url'); 
            $data['sd']= $this->uri->segment(4);
            $data['cd']= $this->uri->segment(4);
            $data['smd']= $this->uri->segment(4);
            $data['pub']= $this->uri->segment(4);
            $data['cpm']= $this->uri->segment(4);
            $data['mfs']= $this->uri->segment(4);
            $data['tsd']= $this->uri->segment(4);


                if( $redirect_page =='cm'){
                           $back_redirect='/admin_categories/admin_comp'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='mc'){
                           $back_redirect='/admin_categories'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='sm'){
                           $back_redirect='/admin_categories/admin_school_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='pa'){
                           $back_redirect='/admin_categories/admin_public_archive';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='cp'){
                           $back_redirect='/admin_categories/admin_captured_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='ms'){
                           $back_redirect='/admin_categories/admin_music_sale'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='sd'){
                           $back_redirect='/admin_categories/admin_s_d'; 
                           $this->session->unset_userdata('common');
                        }





            if (isPostBack()) { 

                    $post = $this->input->post();
                    $this->session->set_userdata('common', $post['common']);
                    unset($post['common']);
                    unset($post['action_taken']);
                   
                    ////////////////////////////
					if($_FILES['fileUpload']['name']!='')
					{
						$filename = $_FILES['fileUpload']['name'];
						$file_name = str_replace('.zip', '', $filename);
						//die;
						$user_id = $this->session->userdata("user_id");

						if($post[parent_id]=='Select Composer'){
						$uid = uniqid();
						$dir =  "assets/uploads/temp_bulk_upload_sheet_music/".$uid;
						//$userdir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$file_name;
						$dst =  "assets/uploads/Sheet-Music";
						$GLOBALS['I']=0;
						//$remdir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uid;
						}
						else{
						//echo "jk";
						$uid = uniqid();
						//$cat_name = $this->Category_model->getRecordById($post[parent_id]);
						$add_dir_path = $this->Category_model->getDirNamesById($post['parent_id']);
						
						$dir = "assets/uploads/temp_bulk_upload_sheet_music/".$uid;	
						$dst = "assets/uploads/Sheet-Music/".$add_dir_path;
//**********************Verify File already exist or not****************************
                       $count_single_file= $this->Category_model->verify_single_file($post['parent_id'],$filename);
                // $destination_ids = $this->Category_model->get_destination_ids($post['parent_id']);
                // $destination_ids[]=$post['parent_id'];
                // $this->session->set_userdata('destination_ids', $destination_ids);   
                                $_SESSION['destination_last_id']=$post['parent_id'];  
                              
                        if(count($count_single_file)>0 && $post['replace_file_id']==''){
                           $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'This file is already exist Into '.$add_dir_path);
                        redirect(site_url($back_redirect));die;
                        }
//**********************Verify File already exist or not end ****************************





						generateDir($dst);
						$GLOBALS['I']=$post['parent_id'];
						}
						generateDir($dir);
										$config['upload_path'] = $dst; 
										$config['allowed_types'] = '*';
                                        $config['overwrite'] = TRUE;
                                        $config['remove_spaces'] = FALSE;
										$this->load->library('upload', $config);
										$this->upload->initialize($config);
									if (!$this->upload->do_upload('fileUpload'))
										{
										$this->session->set_flashdata('error',$this->upload->display_errors());
										dd($this->upload->display_errors());
										die;
										}
									else
										{

                        //print_r($filename);die;

										$data_uploaded      = $this->upload->data();
                                       $save_data['image']=$filename;
                                       if($post['replace_file_id']>0){
                                      $this->Category_model->replace_storeImage($save_data,$post['replace_file_id']);
                                       }else{
                                       $save_data['cat_id']=$post['parent_id'];
                                       $save_data['file_path']=$add_dir_path;
                                      $this->Category_model->storeImage($save_data);
                                       }



									$this->session->set_flashdata('flash_msg_type', 'success');
									$this->session->set_flashdata('flash_msg_text', 'File successfully uploaded into '.$add_dir_path);
                                    $dynamic_flag = $this->session->userdata('common');
                        
									
							}

							redirect(site_url($back_redirect));		
					}else
					{
						$this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'file not selected.');
						redirect(site_url($back_redirect));
					}					                
            } else {
                _adminLayout('add-directory', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }



    public function add_directory_ajax() {
        if (isPostBack()) { 
                    $post = $this->input->post();
                    $this->session->set_userdata('common', $post['common']);
                    unset($post['common']);
                    unset($post['action_taken']);
                    //print_r($_FILES);die;
                    ////////////////////////////
                    if($_FILES['fileUpload']['name']!='')
                    {
                        $filename = $_FILES['fileUpload']['name'];
                        $file_name = str_replace('.zip', '', $filename);
                        //return 'kulbir';die;
                        //die;
                        $verify_folder=$this->Category_model->verify_folder_existing($post['parent_id'],$file_name);
                        if(count($verify_folder)>0){
                          http_response_code(500);
                         return false; die; 
                        }
                        
                        $user_id = $this->session->userdata("user_id");

                        if($post[parent_id]=='Select Composer'){
                        $uid = uniqid();
                        $dir = "assets/uploads/temp_bulk_upload_sheet_music/".$uid;
                        //$userdir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$file_name;
                        $dst = "assets/uploads/Sheet-Music";
                        $GLOBALS['I']=0;
                        //$remdir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uid;
                        }
                        else{
                        //echo "jk";
                        $uid = uniqid();
                        //$cat_name = $this->Category_model->getRecordById($post[parent_id]);
                        $add_dir_path = $this->Category_model->getDirNamesById($post[parent_id]);
              
                        
                        $dir = "assets/uploads/temp_bulk_upload_sheet_music/".$uid;    
                        $dst = "assets/uploads/Sheet-Music/".$add_dir_path;
                        generateDir($dst);
                        $GLOBALS['I']=$post[parent_id];
                        }
                        generateDir($dir);
                                        $config['upload_path'] = $dir; 
                                        $config['allowed_types'] = 'zip';
                                        $config['encrypt_name'] = TRUE; 
                                        $this->load->library('upload', $config);
                                        $this->upload->initialize($config);
                                    if (!$this->upload->do_upload('fileUpload'))
                                        {
                                        $this->session->set_flashdata('error',$this->upload->display_errors());
                                        dd($this->upload->display_errors());
                                        die;
                                        }
                                    else
                                        {
                                        $data      = $this->upload->data();
                                        $zip_file  = new ZipArchive();
                                        $full_path = $data['full_path'];
                            
                                    if ($zip_file->open($full_path) === TRUE) 
                                    {
                                   $zip_file->extractTo($dir);
                                   unlink($full_path);
                                   $zip_file->close();
                $destination_ids = $this->Category_model->get_destination_ids($post['parent_id']);
                $destination_ids[]=$post['parent_id'];
                $this->session->set_userdata('destination_ids', $destination_ids);
                $this->session->set_userdata('main_root_ids', $post['parent_id']);

                                   /////start scandir function
                                    function scanFolder($dir,$parent) {
                                        
                                        $result = array();
                                        if(is_dir($dir))
                                        {
                                            $scn_dir = scandir($dir);
                                            foreach($scn_dir as $value)
                                            {
                                                if(!in_array($value,array(".","..")))
                                                {
                                                    if(is_dir($dir. DIRECTORY_SEPARATOR . $value))
                                                    {
                                                    $CI = & get_instance();
                                                    $CI->load->model('approve_music/Approve_music_model');
                                                    $last_ins_id = $CI->Approve_music_model->storeBulkCategory($value,$parent);
                                                    $GLOBALS['I'] = $last_ins_id;
                 if($_SESSION['main_root_ids']==$parent){                                   
                $_SESSION['destination_last_id']=$last_ins_id;  
                }                               
                                                    $result[$value][] = scanFolder($dir. DIRECTORY_SEPARATOR .$value,$GLOBALS['I']);
                                                    }
                                                    else
                                                    {
                                                    //$result[] = $value;
                                                    $arr_data['cat_id']=$parent;
                                                    $arr_data['image']=$value;
                                                    $CI = & get_instance();
                                                    $CI->load->model('admin_categories/Category_model');
                                                    $CI->Category_model->storeImage($arr_data);
                                                    }
                                                }
                                            }
                                        //return $result;
                                        }
                                    }
                                    /////end scandir function
                                           
                                   scanFolder($dir,$GLOBALS['I']);
                                   // Function to Copy folders and files       
                                    function rcopy($src, $dst) {
                                        //if (file_exists ( $dst ))
                                        //  rrmdir ( $dst );
                                        if (is_dir ( $src )) {
                                            mkdir ( $dst );
                                            $files = scandir ( $src );
                                            foreach ( $files as $file )
                                                if ($file != "." && $file != "..")
                                                    rcopy ( "$src/$file", "$dst/$file" );
                                        } else if (file_exists ( $src ))
                                            copy ( $src, $dst );
                                    }
                                    
                                    rcopy($dir, $dst);
                                    // Function to remove folders and files 
                                    function rrmdir($dir) {
                                        if (is_dir($dir)) {
                                            $files = scandir($dir);
                                            foreach ($files as $file)
                                                if ($file != "." && $file != "..") rrmdir("$dir/$file");
                                            rmdir($dir);
                                        }
                                        else if (file_exists($dir)) unlink($dir);
                                    }                                   
                                    rrmdir($dir);                                   
                echo "<span style='color:green;'>Directory successfully uploaded.</span>";
                                    }
                                    else
                                    {
                echo "<span style='color:red;'>Failed to extract.</span>";
                                    }
                            }

                    }else
                    {
                echo "<span style='color:red;'>Zip file not selected.</span>";
                    }                                   
            }else{
                echo "<span style='color:red;'>Error</span>";
            }
        die;
}



    public function add_directory() {
        try {
            $data['title'] = 'Upload Directory';
            $data['action'] = 'add_directory';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Upload', '/admin/category/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            $data['sd']= $this->uri->segment(3);
            $data['cd']= $this->uri->segment(3);
            $data['smd']= $this->uri->segment(3);
            $data['pub']= $this->uri->segment(3);
            $data['cpm']= $this->uri->segment(3);
            $data['mfs']= $this->uri->segment(3);
            $data['tsd']= $this->uri->segment(3);
            $redirect_page= $this->input->post('back_url');
            $redirect_page_2= $this->uri->segment(3);
            $data['redirect_page']= $this->input->post('back_url');
            if( $redirect_page_2 =='cm'){
                           $back_redirect='/admin_categories/admin_comp'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='mc'){
                           $back_redirect='/admin_categories'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='sm'){
                           $back_redirect='/admin_categories/admin_school_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='pa'){
                           $back_redirect='/admin_categories/admin_public_archive';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='cp'){
                           $back_redirect='/admin_categories/admin_captured_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='ms'){
                           $back_redirect='/admin_categories/admin_music_sale'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='sd'){
                           $back_redirect='/admin_categories/admin_s_d'; 
                           $this->session->unset_userdata('common');
                        } 

             $data['back_redirect']=$back_redirect;

                _adminLayout('add-directory', $data);
           
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    //////added on 21 nov////

/**
     * add
     * @return Save Category
     * @since 0.1
     * @author DHS
     */
    public function add_save_directory() {
        try {
            $data['title'] = 'Save Directory';
            $data['action'] = 'add_save_directory';
            //$data['action'] = 'add_directory';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Upload', '/admin/category/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            $data['sd']= $this->uri->segment(3);
            $data['cd']= $this->uri->segment(3);
            $data['smd']= $this->uri->segment(3);
            $data['pub']= $this->uri->segment(3);
            $data['cpm']= $this->uri->segment(3);
            $data['mfs']= $this->uri->segment(3);
            $data['tsd']= $this->uri->segment(3);
            $data['sub_directory_id']=0;
            if($this->uri->segment(4)){
              $data['sub_directory_id']= base64_decode($this->uri->segment(4));
             }


$redirect_page= $this->uri->segment(3);
            if( $redirect_page =='cm'){
                           $back_redirect='/admin_categories/admin_comp'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='mc'){
                           $back_redirect='/admin_categories'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='sm'){
                           $back_redirect='/admin_categories/admin_school_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='pa'){
                           $back_redirect='/admin_categories/admin_public_archive';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='cp'){
                           $back_redirect='/admin_categories/admin_captured_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='ms'){
                           $back_redirect='/admin_categories/admin_music_sale'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page =='sd'){
                           $back_redirect='/admin_categories/admin_s_d'; 
                           $this->session->unset_userdata('common');
                        } 

 $data['back_redirect']=$back_redirect;



            if (isPostBack()) { 

                    $post = $this->input->post();
					//dd($post);
					//die;
                    $this->session->set_userdata('common', $post['common']);
                    unset($post['common']);
                    unset($post['action_taken']);
                    ////////////////////////////
                    if($_FILES['fileUpload']['name'] !='')
                    {
                        $filename = $_FILES['fileUpload']['name'];
                        $file_name = str_replace('.zip', '', $filename);
                        //die;
                        $user_id = $this->session->userdata("user_id");

                        if($post['parent_id']=='Select Composer'){
                        $uid = uniqid();
                        $dir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uid;
                        //$userdir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$file_name;
                        $dst = FCPATH . "assets/uploads/Sheet-Music";
                        $GLOBALS['I']=0;
                        //$remdir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uid;
                        }
                        else{
                        //echo "jk";
						//die;
                        $uid = uniqid();
                        //$cat_name = $this->Category_model->getRecordById($post[parent_id]);
                        $add_dir_path = $this->Category_model->getDirNamesById($post['parent_id']);
                $destination_ids = $this->Category_model->get_destination_ids($post['parent_id']);
                $destination_ids[]=$post['parent_id'];
                $this->session->set_userdata('destination_ids', $destination_ids);
                $this->session->set_userdata('main_root_ids', $post['parent_id']);
                        
                        $dir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uid;
						//echo "<br>";
						$dirfinal = $dir."/".$file_name;
						//echo "<br>";
                        $dst = FCPATH . "assets/uploads/Sheet-Music/".$add_dir_path;
						//die;
                        generateDir($dst);
                        $GLOBALS['I']=$post['parent_id'];
                        }
                        generateDir($dir);
                                        $config['upload_path'] = $dir; 
                                        $config['allowed_types'] = 'zip';
                                        $config['encrypt_name'] = TRUE; 
                                        $this->load->library('upload', $config);
                                        $this->upload->initialize($config);
                                    if (!$this->upload->do_upload('fileUpload'))
                                        {
                                        $this->session->set_flashdata('error',$this->upload->display_errors());
                                        dd($this->upload->display_errors());
                                        die;
                                        }
                                    else
                                        {
                                        $data      = $this->upload->data();
                                        $zip_file  = new ZipArchive();
                                        $full_path = $data['full_path'];
                            
                                    if ($zip_file->open($full_path) === TRUE) 
                                    {
                                   $zip_file->extractTo($dir);
                                   unlink($full_path);
                                   $zip_file->close();
                                   /////start scandir function
                                    function scanFolder($dir,$parent) {
                                        
                                        $result = array();
                                        if(is_dir($dir))
                                        {
                                            $scn_dir = scandir($dir);
                                            foreach($scn_dir as $value)
                                            {
                                                if(!in_array($value,array(".","..")))
                                                {
                                                    if(is_dir($dir. DIRECTORY_SEPARATOR . $value))
                                                    {
                                                    $CI = & get_instance();
                                                    $CI->load->model('approve_music/Approve_music_model');
                                                    $last_ins_id = $CI->Approve_music_model->storeBulkCategory($value,$parent);
                                                    $GLOBALS['I'] = $last_ins_id;

            if($_SESSION['main_root_ids']==$parent){                                   
                $_SESSION['destination_last_id']=$last_ins_id;  
                } 

                                                    $result[$value][] = scanFolder($dir. DIRECTORY_SEPARATOR .$value,$GLOBALS['I']);
                                                    }
                                                    else
                                                    {
                                                    //$result[] = $value;
                                                    $arr_data['cat_id']=$parent;
                                                    $arr_data['image']=$value;
                                                    $CI = & get_instance();
                                                    $CI->load->model('admin_categories/Category_model');
                                                    $CI->Category_model->storeImage($arr_data);
                                                    }
                                                }
                                            }
                                        //return $result;
                                        }
                                    }
                                    /////end scandir function
                                   
                                   //scanFolder($dir,$GLOBALS['I']);
								   scanFolder($dirfinal,$GLOBALS['I']);
                                   // Function to Copy folders and files       
                                    function rcopy($src, $dst) {
                                        //if (file_exists ( $dst ))
                                        //  rrmdir ( $dst );
                                        if (is_dir ( $src )) {
                                            mkdir ( $dst );
                                            $files = scandir ( $src );
                                            foreach ( $files as $file )
                                                if ($file != "." && $file != "..")
                                                    rcopy ( "$src/$file", "$dst/$file" );
                                        } else if (file_exists ( $src ))
                                            copy ( $src, $dst );
                                    }
                                    
                                    //rcopy($dir, $dst);
									rcopy($dirfinal, $dst);
                                    // Function to remove folders and files 
                                    function rrmdir($dir) {
                                        if (is_dir($dir)) {
                                            $files = scandir($dir);
                                            foreach ($files as $file)
                                                if ($file != "." && $file != "..") rrmdir("$dir/$file");
                                            rmdir($dir);
                                        }
                                        else if (file_exists($dir)) unlink($dir);
                                    }                                   
                                    rrmdir($dir);                                   
                                    $this->session->set_flashdata('flash_msg_type', 'success');
                                    $this->session->set_flashdata('flash_msg_text', 'Directory successfully uploaded!!');
                                    $dynamic_flag = $this->session->userdata('common');
                                    }
                                    else
                                    {
                                    $this->session->set_flashdata('flash_msg_type', 'error');
                                    $this->session->set_flashdata('flash_msg_text', 'Failed to extract');
                                    }
                            }

                            redirect(site_url($back_redirect));     
                    }else
                    {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Zip file not selected.');
                        redirect(site_url($back_redirect));
                    }                                   
            } else {
                _adminLayout('save-directory', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /////////////////////////

 

	/**
     * add
     * @return Add Composer
     * @since 0.1
     * @author DHS
     */
    public function add_composer($id = false) {
        try {
			$id = base64_decode($id);
            $data['title'] = 'Edit Composer';
            $data['action'] = 'add_composer';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('edit', '/admin/category/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            $data['sd']= $this->uri->segment(5);
            $data['cd']= $this->uri->segment(5);
            $data['smd']= $this->uri->segment(5);
            $data['pub']= $this->uri->segment(5);
            $data['cpm']= $this->uri->segment(5);
            $data['mfs']= $this->uri->segment(5);
            $data['tsd']= $this->uri->segment(5);
            //dd($data['sd']); die;
            $msd = $data['sd'];

            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_category')) {
                    $post = $this->input->post();
                    $this->session->set_userdata('common', $post['common']);
                    //dd($post); die();
                    unset($post['common']);
                    unset($post['action_taken']);
                    unset($post['submits']);
					$arr_compdata['cat_id'] = $post['id'];
					$arr_compdata['name'] = $post['name'];
					$arr_compdata['description'] = $post['description'];
                    $insert_id = $this->Category_model->storeComposer($arr_compdata);
                    if (isset($insert_id) && !empty($insert_id)) {
                        $files = $_FILES;						
                        /////////Generate directory if not exist
                        $dir = FCPATH . 'assets/uploads/ComposerProfileImages';
                        generateDir($dir);
                        //for ($i = 0; $i < $cpt; $i++) {
                            $img_data = UploadImage($files, './assets/uploads/ComposerProfileImages', 'image', null);
							//dd($img_data);
							//die;
                            if ($img_data) {
                                $arr_data['image'] = $img_data['file_name'];								
                                $this->Category_model->updateRecordComposerDetail($insert_id, $arr_data);                               
                            }
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Composer Edited successfully!!');
                        //_adminLayout('add-composer-detail', $data);
                        $dynamic_flag = $this->session->userdata('common');
                        if( $dynamic_flag =='cm'){
                           redirect('/admin_categories/admin_comp'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='mc'){
                           redirect('/admin_categories'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='sm'){
                           redirect('/admin_categories/admin_school_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='pa'){
                           redirect('/admin_categories/admin_public_archive'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='cp'){
                           redirect('/admin_categories/admin_captured_music'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='ms'){
                           redirect('/admin_categories/admin_music_sale'); 
                           $this->session->unset_userdata('common');
                        }
                        if( $dynamic_flag =='sd'){
                           redirect('/admin_categories/admin_s_d'); 
                           $this->session->unset_userdata('common');
                        }
                    }
                } else {
                    _adminLayout('add-composer-detail', $data);
                }
            } else {
				$obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = $this->Category_model->getComposerProfileImagesById($obj_cat['id']);				
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                _adminLayout('add-composer-detail', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    /**
     * edit
     * @return Add Category
     * @since 0.1
     * @author DHS
     */
    public function replace_file_content($id = false) {
        $data=array();
         echo $id = base64_decode($id);
         $data['replace_file_id']=$id;
                //  $obj_cat = (array) $this->Category_model->getRecordById($id);
                // $arr_img = array();//$this->Category_model->getImagesById($obj_cat['id']);
                // $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
               // $data['obj_data'] = $this->Category_model->getRecordById($id);
                //print_r($data['obj_data']);die;
                _adminLayout('add_edit_file_content', $data);

    }
    public function add_edit_folder_content($id = false) {
        $data=array();
                     $id = base64_decode($id);
                 $obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = array();//$this->Category_model->getImagesById($obj_cat['id']);
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                $redirect_page_2= $this->uri->segment(4);
            $data['redirect_page']= $this->input->post('back_url');
            if( $redirect_page_2 =='cm'){
                           $back_redirect='/admin_categories/admin_comp'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='mc'){
                           $back_redirect='/admin_categories'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='sm'){
                           $back_redirect='/admin_categories/admin_school_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='pa'){
                           $back_redirect='/admin_categories/admin_public_archive';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='cp'){
                           $back_redirect='/admin_categories/admin_captured_music';  
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='ms'){
                           $back_redirect='/admin_categories/admin_music_sale'; 
                           $this->session->unset_userdata('common');
                        }
                        if( $redirect_page_2 =='sd'){
                           $back_redirect='/admin_categories/admin_s_d'; 
                           $this->session->unset_userdata('common');
                        } 

             $data['back_redirect']=$back_redirect;
                _adminLayout('add_edit_folder_content', $data);

    }
    public function add_edit_file_content($id = false,$back_url='') {
        $data=array();
                     $id = base64_decode($id);
                //  $obj_cat = (array) $this->Category_model->getRecordById($id);
                // $arr_img = array();//$this->Category_model->getImagesById($obj_cat['id']);
                // $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                $data['obj_data'] = $this->Category_model->getRecordById($id);

                //print_r( $data['obj_data']);die;
                _adminLayout('add_edit_file_content', $data);

    }
    public function edit($id = false) {
        try {
            $id = base64_decode($id);
            $dynamic_title =$this->uri->segment(5);
            $dynam_url =$this->uri->segment(6);
            //dd($dynam_url); die;
            //echo $dynamic_title; die;
			if($dynamic_title == "AddSubDirectory"){
				$data['title'] = 'Add Sub Directory';
			}
			elseif($dynamic_title == "AddDocument"){
				$data['title'] = 'Add Document';
                 $data['last_url'] = $dynam_url;
			}
			elseif($dynamic_title == "ManageCustomText"){
				$data['title'] = 'Manage CustomText';
                $data['last_url'] = $dynam_url;
			}
			elseif($dynamic_title == "AddKeywords"){
				$data['title'] = 'Add Keywords';
                 $data['last_url'] = $dynam_url;
			}
			else{
				$data['title'] = 'Edit Composer';
			}
            $data['action'] = 'edit';
            //$data['actions'] = 'add';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Edit', '/admin/category/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
                // $dynam_url =$this->uri->segment(6);
                // dd($dynam_url); die;
                if ($this->form_validation->run($this, 'admin_category')) {
                    $post = $this->input->post();
                    $this->session->set_userdata('action_taken', $post['action_taken']);
                    $this->session->set_userdata('url_taken', $post['url_taken']);
                    unset($post['action_taken']);
                    unset($post['url_taken']);
                    unset($post['submits']);
                    if (!empty($_FILES['image']['name'])) {	
						$path = $this->Category_model->getRevArrayCatbyId($post['id'],$post['parent_id']);						
                        $files = $_FILES;
                        $cpt = count($_FILES['image']['name']);						
                        /////////Generate directory if not exist
                        $dir = FCPATH . "assets/uploads/Sheet-Music/$path";
                        generateDir($dir);
                        for ($i = 0; $i < $cpt; $i++) {
                            $img_data = UploadImage($files, "./assets/uploads/Sheet-Music/$path", 'image', $i);							
                            if ($img_data) {
                                $arr_data['cat_id'] = $post['id'];
                                $arr_data['image'] = $img_data['file_name'];
                                $post['icon'] = $img_data['file_name'];
                                if ($i == 0) {
                                    $this->Category_model->updateRecord($post['id'], $post);
                                }
                                $this->Category_model->storeImage($arr_data);
                            }
                        }
                    }
                    if ($this->Category_model->updateRecord($post['id'], $post)) {
                        $dynamic_msg = $this->session->userdata('action_taken');
                        $dynamic_url = $this->session->userdata('url_taken');
                        //$posts = $this->input->post();
                        //dd($posts); die();
                        // dd($post['action_taken']); die;
                        //dd($msg); die;
                        if( $dynamic_msg =='Manage CustomText'){
                             $msg = "Manage Custom text has been modified.";
                             //echo $msg; die;
                             $this->session->unset_userdata('action_taken');
                             $this->session->unset_userdata('url_taken');
                        }


                        if($dynamic_msg =='Add Keywords'){
                            $msg = "Keyword has been added.";
                            $this->session->unset_userdata('action_taken');
                            $this->session->unset_userdata('url_taken');
                        }
                        if($dynamic_msg =='Add Document'){
                            $msg = "Document has been added.";
                            $this->session->unset_userdata('action_taken');
                            $this->session->unset_userdata('url_taken');
                        }

                        if($dynamic_msg =='Add Sub Directory'){
                            $msg = "Sub Directory has been added.";
                            $this->session->unset_userdata('action_taken');
                        }
                        // if($data['title']=='Manage CustomText'){
                        //     $msg = "Manage Custom text has been modified."
                        // }
                        // if($data['title']=='Manage CustomText'){
                        //     $msg = "Manage Custom text has been modified."
                        // }

                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', $msg);
                        if($dynamic_url == 'mc'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url == 'cm'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url == 'sm'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url == 'pa'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url == 'cp'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url == 'ms'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }else{
                          redirect(site_url('admin_categories/admin_s_d'));
                        }
                        
                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('add-categories', $data);
                    }
                } else {
                    $obj_cat = (array) $this->Category_model->getRecordById($this->input->post('id'));
                    $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                    $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                    _adminLayout('add-categories', $data);
                }
            } else {
                $obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                _adminLayout('add-categories', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

	/**
     * Update
     * @since 0.1
     * @author DHS
     */
    public function update($id = false) {
        try {
			//echo "jitu"; die;
            $id = base64_decode($id);
			//echo $id;
			//die;
            $dynamic_title =$this->uri->segment(5);
			if($dynamic_title=="UpdateDocument")
			{
			$parent_cat_img_id_data = $this->Category_model->getImagesById($id,"parentIdData");
			$data["parent_cat_img_id_data"] = $parent_cat_img_id_data;
			//dd($parent_cat_img_id_data);
			//die;
			$parent_cat_id = $parent_cat_img_id_data->cat_id;
			$data["parent_cat_id_data_row"] = $this->Category_model->getRecordById($parent_cat_id);
			}
            $dynam_url =$this->uri->segment(6);
            //dd($dynam_url); die;
            //echo $dynamic_title; die;
			if($dynamic_title == "AddSubDirectory"){
				$data['title'] = 'Add Sub Directory';
			}
			elseif($dynamic_title == "AddDocument"){
				$data['title'] = 'Add Document';
                 $data['last_url'] = $dynam_url;
			}
			elseif($dynamic_title == "ManageCustomText"){
				$data['title'] = 'Manage CustomText';
                $data['last_url'] = $dynam_url;
			}
			elseif($dynamic_title == "AddKeywords"){
				$data['title'] = 'Add Keywords';
                 $data['last_url'] = $dynam_url;
			}
			elseif($dynamic_title == "UpdateDocument"){
				$data['title'] = 'Update Document';
                 $data['last_url'] = $dynam_url;
			}
			else{
				$data['title'] = 'update Composer';
			}
            $data['action'] = 'update';
            //$data['actions'] = 'add';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Edit', '/admin/category/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
					//echo "jk";
					//die;
                    $post = $this->input->post();
					//dd($post);
					//die;
                    $this->session->set_userdata('action_taken', $post['action_taken']);
                    $this->session->set_userdata('url_taken', $post['url_taken']);
                    unset($post['action_taken']);
                    unset($post['url_taken']);
                    unset($post['submits']);
                    if (!empty($_FILES['image']['name'])) {	
						$path = $this->Category_model->getRevArrayCatbyId($post['id'],$post['root_parent_id']);
						//echo "$path";
						//die;
                        $files = $_FILES;
                        $cpt = count($_FILES['image']['name']);	
						//die;
                        /////////Generate directory if not exist
                        $dir = FCPATH . "assets/uploads/Sheet-Music/$path";
                        generateDir($dir);
                        for ($i = 0; $i < $cpt; $i++) {
                             if ($i == 0) {
                                    unlink($dir."/".$post['image_name']);
                                }

                            $img_data = UploadImage($files, "./assets/uploads/Sheet-Music/$path", 'image', $i);							
                            if ($img_data) {
                                if ($i == 0) {
                                    $this->Category_model->updateSingleImageRecord($post['image_id'], $post['id'],$img_data['file_name']);
                                }
                                //$arr_data['cat_id'] = $post['id'];
								//$arr_data['id'] = $post['image_id'];
                                //$arr_data['image'] = $img_data['file_name'];
                                $post['icon'] = $img_data['file_name'];
                               
                                //$this->Category_model->storeImage($arr_data);
                            }
                        }
                    }
					//die;
                    if (1==1) {
                        $dynamic_msg = $this->session->userdata('action_taken');
                        $dynamic_url = $this->session->userdata('url_taken');
                        //$posts = $this->input->post();
                        //dd($posts); die();
                        // dd($post['action_taken']); die;
                        //dd($msg); die;
                        if( $dynamic_msg =='Manage CustomText'){
                             $msg = "Manage Custom text has been modified.";
                             //echo $msg; die;
                             $this->session->unset_userdata('action_taken');
                             $this->session->unset_userdata('url_taken');
                        }


                        if($dynamic_msg =='Add Keywords'){
                            $msg = "Keyword has been added.";
                            $this->session->unset_userdata('action_taken');
                            $this->session->unset_userdata('url_taken');
                        }
                        if($dynamic_msg =='Add Document'){
                            $msg = "Document has been added.";
                            $this->session->unset_userdata('action_taken');
                            $this->session->unset_userdata('url_taken');
                        }

                        if($dynamic_msg =='Add Sub Directory'){
                            $msg = "Sub Directory has been added.";
                            $this->session->unset_userdata('action_taken');
                        }
                        // if($data['title']=='Manage CustomText'){
                        //     $msg = "Manage Custom text has been modified."
                        // }
                        // if($data['title']=='Manage CustomText'){
                        //     $msg = "Manage Custom text has been modified."
                        // }

                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', $msg);
                        if($dynamic_url == 'mc'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url == 'cm'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url == 'sm'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url == 'pa'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url == 'cp'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url == 'ms'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }else{
                          redirect(site_url('admin_categories/admin_s_d'));
                        }
                        
                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('update-categories', $data);
                    }
                 
            } else {
                $obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                _adminLayout('update-categories', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * edit
     * @return Move Directory
     * @since 0.1
     * @author DHS
     */
    public function move_file($id = false,$add_document='',$redirection_type='') {
           $data['type']='file';
            $data['action'] = 'move_file';
        $data['submit_button_name'] = 'Move file';
            $data['back_redirect_btn'] = $this->uri->segment(5);
            $obj_cat['id'] = base64_decode($id);

            $data['file_detail_path'] = $this->Category_model->get_file_detail($obj_cat['id']);

            $data['move_folder_path'] = $this->Category_model->getDirNamesById($data['file_detail_path']->cat_id);
                $data['obj_data'] = (object) $obj_cat;
            if (isPostBack()) {
                                $post = $this->input->post();
                                $post['id']=$obj_cat['id'];
                                //echo $post['hidden_select_radio1']; die;
            $to_path = $this->Category_model->getDirNamesById($post['hidden_select_radio1']);
                                //print_r($to_path);die;

                                //echo $dynamic_url= $redirection_type;
                                unset($post['submits']);
                                unset($post['redirection_type']);
                        //         if($post['main_category_id']!='' && $post['dest_id']!==''){
                        //  $dest_idm = $this->Category_model->getDirIdBy_name_id($post['dest_id'],$post['main_category_id']);
                        // }elseif($post['main_category_id']!=''){
                        //  $dest_idm = $this->Category_model->getDirIdBy_main_id($post['dest_id'],$post['main_category_id']);
                        // }
                        // $dest_idm = $this->Category_model->getDirIdBy_name_id($post['dest_id'],$post['main_category_id']);





               




                         $file_detail = $this->Category_model->get_file_detail($post['id']);
                        $arr_data['file_path']=$to_path;
                        $arr_data['cat_id']=$post['hidden_select_radio1'];
                        $arr_data['image']=$file_detail->image;
                        $arr_data['status']=1;
                        $arr_data['created_on']=date('Y-m-d h:i:s');

               




                        //$this->Category_model->storeImage($arr_data);
                      //$from = FCPATH . "assets/uploads/Sheet-Music/".$data['move_folder_path'].'/'.$file_detail->image;
                         $from = "assets/uploads/Sheet-Music/".$data['move_folder_path'].'/'.$file_detail->image;
               // echo "<br/>";
                      $dirto = "assets/uploads/Sheet-Music/".$to_path;
                      $to = "assets/uploads/Sheet-Music/".$to_path.'/'.$file_detail->image;
                                          generateDir($dirto);

                        if(copy($from, $to)){
                        $this->Category_model->storeImage($arr_data);
                // $destination_ids = $this->Category_model->get_destination_ids($post['hidden_select_radio1']);
                // $destination_ids[]=$post['hidden_select_radio1'];
                $this->session->set_userdata('destination_last_id', $post['hidden_select_radio1']);
                        //***********after move file delete previous file 
                        $old_delete=$this->Category_model->delete_single_file($post['id']);
                        if($old_delete){
                            unlink($from);
                        }
                        //***********after move file delete previous file 
                        }

                     $dest_idm = $this->Category_model->getDirNamesById($post['hidden_select_radio1']);
                     $dynamic_url=explode('/', $dest_idm);
                    // print_r($dynamic_url);die;
                       if($dynamic_url[0] == 'master-composers'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url[0] == 'composers'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url[0] == 'School-Music'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url[0] == 'Public Archive'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url[0] == 'Captured Music'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url[0] == 'Music For Sale'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }elseif($dynamic_url[0] == 'S D'){
                          redirect(site_url('admin_categories/admin_s_d'));
                        }else{
                          redirect(site_url('admin_categories'));
                        }
                               
                               die;


            }
 $data['back_redirect_btn']=$this->uri->segment(5);
$_SESSION['destination_last_id']=$data['file_detail_path']->cat_id;
                _adminLayout('move-approve-music', $data);



    }
     
      public function move_files() {
           	$data['type']='file';
            $data['action'] = 'move_files';
        	$data['submit_button_name'] = 'Move files';
            $data['back_redirect_btn'] = $this->uri->segment(5);
          //echo "<pre>";print_r($this->input->post());die;
            if (isPostBack()) {

                $post = $this->input->post();
                if($this->input->post("move")){
                    
                    
                    
                    foreach(explode(",",$this->input->post("ids")) as $id){
                        $obj_cat['id'] = ($id);
                        $data['file_detail_path'] = $this->Category_model->get_file_detail($obj_cat['id']);
                        $data['move_folder_path'] = $this->Category_model->getDirNamesById($data['file_detail_path']->cat_id);
                        $data['obj_data'] = (object) $obj_cat;
                        $post['id']=$obj_cat['id'];
                    	$to_path = $this->Category_model->getDirNamesById($post['hidden_select_radio1']);
    
                           
        				$file_detail = $this->Category_model->get_file_detail($post['id']);
        				$arr_data['file_path']=$to_path;
        				$arr_data['cat_id']=$post['hidden_select_radio1'];
        				$arr_data['image']=$file_detail->image;
        				$arr_data['status']=1;
        				$arr_data['created_on']=date('Y-m-d h:i:s');
        				//echo "<pre>";print_r($this->input->post()); print_r($arr_data);die;
                        $from = "assets/uploads/Sheet-Music/".$data['move_folder_path'].'/'.$file_detail->image;
        				$dirto = "assets/uploads/Sheet-Music/".$to_path;
        				$to = "assets/uploads/Sheet-Music/".$to_path.'/'.$file_detail->image;
                        generateDir($dirto);
        
                        if(copy($from, $to)){
                            $this->Category_model->storeImage($arr_data);
                        	$this->session->set_userdata('destination_last_id', $post['hidden_select_radio1']);
                            //***********after move file delete previous file 
                            $old_delete=$this->Category_model->delete_single_file($post['id']);
                            if($old_delete){
                                unlink($from);
                            }
                            //***********after move file delete previous file 
                        }
                    }
    
                    // print_r($dynamic_url);die;
    			
    				redirect(site_url('admin_categories'));
    				die;
                }
            }
 			$data['back_redirect_btn']=$this->uri->segment(5);
			
 			$data['ids']=$this->input->post("ids");
			
            _adminLayout('move-approved-files-gaurav', $data);
    }

   

    public function copy_file($id = false,$add_document='',$redirection_type='') {
        $data['type']='file';
       
        $data['action'] = 'copy_file';
        $data['submit_button_name'] = 'Copy file';
            $data['back_redirect_btn'] = $this->uri->segment(5);
        $obj_cat['id'] = base64_decode($id);
         $data['file_detail_path'] = $this->Category_model->get_file_detail($obj_cat['id']);
        $data['move_folder_path'] = $this->Category_model->getDirNamesById($data['file_detail_path']->cat_id);
                $data['obj_data'] = (object) $obj_cat;
 $last_id=$data['file_detail_path']->cat_id;

                    if (isPostBack()) {
                        $post=$this->input->post();
                        $post['id']=$obj_cat['id'];
                        $to_path = $this->Category_model->getDirNamesById($post['hidden_select_radio1']);
                        $dynamic_url= $redirection_type;
                        unset($post['submits']);
                        unset($post['redirection_type']);
                        //print_r($post);die;
                        // if($post['main_category_id']!='' && $post['dest_id']!==''){
                        //  $dest_idm = $this->Category_model->getDirIdBy_name_id($post['dest_id'],$post['main_category_id']);
                        // }elseif($post['main_category_id']!=''){
                        //  $dest_idm = $this->Category_model->getDirIdBy_main_id($post['dest_id'],$post['main_category_id']);
                        // }
             


                         $file_detail = $this->Category_model->get_file_detail($post['id']);
                        $arr_data['file_path']=$to_path;
                        $arr_data['cat_id']=$post['hidden_select_radio1'];
                        $arr_data['image']=$file_detail->image;
                        $arr_data['status']=1;
                        $arr_data['created_on']=date('Y-m-d h:i:s');
                        //$this->Category_model->storeImage($arr_data);
                      //$from = FCPATH . "assets/uploads/Sheet-Music/".$data['move_folder_path'].'/'.$file_detail->image;
                      $from = "assets/uploads/Sheet-Music/".$data['move_folder_path'].'/'.$file_detail->image;
                     //$to = FCPATH . "assets/uploads/Sheet-Music/".$to_path.'/'.$file_detail->image;
                     $to = "assets/uploads/Sheet-Music/".$to_path.'/'.$file_detail->image;
                     $dirto = "assets/uploads/Sheet-Music/".$to_path;
                                          generateDir($dirto);
                        if(copy($from, $to)){
                           $this->Category_model->storeImage($arr_data);
                $this->session->set_userdata('destination_last_id', $post['hidden_select_radio1']);

                        }

                       if($dynamic_url == 'mc'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url == 'cm'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url == 'sm'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url == 'pa'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url == 'cp'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url == 'ms'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }elseif($dynamic_url == 'sd'){
                          redirect(site_url('admin_categories/admin_s_d'));
                        }else{
                          redirect(site_url('admin_categories'));
                        }


                        die;
                   }else{
                      $data['back_redirect_btn']=$this->uri->segment(5);
  //$last_id=base64_decode($this->uri->segment(4));
$_SESSION['destination_last_id']=$last_id;
                                    _adminLayout('move-approve-music', $data);
                    }
    }
    public function move_directory($id = false) {
        try {


            $id = base64_decode($id);
            $data['move_folder_path'] = $this->Category_model->getDirNamesById($id);
			$data['submit_button_name'] = "Move Folder";
             $add_src_path = $this->Category_model->getDirNamesById($id); 
            $data['src_path'] = "Sheet-Music/".$add_src_path;
            //dd($dstsee); die;
                    //echo $dst;
            //dd($id); die;
            $data['title'] = 'Move Directory';
            $data['action'] = 'move_directory';
            $data['back_redirect_btn'] = $this->uri->segment(6);
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Edit', '/admin/category/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
				$post = $this->input->post();
                $dir_idm = $this->Category_model->getDirNamesById($id);
                $folder_name=explode('/', $dir_idm);
                $dest_idm = $this->Category_model->getDirNamesById($post['hidden_select_radio1']);
                $this->session->set_userdata('destination_last_id', $post['hidden_select_radio1']);

				//$dir = FCPATH . "assets/uploads/temp_upload_sheet_music/".$user_id.'/'.$post['folder_name'];
                       // $dir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$user_id;
                $dynamic_url=explode('/', $dest_idm);


//***************move first in temrary folder*************
					$uniqid = uniqid();
					$tempdst = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uniqid."/".end($folder_name);
					$tempdstmove = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uniqid;
					generateDir($tempdst);
//***************move first in temrary folder end *************








                        $dir = FCPATH . "assets/uploads/Sheet-Music/".$dir_idm;
                        $dst = FCPATH . "assets/uploads/Sheet-Music/".$dest_idm;
                        $GLOBALS['I']=$post['hidden_select_radio1'];////// upload 'personal library id'
					generateDir($dst);
  

//***********copy to temp folder start here*****************
                                   function rcopy($dir, $dst) {
                                        //if (file_exists ( $dst ))
                                        //  rrmdir ( $dst );
                                        if (is_dir ( $dir )) {
                                            mkdir ( $dst );
                                            $files = scandir ( $dir );
                                            foreach ( $files as $file )
                                                if ($file != "." && $file != "..")
                                                    rcopy ( "$dir/$file", "$dst/$file" );
                                        } else if (file_exists ( $dir ))
                                            copy ( $dir, $dst );
                                    }
                                    
                                    rcopy($dir, $tempdst);
                      //***********copy to temp folder end here*****************

//*********** temp to main folder start here*****************
                                   function rcopy_2($dir, $dst) {
                                        //if (file_exists ( $dst ))
                                        //  rrmdir ( $dst );
                                        if (is_dir ( $dir )) {
                                            mkdir ( $dst );
                                            $files = scandir ( $dir );
                                            foreach ( $files as $file )
                                                if ($file != "." && $file != "..")
                                                    rcopy ( "$dir/$file", "$dst/$file" );
                                        } else if (file_exists ( $dir ))
                                            copy ( $dir, $dst );
                                    }
                                    
                                    rcopy_2($tempdstmove, $dst);
 //***********temp to main folder  end here*****************
  $data_copy_path_1 = $this->Category_model->getDirNamesById($id);
                    

$table_name='categories';
$where['id']=$id;
$save['parent_id']=$post['hidden_select_radio1'];
$update=$this->Category_model->update_folder_data($table_name,$where,$save);
if($update){

                $_SESSION['destination_last_id']=$id;  

    
                    $data_copy_path_2 = $this->Category_model->getDirNamesById($id);
	//***********remove temp folder start here*****************
                                    function rrmdir($dir) {
                                        if (is_dir($dir)) {
                                            $files = scandir($dir);
                                            foreach ($files as $file)
                                                if ($file != "." && $file != "..") rrmdir("$dir/$file");
                                            rmdir($dir);
                                        }
                                        else if (file_exists($dir)) unlink($dir);
                                    }                                   
                                    rrmdir($dir);
                      //***********remove temp folder end here*****************
	//***********remove temp folder start here*****************
                                    function rrmdir_2($dir) {
                                        if (is_dir($dir)) {
                                            $files = scandir($dir);
                                            foreach ($files as $file)
                                                if ($file != "." && $file != "..") rrmdir("$dir/$file");
                                            rmdir($dir);
                                        }
                                        else if (file_exists($dir)) unlink($dir);
                                    }                                   
                                    rrmdir_2($tempdstmove);
                      //***********remove temp folder end here*****************
}

                    $this->session->set_flashdata('flash_msg_type', 'success');
                    $this->session->set_flashdata('flash_msg_text', 'Data moved successfully. Source directory <strong>'.$data_copy_path_1.'</strong> TO Destination <strong>'.$data_copy_path_2.'</strong>');
                    //redirect(site_url('admin_categories'));
//$dynamic_url= $this->uri->segment(5); ////Chnaged on26-02-20

                       if($dynamic_url[0] == 'master-composers'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url[0] == 'composers'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url[0] == 'School-Music'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url[0] == 'Public Archive'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url[0] == 'Captured Music'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url[0] == 'Music For Sale'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }elseif($dynamic_url[0] == 'S D'){
                          redirect(site_url('admin_categories/admin_s_d'));
                        }else{
                          redirect(site_url('admin_categories'));
                        }







					//////////////////
            } else {   //**********************************************isPostBack end here
				//echo "else";
				//die;
                $obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                /*$data['objTree'] = $this->Mastercomposer_model->getCategoryTreeData();
                $data['objTreec'] = $this->Comp_model->getCategoryTreeDataComp();
                $data['objTreesm'] = $this->Mastercomposer_model->getCategoryTreeDataSm();
                $data['objTreeccm'] = $this->Mastercomposer_model->getCategoryTreeDataCapMusic();
                $data['objTreecpa'] = $this->Mastercomposer_model->getCategoryTreeDataPa(); 
                $data['objTreemfs'] = $this->Mastercomposer_model->getCategoryTreeDataMusicSale();*/
                //$last_names = array_column($data['objTree'], 'name');
                //print_r($last_names); 
                //dd($data['objTreec']); die;
                //_adminLayout('move-directory', $data);
 $data['back_redirect_btn']=$this->uri->segment(6);
  $last_id=base64_decode($this->uri->segment(4));
$_SESSION['destination_last_id']=$last_id;

                _adminLayout('move-approve-music', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	//////////////////////////////////////////
	/**
     * edit
     * @return Move Directory
     * @since 0.1
     * @author DHS
     */
    public function move_approve_music($id = false,$folder_name=false) {
        
            $id = base64_decode($id);
             $data['folder_name'] = base64_decode($folder_name);
             $data['approve_folder_name'] = base64_decode($folder_name);
          
            //$add_src_path = $this->Category_model->getDirNamesById($id);
			$user_id = $id;
            //$data['src_path'] = "Sheet-Music/".$add_src_path;
			$data['move_folder_path'] = "temp_upload_sheet_music/".$user_id;
			$data['submit_button_name'] = "Move Folder";
			$data['user_id']=$id;
            //dd($dstsee); die;
                    //echo $dst;
            //dd($id); die;
            $data['title'] = 'Approve Music';
            $data['action'] = 'move_approve_music';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Edit', '/admin/category/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
				$post = $this->input->post();
                // print_r($post);
                // echo "<br/>";
                $dest_idm = $this->Category_model->getDirNamesById($post['hidden_select_radio1']);
                $destination_ids = $this->Category_model->get_destination_ids($post['hidden_select_radio1']);
                $destination_ids[]=$post['hidden_select_radio1'];
                $this->session->set_userdata('destination_ids', $destination_ids);
                 $dynamic_url=explode('/', $dest_idm);//die;
                // print_r($redirect_path);die;
                // echo "<br/>";
				$dir = FCPATH . "assets/uploads/temp_upload_sheet_music/".$user_id.'/'.$post['folder_name'];
                // print_r($dir);
                // echo "<br/>";
                       // $dir = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$user_id;
                        $dst = FCPATH . "assets/uploads/Sheet-Music/".$dest_idm;
                        $dirto = "assets/uploads/Sheet-Music/".$dest_idm;
                          generateDir($dirto);
                // print_r($dst);
                // echo "<br/>";
                        $GLOBALS['I']=$post['hidden_select_radio1'];////// upload 'personal library id'
                // print_r($GLOBALS['I']);
                // echo "<br/>";
$_SESSION['main_root_ids']=$GLOBALS['I'];
//die;
//*********************insert into DB start here*****************
                       function scanFolder($dir,$parent,$user_id) {
$CI = & get_instance();
$CI->load->model('upload_music/upload_music_model'); 
                                $result = array();
                                        if(is_dir($dir))
                                        {
                                            $scn_dir = scandir($dir);
                                            foreach($scn_dir as $value)
                                            {
                                                if(!in_array($value,array(".","..")))
                                                {
                                                    if(is_dir($dir. DIRECTORY_SEPARATOR . $value))
                                                    {
                                                     $folder_data['folder_user_id']=$user_id;   
                                                     $folder_data['name']=$value;   
                                                     $folder_data['parent_id']=$parent;
                                                    
                                                    $last_ins_id = $CI->upload_music_model->insert_directory($folder_data);
                                                    $GLOBALS['I'] = $last_ins_id;
 if($_SESSION['main_root_ids']==$parent){                                   
                $_SESSION['destination_last_id']=$last_ins_id;  
                } 
                             $result[$value][] = scanFolder($dir. DIRECTORY_SEPARATOR .$value,$GLOBALS['I'],$user_id,0);
                                                    }
                                                    else
                                                    {
                                                    //$result[] = $value;
                                                    $arr_data['cat_id']=$parent;
                                                    $arr_data['image']=$value;
                                                    $arr_data['file_user_id']=$user_id;
                                                    $CI->upload_music_model->insert_files($arr_data);
                                                    }
                                                }
                                            }
                                        //return $result;
                                        }
                                    }
                                    /////end scandir function
                                   
                                   scanFolder($dir,$GLOBALS['I'],$user_id);
                     //*********************insert into DB end here*****************
                      //***********copy folder start here*****************
                                   function rcopy($dir, $dst) {
                                        //if (file_exists ( $dst ))
                                        //  rrmdir ( $dst );
                                        if (is_dir ( $dir )) {
                                            mkdir ( $dst );
                                            $files = scandir ( $dir );
                                            foreach ( $files as $file )
                                                if ($file != "." && $file != "..")
                                                    rcopy ( "$dir/$file", "$dst/$file" );
                                        } else if (file_exists ( $dir ))
                                            copy ( $dir, $dst );
                                    }
                                    
                                    rcopy($dir, $dst);
                      //***********copy folder end here*****************
                      //***********remove temp folder start here*****************
                                    function rrmdir($dir) {
                                        if (is_dir($dir)) {
                                            $files = scandir($dir);
                                            foreach ($files as $file)
                                                if ($file != "." && $file != "..") rrmdir("$dir/$file");
                                            rmdir($dir);
                                        }
                                        else if (file_exists($dir)) unlink($dir);
                                    }                                   
                                    rrmdir($dir);
                      //***********remove temp folder end here*****************


                        //generateDir($dst);
                       // generateDir($dst);
                        //***********extract zip file start here**************
                       //  $zip_file  = new ZipArchive();
                       //  if ($zip_file->open($dir_file) === TRUE){
                       //     $zip_file->extractTo($dir);
                       //     unlink($dir_file);
                       //     $zip_file->close();
                       //     $map = directory_map($dir, FALSE, TRUE);
                       // }
            $this->session->set_flashdata('flash_msg_type', 'success');
                    $this->session->set_flashdata('flash_msg_text', 'Music approved successfully!!');
                    //redirect(site_url('approve_music'));
                    if($dynamic_url[0] == 'master-composers'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url[0] == 'composers'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url[0] == 'School-Music'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url[0] == 'Public Archive'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url[0] == 'Captured Music'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url[0] == 'Music For Sale'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }elseif($dynamic_url[0] == 'S D'){
                          redirect(site_url('admin_categories/admin_s_d'));
                        }else{
                          redirect(site_url('admin_categories'));
                        }
            } else {
				
                _adminLayout('move-approve-music', $data);
            }
        
    }
	/////////////////////////////////////////

///////added on 21 nov////
/**
     * edit
     * @return Copy Directory
     * @since 0.1
     * @author DHS
     */
    public function copy_directory($id = false) {

        try {
        $data['type']='folder';
             $id = base64_decode($id);
            $data['move_folder_path'] = $this->Category_model->getDirNamesById($id);
            $data['submit_button_name'] = 'Copy Folder';
$folder_name=explode('/', $data['move_folder_path']);
            $data['title'] = 'Copy  to Directory';
            $data['action'] = 'copy_directory';
            $data['back_redirect_btn'] = $this->uri->segment(5);
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Edit', '/admin/category/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
                $post = $this->input->post();
                $did = $post['id'];
                //print_r($post);die;
                        $desired_id = $post['hidden_select_radio1'];
                        $dest_idm = $this->Category_model->getDirNamesById($desired_id);
                $destination_ids = $this->Category_model->get_destination_ids($post['hidden_select_radio1']);
                $destination_ids[]=$post['hidden_select_radio1'];
                $this->session->set_userdata('destination_ids', $destination_ids);
$dynamic_url=explode('/', $dest_idm);                   
                $dest_id = $dest_idm->id;
                    $add_dir_path = $this->Category_model->getDirNamesById($dest_id);
                    $dir_dir_path = $this->Category_model->getDirNamesById($did);
                    $dst = FCPATH . "assets/uploads/Sheet-Music/".$dest_idm;
                    $dir = FCPATH . "assets/uploads/Sheet-Music/".$data['move_folder_path'];
                    $sName = $this->Category_model->getRecordNameById($did);
                    $uid = uniqid();
                    $tempdst = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uid."/".end($folder_name);
                    $tempdstmove = FCPATH . "assets/uploads/temp_bulk_upload_sheet_music/".$uid;

$dirto = "assets/uploads/Sheet-Music/".$dest_idm;
                          generateDir($dirto);


                    generateDir($tempdst);
                    $GLOBALS['I']=$desired_id;
$_SESSION['main_root_ids']=$GLOBALS['I'];
//***********copy to temp folder start here*****************
                                   function rcopy($dir, $dst) {
                                        //if (file_exists ( $dst ))
                                        //  rrmdir ( $dst );
                                        if (is_dir ( $dir )) {
                                            mkdir ( $dst );
                                            $files = scandir ( $dir );
                                            foreach ( $files as $file )
                                                if ($file != "." && $file != "..")
                                                    rcopy ( "$dir/$file", "$dst/$file" );
                                        } else if (file_exists ( $dir ))
                                            copy ( $dir, $dst );
                                    }
                                    
                                    rcopy($dir, $tempdst);
                      //***********copy to temp folder end here*****************

//*********** temp to main folder start here*****************
                                   function rcopy_2($dir, $dst) {
                                        //if (file_exists ( $dst ))
                                        //  rrmdir ( $dst );
                                        if (is_dir ( $dir )) {
                                            mkdir ( $dst );
                                            $files = scandir ( $dir );
                                            foreach ( $files as $file )
                                                if ($file != "." && $file != "..")
                                                    rcopy ( "$dir/$file", "$dst/$file" );
                                        } else if (file_exists ( $dir ))
                                            copy ( $dir, $dst );
                                    }
                                    
                                    rcopy_2($tempdstmove, $dst);
 //***********temp to main folder  end here*****************
                    //die;
                    /////start scandir function


 $copy_folder_new_id=0; 

                    function scanFolder($dir,$parent,$copy_folder_new_id) {
                        $result = array();
                        if(is_dir($dir))
                        {
                            $scn_dir = scandir($dir);
                            foreach($scn_dir as $value)
                            {
                                if(!in_array($value,array(".","..")))
                                {
                                    if(is_dir($dir. DIRECTORY_SEPARATOR . $value))
                                    {
                                    $CI = & get_instance();
                                    $CI->load->model('approve_music/Approve_music_model');
                                    $last_ins_id = $CI->Approve_music_model->storeBulkCategory($value,$parent);
                                    $GLOBALS['I'] = $last_ins_id;
                if($_SESSION['main_root_ids']==$parent){                                  
                $_SESSION['destination_last_id']=$last_ins_id;  
                }
                                    if($copy_folder_new_id==0){
                                    	$copy_folder_new_id=$last_ins_id;
                                    }
                                   

                                    scanFolder($dir. DIRECTORY_SEPARATOR .$value,$GLOBALS['I'],$copy_folder_new_id);
                                    }
                                    else
                                    {
                                    //$result[] = $value;
                                    $arr_data['cat_id']=$parent;
                                    $arr_data['image']=$value;
                                    $CI = & get_instance();
                                    $CI->load->model('admin_categories/Approve_music_model');
                                    $CI->Category_model->storeImage($arr_data);
                                    }
                                }
                            }
                        //return $result;
                          return $copy_folder_new_id;

                        }
                    }
                    /////end scandir function              
                    $copy_folder_new_id=scanFolder($tempdstmove,$GLOBALS['I'],$copy_folder_new_id);             
                    //die;
                    // Function to remove folders and files 
                    function rrmdir($dir) {
                        if (is_dir($dir)) {
                            $files = scandir($dir);
                            foreach ($files as $file)
                                if ($file != "." && $file != "..") rrmdir("$dir/$file");
                            rmdir($dir);
                        }
                        else if (file_exists($dir)) unlink($dir);
                    }               
                    rrmdir($tempdstmove);
                    //rrmdir($dir);
                    //$this->Category_model->deleteRecord($did);
                    $data_copy_path_1 = $data['move_folder_path'];
                    $data_copy_path_2 = $this->Category_model->getDirNamesById($copy_folder_new_id);
                    $this->session->set_flashdata('flash_msg_type', 'success');
                    $this->session->set_flashdata('flash_msg_text', 'Data copied successfully. Source directory <strong>'.$data_copy_path_1.'</strong> TO Destination <strong>'.$data_copy_path_2.'</strong>');
                   // redirect(site_url('admin_categories'));
//$dynamic_url= $this->uri->segment(5); ////Chnaged on26-02-20

                       if($dynamic_url[0] == 'master-composers'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url[0] == 'composers'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url[0] == 'School-Music'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url[0] == 'Public Archive'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url[0] == 'Captured Music'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url[0] == 'Music For Sale'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }elseif($dynamic_url[0] == 'S D'){
                          redirect(site_url('admin_categories/admin_s_d'));
                        }else{
                          redirect(site_url('admin_categories'));
                        }
                    //////////////////
            } else {
                //echo "else";
                //die;
                $obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                /*$data['objTree'] = $this->Mastercomposer_model->getCategoryTreeData();
                $data['objTreec'] = $this->Comp_model->getCategoryTreeDataComp();
                $data['objTreesm'] = $this->Mastercomposer_model->getCategoryTreeDataSm();
                $data['objTreeccm'] = $this->Mastercomposer_model->getCategoryTreeDataCapMusic();
                $data['objTreecpa'] = $this->Mastercomposer_model->getCategoryTreeDataPa(); 
                $data['objTreemfs'] = $this->Mastercomposer_model->getCategoryTreeDataMusicSale();*/
                //$last_names = array_column($data['objTree'], 'name');
                //print_r($last_names); 
                //dd($data['objTreec']); die;
                //_adminLayout('copy-directory', $data);
$data['back_redirect_btn']=$this->uri->segment(5);
  $last_id=base64_decode($this->uri->segment(4));
$_SESSION['destination_last_id']=$last_id;                
                _adminLayout('move-approve-music', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

/////////////////////////    
    /**
     * edit
     * @return Add Composer
     * @since 0.1
     * @author DHS
     */
    public function rename($id = false) {
        try {            
            $id = base64_decode($id);
$data['rename_type']='rename_folder';
            $data['title'] = 'Rename Composer';
            $data['action'] = 'rename';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Rename', '/admin/category/rename');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_category')) {
                    $post = $this->input->post();
                    unset($post['submits']);
//*******************update payment url and directory****************
// $parent_details = $this->Category_model->getCategory_name($post['id']);
// $parent_array=explode('/', $parent_details[0]->parent_url);
// end($parent_array);
// $key = key($parent_array);
// $parent_array[$key]=$post['name'];
// $parent_array=implode('/', $parent_array);
// $post['parent_url']=$parent_array;

$parent_url=$this->Category_model->getDirNamesById($post['id']);//$this->Category_model->getCategory_name($post['parent_id']);


 

//*******************update payment url end  directory****************
                    if ($this->Category_model->updateRecord($post['id'], $post)) {
$parent_url_new=$this->Category_model->getDirNamesById($post['id']);
$dir_old = FCPATH . "assets/uploads/Sheet-Music/".$parent_url."/".$post['old_folder_name'];
 $dir_new = FCPATH . "assets/uploads/Sheet-Music/".$parent_url_new."/".$post['new_folder_name'];
rename($dir_old,$dir_new);/////************rename is php default function
//$this->Category_model->updateRecord($post['id'], $post)

                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Composer updated successfully!!');
                        redirect(site_url('admin_categories'));
                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('rename-categories', $data);
                    }
                } else {
                    $obj_cat = (array) $this->Category_model->getRecordById($this->input->post('id'));
                    $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                    $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                    _adminLayout('rename-categories', $data);
                }
            } else {
                $obj_cat = (array) $this->Category_model->getRecordById($id);
                //print_r($obj_cat);die;
                $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                _adminLayout('rename-categories', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }    
    ///rename folder ends///
    ///rename file start///
    public function rename_file($id = false,$redirect_type='',$r_type='') {
        try {            
            $id = base64_decode($id);
$data['rename_type']='rename_file';
            $data['title'] = 'Rename Composer';
            $data['action'] = 'rename_file';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Rename', '/admin/category/rename');
            $data['breadcrumb'] = $this->breadcrumbs->show();

            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_category')) {
 $post=$this->input->post();
 
 $post['image']=$post['name'];
$parent_url=$this->Category_model->getDirNamesById($post['parent_id']);//$this->Category_model->getCategory_name($post['parent_id']);
$post['file_path']=$parent_url;
$dir_old = FCPATH . "assets/uploads/Sheet-Music/".$parent_url.'/'.$post['old_file_name'];
 $dir_new = FCPATH . "assets/uploads/Sheet-Music/".$parent_url.'/'.$post['name'];

$dynamic_url=explode('/', $parent_url);                   

                $_SESSION['destination_last_id']=$post['parent_id'];  



                    unset($post['submits']);
                    unset($post['parent_id']);
                    unset($post['old_file_name']);
                    unset($post['old_file_path']);
                    unset($post['name']);
//*******************update file****************

                    if ($this->Category_model->updateRecord_file($post['id'], $post)) {

rename($dir_old,$dir_new);/////************rename is php default function
//$this->Category_model->updateRecord($post['id'], $post)

                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Composer updated successfully!!');
                        //redirect(site_url('admin_categories'));
                    if($dynamic_url[0] == 'master-composers'){
                        redirect(site_url('admin_categories'));
                        }elseif($dynamic_url[0] == 'composers'){
                          redirect(site_url('admin_categories/admin_comp'));  
                        }elseif($dynamic_url[0] == 'School-Music'){
                          redirect(site_url('admin_categories/admin_school_music'));  
                        }elseif($dynamic_url[0] == 'Public Archive'){
                          redirect(site_url('admin_categories/admin_public_archive'));  
                        }elseif($dynamic_url[0] == 'Captured Music'){
                          redirect(site_url('admin_categories/admin_captured_music'));  
                        }elseif($dynamic_url[0] == 'Music For Sale'){
                          redirect(site_url('admin_categories/admin_music_sale'));  
                        }elseif($dynamic_url[0] == 'S D'){
                          redirect(site_url('admin_categories/admin_s_d'));
                        }else{
                          redirect(site_url('admin_categories'));
                        }



                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('rename-categories', $data);
                    }
                } else {
                    $arr_img = $this->Category_model->getImagesById($this->input->post('id'));
                    $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                    _adminLayout('rename-categories', $data);
                }
            } else {
                //$obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = $this->Category_model->getImagesById($id,'file');
               // print_r($arr_img);die;
                $data['obj_data'] = (object) $arr_img;
                _adminLayout('rename-categories', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }    
    ///rename file ends///
	
    public function edit_composer($id = false) {
        try {
			//echo "$id";die;
            $id = base64_decode($id);
            $data['title'] = 'Edit Composer';
            $data['action'] = 'edit_composer';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Directory', '/admin/category');
            $this->breadcrumbs->push('Edit', '/admin/category/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_category')) {
                    $post = $this->input->post();					
                    unset($post['submits']);
                    if (!empty($_FILES['image']['name'])) {
                        $files = $_FILES;                        
                        /////////Generate directory if not exist
                        $dir = FCPATH . 'assets/uploads/ComposerProfileImages';
                        generateDir($dir);                        
                            $img_data = UploadImage($files, './assets/uploads/ComposerProfileImages', 'image', null);
                            if ($img_data) {
                                $arr_data['cat_id'] = $post['id'];
                                $arr_data['image'] = $img_data['file_name'];                                
								$arr_compdata['name'] = $post['name'];
								$arr_compdata['description'] = $post['description'];
								$arr_compdata['image'] = $img_data['file_name'];                                
                                $this->Category_model->updateRecordComposerDetail($post['id'], $arr_compdata);                           
                            }                       
                    }
					$arr_compddata['name'] = $post['name'];
					$arr_compddata['description'] = $post['description'];
                    if ($this->Category_model->updateComposerDetailRecord($post['id'], $arr_compddata)) {
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Composer updated successfully!!');
                        redirect(site_url('admin_categories'));                        
                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('add-composer-detail', $data);
                    }
                } else {
                    $obj_cat = (array) $this->Category_model->getRecordById($this->input->post('id'));
                    $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                    $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                    _adminLayout('add-composer-detail', $data);
                }
            } else {
                $obj_cat = (array) $this->Category_model->getRecordById($id);
                $arr_img = $this->Category_model->getImagesById($obj_cat['id']);
                $data['obj_data'] = (object) array_merge($obj_cat, array("cat_image" => $arr_img));
                _adminLayout('add-composer-detail', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	/////////////////////////////////////////////////////////
    /**
     * deleteRecord
     * @param
     * @return json
     * @since version 0.1
     * @author DHS
     */
    public function deleteRecord() {
        $id = $this->input->post('id');
        if (isset($id) && !empty($id)) {
            $getAllImages = $this->Category_model->getImagesById($id);			
            if (isset($getAllImages) && !empty($getAllImages) && is_array($getAllImages) && count($getAllImages) > 0) {
                foreach ($getAllImages as $images) {
                    $ImgArr = [];
                    $ImgArr['path'] = FCPATH . '/assets/uploads/category_images/';
                    $ImgArr['id'] = '';
                    $ImgArr['image_name'] = $images->image;					
                    if ($images->image != '') {
                        unLinkImage($ImgArr);
                    }
                }
            }
            $relatedcatImageId = $this->Category_model->deleteRecord($id);
			if($relatedcatImageId)
			{
			$this->Category_model->relatedcatImageDelete($id);
			}
        }
    }
    /**
     * changeStatus
     * @param
     * @return json
     * @since version 0.1
     * @author DHS
     */
    public function changeStatus() {
        $id = $this->input->post('id');
        $sts = $this->input->post('sts');
        echo $this->Category_model->changeStatus($id, $sts);
    }
    /**
     * removeCatImage
     * @param
     * @return json
     * @since version 0.1
     * @author DHS
     */
    public function removeCatImage() {
        try {
            $img_id = $this->input->post('id');
            if (isset($img_id) && !empty($img_id)) {
                $data = $this->Category_model->getImagesById($img_id, 'single');
				if(isset($data))
				{
				$cat_data = $this->Category_model->getRecordById($data->cat_id);
				$path = $this->Category_model->getRevArrayCatbyId($cat_data->id,$cat_data->parent_id);
				}
                $imgArr = [];
                $ImgArr['path'] = FCPATH . "assets/uploads/Sheet-Music/$path/";
                $ImgArr['id'] = '';
                $ImgArr['image_name'] = $data->image;
                if ($data->image != '') {	
                    unLinkImage($ImgArr);
                }
                if ($data->id) {
                    $result = $this->Category_model->catImageDelete($data->id);
                }
                echo $result;
                exit;
            }
        } catch (Exception $ex) {
            
        }
    }	
	/**
     * removeComposerProfileImages
     * @param
     * @return json
     * @since version 0.1
     * @author DHS
     */
    public function removeComposerProfileImage() {
        try {
            $img_id = $this->input->post('id');
            if (isset($img_id) && !empty($img_id)) {
                $data = $this->Category_model->getComposerProfileImagesById($img_id, 'single');
                $imgArr = [];
                $ImgArr['path'] = FCPATH . '/assets/uploads/ComposerProfileImages/';
                $ImgArr['id'] = '';
                $ImgArr['image_name'] = $data->image;
                if ($data->image != '') {
                    unLinkImage($ImgArr);
                }
                if ($data->id) {
                    $result = $this->Category_model->ComposerProfileImageDelete($data->id);
                }
                echo $result;
                exit;
            }
        } catch (Exception $ex) {
            
        }
    }
    /**
     * check_unique_category
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    function check_unique_category($str) {
        if (!empty($this->Category_model->catCheck($str, $this->input->post()))) {
            $this->form_validation->set_message('check_unique_category', 'composer should be unique');
            return false;
        } else {
            return true;
        }
    }

//********************************File and directory delete start here*********************
public function delete_initiate($id = false) {
        //echo "adfs";
        $delete_id = $this->input->post('delete_id');
        $data['redirect_type']=$this->input->post('redirect_type');
        //dd($id); die;
        $delete_status=1;
         $result=$this->Category_model->update_del_status($delete_id,$delete_status);
          $data['delete_html'][0] = 1;
          $data['parent_id_tree'] = $delete_id;
         $html_name = $this->Category_model->getDirIdBy_main_id($delete_id);
         $data['html_name'] = $html_name;
          $data['type'] = 'folder';
        return $this->load->view('ajax_child_tree',$data);
          die;        
        
    }
public function delete_undothis($id = false) {
        //echo "adfs";
        $delete_id = $this->input->post('delete_id');
        $data['redirect_type']=$this->input->post('redirect_type');
        //dd($id); die;
         $result=$this->Category_model->update_del_ustatus($delete_id);
          $data['delete_html'][0] = 2;
          $data['parent_id_tree'] = $delete_id;
          $html_name = $this->Category_model->getDirIdBy_main_id($delete_id);
          $data['html_name'] = $html_name;
          $data['type'] = 'folder';
        return $this->load->view('ajax_child_tree',$data);
          die;       
    }
public function delete_initiate_file($id = false) {
        //echo "adfs";
        $delete_id = $this->input->post('delete_id');
        $data['redirect_type']=$this->input->post('redirect_type');
        //dd($id); die;
         $result=$this->Category_model->update_del_file_status($delete_id,1);
          $data['delete_html'][0] = 1;// temprary delete
          $data['parent_id_tree'] = $delete_id;
          $data['html_name'] = $this->Category_model->get_file_detail($delete_id);
          $data['type'] = 'file';
        return 1;//$this->load->view('ajax_child_tree',$data);
          die;        
        
    }
public function delete_undothis_file($id = false) {
        //echo "adfs";
        $delete_id = $this->input->post('delete_id');
        $data['redirect_type']=$this->input->post('redirect_type');
        //dd($id); die;
         $result=$this->Category_model->update_del_file_status($delete_id,0);
          $data['delete_html'][0] = 2;// undo delete
          $data['parent_id_tree'] = $delete_id;
          $data['html_name'] = $this->Category_model->get_file_detail($delete_id);
          $data['type'] = 'file';
        return $this->load->view('ajax_child_tree',$data);
          die;       
    }
//********************************File and directory delete end here*********************
public function child_multi_level() {
	$data['title']='';
           $data['tree_level']=$this->input->post('tree_level')+1;
           $id=$this->input->post('category_id');
         //  $category_title=$this->input->post('category_title');
         // $result=$this->Category_model->tree_html_name($id,$category_title);
         $data['objTree'] = $this->Category_model->getCategoryTreeData_new($id);
          if(count($data['objTree'])==0){
          	echo "END";die;
          }
           return $this->load->view('child_multi_level',$data);
 
          die;       
    }
//********************************add seerch keyword*********************
public function add_search_keyword($id) {
    $data['title']='';
     
           return $this->load->view('add_search_keyword',$data);
 
          die;       
    }



}