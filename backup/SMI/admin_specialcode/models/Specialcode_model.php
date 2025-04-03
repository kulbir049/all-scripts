<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class specialcode_model extends CI_Model {
    private $admin_specialcode = 'admin_specialcode';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * getall specialcode
     * @return all specialcode
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function getAllspecialcode() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('admin_specialcode');
        return $query->result_array();
    }
    /**
     * add
     * @return Add specialcode
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function storespecialcode($array) {
        //dd($array); die;
        try {
            $this->db->insert($this->admin_specialcode, $array);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


    /**
     * get specialcode id
     * @return  specialcode @id
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function getspecialcodeById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('admin_specialcode');
        return $query->row_array();
    }

    /**
     * get Update specialcode
     * @return update data
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function updatespecialcode($array) {
        try {
            $this->db->where("id", $array['id']);
            unset($array['id']);
            unset($array['old_image']);
            unset($array['old_banner']);
            return $this->db->update($this->admin_specialcode, $array);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * changeStatus
     * @return change status active or inactive
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function changeStatus($id, $status) {
        try {
            $data = [];
            $this->db->set('status', "'$status'", false);
            $this->db->where('id', $id);
            $arr_update = $this->db->update($this->admin_specialcode, $data);
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
     * @author Devendra Tiwari
     */
    public function deleteRecord($id) {

        try {
            return $this->db->delete($this->admin_specialcode, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

}
?>
