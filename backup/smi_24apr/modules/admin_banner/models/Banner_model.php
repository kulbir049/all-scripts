<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner_model extends CI_Model
{
    private $banners = 'banner';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * getall Banner
     * @return all Banner
     * @since 0.1
     * @author DHS
     */
    public function getAllBanner() {
        $this->db->order_by('position_index', 'ASC');
		//$this->db->where('b_type', "2");
        $query = $this->db->get('banner');
        return $query->result_array();
    }
    public function getlastBanner_position() {
        $this->db->order_by('position_index', 'desc');
        $this->db->limit(1);
        //$this->db->where('b_type', "2");
        $query = $this->db->get('banner');
        return $query->result_array();
    }
    public function getAllBanner_by_position($number) {
        $this->db->where('position_index', $number);
        //$this->db->where('b_type', "2");
        $query = $this->db->get('banner');
        return $query->result_array();
    }
    /**
     * storeBanner
     * @return add
     * @since 0.1
     * @author DHS
     */
    public function storeBanner($array) {
        //dd($array); die;
        try {
            $this->db->insert($this->banners, $array);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


    /**
     * get Banner id
     * @return id
     * @since 0.1
     * @author DHS
     */
    public function getBannerById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('banner');
        return $query->row_array();
    }

    /**
     * get Update Banner
     * @return update data
     * @since 0.1
     * @author DHS
     */
    public function updateBanner($array) {
        try {
            $this->db->where("id", $array['id']);
            unset($array['id']);
            unset($array['old_image']);
            return $this->db->update($this->banners, $array);
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
            $arr_update = $this->db->update($this->banners, $data);
            //echo $this->db->last_query();die;
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function update_deleteRecord($id) {
        try {
            $data = [];
            $this->db->set('delete_status', 2);
            $this->db->set('status', 0);
            $this->db->where('id', $id);
            $arr_update = $this->db->update($this->banners);
            //echo $this->db->last_query();die;
            return (isset($arr_update) && !empty($arr_update) ? $arr_update : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    public function update_music_library($id) {
        try {
            $data = [];
            $this->db->set('folder_user_id', 0);
            $this->db->where('id', $id);
            $arr_update = $this->db->update('categories');
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
    public function deleteRecord($id) {

        try {
            return $this->db->delete($this->banners, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


}

?>
