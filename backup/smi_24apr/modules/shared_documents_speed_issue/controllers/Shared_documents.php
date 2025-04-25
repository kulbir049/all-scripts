<?php
error_reporting(1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Shared_documents extends MY_Controller
{
    private $user_id;
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('viewcart/Main_model', 'Shared_documents_model', 'admin_categories/Category_model', 'comp/Comp_model', 'personal_library/Personal_library_model'));
        $this->load->model(array('admin_seo_management/Folder_seo_model'));
		
    }

    public function index()
    {     
        $data['title'] = 'All Cpmposers';
        $data['category_list']=$this->Shared_documents_model->getMasterComposer();
        $data['get_composer']=$this->Shared_documents_model->getComposer();
        $data['objTree'] = $this->Shared_documents_model->getCategoryTreeData();
        //dd($data['objTree']); die();
        //dd($data['get_composer']);
        _frontLayout('shared_documents', $data);

    }
	
	public function doc($id=false,$permision_logs='')
    {
		//echo $id;
		  $pid = base64_decode($id);
         $data['permision_logs'] = base64_decode($permision_logs);
        $permision_logs_array=explode('_', $data['permision_logs']);
        $data['permision_logs_array']=$permision_logs_array;
        
        $data['title'] = 'All Cpmposers';
        
        $page_url = rtrim(current_url(),"/");
        $meta_details = $this->Folder_seo_model->getCmsBy_url($page_url);
//print_r($meta_details);
if(count($meta_details)>0){
        $data['meta_details'] = $meta_details;
}else{
        $data['meta_details'] = $this->Folder_seo_model->getCmsById($pid,true);
}
        $data['objTree'] = $this->Shared_documents_model->getCategory_name($pid,$permision_logs_array);
        
        
        _frontLayout('shared_documents', $data);

    }

    public function pl($id=false)
    {
        //echo $id;
        $pid = base64_decode($id);
        //$arr_data = explode("_",$id);
        //echo $pid = base64_decode($arr_data['0']);
        //echo $cid = base64_decode($arr_data['1']);
        //die;
        $data['title'] = 'All Cpmposers';
        //$data['category_list']=$this->Shared_documents_model->getMasterComposer();
        //$data['get_composer']=$this->Shared_documents_model->getComposer();
        //$data['objTree'] = $this->Shared_documents_model->getCategoryTreeData();
        $data['objTree'] = $this->Category_model->getRecordById($pid);
        $cat_id = $data['objTree']->id;
        $parent_id = $data['objTree']->parent_id;
        $user_email= $this->session->userdata('user_email');

        //$plArray = array($user_email,$cat_id,$parent_id);
        $plArray = array(
        'cat_id'=>$cat_id,
        'parent_id'=>$parent_id,
        'user_email'=>$user_email
        );

        $data['pl_Array'] = $this->Category_model->storePersonalLibrary($plArray);
        $data['personal_Array'] = $this->Category_model->getRecordByEmail($user_email);
           
        //$myArray = json_decode(json_encode($data['objTree']), true);
//var_dump($myArray); 
        //dd($data['personal_Array']); die();
        //dd($data['get_composer']);
        _frontLayout('personal_library', $data);

    }
