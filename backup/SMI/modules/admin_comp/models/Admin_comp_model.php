<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_comp_model extends CI_Model {

    private $categories = 'categories';
	private $category_detail = 'category_detail';
    private $category_image = 'category_image';
    private $personal_library = 'personal_library';

    public function __construct() {
        parent::__construct();
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
    
    /**
     * getRecordById
     * @return boolean
     * @since 0.1
     * @author DHS
     */
    public function getRecordById($id) {
        try {


            $select_field = array('id', 'name', 'custom_text', 'parent_id', 'icon', 'short_order', 'priority', 'status');
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
    public function getDirNamesById($id) {
        try {
			while($id!=0)
			{
            $select_field = array('id', 'name','parent_id', 'status');
            $this->db->select($select_field);
            $this->db->from($this->categories);
            $this->db->where('id', $id);
            $arr_data = $this->db->get()->row_object();
			$directory[] = $arr_data->name;
			$id= $arr_data->parent_id;
			}
			$dir_path_arr = array_reverse($directory);
			$add_dir_path = implode("/",$dir_path_arr);
            return (isset($add_dir_path) && !empty($add_dir_path) ? $add_dir_path : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


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
    function getRevArrayCatbyId($id = false,$parent_id =false) {
        try {
            $where = [];
            if (isset($parent_id) && !empty($parent_id)) {
				if(isset($id) && !empty($id))
				{
				$where = array('id' => $id, 'status' => '1');
                $this->db->select("id, name, parent_id, short_order, status");
				$this->db->from($this->categories);
				$this->db->where($where);
				$arr_data_p = $this->db->get()->row_object();
				$cat_arr[] = $arr_data_p->name;
				}
				$where = [];
                $where = array('id' => $parent_id, 'status' => '1');
                $this->db->select("id, name, parent_id, short_order, status");
				$this->db->from($this->categories);
				$this->db->where($where);
				$arr_data = $this->db->get()->row_object();
				$cat_arr[] = $arr_data->name;
					if($arr_data->parent_id !=0)
					{
					$where = [];
					$where = array('id' => $arr_data->parent_id, 'status' => '1');
					$this->db->select("id, name, parent_id, short_order, status");
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
						$this->db->select("id, name, parent_id, short_order, status");
						$this->db->from($this->categories);
						$this->db->where($where);
						$arr_data = $this->db->get()->row_object();
						$cat_arr[] = $arr_data->name;
						//start third level//
						if($arr_data->parent_id !=0)
						{
						$where = [];
						$where = array('id' => $arr_data->parent_id, 'status' => '1');
						$this->db->select("id, name, parent_id, short_order, status");
						$this->db->from($this->categories);
						$this->db->where($where);
						$arr_data = $this->db->get()->row_object();
						$cat_arr[] = $arr_data->name;
							//start fourth level//
							if($arr_data->parent_id !=0)
							{
							$where = [];
							$where = array('id' => $arr_data->parent_id, 'status' => '1');
							$this->db->select("id, name, parent_id, short_order, status");
							$this->db->from($this->categories);
							$this->db->where($where);
							$arr_data = $this->db->get()->row_object();
							$cat_arr[] = $arr_data->name;
								//start fifth level//
								if($arr_data->parent_id !=0)
								{
								$where = [];
								$where = array('id' => $arr_data->parent_id, 'status' => '1');
								$this->db->select("id, name, parent_id, short_order, status");
								$this->db->from($this->categories);
								$this->db->where($where);
								$arr_data = $this->db->get()->row_object();
								$cat_arr[] = $arr_data->name;
									//start sixth level//
									if($arr_data->parent_id !=0)
									{
									$where = [];
									$where = array('id' => $arr_data->parent_id, 'status' => '1');
									$this->db->select("id, name, parent_id, short_order, status");
									$this->db->from($this->categories);
									$this->db->where($where);
									$arr_data = $this->db->get()->row_object();
									$cat_arr[] = $arr_data->name;
										//start seventh level//
										if($arr_data->parent_id !=0)
										{
										$where = [];
										$where = array('id' => $arr_data->parent_id, 'status' => '1');
										$this->db->select("id, name, parent_id, short_order, status");
										$this->db->from($this->categories);
										$this->db->where($where);
										$arr_data = $this->db->get()->row_object();
										$cat_arr[] = $arr_data->name;
											//start eighthLevel level//
											if($arr_data->parent_id !=0)
											{
											$where = [];
											$where = array('id' => $arr_data->parent_id, 'status' => '1');
											$this->db->select("id, name, parent_id, short_order, status");
											$this->db->from($this->categories);
											$this->db->where($where);
											$arr_data = $this->db->get()->row_object();
											$cat_arr[] = $arr_data->name;
												//start ninthLevel level//
												if($arr_data->parent_id !=0)
												{
												$where = [];
												$where = array('id' => $arr_data->parent_id, 'status' => '1');
												$this->db->select("id, name, parent_id, short_order, status");
												$this->db->from($this->categories);
												$this->db->where($where);
												$arr_data = $this->db->get()->row_object();
												$cat_arr[] = $arr_data->name;
													//start tenthLevel level//
													if($arr_data->parent_id !=0)
													{
													$where = [];
													$where = array('id' => $arr_data->parent_id, 'status' => '1');
													$this->db->select("id, name, parent_id, short_order, status");
													$this->db->from($this->categories);
													$this->db->where($where);
													$arr_data = $this->db->get()->row_object();
													$cat_arr[] = $arr_data->name;
														//start eleventhLevel level//
														if($arr_data->parent_id !=0)
														{
														$where = [];
														$where = array('id' => $arr_data->parent_id, 'status' => '1');
														$this->db->select("id, name, parent_id, short_order, status");
														$this->db->from($this->categories);
														$this->db->where($where);
														$arr_data = $this->db->get()->row_object();
														$cat_arr[] = $arr_data->name;
															//start twelfthlevel level//
															if($arr_data->parent_id !=0)
															{
															$where = [];
															$where = array('id' => $arr_data->parent_id, 'status' => '1');
															$this->db->select("id, name, parent_id, short_order, status");
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
            $select_field = array('id', 'cat_id', 'image', 'status');
            
            $this->db->from($this->category_image);
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
    public function get_categories($data_id)
    {
        $alp = $data_id;
        $this->db->select('id, name, custom_text, parent_id, status');
        $this->db->from('categories');
        $this->db->where('parent_id', 1);
        $this->db->or_where('parent_id', 132);
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


}

?>
