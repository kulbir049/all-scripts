<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comp_model extends CI_Model {

	private $categories = "categories";
    public function __construct() {
        parent::__construct();
    }
//*********************new function for page speed start here***********************    

    public function getCategoryTreeData_by_id($id)
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->order_by("name", "asc");
        $this->db->where('id', $id);
       $this->db->where('delete_status', 0);
       
        $parent = $this->db->get();

        $categories = $parent->result();
        $i=0;
        // foreach($categories as $p_cat){

        //     $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
        //     $i++;
        // }
        return $categories;
    }
    public function getCategoryTreeData_new($cate_type='',$parent_id)
    {
       
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->order_by("name", "asc");
        
       // if($cate_type=='comp'){
       //  $this->db->or_where('parent_id=132 AND delete_status=0');
       //  }
       if($parent_id==132){
        $this->db->or_where('(parent_id=1 AND delete_status=0) OR (parent_id=132 AND delete_status=0)');
        }else{
            $this->db->where('parent_id', $parent_id);
       $this->db->where('delete_status', 0);
        }
        $parent = $this->db->get();

        $categories = $parent->result();
        $i=0;
        // foreach($categories as $p_cat){

        //     $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
        //     $i++;
        // }
            //echo $this->db->last_query();die;
        return $categories;
    }
 
    public function getCategoryTreeData_ajax123($parent_id,$ajax_search='')
    {
        echo "db_gaurav";die;
         $this->db->select('*');
            $this->db->from($this->categories);
            $this->db->where('parent_id', $parent_id);
            $this->db->where('delete_status', 0);
            

            if($ajax_search!=''){//***************search directory with keyword end **************************
            $keyword=$ajax_search;
            $str_replace = str_replace(' ','-',trim($ajax_search));
            $this->db->where("((name LIKE '%".$keyword."%' or name LIKE '%".$str_replace."%') OR (custom_text LIKE '%".$keyword."%' or custom_text LIKE '%".$str_replace."%') OR (keyword LIKE '%".$keyword."%' or keyword LIKE '%".$str_replace."%'))");
                    $this->db->where("(name!='' OR custom_text!='' OR keyword!='')");

            }else{
                if($parent_id==132){
                  $this->db->or_where('parent_id=1 AND delete_status=0');
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
public function getCategoryTreeData_alphaSearch($parent_id,$keyword,$cate_type='')
    {
       
        
        $this->db->select('*');
        $this->db->from('categories');

        if($keyword!='all'){
           $this->db->where("name LIKE '$keyword%'");
        }
        $this->db->order_by("name", "asc");
        if($cate_type=='comp'){
        $this->db->where('(`parent_id` = 1 OR `parent_id` = 132)');
        }else{
        $this->db->where('parent_id', $parent_id);
        }
       $this->db->where('delete_status', 0);
        $this->db->group_by("id");

        $parent = $this->db->get(); 
        $categories = $parent->result();
        //echo $this->db->last_query();
        return $categories;
    }
   public function get_categories_alphaSearch($data_id)
    {
        $alp = $data_id;

        
        $sql = "SELECT `id`, `name`, `custom_text`, `parent_id`, `status` FROM `categories` WHERE `parent_id` IN ('1', '132') AND name LIKE '$alp%'";
        $parent = $this->db->query($sql);
        //$parent = $this->db->get();
        //echo get_query(); die();
        $categories = $parent->result();
       
        return $categories;
    }
//*********************new function for page speed end here*********************** 
    public function orderhistory_data($user_id)
    {
       
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->order_by("id", "desc");
        $this->db->where('user_id', $user_id);
        $this->db->where('payment_status', 'Success');
        $parent = $this->db->get();

        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }
    public function getCategoryTreeData()
    {
       
        $this->db->select('id, name, custom_text, keyword, parent_id, status');
        $this->db->from('categories');
        $this->db->order_by("name", "asc");
        $this->db->where('parent_id', 1);
        $this->db->or_where('parent_id', 132);
        $parent = $this->db->get();

        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }


    public function getCategoryTreeDataComp()
    {
       
        $this->db->select('id, name, custom_text, keyword, parent_id, status');
        $this->db->from('categories');
        $this->db->order_by("name", "asc");
        // $this->db->where('parent_id', 1);
        $this->db->or_where('parent_id', 132);
        $parent = $this->db->get();

        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }


        public function getCategoryTreeDataByAlphabet($data_id)
    {
        $alp = $data_id;
        //dd($alp); die();
        $query = $this->db
            ->select("id, name, custom_text, keyword, parent_id, status")
            ->from($this->categories)
            ->where('parent_id != ', '0')
            ->like('name', $alp, 'after', false)
            ->get();

          //echo get_query(); die();

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
            if (isset($arrTreeById[$objItem->parent_id]))   
                $arrTreeById[$objItem->parent_id]->arrChilds[] = $objItem;
            //echo print_r($objItem); die;
            elseif ($objItem->parent_id == 1)
            {
                $objTreeWrapper->arrChilds[] = $objItem;

            }
        }

        return $objTreeWrapper;


    }


    public function get_categories($data_id)
    {
        $alp = $data_id;

        // $this->db->select('id, name, custom_text, parent_id, status');
        // $this->db->from('categories');
        // $this->db->where('parent_id', 1);
        // $this->db->or_where('parent_id', 132);
        // $this->db->like('name', $alp, 'after', false);


        $sql = "SELECT `id`, `name`, `custom_text`,  `keyword`, `parent_id`, `status` FROM `categories` WHERE `parent_id` IN ('1', '132') AND name LIKE '$alp%'";
        $parent = $this->db->query($sql);
        //$parent = $this->db->get();
        //echo get_query(); die();
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }

     public function get_categories_sm($data_id)
    {
        $alp = $data_id;
        $sql = "SELECT `id`, `name`, `custom_text`,  `keyword`, `parent_id`, `status` FROM `categories` WHERE `parent_id` =1321 AND name LIKE '$alp%'";

        $parent = $this->db->query($sql);
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }

    


    public function get_admincategories($data_id)
    {
        $alp = $data_id;
        $this->db->select('id, name, custom_text, keyword, parent_id, status');
        $this->db->from('categories');
        $this->db->where('parent_id', 1);
        $this->db->where('parent_id', 132);
        $this->db->like('name', $alp, 'after', false);
        $parent = $this->db->get();
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->arrChilds = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }

    public function sub_categories($id){

        $this->db->select('id, name, custom_text, keyword, parent_id, status');
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

    public function getCategoryTreeData_ajax_search($ajax_search='',$ajax_search_file='',$parent_id)
    {
       // $ajax_search=explode(',', $ajax_search);
        $keyword=$ajax_search;

       $str_replace = str_replace(' ','-',trim($ajax_search));
       $str_replace_file = str_replace(' ','-',trim($ajax_search_file));
        $this->db->select('C.id, C.name,C.rename_folder, C.custom_text, C.keyword, C.parent_id, C.status,C.delete_status');
if($parent_id==1 || $parent_id==132 || $parent_id==1321){ 
  //******************ONLY folder dearch    
           $this->db->from('categories C');
            $this->db->where('C.parent_id', $parent_id);
            $this->db->where('C.delete_status', 0);
            //$this->db->where_in('C.id', $ajax_search);//WHERE author IN ('Bob', 'Geoff')
                    $this->db->where("((C.name LIKE '%".$keyword."%' or C.name LIKE '%".$str_replace."%') OR (C.keyword LIKE '%".$keyword."%' or C.keyword LIKE '%".$str_replace."%') )");

        }else{
             $this->db->join('category_image CM', 'CM.cat_id = C.id');
           $this->db->from('categories C');
           if(count($ajax_search)>0){
            $this->db->where_in('C.id', $ajax_search);//WHERE author IN ('Bob', 'Geoff')
            }
           if($ajax_search_file!=''){
        //$this->db->where("(CM.image LIKE '%".$ajax_search_file."%' or CM.image LIKE '%".$str_replace_file."%') OR (CM.keyword_text LIKE '%".$ajax_search_file."%' or CM.keyword_text LIKE '%".$str_replace_file."%')");
        $this->db->where("((C.name LIKE '%".$keyword."%' or C.name LIKE '%".$str_replace."%') OR (C.keyword LIKE '%".$keyword."%' or C.keyword LIKE '%".$str_replace."%') ) OR ((CM.image LIKE '%".$keyword."%' or CM.image LIKE '%".$str_replace."%') OR (CM.keyword_text LIKE '%".$keyword."%' or CM.keyword_text LIKE '%".$str_replace."%')) ");
            }
        $this->db->where("CM.delete_status",0);// search from public libraray
        }


        $this->db->where("C.delete_status",0);// search from public libraray
        $this->db->where("C.public_personal",0);// search from public libraray
           $query = $this->db->get();
           //echo $this->db->last_query();
        $arrTreeById = array();
        $arrTree = $query->result();

        return $arrTree;
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
        $this->db->where("C.delete_status",0);// search from public libraray
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
    public function get_keywordsearch($searchon='',$file_search='',$parent_id='',$folder_id=''){
$searchon = str_replace("'",'',trim($searchon));//$searchon;
$file_search = str_replace("'",'',trim($file_search));//$searchon;



 if($parent_id==''){
//$parent_id_array=array();//array(1,132,1321);
    $root_search=1;
    if($this->session->userdata('search_music_for_sale')==1){
       $parent_id_array=array(1,132,1321,13763,12619,12522);
    }else{
        $parent_id_array=array(1,132,1321,12619,12522);
    }
 }else{
    $root_search=0;
$parent_id_array=array($parent_id);
 }   
 //print_r($parent_id_array);die;
       $keyword = str_replace(' ','%',trim($searchon));//$searchon;
        $str_replace = str_replace(' ','-',trim($searchon));
       // $keyword_file = str_replace(' ',' % ',trim($file_search));//$searchon;
       // $str_replace_file = str_replace(' ','-',trim($file_search));
        $keyword_array = explode(' ',trim($searchon));//$searchon;


$sql_string='';
if($file_search==''){ ///******************only folder searching...

        foreach ($keyword_array as $key => $value) {
            if($key>0){
             $sql_string.=" OR ";
            }
            //$sql_string.="(C.name LIKE  '%".$value."%' or C.name LIKE '%".$str_replace."%') or (C.keyword LIKE '%".$value."%'  or C.keyword LIKE '%".$str_replace."%') or (C.custom_text LIKE '%".$value."%'  or C.custom_text LIKE '%".$str_replace."%')";//**************14-10-2020************
            if($root_search==1){
            $sql_string.="(C.name LIKE  '".$value."%' or C.name LIKE '".$str_replace."%') or (C.keyword LIKE '%".$value."%'  or C.keyword LIKE '%".$str_replace."%') or (C.custom_text LIKE '%".$value."%'  or C.custom_text LIKE '%".$str_replace."%')";

            }else{
            $sql_string.="(C.name LIKE  '%".$value."%' or C.name LIKE '%".$str_replace."%') or (C.keyword LIKE '%".$value."%'  or C.keyword LIKE '%".$str_replace."%') or (C.custom_text LIKE '%".$value."%'  or C.custom_text LIKE '%".$str_replace."%')";
            }
             }
            
        }

if($searchon!='' && $file_search!=''){ ///******************both searching...
    //echo "hello";
    //$sql_string.="((C.name LIKE '%".$keyword."%' or C.name LIKE '%".$str_replace."%') OR (C.keyword LIKE '%".$keyword."%' or C.keyword LIKE '%".$str_replace."%') ) OR ((CM.image LIKE '%".$keyword."%' or CM.image LIKE '%".$str_replace."%') OR (CM.keyword_text LIKE '%".$keyword."%' or CM.keyword_text LIKE '%".$str_replace."%')) ";
    if($root_search==1){ 
     $sql_string.="((C.name LIKE '".$keyword."%' or C.name LIKE '".$str_replace."%') OR (C.keyword LIKE '".$keyword."%' or C.keyword LIKE '".$str_replace."%') OR (C.custom_text LIKE '".$keyword."%' or C.custom_text LIKE '".$str_replace."%'))";
       }else{
    $sql_string.="((C.name LIKE '%".$keyword."%' or C.name LIKE '%".$str_replace."%') OR (C.keyword LIKE '%".$keyword."%' or C.keyword LIKE '%".$str_replace."%') OR (C.custom_text LIKE '%".$keyword."%' or C.custom_text LIKE '%".$str_replace."%'))";

       }
}




        $this->db->select('C.id, C.name,C.rename_folder, C.custom_text, C.keyword, C.parent_id, C.status,C.delete_status');
    if($searchon!='' && $file_search!='' && $root_search!=1){ ///******************both searching...
             $this->db->join('category_image CM', 'CM.cat_id = C.id');
    }
            $this->db->from('categories C');
            if(count($parent_id_array)>0){
            $this->db->where_in("C.parent_id",$parent_id_array);// search from public libraray
             }
            if($folder_id>0){
            $this->db->where("C.id",$folder_id);// search from public libraray
             }
        $this->db->where("C.delete_status",0);// search from public libraray
    if($this->session->userdata('search_music_for_sale')!=1){
        $this->db->where("C.public_personal",0);// search from public libraray
    }

        //$this->db->where("((C.name LIKE '%".$keyword."%' or C.name LIKE '%".$str_replace."%') OR (C.keyword LIKE '%".$keyword."%' or C.keyword LIKE '%".$str_replace."%') ) OR ((CM.image LIKE '%".$keyword_file."%' or CM.image LIKE '%".$str_replace_file."%') OR (CM.keyword_text LIKE '%".$keyword_file."%' or CM.keyword_text LIKE '%".$str_replace_file."%')) ");
        $this->db->where('('.$sql_string.')');






         $this->db->group_by('C.id'); 

        $parent = $this->db->get();
        $categories = $parent->result();
        //echo $this->db->last_query();//die;
        return $categories;      
    }
    public function get_keywordsearch_file($file_search='',$parent_id='',$repertoire_key='',$folder_search=''){

$file_search = str_replace("'",'',trim($file_search));//$searchon;

        
 if($parent_id==''){
    if($this->session->userdata('search_music_for_sale')==1){
       $parent_id_array=array(1,132,1321,13763,12619,12522);
    }else{
        $parent_id_array=array(1,132,1321,12619,12522);
    }
//$parent_id_array=array();
 }else{
$parent_id_array=array();
//$parent_id_array[]=$parent_id;
 }   
  print_r($parent_id_array);die;
 if($folder_search=='' && $this->session->userdata('search_music_for_sale')!=1){
   unset($parent_id_array); 
 } 
 //print_r($file_search);//die; 
 $file_search_new=trim($file_search);  
        //$file_search_1 = str_replace('%20',' ',trim($repertoire_key));//$searchon;
       // $str_replace = str_replace(' ','-',trim($searchon));
        //$keyword_file = str_replace(' ',' % ',trim($file_search));//$searchon;
        $file_search = trim($file_search_new);
        $str_replace_file = str_replace(' ','-',trim($file_search_new));
        $keyword_array = explode(' ',trim($file_search));//$searchon;
       // $keyword_array_1 = explode(' ',trim($file_search_1));//$searchon;
       // $keyword_array_2 = array_unique(array_merge($keyword_array,$keyword_array_1));


$sql_string='';
//print_r($keyword_array_2);die;
// if($repertoire_key!=''){
//  $i=0;   
// foreach ($keyword_array_2 as $key => $value) {
//     if(strlen($value)>3){
//     if($i>0){
//      $sql_string.=" OR ";
//     }
//     $sql_string.="(CM.image LIKE '%".$value."%' or CM.image LIKE '%".$str_replace_file."%')";
//     //$sql_string.="(C.name LIKE '%".trim($file_search)."%')";
//     $i++;
//    }
// }
//   }else{  
    // $sql_string.="((C.name LIKE '%".trim($file_search)."%' or C.name LIKE '%".trim($str_replace_file)."%' or C.keyword LIKE '%".trim($file_search)."%' or C.keyword LIKE '%".trim($str_replace_file)."%' or C.custom_text LIKE '%".trim($file_search)."%' or C.custom_text LIKE '%".trim($str_replace_file)."%')  or (CM.image LIKE '%".trim($file_search)."%' or CM.image LIKE '%".trim($str_replace_file)."%' or CM.keyword_text LIKE '%".trim($file_search)."%' or CM.keyword_text LIKE '%".trim($str_replace_file)."%' or CM.custom_text LIKE '%".trim($file_search)."%' or CM.custom_text LIKE '%".trim($str_replace_file)."%'))";
        $this->db->select('C.id, C.name,C.rename_folder, C.custom_text, C.keyword, C.parent_id, C.status,C.delete_status');
$file_ext_array=array('pdf','txt','doc','mp3','mp4');
   $file_ext = pathinfo($file_search, PATHINFO_EXTENSION);
if(in_array($file_ext, $file_ext_array)){
             $this->db->join('category_image CM', 'CM.cat_id = C.id');
    $sql_string.="((C.name LIKE '%".$file_search."%' or C.name LIKE '%".$str_replace_file."%') OR (C.keyword LIKE '%".$file_search."%' or C.keyword LIKE '%".$str_replace_file."%') OR (C.custom_text LIKE '%".$file_search."%' or C.custom_text LIKE '%".$str_replace_file."%')or(CM.image LIKE '%".trim($file_search)."%' or CM.image LIKE '%".trim($str_replace_file)."%'))";

}else{
             //$this->db->join('category_image CM', 'CM.cat_id = C.id');
    $sql_string.="((C.name LIKE '%".$file_search."%' or C.name LIKE '%".$str_replace_file."%') OR (C.keyword LIKE '%".$file_search."%' or C.keyword LIKE '%".$str_replace_file."%') OR (C.custom_text LIKE '%".$file_search."%' or C.custom_text LIKE '%".$str_replace_file."%'))";
}

    //$sql_string.="((C.name LIKE '%".trim($file_search)."%' or C.name LIKE '%".trim($str_replace_file)."%')or(CM.image LIKE '%".trim($file_search)."%' or CM.image LIKE '%".trim($str_replace_file)."%'))";



//}


            $this->db->from('categories C');
            if(count($parent_id_array)>0){
            $this->db->where_in("C.parent_id",$parent_id_array);// search from public libraray
            }
        $this->db->where("C.delete_status",0);// search from public libraray
       // $this->db->where("C.public_personal",0);// search from public libraray

        $this->db->where('('.$sql_string.')');
        //$this->db->where('('.$sql_string.')');






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
            $this->db->where('parent_id', $parent_id);
            $this->db->order_by('name','asc');
            $this->db->group_by('id');
            $arr_data = $this->db->get()->result();
            
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        
    }
   public function getDirNamesById($id) {
            while($id!=0)
            {
            $select_field = array('id', 'name','parent_id', 'status');
            $this->db->select($select_field);
            $this->db->from('categories');
            $this->db->where('id', $id);
            $arr_data = $this->db->get()->row_object();
            $directory[] = $arr_data->name;
            $id= $arr_data->parent_id;
            }
            $dir_path_arr = array_reverse($directory);
            $add_dir_path[] = implode("/",$dir_path_arr);
            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        
    }
   public function getDirNamesById_keywordsearch($id,$control_id) {
            while($id>$control_id)
            {
            $this->db->select('*');
            $this->db->from('categories');
            $this->db->where('id', $id);
           // $this->db->where('delete_status', 0);
            //if($this->session->userdata('search_music_for_sale')!=1){
            $this->db->where('public_personal', 0);
            //}
            $arr_data = $this->db->get()->row_object();
            // echo $this->db->last_query();
            // echo "<br/>";
            $directory[] = $arr_data->id;
            $id= $arr_data->parent_id;
            $main_root_id= $arr_data->id;
            }
            $dir_path_arr = array_reverse($directory);
            $add_dir_path = $dir_path_arr;//implode("/",$dir_path_arr);
           
            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        
    }
   public function getDirNamesById_all_parent_folders($id,$control_id) {
            while($id>$control_id)
            {
            $this->db->select('*');
            $this->db->from('categories');
            $this->db->where('id', $id);
            $this->db->where('delete_status', 0);
            $this->db->where('public_personal', 0);
            $arr_data = $this->db->get()->row_object();
            $directory[] = $arr_data->parent_id;
            $id= $arr_data->parent_id;
            $main_root_id= $arr_data->id;
            }
            $dir_path_arr = array_reverse($directory);
            $add_dir_path = $dir_path_arr;//implode("/",$dir_path_arr);
            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        
    }
    public function check_bookmarked($file_id,$user_id){
        $parent_id=2;
  $this->db->select('*');
            $this->db->from('personal_library_file');
        $this->db->where("file_id",$file_id);
        $this->db->where("user_id",$user_id);// search from public libraray
        $this->db->where("cat_id",2);// search from public libraray
        $parent = $this->db->get();
        return $parent->result();
    }

  public function getImagesById($id, $ajax_search_file='') {
 $loop=0;   


 if($this->session->userdata('ajax_search_file_folder_string_matched')>0){
 // echo "kkkkk";
       $show_all = 1;//$this->Comp_model->getImagesById($parent_id_tree);
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
        $count_folder=$this->db->where("(C.name LIKE '%".$ajax_search_file."%' or C.name LIKE '%".$str_replace_file."%') OR (C.keyword LIKE '%".$ajax_search_file."%' or C.keyword LIKE '%".$str_replace_file."%')");
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
        $this->db->where("(CM.image LIKE '%".$ajax_search_file."%' or CM.image LIKE '%".$str_replace_file."%') OR (CM.keyword_text LIKE '%".$ajax_search_file."%' or CM.keyword_text LIKE '%".$str_replace_file."%')");
        $this->db->group_by("CM.id");// search from public libraray
                $arr_data = $this->db->get()->result_object();

                if((count($arr_data)==0 && $loop==0) || $show_all==1){
                    //echo "ssss";
                $this->db->select("*");
                    $this->db->from('category_image');
                        $this->db->where('cat_id', $id);
                        $this->db->where("delete_status",0);// search from public libraray
                      $this->db->group_by("id");// search from public libraray
                        $arr_data_1 = $this->db->get()->result_object();
             return $arr_data_1;
                }else{
             return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
                }
}else{
//echo "hello";
    $this->db->select("*");
                    $this->db->from('category_image');
                        $this->db->where('cat_id', $id);
                        $this->db->where("delete_status",0);// search from public libraray
                      $this->db->group_by("id");// search from public libraray
                        $arr_data_1 = $this->db->get()->result_object();
                if($loop==0 || $show_all==1){
             return $arr_data_1;
                 }else{
             return $arr_data_1='';//*********************Root parent Folders******************
                 }
}

   /*if($ajax_search_file==''){
            $this->db->select("*");
            $this->db->from('category_image');
                $this->db->where('cat_id', $id);
                $arr_data = $this->db->get()->result_object();
               // echo $this->db->last_query();die;
             return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        }else{
  $str_replace_file = str_replace(' ','-',trim($ajax_search_file));
            $this->db->select("CM.*");

$this->db->join('category_image CM', 'CM.cat_id = C.id','left');
           $this->db->from('categories C');
           if($id>0){
            $this->db->where_in('C.id', $id);//WHERE author IN ('Bob', 'Geoff')
            }
           if($ajax_search_file!=''){
        $this->db->where("(CM.image LIKE '%".$ajax_search_file."%' or CM.image LIKE '%".$str_replace_file."%') OR (CM.keyword_text LIKE '%".$ajax_search_file."%' or CM.keyword_text LIKE '%".$str_replace_file."%')");
            }
        $this->db->where("C.delete_status",0);// search from public libraray
        $this->db->where("C.public_personal",0);// search from public libraray
        $this->db->where("CM.delete_status",0);// search from public libraray
         $query = $this->db->get();
        $arrTreeById = array();
        $arrTree = $query->result();

        return $arrTree;  
        } */    
        
    }
     public function getImagesById_share($id, $permission) {

    
            $this->db->select("C.*");
        $this->db->join('personal_library_file P', 'P.file_id = C.id','left');
            $this->db->from('category_image C');

         $this->db->where('C.cat_id', $id);
       if($permission[0]=='personal' && $permission[2]!=''){
        $this->db->where('P.delete_status', 0);
        $this->db->where('P.user_id', $permission[2]);
        }elseif($permission[0]=='temporary' && $permission[2]!=''){
        $this->db->where('P.temp_status', 0);
        $this->db->where('P.user_id', $permission[2]);
        }else{
         $this->db->where('C.delete_status', 0);////Public share and delete by admin
        }

                $arr_data = $this->db->get()->result_object();   
            //echo $this->db->last_query();die;
            return $arr_data;
        
    }


    
}





?>