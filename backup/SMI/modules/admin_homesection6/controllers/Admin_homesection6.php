<?php defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting('0');
class Admin_homesection6 extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Homepage_model','admin_dashboard/Homeview'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('form', 'url'));
        isAdminProtected();
    }

    public function index()
    {

        $data['title'] = 'Manage Home';
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('General Copyright Guidelines', '/admin/homesection6');
        $data['breadcrumb'] = $this->breadcrumbs->show();
        $data['home_list'] = $this->Homepage_model->getAllHomePage();
        _adminLayout('home-page', $data);
    }

    /**
     * add
     * @return Add Home Page
     * @since 0.1
     * @author DHS
     */
    public function add()
    {

        try {

            $data['title'] = 'Manage Home';
            $data['action'] = 'add';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Home Page', '/admin/homesection6');
            $this->breadcrumbs->push('Add', '/admin/homesection6/add');
            $data['breadcrumb'] = $this->breadcrumbs->show();
            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_home6')) {
                    $post = $this->input->post();
                    unset($post['submits']);
                    unset($post['id']);
                    unset($post['old_image']);
                    $files = $_FILES;
                   // dd($files); die;
                    /////////Generate directory if not exist
                    $dir = FCPATH . 'assets/uploads/home_image';
                    generateDir($dir);
                    $img_data = UploadImage($files, './assets/uploads/home_image', 'image', null);
                    $post['image'] = $img_data['file_name'];
                    $this->Homepage_model->storeHomePage($post);
                    $this->session->set_flashdata('flash_msg_type', 'success');
                    $this->session->set_flashdata('flash_msg_text', 'HomePage added successfully!!');

                    redirect(site_url('admin/homesection6'));
                    _adminLayout('add-home', $data);
                } else {
                    _adminLayout('add-home', $data);
                }
            } else {
                _adminLayout('add-home', $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * Edit
     * @return Edit homepage
     * @since 0.1
     * @author DHS
     */
    public function edit($id = false)
    {

        try {

            $id = base64_decode($id);
            $data['title'] = 'Manage Home';
            $data['action'] = 'edit';
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            //$this->breadcrumbs->push('Homepage', '/admin/homesection6');
            $this->breadcrumbs->push('Edit', '/admin/homesection6/edit');
            $data['breadcrumb'] = $this->breadcrumbs->show();
			$data['all_data']=$this->Homeview->getAllBenefit();
			$data['all_data_member']=$this->Homeview->getAllMemberships();
            //echo "shdshdshdhs"; die;
            if (isPostBack()) {
                if ($this->form_validation->run($this, 'admin_home6')) {
                    $post = $this->input->post();
                    //dd($post); die;

                    unset($post['submits']);
                    $files = $_FILES;
                    $dir = FCPATH . 'assets/uploads/home_image';
                    generateDir($dir);
                    ////////////////Image unlink from server//////////////
                    if (!empty($_FILES['image']['name'])) {
                        $path = FCPATH . 'assets/uploads/home_image/' . $post['old_image'];
                        if (!empty($post['old_image'])) {
                            if (file_exists($path)) {
                                unlink($path);
                            }
                        }
                        $img_data = UploadImage($files, './assets/uploads/home_image', 'image', null);
                        if ($img_data) {
                            $post['image'] = $img_data['file_name'];
                            unset($post['old_image']);
                        }
                    }

                    if ($this->Homepage_model->updateHomePage($post)) {
                        $this->session->set_flashdata('flash_msg_type', 'success');
                        $this->session->set_flashdata('flash_msg_text', 'Homepage updated successfully!!');
                        redirect(site_url('admin/homesection6/edit/'.base64_encode($post['id'])));
                       // redirect(site_url('admin/homesection6'));

                    } else {
                        $this->session->set_flashdata('flash_msg_type', 'error');
                        $this->session->set_flashdata('flash_msg_text', 'Some problem occurred, please try again!!');
                        _adminLayout('add-home', $data);
                    }
                } else {
                    $data['obj_data'] = (object)$this->Homepage_model->getHomePageById($id);
                    _adminLayout('add-home', $data);
                }
            } else {
                $data['obj_data'] = (object)$this->Homepage_model->getHomePageById($id);
                //dd($data); die;
                _adminLayout('add-home', $data);
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
        if (isset($id) && !empty($id)) {
            echo $this->Homepage_model->deleteRecord($id);
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
        echo $this->Homepage_model->changeStatus($id, $sts);
    }

}


