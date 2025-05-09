<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(1);
class Front_ajax extends MY_Controller
{
    
    
    
    function undo_initiate(){
        $delete_id= $this->input->post('delete_id');
        $user_email= $this->session->userdata('user_email');
        $user_id= $this->session->userdata('user_id');

        if($delete_id>0){
            $save['delete_status']= 0;
            $where['cat_id']= $delete_id;
            $where['user_id']= $user_id;
            $table_name="personal_library";
            
            $this->db->where($where);
            $this->db->update($table_name,$save);
            
            $save_0['delete_status']= 0;
            $where_0['id']= $delete_id;
            $where_0['user_id']= $user_id;
            $table_name_0="personal_library";
            
            $this->db->where($where_0);
            $this->db->update($table_name_0,$save_0);
            
            
            
            $save_1['delete_status']= 0;
            $where_1['id']= $delete_id;
            $where_1['folder_user_id']= $user_id;
            $table_name_1="categories";
            
            $this->db->where($where_1);
            $this->db->update($table_name_1,$save_1);
        }
        die;
    }
    
     public function delete_initiate()
    {  
         $delete_id= $this->input->post('delete_id');
         $user_email= $this->session->userdata('user_email');
         $user_id= $this->session->userdata('user_id');
            if($delete_id>0){
         
            
           // die;
            echo "update personal_library set delete_status=2 where cat_id='".$delete_id."' and user_id='".$user_id."' ";die;
            $this->db->query("update personal_library set delete_status=2 where cat_id='".$delete_id."' and user_id='".$user_id."' ");
          
       
            $this->db->query("update personal_library set delete_status=2 where id='".$delete_id."' and user_id='".$user_id."' ");
          
           
            $this->db->query("update categories set delete_status=2 where id='".$delete_id."' and folder_user_id='".$user_id."' ");
          die("gaurav1");
        }
        die;
    }
    
}