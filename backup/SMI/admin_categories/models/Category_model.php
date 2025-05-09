<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_Model {

    private $categories = 'categories';
	private $category_detail = 'category_detail';
    private $category_image = 'category_image';
    private $personal_library = 'personal_library';

    public function __construct() {
        parent::__construct();
    }
public function verify_single_file($parent_id,$filename)
    {
       
        $this->db->select('*');
        $this->db->from('category_image');
        $this->db->where("cat_id",$parent_id);
        $this->db->where("image",$filename);
        $parent = $this->db->get();
        $categories = $parent->result();
       // echo $this->db->last_query();die;
        return $categories;
    }
public function verify_folder_existing($parent_id,$folder_name)
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where("parent_id",$parent_id);
        $this->db->where("name",$folder_name);
        $this->db->where("delete_status!=",2);
        $parent = $this->db->get();
        $categories = $parent->result();
       // echo $this->db->last_query();die;
        return $categories;
    }
public function verify_folder_rename($parent_id,$id,$folder_name)
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where("parent_id",$parent_id);
        $this->db->where("id!=",$id);
        $this->db->where("name",$folder_name);
        $this->db->where("delete_status!=",2);
        $parent = $this->db->get();
        $categories = $parent->result();
       // echo $this->db->last_query();die;
        return $categories;
    }
public function getall_parent_url()
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where("parent_url=''");
        $parent = $this->db->get();
        $categories = $parent->result();
        return $categories;
    }
public function tree_html_name($id,$category_title='')
    {
       
        $this->db->select('id,name');
        $this->db->from('categories');
        $this->db->where('status', 1);
        $this->db->where('parent_id', $id);
        $this->db->order_by("name", "asc");
        if($category_title=='composer'){
        $this->db->or_where('parent_id', 1);
        }
        $this->db->where('delete_status', 0);
        $parent = $this->db->get();
        $categories = $parent->result();
        return $categories;
    }
public function getCategory_name($id)
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('id', $id);
        $parent = $this->db->get();
        $categories = $parent->result();
        return $categories;
    }
public function profile_details_tree($id)
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->order_by("name", "asc");
        //$this->db->where_in('parent_id', array(1,132,1321));
        $this->db->where('folder_user_id', $id);
        $this->db->where('delete_status!=', 2);
        $parent = $this->db->get();
        $categories = $parent->result();
       // echo $this->db->last_query();
        return $categories;  
    }
public function getCategoryTreeData_new($parent_id,$cate_type='')
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->order_by("name", "asc");
        $this->db->where('parent_id', $parent_id);
        $this->db->where('delete_status!=', 2);
        if($cate_type=='comp'){
        $this->db->or_where('parent_id', 132);
        }
        $parent = $this->db->get();
        $categories = $parent->result();
        return $categories;
    }

public function getCategoryTreeData_deleted_data($parent_id)
{
   
    $this->db->select('*');
    $this->db->from('categories');
    $this->db->order_by("name", "asc");
    $this->db->where_in('parent_id', $parent_id);
    $this->db->where('delete_status', 2);
    $parent = $this->db->get();
    $categories = $parent->result();
    
    return $categories;
}

public function getCategoryTreeData_deleted_verify($url)
{
   
    $this->db->select('*');
    $this->db->from('categories');
    $this->db->order_by("name", "asc");
    $this->db->where('parent_url', $url);
    $this->db->where('delete_status!=', 2);
    $parent = $this->db->get();
    $categories = $parent->result();
    
    return $categories;
}
public function getCategoryTreeData_new_root($parent_id,$cate_type='')
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->order_by("name", "asc");
        $this->db->where('parent_id', $parent_id);
        $this->db->where('delete_status!=', 2);
        if($parent_id==132){
        $this->db->or_where('parent_id=1 AND delete_status!=2');
        }
        $parent = $this->db->get();
        $categories = $parent->result();
       // echo $this->db->last_query();
        return $categories;
    }
