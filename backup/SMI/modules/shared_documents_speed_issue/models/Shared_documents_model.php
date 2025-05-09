<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shared_documents_model extends CI_Model {

	private $categories = "categories";
    public function __construct() {
        parent::__construct();
    }

    public function getMasterComposer() {
        try {
            $this->db->select("id, name, custom_text, parent_id, status");
            $this->db->from($this->categories);
            $this->db->where('parent_id', '1');
            $this->db->where('status', '1');
            $obj_data = $this->db->get()->result_object();
            //dd($obj_data);
            return (isset($obj_data) && !empty($obj_data) ? $obj_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function getComposer() {
        try {
            $this->db->select("id, name, custom_text, parent_id, status");
            $this->db->from($this->categories);
            $this->db->where('parent_id', '2');
            $this->db->where('status', '1');
            $obj_data = $this->db->get()->result_object();
            //dd($obj_data);
            return (isset($obj_data) && !empty($obj_data) ? $obj_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

        public function getCategoryTreeData()
    {
        $query = $this->db
            ->select("id, name, custom_text, parent_id, status")
            ->from($this->categories)
            ->where('parent_id != ', '0')
            ->get();         

        $arrTreeById = array();
        $arrTree = $query->result();
         //echo print_r($arrTree); die;
        $objTreeWrapper = new stdClass();
        $objTreeWrapper->arrChilds = array();
        foreach($arrTree AS $row)
        {
            $arrTreeById[$row->id] = $row;
            $row->arrChilds = array();
        }
        foreach($arrTree AS $objItem)
        {
            if (isset($arrTreeById[$objItem->parent_id]))   $arrTreeById[$objItem->parent_id]->arrChilds[] = $objItem;
            elseif ($objItem->parent_id !== 0)
            {
                $objTreeWrapper->arrChilds[] = $objItem;
            }
        }
        return $objTreeWrapper;
    }  
    public function getCategory_name($id,$permission)
    {
      // print_r($permission);
        //$this->db->select('C.*,P.rename_folder');
         $this->db->select('C.id,C.name,C.searchkeyword, C.folder_user_id,C.parent_id,C.custom_text,C.public_personal, P.personal_upload,C.keyword,P.id AS p_id,P.temporary_lib,P.p_custom_text,P.rename_folder,P.delete_status AS folder_delete_status,P.delete_temp_status,P.created_status,P.move_id,P.parent_id AS p_parent_id,  P.user_id AS p_user_id,  P.temp_rename_folder');

        $this->db->join('personal_library P', 'P.cat_id = C.id','left');
        $this->db->from('categories C');
        if($permission[0]=='personal' && $permission[2]!=''){
        $this->db->where('P.delete_status', 0);
        $this->db->where('P.user_id', $permission[2]);
        }elseif($permission[0]=='temporary' && $permission[2]!=''){
        $this->db->where('P.temporary_lib', 1);
        $this->db->where('P.user_id', $permission[2]);
        }else{
        $this->db->where('C.delete_status', 0);//********Public share and not delete by admin
        }
        $this->db->where('C.id', $id);
        $this->db->order_by('C.name');
        $this->db->group_by('C.id');
        $parent = $this->db->get();
        //echo $this->db->last_query();
        $categories = $parent->result();
        return $categories;
    }
     public function getCategoryTreeData_ajax($parent_id,$permision_logs='')
    {
       // $parent_id=50261;
       // $permision_logs='temporary_89_89';
         $permission=explode('_', $permision_logs);
     $this->db->select('C.id,C.name,C.searchkeyword,C.parent_id,C.custom_text,C.public_personal,C.folder_user_id, P.personal_upload,C.keyword,P.id AS p_id,P.temporary_lib,P.p_custom_text,P.rename_folder,P.delete_status AS folder_delete_status,P.created_status,P.move_id,P.parent_id AS p_parent_id');
     $this->db->join('personal_library P', 'P.cat_id = C.id','left');
        $this->db->from('categories C');

     //  if($permission[0]=='personal' || $permission[0]=='temporary'){
     //    $this->db->join('categories C', 'P.cat_id = C.id','left');
     //        $this->db->from('personal_library P');
     //        $this->db->where('P.parent_id', $parent_id);
     // }else{
     //    $this->db->join('personal_library P', 'P.cat_id = C.id','left');
     //        $this->db->from('categories C');
     //        $this->db->where('C.parent_id', $parent_id);
     //    }
     if($permission[0]=='personal' && $permission[2]!=''){
        $this->db->where('P.delete_status', 0);
        $this->db->where('P.user_id', $permission[2]);
        $this->db->where('((`P`.`move_id` ='.$parent_id.' OR `P`.`parent_id` = '.$parent_id.' OR `C`.`parent_id` = '.$parent_id.')) ');

        }elseif($permission[0]=='temporary' && $permission[2]!=''){
        $this->db->where('P.delete_temp_status', 0);
        $this->db->where('P.user_id', $permission[2]);
        $this->db->where('P.delete_temp_status', 0);
        $this->db->where('((`P`.`temp_move_id` ='.$parent_id.' OR `P`.`temp_parent_id` = '.$parent_id.' OR `C`.`parent_id` = '.$parent_id.')) ');
        }else{
         $this->db->where('C.delete_status', 0);////Public share and delete by admin
          $this->db->where('C.parent_id', $parent_id);
        }
          $this->db->group_by('C.id');
         $this->db->order_by('C.name', 'asc');////Public share and delete by admin

           $query = $this->db->get();
          // echo $this->db->last_query();
        $arrTree = $query->result();
        return $arrTree;
    }  
         public function getImagesById_share($id, $permission,$sharing_true=0) {
$permission=explode('_', $permission);
//print_r($permission);
//echo "<br/><br/>";
            $this->db->select("C.*");
            $this->db->from('category_image C');
       if($permission[0]=='personal' && $permission[2]!=''){
            $this->db->select("P.rename_file as p_rename_file, P.temp_rename_file ");
        $this->db->join('personal_library_file P', 'P.file_id = C.id');
        $this->db->where('P.delete_status', 0);
       $this->db->where('P.user_id', $permission[2]);
         //$this->db->where('(C.cat_id='.$id.' or P.temp_fparent_id='.$id.')');
               $this->db->where('((P.cat_id='.$id.' and P.move_per_id=0) or (P.cat_id='.$id.' and P.move_per_id='.$id.') or (P.cat_id=2 and P.move_per_id='.$id.') or ( P.move_per_id='.$id.'))');
                $this->db->order_by('P.rename_file', 'asc');

        }elseif($permission[0]=='temporary' && $permission[2]!=''){
            $this->db->select("P.rename_file as p_rename_file, P.temp_rename_file ");
//print_r($sharing_true);die; 
        $this->db->join('personal_library_file P', 'P.file_id = C.id');
        $this->db->where('P.temp_status', 0);
        $this->db->where('P.user_id', $permission[2]);


            if($sharing_true==1){
             // echo "hello<br/>";
            //$this->db->where('((C.cat_id='.$id.' and P.temp_fmove_id=0) or (P.temp_fparent_id='.$id.' and P.temp_fmove_id='.$id.'))');
        //$this->db->where('((C.cat_id='.$id.' and (P.temp_fparent_id=0 or P.temp_fparent_id='.$id.')) or P.temp_fparent_id='.$id.')');/////after move file duplicay issue

        $this->db->where('((P.cat_id='.$id.' and P.move_temp_id=0) or (P.cat_id='.$id.' and P.move_temp_id='.$id.') or (P.cat_id=2 and P.move_temp_id='.$id.') or (P.move_temp_id='.$id.'))');


            }
                $this->db->order_by('P.temp_rename_file', 'asc');
        }else{
         $this->db->where('C.cat_id', $id);
         $this->db->where('C.delete_status', 0);////Public share and delete by admin
                         $this->db->order_by('C.image', 'asc');

        }

                $arr_data = $this->db->get()->result_object();   
            //echo $sharing_true.'-------'.$this->db->last_query();die;
            return $arr_data;
        
    }
}

?>