public function ajax_child_data()
    {    
        $this->session->set_userdata('permission_type','public');
         $parent_id=$this->input->post('parent_id');
            $data['permision_logs'] = $this->input->post('permision_logs');
             $permision_logs_array= $this->input->post('permision_logs');// die;
            $data['permision_logs_array'] =$permision_logs_array; //die;
           //print_r($data['permision_logs']);die;
           $permision_logs=explode('_', $data['permision_logs']);
            $objTree_count = $this->Shared_documents_model->getCategoryTreeData_ajax($parent_id,$data['permision_logs']);
if($permision_logs[0]!='public'){
    if(count($objTree_count)==0){
    $secondLevel = $this->Comp_model->getCategoryTreeData_new('',$parent_id);
//print_r($secondLevel);die;

    if($permision_logs[0]=='temporary'){
     $temporary_lib=1;
    }
    if($permision_logs[0]=='personal'){
    $temporary_lib=0; 
    }

   //print_r($secondLevel);die;
    if(isset($permision_logs[1]) && $permision_logs[1]>0){ //***User's personal & temp
   // echo "hello";die;
      foreach ($secondLevel as $key => $value) {

            $save_data['cat_id']=$value->id;
                $save_data['parent_id']=$value->parent_id;
                $save_data['user_id']=$permision_logs[1];
                $save_data['rename_folder']=$value->name;
                $save_data['temp_rename_folder']=$value->name;
                $save_data['temporary_lib']=$temporary_lib;
              $save_data['personal_upload']=$value->public_personal;
                $save_data['folder_path']=$this->Category_model->getDirNamesById($value->id);
              if($value->name!=''){
                $this->Personal_library_model->save_data_insert('personal_library',$save_data);
                $arr_img_pdf_txt = $this->Category_model->getImagesById_share($value->id,$permision_logs_array);
                //print_r($arr_img_pdf_txt);die; 
                if(count($arr_img_pdf_txt)>0){
                foreach ($arr_img_pdf_txt as $key_1 => $filevalue) {
                    $save_data_file['file_id']=$filevalue->id;
                    $save_data_file['cat_id']=$filevalue->cat_id;
                    $save_data_file['user_id']=$permision_logs[1];
                    $save_data_file['file_name']=$filevalue->image;
                    $save_data_file['rename_file']=$filevalue->image;
                    $save_data_file['temp_rename_file']=$filevalue->image;
                    $save_data_file['file_path']=$filevalue->file_path;
                   $this->Personal_library_model->save_data_insert('personal_library_file',$save_data_file);
                    }
                }
              }
      }
  }//************Personal & tem shared data*********
  }
      //****************ROOT file insert here***********
//echo "hello";
      $arr_img_pdf_txt_verify = array();//$this->Shared_documents_model->getImagesById_share($parent_id,$permision_logs_array);
//print_r($arr_img_pdf_txt_verify);die;
    if(isset($permision_logs[1]) && $permision_logs[1]>0){ //***User's personal & temp

if(count($arr_img_pdf_txt_verify)==0){ 
  $sharing_true=1;
      $arr_img_pdf_txt_root = $this->Category_model->getImagesById_share($parent_id,$permision_logs_array,$sharing_true);
                if(count($arr_img_pdf_txt_root)>0){
                foreach ($arr_img_pdf_txt_root as $key_3 => $filevalue_root) {

$user_id=explode('_', $permision_logs_array);//die;

                 $files_detail = $this->Personal_library_model->personal_file_verify($filevalue_root->id,$user_id[2]);
//print_r($files_detail);die;
                  if(count($files_detail)==0){
                    $save_data_file['file_id']=$filevalue_root->id;
                    $save_data_file['cat_id']=$filevalue_root->cat_id;
                    $save_data_file['user_id']=$permision_logs[1];
                    $save_data_file['file_name']=$filevalue_root->image;
                    $save_data_file['rename_file']=$filevalue_root->image;
                    $save_data_file['temp_rename_file']=$filevalue_root->image;
                    $save_data_file['file_path']=$filevalue_root->file_path;
                   $this->Personal_library_model->save_data_insert('personal_library_file',$save_data_file);
                     }
                    }
                }
      }
  }//****user personal & temp data*****

}
// echo "<br/><br/>";
// print_r($data['permision_logs']);

            $data['objTree'] = $this->Shared_documents_model->getCategoryTreeData_ajax($parent_id,$data['permision_logs']);
            $data['parent_id_tree'] = $parent_id;






            // print_r($data['objTree']);
            // die;
            // if($ajax_search!='' && count($data['objTree'])==0){
            //     echo "No Record Found. Keyword '<strong>".$ajax_search."</strong>'";die;
            // }
        return $this->load->view('ajax_child_tree',$data);
        die;
    }
	
}
