<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_dbbackup_model extends CI_Model
{
    private $countries = 'countries';
	private $dbbackup = 'dbbackup';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get All
     * @return all Country
     * @since 0.1
     * @author DHS
     */
    public function getAllCountry()
    {
        try {
            $select_field = array('id', 'name','path', 'status', 'created_on', 'updated_on');
            $this->db->select($select_field);
            $this->db->order_by("id", "DESC");
            $this->db->from($this->dbbackup);
            $arr_data = $this->db->get()->result_object();
            //echo get_query(); die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * add
     * @return Add Country
     * @since 0.1
     * @author DHS
     */
    public function storeDatabase($array,$path)
    {
        try {
			//dd($array);
			$array['path']=$path;
			//dd($array);
			//die;
            $this->db->insert($this->dbbackup, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * get  id
     * @return  Country @id
     * @since 0.1
     * @author DHS
     */
    public function getCountryById($id)
    {
        try {
            $select_field = array('id', 'name', 'status', 'created_on', 'updated_on');
            $this->db->select($select_field);
            $this->db->from($this->countries);
            $this->db->where('id', $id);
            $arr_data = $this->db->get()->row_array();
            // echo get_query(); die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }

    }

    /**
     * get Country
     * @return update data
     * @since 0.1
     * @author DHS
     */
    public function updateCountry($array)
    {
        try {
            $this->db->where("id", $array['id']);
            unset($array['id']);
            return $this->db->update($this->countries, $array);
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
    public function changeStatus($id, $status)
    {
        try {
            $data = [];
            $this->db->set('status', "'$status'", false);
            $this->db->where('id', $id);
            $arr_update = $this->db->update($this->countries, $data);
            //echo $this->db->last_query();die;
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
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
    public function deleteRecord($id)
    {
        try {
			//echo "$id";
			//die;
            return $this->db->delete($this->dbbackup, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


}

?>
