<?php error_reporting(0); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dbbackup extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Admin_dbbackup_model','admin_dashboard/Homeview'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('form', 'url'));
        isAdminProtected();
    }

    public function index()
    {
		//echo "jit";die;
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Database', '/admin/database');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['country'] = $this->Admin_dbbackup_model->getAllCountry();
        $data['title'] = 'Database backup';
		$data['all_data']=$this->Homeview->getAllBenefit();
		$data['all_data_member']=$this->Homeview->getAllMemberships();
        _adminLayout('countrys', $data);

    }


    /**
     * add
     * @return Add Country
     * @since 0.1
     * @author DHS
     */
    public function add()
    {
        try {
			
            $data['title'] = 'Add Database';
            $data['action'] = 'add';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Database', '/admin/dbbackup');
            $this->breadcrumbs->push('Add', '/admin/dbbackup/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_country')) {
                    $post = $this->input->post();
					//dd($post);
					//die;
                    unset($post['submits']);
                    unset($post['id']);
                    //$in_id = $this->Admin_dbbackup_model->storeDatabase($post);
					if(isset($post))
					{
						//$this->Admin_dbbackup_model->createDatabaseBackup($post);
						//echo "jitendra";
						//die;
						//
						$this->load->dbutil();
						

						$prefs = array(     
							'format'      => 'zip',             
							'filename'    => "$post[name]"
							);

						
						$backup =& $this->dbutil->backup($prefs); 

						$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
						//$path = FCPATH . "assets/uploads/database-backup/" . $db_name;
						$save = FCPATH . "assets/uploads/database-backup/" . "$post[name]/". $db_name;
						$save_go = base_url() . "assets/uploads/database-backup/" . "$post[name]/". $db_name;
						$dir = FCPATH . "assets/uploads/database-backup/" . "$post[name]/";
						generateDir($dir);
						
						$this->load->helper('file');
						write_file($save, $backup); 
						$this->Admin_dbbackup_model->storeDatabase($post,$save_go);
						//die;

						$this->load->helper('download');
						force_download($db_name, $backup);
						
					}
					
                    $this->session->set_flashdata('flash_msg_type', 'success');
                    $this->session->set_flashdata('flash_msg_text', 'Country added successfully!!');
                    redirect(site_url('admin/country'));
                    _adminLayout('add-country', $data);
                } else {
                    _adminLayout('add-country', $data);
                }
            } else {
                _adminLayout('add-country', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * Edit
     * @return Edit Country
     * @since 0.1
     * @author DHS
     */
    public function edit($id = false)
    {
        try {

            $id = base64_decode($id);
            $data['title'] = 'Edit Country';
            $data['action'] = 'edit';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Country', '/admin/country');
            $this->breadcrumbs->push('Edit', '/admin/country/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();

            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_country')) {

                    $post = $this->input->post();
                    unset($post['submits']);
                    if ($this->Admin_dbbackup_model->updateCountry($post)) {
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Country updated successfully!!');
                        redirect(site_url('admin/country'));

                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('add-country', $data);
                    }
                } else {

                    $data['obj_data'] = (object)$this->Admin_dbbackup_model->getCountryById($id);
                    _adminLayout('add-country', $data);
                }
            } else {
                $data['obj_data'] = (object)$this->Admin_dbbackup_model->getCountryById($id);
                //dd($data); die;
                _adminLayout('add-country', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * Delete
     * @return Delete Record
     * @since 0.1
     * @author DHS
     */
    public function deleteRecord()
    {
		
        $id = $this->input->post('id');
		
		
		//echo "$id";
		//die;
        if (isset($id) && !empty($id)) {
            echo $this->Admin_dbbackup_model->deleteRecord($id);
        }
    }

    /**
     * change
     * @return change Status
     * @since 0.1
     * @author DHS
     */
    public function changeStatus()
    {
        $id = $this->input->post('id');
        $sts = $this->input->post('sts');
        echo $this->Admin_dbbackup_model->changeStatus($id, $sts);
    }


}