public function getCategoryTreeData_alphaSearch($parent_id,$keyword,$cate_type='')
    {
       
        
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('delete_status!=', 2);

        if($keyword!='all'){
           $this->db->where("name LIKE '$keyword%'");
        }
        $this->db->order_by("name", "asc");
        if($cate_type=='comp'){
        $this->db->where('(`parent_id` = 1 OR `parent_id` = 132)');
        }else{
        $this->db->where('parent_id', $parent_id);
        }

       

        $parent = $this->db->get(); 
        $categories = $parent->result();
       // echo $this->db->last_query();
        return $categories;
    }
    
    public function getCategoryTreeData_ajax1($parent_id,$ajax_search='')
    {
         $this->db->select('*');
            $this->db->from('categories');
            $this->db->where('parent_id', $parent_id);
            $this->db->where('delete_status!=', 2);
            

            if($ajax_search!=''){//***************search directory with keyword end **************************
            $keyword=$ajax_search;
            $str_replace = str_replace(' ','-',trim($ajax_search));
            $this->db->where("((name LIKE '%".$keyword."%' or name LIKE '%".$str_replace."%') OR (custom_text LIKE '%".$keyword."%' or custom_text LIKE '%".$str_replace."%') OR (keyword LIKE '%".$keyword."%' or keyword LIKE '%".$str_replace."%'))");
                    $this->db->where("(name!='' OR custom_text!='' OR keyword!='')");

            }else{
                if($parent_id==132){
                  $this->db->or_where('parent_id=1 AND delete_status!=2');
               }  
            } //***************search directory with keyword end **************************


        $this->db->order_by("searchkeyword asc, name asc");
           $query = $this->db->get();
           //echo $this->db->last_query();
        $arrTreeById = array();
        $arrTree = $query->result();

        // foreach($arrTree AS $row)
        // {
        //     $arrTreeById[$row->id] = $row;
        // }


        return $arrTree;

    }


