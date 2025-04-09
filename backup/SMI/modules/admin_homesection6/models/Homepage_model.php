<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Homepage_model extends CI_Model
{
    private $home_setting = 'home_setting';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get All
     * @return all homepage
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function getAllHomePage()
    {
        try {
            //$select_field = array('id','pkg_type_id', 'name', 'description', 'price', 'status', 'created_on', 'updated_on', 'created_by', 'updated_by');
            $this->db->select('*');
            $this->db->order_by("id", "DESC");
            $this->db->where("type", "Section6");
            $this->db->from($this->home_setting);
            $arr_data = $this->db->get()->result_object();
            //echo get_query(); die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * add
     * @return Add HomePage
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function storeHomePage($array)
    {
        try {
            $this->db->insert($this->home_setting, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * get  id
     * @return  Home Page @id
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function getHomePageById($id)
    {
        try {

            $this->db->select('*');
            $this->db->from($this->home_setting);
            $this->db->where('id', $id);
            $arr_data = $this->db->get()->row_array();
            // echo get_query(); die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }

    }

    /**
     *
     * @return update data
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function updateHomePage($array)
    {
        try {
            $this->db->where("id", $array['id']);
            unset($array['id']);
            unset($array['old_image']);
            unset($array['old_pdf']);
            unset($array['old_image1']);
            unset($array['old_pdf1']);
            unset($array['old_image2']);
            unset($array['old_pdf2']);
            unset($array['old_invest']);
            return $this->db->update($this->home_setting, $array);
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
    public function changeStatus($id, $status)
    {
        try {
            $data = [];
            $this->db->set('status', "'$status'", false);
            $this->db->where('id', $id);
            $arr_update = $this->db->update($this->home_setting, $data);
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
    public function deleteRecord($id)
    {
        try {
            return $this->db->delete($this->home_setting, array('id' => $id));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

}

?>