public function getCategoryTreeData_ajax($parent_id)
    {
        
           $this->db ->select('*');
           $this->db ->from($this->categories);
            $this->db->where('parent_id', $parent_id);
            $this->db->where('delete_status!=', 2);
           //$this->db->order_by("name", "asc");
           $this->db->order_by("searchkeyword asc, name asc");
            $query = $this->db->get();

        $arrTreeById = array();
        $arrTree = $query->result();
      // echo $this->db->last_query();
        return $arrTree;

    }
    public function update_del_status($id,$delete_status=''){
            $this->db->set('delete_status', $delete_status);
            $this->db->where('id',$id);
            $this->db->or_where('parent_id', $id);
            $this->db->update($this->categories);
    }
    public function update_del_ustatus($id){
            $this->db->set('delete_status', '0');
            $this->db->where('id',$id);
            $this->db->or_where('parent_id', $id);
            $this->db->update($this->categories);
    }
    public function update_del_file_status($id,$del_status){
            $this->db->set('delete_status', $del_status);
            $this->db->where('id',$id);
            $this->db->update('category_image');
    }
    public function update_folder_data($table_name,$where,$save) {
           $this->db->where($where);
            $query=$this->db->update($table_name,$save);
            return $query;
 }

     public function getCategoryTreeData()
    {
        $query = $this->db
            ->select("id, name, custom_text, parent_id, status, delete_status")
            ->from($this->categories)
            ->where('parent_id != ', '0')
            ->get();

        $arrTreeById = array();
        $arrTree = $query->result();
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
	
	public function getassCategoryData($id)
    {
	$select_field = array('id');
            $this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where('parent_id', $id);
			$this->db->where('status', 1);
            $arr_data = $this->db->get()->result_array();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
    }

    /**
     * storeCategory
     * @return last inserted id
     * @since 0.1
     * @author DHS
     */
    public function storeCategory($array) {
        try {
            $this->db->insert($this->categories, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function storePersonalLibrary($plArray) {
        try {
            $this->db->insert($this->personal_library, $plArray);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * storeComposer
     * @return last inserted id
     * @since 0.1
     * @author DHS
     */
    public function storeComposer($array) {
        try {
            $this->db->insert($this->category_detail, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * storeImage
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function storeImage($array) {
        try {
            return $this->db->insert($this->category_image, $array);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function replace_storeImage($array,$id) {
            $this->db->where('id', $id);
            return $this->db->update($this->category_image, $array);
        
    }
     public function storeBulkCategory($value,$parent,$user_id=0) {
        try {
            
            $array['parent_id']=$parent;
            $array['name']=$value;
            $array['folder_user_id']=$user_id;
            $this->db->insert($this->categories, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    
    /**
     * getRecordById
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function getRecordById($id) {
        try {


            $select_field = array('*');
            $this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where('id', $id);
            $arr_data = $this->db->get()->row_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * getRecordNameById
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function getRecordNameById($id) {
        try {


            $select_field = array('name','status');
            $this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where('id', $id);
            $arr_data = $this->db->get()->row_object();
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * getDirNamesById
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function getDirNamesById($id,$is_personal=null) {
        $var_txt='';
        try {
			while($id!=0)
			{
            $select_field = array('id', 'name','parent_id', 'status');
            $this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where('id', $id);
            if($is_personal=='personal'){
                $this->db->where('folder_user_id', $this->session->userdata('user_id'));
            }
            $arr_data = $this->db->get()->row_object();

			$directory[] = $arr_data->name;
              //  $var_txt.=",".$arr_data->name;
              //  var_dump($directory); die;
			$id= $arr_data->parent_id;
			}
            $dir_path_arr = array_reverse($directory);
			$add_dir_path = implode("/",$dir_path_arr);

            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function getDirNamesById_forDeletePersonal($id,$is_personal=null) {
        $var_txt='';
        try {
			while($id!=0)
			{
            $select_field = array('id', 'name','parent_id', 'status');
            $this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where('id', $id);
            if($is_personal=='personal'){
                $this->db->where('folder_user_id', $this->session->userdata('user_id'));
            }
            $arr_data = $this->db->get()->row_object();

			$directory[] = $arr_data->name;
              //  $var_txt.=",".$arr_data->name;
              //  var_dump($directory); die;
			$id= $arr_data->parent_id;
			}
            $dir_path_arr = array_reverse($directory);
			$add_dir_path = implode("/",$dir_path_arr);

            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function get_destination_ids($id) {
            while($id!=0)
            {
            $select_field = array('id', 'name','parent_id', 'status');
            $this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where('id', $id);
            $arr_data = $this->db->get()->row_object();
            $directory[] = $arr_data->parent_id;
            $id= $arr_data->parent_id;
            }
            $dir_path_arr = array_reverse($directory);
            ///$add_dir_path = implode("/",$dir_path_arr);
            return $dir_path_arr;//(isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        
    }


    ///added on 18nov

    public function getDirIdByName($desired_name) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('name', $desired_name);
        $query = $this->db->get();
        return $result = $query->row();
    }

    public function getDirIdBy_catid_name($desired_name,$main_category_id) {
        $this->db->select('*');
        $this->db->from('category_image');
        $this->db->where('image', $desired_name);
        $this->db->where('cat_id', $main_category_id);
        $query = $this->db->get();
        return $result = $query->row();
    }

    public function getDirIdBy_name_id($desired_name,$main_category_id) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('name', $desired_name);
        $this->db->where('parent_id', $main_category_id);
        $query = $this->db->get();
        return $result = $query->row();
    }
    public function getDirIdBy_main_id($main_category_id) {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('id', $main_category_id);
        $query = $this->db->get();
        return $result = $query->row();
    }
    public function get_file_detail($id) {
        $this->db->select('*');
        $this->db->from('category_image');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $result = $query->row();
    }

    ////


    public function getRecordByalphabet($data_id){
        try {
             $user_email= $this->session->userdata('user_email');
             $sql = "SELECT * FROM categories WHERE name LIKE '$data_id%' AND  id IN (SELECT cat_id FROM personal_library WHERE user_email = '$user_email')";

            $arr_data = $this->db->query($sql)->result_object();
             $i=0;
        foreach($arr_data as $p_cat){

            $arr_data[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


    /**
     * getRecordByEmail of personal library
     * @return boolean
     * @since 0.1
     * @author DHS
     */

    public function getRecordByEmail($user_email){
        try {

            $sql = "SELECT * FROM categories WHERE id IN (SELECT cat_id FROM personal_library WHERE user_email = '$user_email')";
            $arr_data = $this->db->query($sql)->result_object();
            $i=0;
        foreach($arr_data as $p_cat){

            $arr_data[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


    public function sub_categories($id){

        $this->db->select('id, name, custom_text, parent_id, status');
        $this->db->from('categories');
        $this->db->where('parent_id', $id);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;       
    }



    /**
     * @Function getAllCategory
     * @purpose Get all category
     * @created  Jan 2018
     * @author DHS
     */
    function getAllCategory($id = false, $type = false) {
        try {

            $where = [];
            if (isset($id) && !empty($id)) {
                if ($type == 'level') {
                    $where = array('parent_id' => $id, 'status' => '1');
                } else {
                    $where = array('id' => $id, 'status' => '1');
                }
            } else {
                
            }

            $this->db->select("id,name,parent_id,icon,priority,short_order,created_on,updated_on,CASE WHEN status = 1 THEN 'Active' ELSE 'Deactive' END AS status", FALSE);
            //$select_field = array('id', 'name', 'parent_id', 'icon', 'short_order', 'status', 'created_on', 'updated_on');
            //$this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where($where);
			//$this->db->order_by(name, ASC);
            $arr_data = $this->db->get()->result_object();
            //echo $this->db->last_query();die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            
        }
    }
	
	/**
     * @Function getCategorybycomposer id
     * @purpose Get all category
     * @created  Jan 2018
     * @author DHS
     */
    function getCategorybycomposerid($id = false) {
        try {

            $where = [];
            if (isset($id) && !empty($id)) {
                $where = array('parent_id' => $id, 'status' => '1');
                
            } else {
                //$where = array('status' => '1');
            }

            $this->db->select("id, name, parent_id, icon, short_order, status");
            //$select_field = array('id', 'name', 'parent_id', 'icon', 'short_order', 'status', 'created_on', 'updated_on');
            //$this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where($where);
			//$this->db->order_by(name, ASC);
            $arr_data = $this->db->get()->result_object();
            //echo $this->db->last_query();die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            
        }
    }
	
	/**
     * @Function getCategorybycomposer id
     * @purpose Get all category
     * @created  Jan 2018
     * @author DHS
     */
    

    /**
     * updateMobileStatus
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function updateRecord($id, $array) {

        try {
            $data = [];
            unset($array['id']);
            $this->db->set($array, false);
            $this->db->where('id', $id);
            $arr_update = $this->db->update($this->categories, $data);
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function updateRecord_file($id, $array) {

        try {
            $data = [];
            unset($array['id']);
            $this->db->set($array, false);
            $this->db->where('id', $id);
            $arr_update = $this->db->update('category_image');
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function updateRecord_file_ajax($id, $array) {

        try {
            $this->db->where('cat_id', $id);
            $arr_update = $this->db->update('category_image',$array);
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * updatesingleImagedata
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function updateSingleImageRecord($id, $cat_id, $image) {

        try {
			$data = [];
			$array = array('image'=>$image);
            $this->db->set($array, false);
            $this->db->where('id', $id);
            $arr_update = $this->db->update($this->category_image, $data);
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * updateMobileStatus
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function updateComposerDetailRecord($id, $array) {

        try {
			
            $data = [];
            $this->db->set($array, false);
            $this->db->where('cat_id', $id);
            $arr_update = $this->db->update($this->category_detail, $data);
            //echo $this->db->last_query();die;
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * updateMobileStatus
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function updateRecordComposerDetail($id, $array) {

        try {
            $data = [];
            $this->db->set($array, false);
            $this->db->where('cat_id', $id);
            $arr_update = $this->db->update($this->category_detail, $data);
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * changeStatus
     * @return change status active or inactive
     * @since 0.1
     * @author DHS
     */
    public function changeStatus($id, $status) {
        try {
            $data = [];
            $this->db->set('status', "'$status'", false);
            $this->db->where('id', $id);
            $arr_update = $this->db->update($this->categories, $data);
            //echo $this->db->last_query();die;
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * getProfile
     * @return object
     * @since 0.1
     * @author DHS
     */
    public function getImagesById($id, $type = false) {

        try {
			//$select_field = array();
            //$select_field = array('id', 'cat_id', 'image', 'status');
            $this->db->select("*");
            $this->db->from($this->category_image);
                $this->db->where('delete_status!=',2);
            if(!empty($type) && isset($type)){
                $this->db->order_by('image', 'asc');
                $this->db->where('id', $id);
                $arr_data = $this->db->get()->row_object();   
            }else{
                $this->db->order_by('image', 'asc');
                $this->db->where('cat_id', $id);
                $arr_data = $this->db->get()->result_object();
            //echo $this->db->last_query();die;
            }
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	 public function getImagesById_share($id, $permission) {

    
            $this->db->select("C.*");
        //$this->db->join('personal_library_file P', 'P.file_id = C.id','left');
            $this->db->from('category_image C');

         $this->db->where('C.cat_id', $id);
       if($permission[0]=='personal' && $permission[2]!=''){
        //$this->db->where('P.delete_status', 0);
       // $this->db->where('P.user_id', $permission[2]);
        }elseif($permission[0]=='temporary' && $permission[2]!=''){
        //$this->db->where('P.temp_status', 0);
        //$this->db->where('P.user_id', $permission[2]);
        }else{
         $this->db->where('C.delete_status', 0);////Public share and delete by admin
        }
                $this->db->order_by('C.image', 'asc');

                $arr_data = $this->db->get()->result_object();   
          //  echo $this->db->last_query();die;
            return $arr_data;
        
    }
	/**
     * getComposerProfileImages
     * @return object
     * @since 0.1
     * @author DHS
     */
    public function getComposerProfileImagesById($id, $type = false) {

        try {
            
            $this->db->from($this->category_detail);
            if(!empty($type) && isset($type)){
                $this->db->where('id', $id);
                $arr_data = $this->db->get()->row_object();
                
            }else{
                $this->db->where('cat_id', $id);
                $arr_data = $this->db->get()->result_object();
            }
            
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * deleteRecord
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function deleteRecord($id) {

        try {
            return $this->db->delete($this->categories, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
	/**
     * catImageDelete
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function relatedcatImageDelete($id) {

        try {
            return $this->db->delete($this->category_image, array('cat_id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function delete_single_file($id) {

        
            return $this->db->delete($this->category_image, array('id' => $id));
        
    }
    public function relatedcatImageDelete_single($id) {

        try {
            return $this->db->delete($this->category_image, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
    /**
     * catImageDelete
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function catImageDelete($id) {

        try {
            return $this->db->delete($this->category_image, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	/**
     * ComposerProfileImageDelete
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function ComposerProfileImageDelete($id) {

        try {
            return $this->db->delete($this->category_detail, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
    /**
     * catCheck
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function catCheck($val, $arr) {

        try {
            if(isset($arr['id']) && !empty($arr['id'])){
                $array = array('name' => $arr['name'], 'id <>' => $arr['id']);

            }else{
                $array = array('name' => $arr['name']);
            }

            $this->db->where($array);
            $query = $this->db->get($this->categories);
            $arr_data = $query->num_rows();
            return (isset($arr_data) && !empty($arr_data) ? true : false);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    function getRevArrayCatbyId($id = false,$parent_id =false) {
        try {
            //echo $id.'-'.$parent_id;die;

            $where = [];
            if (isset($parent_id) && !empty($parent_id)) {
                if(isset($id) && !empty($id))
                {
                $where = array('id' => $id, 'status' => '1');
                $this->db->select("id, name, parent_id, status, delete_status");
                $this->db->from($this->categories);
                $this->db->where($where);
                
                $arr_data_p = $this->db->get()->row_object();
                $cat_arr[] = $arr_data_p->name;
                }
                $where = [];
                $where = array('id' => $parent_id, 'status' => '1');
                $this->db->select("id, name, parent_id, status, delete_status");
                $this->db->from($this->categories);
                $this->db->where($where);
                
                $arr_data = $this->db->get()->row_object();
                $cat_arr[] = $arr_data->name;
                    if($arr_data->parent_id !=0)
                    {
                    $where = [];
                    $where = array('id' => $arr_data->parent_id, 'status' => '1');
                    $this->db->select("id, name, parent_id, status, delete_status");
                    $this->db->from($this->categories);
                    $this->db->where($where);
                    
                    $arr_data = $this->db->get()->row_object();
                    //echo $this->db->last_query();die;
                    $cat_arr[] = $arr_data->name;
                    //////start second level///////
                        if($arr_data->parent_id !=0)
                        {
                        $where = [];
                        $where = array('id' => $arr_data->parent_id, 'status' => '1');
                        $this->db->select("id, name, parent_id, status, delete_status");
                        $this->db->from($this->categories);
                        $this->db->where($where);
                        
                        $arr_data = $this->db->get()->row_object();
                        $cat_arr[] = $arr_data->name;
                        //start third level//
                        if($arr_data->parent_id !=0)
                        {
                        $where = [];
                        $where = array('id' => $arr_data->parent_id, 'status' => '1');
                        $this->db->select("id, name, parent_id, status, delete_status");
                        $this->db->from($this->categories);
                        $this->db->where($where);
                        
                        $arr_data = $this->db->get()->row_object();
                        $cat_arr[] = $arr_data->name;
                            //start fourth level//
                            if($arr_data->parent_id !=0)
                            {
                            $where = [];
                            $where = array('id' => $arr_data->parent_id, 'status' => '1');
                            $this->db->select("id, name, parent_id, status, delete_status");
                            $this->db->from($this->categories);
                            $this->db->where($where);
                            
                            $arr_data = $this->db->get()->row_object();
                            $cat_arr[] = $arr_data->name;
                                //start fifth level//
                                if($arr_data->parent_id !=0)
                                {
                                $where = [];
                                $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                $this->db->select("id, name, parent_id, status, delete_status");
                                $this->db->from($this->categories);
                                $this->db->where($where);
                                
                                $arr_data = $this->db->get()->row_object();
                                $cat_arr[] = $arr_data->name;
                                    //start sixth level//
                                    if($arr_data->parent_id !=0)
                                    {
                                    $where = [];
                                    $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                    $this->db->select("id, name, parent_id, status, delete_status");
                                    $this->db->from($this->categories);
                                    $this->db->where($where);
                                    
                                    $arr_data = $this->db->get()->row_object();
                                    $cat_arr[] = $arr_data->name;
                                        //start seventh level//
                                        if($arr_data->parent_id !=0)
                                        {
                                        $where = [];
                                        $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                        $this->db->select("id, name, parent_id, status, delete_status");
                                        $this->db->from($this->categories);
                                        $this->db->where($where);
                                        
                                        $arr_data = $this->db->get()->row_object();
                                        $cat_arr[] = $arr_data->name;
                                            //start eighthLevel level//
                                            if($arr_data->parent_id !=0)
                                            {
                                            $where = [];
                                            $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                            $this->db->select("id, name, parent_id, status, delete_status");
                                            $this->db->from($this->categories);
                                            $this->db->where($where);
                                            $arr_data = $this->db->get()->row_object();
                                            $cat_arr[] = $arr_data->name;
                                                //start ninthLevel level//
                                                if($arr_data->parent_id !=0)
                                                {
                                                $where = [];
                                                $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                                $this->db->select("id, name, parent_id, status, delete_status");
                                                $this->db->from($this->categories);
                                                $this->db->where($where);
                                                
                                                $arr_data = $this->db->get()->row_object();
                                                $cat_arr[] = $arr_data->name;
                                                    //start tenthLevel level//
                                                    if($arr_data->parent_id !=0)
                                                    {
                                                    $where = [];
                                                    $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                                    $this->db->select("id, name, parent_id, status, delete_status");
                                                    $this->db->from($this->categories);
                                                    $this->db->where($where);
                                                    
                                                    $arr_data = $this->db->get()->row_object();
                                                    $cat_arr[] = $arr_data->name;
                                                        //start eleventhLevel level//
                                                        if($arr_data->parent_id !=0)
                                                        {
                                                        $where = [];
                                                        $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                                        $this->db->select("id, name, parent_id, status, delete_status");
                                                        $this->db->from($this->categories);
                                                        $this->db->where($where);
                                                        
                                                        $arr_data = $this->db->get()->row_object();
                                                        $cat_arr[] = $arr_data->name;
                                                            //start twelfthlevel level//
                                                            if($arr_data->parent_id !=0)
                                                            {
                                                            $where = [];
                                                            $where = array('id' => $arr_data->parent_id, 'status' => '1');
                                                            $this->db->select("id, name, parent_id, status, delete_status");
                                                            $this->db->from($this->categories);
                                                            $this->db->where($where);
                                                            
                                                            $arr_data = $this->db->get()->row_object();
                                                            $cat_arr[] = $arr_data->name;
                                                                //start thirteenth level//
                                                                
                                                                //end thirteenth level//
                                                            }
                                                            //end twelfthlevel level//
                                                        }
                                                        //end eleventhLevel level//
                                                    }
                                                    //end tenthLevel level//
                                                }
                                                //end ninthLevel level//
                                            }
                                            //end eighthLevel level//
                                        }
                                        //end seventh level//
                                    }
                                    //end sixth level//
                                }
                                //end fifth level//
                            }
                            //end fourth level//
                        }
                        //end third level//
                        }
                    //////end second level///////
                    }
                
                //dd(array_reverse($cat_arr));
                //die;
                $path = implode("/",array_reverse($cat_arr));
            }

            return (isset($path) && !empty($path) ? $path : '');
        } catch (Exception $ex) {
            
        }
    }
    
    
    public function get_keywordsearch_file($file_search='',$parent_id='',$repertoire_key='',$folder_search=''){

        $file_search = str_replace("'",'',trim($file_search));   
        if($parent_id==''){
            if($this->session->userdata('search_music_for_sale')==1){
                $parent_id_array=array(1,132,1321,13763);
            }else{
                $parent_id_array=array(1,132,1321);
            }
        }else{
            $parent_id_array=array();
        }  
        if($folder_search=='' && $this->session->userdata('search_music_for_sale')!=1){
            unset($parent_id_array); 
        } 
        $file_search_new=trim($file_search);  
        $file_search = trim($file_search_new);
        $str_replace_file = str_replace(' ','-',trim($file_search_new));
        $keyword_array = explode(' ',trim($file_search));//$searchon;
        $sql_string='';
        $this->db->select('C.id, C.name,C.rename_folder, C.custom_text, C.keyword, C.parent_id, C.status,C.delete_status');
        $file_ext_array=array('pdf','txt','doc','mp3','mp4');
        $file_ext = pathinfo($file_search, PATHINFO_EXTENSION);
        if(in_array($file_ext, $file_ext_array)){
            $this->db->join('category_image CM', 'CM.cat_id = C.id');
            $sql_string.="((C.name LIKE '%".$file_search."%' or C.name LIKE '%".$str_replace_file."%') OR (C.keyword LIKE '%".$file_search."%' or C.keyword LIKE '%".$str_replace_file."%') OR (C.custom_text LIKE '%".$file_search."%' or C.custom_text LIKE '%".$str_replace_file."%')or(CM.image LIKE '%".trim($file_search)."%' or CM.image LIKE '%".trim($str_replace_file)."%'))";

        }else{
            $sql_string.="((C.name LIKE '%".$file_search."%' or C.name LIKE '%".$str_replace_file."%') OR (C.keyword LIKE '%".$file_search."%' or C.keyword LIKE '%".$str_replace_file."%') OR (C.custom_text LIKE '%".$file_search."%' or C.custom_text LIKE '%".$str_replace_file."%'))";
        }
        $this->db->from('categories C');
        if(count($parent_id_array)>0){
            $this->db->where_in("C.parent_id",$parent_id_array);// search from public libraray
        }
        $this->db->where("C.delete_status!=",2);// search from public libraray
        $this->db->where('('.$sql_string.')');
        $this->db->group_by('C.id'); 
        $this->db->order_by('C.name','asc'); 
        $parent = $this->db->get();
        $categories = $parent->result();
        //echo $this->db->last_query();//die;
        return $categories;      
    }
       public function get_folders_by_ids($ids,$parent_id) {
            
            $select_field = array('id', 'name','parent_id', 'status');
            $this->db->select('*');
            $this->db->from('categories');
            if(count($ids)>0){
            $this->db->where_in('id', $ids);
            }
            $this->db->where('delete_status!=', 2);
            $this->db->where('parent_id', $parent_id);
            $this->db->order_by('name','asc');
            $this->db->group_by('id');
            $arr_data = $this->db->get()->result();
            
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        
    }
    
    
       public function get_folders_by_idsC($ids,$parent_id) {
            
            $select_field = array('id', 'name','parent_id', 'status');
            $this->db->select('*');
            $this->db->from('categories');
            if(count($ids)>0){
            $this->db->where_in('id', $ids);
            }
            $this->db->where('delete_status!=', 2);
            $this->db->where_in('parent_id', $parent_id);
            $this->db->order_by('name','asc');
            $this->db->group_by('id');
            $arr_data = $this->db->get()->result();
            
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        
    }
    
     public function getDirNamesById_all_parent_folders($id,$control_id) {
            while($id>$control_id)
            {
            $this->db->select('*');
            $this->db->from('categories');
            $this->db->where('id', $id);
            $this->db->where('delete_status!=', 2);
           // $this->db->where('public_personal', 0);
            $arr_data = $this->db->get()->row_object();
            $directory[] = $arr_data->parent_id;
            $id= $arr_data->parent_id;
            $main_root_id= $arr_data->id;
            }
            $dir_path_arr = array_reverse($directory);
            $add_dir_path = $dir_path_arr;//implode("/",$dir_path_arr);
            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        
    }

   public function getDirNamesById_keywordsearch($id,$control_id) {
            while($id>$control_id)
            {
                $this->db->select('*');
                $this->db->from('categories');
                $this->db->where('id', $id);
                $this->db->where('delete_status!=', 2);
                if($this->session->userdata('search_music_for_sale')!=1){
                   // $this->db->where('public_personal', 0);
                }
                $arr_data = $this->db->get()->row_object();
                $directory[] = $arr_data->id;
                $id= $arr_data->parent_id;
                $main_root_id= $arr_data->id;
            }
            $dir_path_arr = array_reverse($directory);
            $add_dir_path = $dir_path_arr;
            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
    }
    
    
  public function getImagesById11($id, $ajax_search_file='') {
 $loop=0;   


 if($this->session->userdata('ajax_search_file_folder_string_matched')>0){
 // echo "kkkkk";
       $show_all = 0;//$this->Comp_model->getImagesById($parent_id_tree);
          }else{
       $show_all = 0;//$this->Comp_model->getImagesById($parent_id_tree);
          }



//$unset_keyword=array(35552,34630);
if($this->session->userdata('root_folders_ids')){
$root_folders_ids=$this->session->userdata('root_folders_ids');
        if (in_array($id, $root_folders_ids)){ $loop++; }
 }      

  $str_replace_file = str_replace(' ','-',trim($ajax_search_file));

//*******************Search folder instead of file first Nth level start here**************
          $count_folder=$this->db->select("*");
          $count_folder=  $this->db->from('categories C');
           $count_folder= $this->db->where('C.id', $id);
        $count_folder=$this->db->where("C.delete_status",0);// search from public libraray
        $count_folder=$this->db->where("(C.name LIKE '%".$ajax_search_file."%' or C.name LIKE '%".$str_replace_file."%') 
        OR (C.keyword LIKE '%".$ajax_search_file."%' or C.keyword LIKE '%".$str_replace_file."%')");
        $count_folder=$this->db->group_by("C.id");// search from public libraray
                $count_folder = $this->db->get()->result_object();
               //echo $this->db->last_query();die;
//*******************Search folder instead of file first Nth level end here**************

// if(count($count_folder)>0){
//     $this->session->set_userdata('ajax_search_file_folder_string_matched',1);
// }else{
//     $this->session->set_userdata('ajax_search_file_folder_string_matched',0);
// }

//print_r($count_folder);


  if($ajax_search_file!='' && count($count_folder)==0){
      
            $this->db->select("*");
            $this->db->from('category_image CM');
                $this->db->where('CM.cat_id', $id);
        $this->db->where("CM.delete_status",0);// search from public libraray
        $this->db->where("(CM.image LIKE '%".$ajax_search_file."%' or CM.image LIKE '%".$str_replace_file."%') OR 
        (CM.keyword_text LIKE '%".$ajax_search_file."%' or CM.keyword_text LIKE '%".$str_replace_file."%')");
        $this->db->group_by("CM.id");// search from public libraray
                $arr_data = $this->db->get()->result_object();

                if((count($arr_data)==0 && $loop==0) || $show_all==1){
                    //echo "ssss";
                $this->db->select("*");
                    $this->db->from('category_image');
                        $this->db->where('cat_id', $id);
                        $this->db->where("delete_status!=",2);// search from public libraray
                      $this->db->group_by("id");// search from public libraray
                        $arr_data_1 = $this->db->get()->result_object();
             return $arr_data_1;
                }else{
             return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
                }
}else{

    $this->db->select("*");
                    $this->db->from('category_image');
                        $this->db->where('cat_id', $id);
                        $this->db->where("delete_status!=",2);// search from public libraray
                      $this->db->group_by("id");// search from public libraray
                        $arr_data_1 = $this->db->get()->result_object();
                if($loop==0 || $show_all==1){
                //    echo "data";die;
             return $arr_data_1;
                 }else{
                  //   echo "data123";die;
             return $arr_data_1='';//*********************Root parent Folders******************
                 }
}

 
        
    }
        public function get_keywordsearch_verify($folder_search='',$folder_id){
 


$folder_search = str_replace("'",'',trim($folder_search));//$searchon;


unset($keyword_array);
$keyword = str_replace(' ','%',trim($folder_search));//$searchon;
        $str_replace = str_replace(' ','-',trim($folder_search));
        $keyword_array = explode(' ',trim($folder_search));//$searchon;
       // $keyword_array_string = implode(',',$keyword_array));//$searchon;
    //$keyword_array_2=$keyword_array[0];
    //print_r(count($keyword_array));
//************************************Commented on 23062021********************
// if(count($keyword_array)>1){
//         $sql_string.="(C.name LIKE  '%".$keyword_array[1]."%' or C.name LIKE '%".$str_replace."%') or (C.keyword LIKE '%".$keyword_array[1]."%'  or C.keyword LIKE '%".$str_replace."%') or (C.custom_text LIKE '%".$keyword_array[1]."%'  or C.custom_text LIKE '%".$str_replace."%')";

// }else{
//         $sql_string.="(C.name LIKE  '%".$keyword."%' or C.name LIKE '%".$str_replace."%') or (C.keyword LIKE '%".$keyword."%'  or C.keyword LIKE '%".$str_replace."%') or (C.custom_text LIKE '%".$keyword."%'  or C.custom_text LIKE '%".$str_replace."%')";
// }
//************************************Commented on 23062021 end********************

$sql_string.="(C.name LIKE  '%".$keyword."%' or C.name LIKE '%".$str_replace."%') or (C.keyword LIKE '%".$keyword."%'  or C.keyword LIKE '%".$str_replace."%') or (C.custom_text LIKE '%".$keyword."%'  or C.custom_text LIKE '%".$str_replace."%')";

 $this->db->select('C.id, C.name,C.rename_folder, C.custom_text, C.keyword, C.parent_id, C.status,C.delete_status');
            $this->db->from('categories C');
            //if($folder_id>0){
            $this->db->where("C.id",$folder_id);// search from public libraray
            // }
        $this->db->where("C.delete_status!=",2);// search from public libraray$this->db->where('delete_status!=', 2);
        if($folder_search!=''){
        $this->db->where('('.$sql_string.')');
       }
       $this->db->group_by('C.id'); 
        $parent = $this->db->get();
        $categories = $parent->result();
        // if(count($keyword_array)>1){
        // echo $this->db->last_query();//die;
        //  }
        return $categories; 

    }


}

?>
