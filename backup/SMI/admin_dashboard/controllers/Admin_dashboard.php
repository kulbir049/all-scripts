<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting('1');
class Admin_dashboard extends MY_Controller {
    public function __construct() {
        parent::__construct();
        //$this->load->model('Homeview');
        $this->load->model(array('Homeview','Homeview2','admin_user/Usermodal'));
        //$this->load->helper(array('admin_helper'));
        isAdminProtected();
    }
    public function index() {
        $this->load->view('index');
    }
    public function dashboard()
	{



        $data['limit_days']=ACCOUNT_EXPIRE_DAYS;
       $since_date=date('Y-m-d',strtotime("-".$data['limit_days']." days"));
        $data['user_list']=$this->Usermodal->get_unlogin_account($since_date);
        $data['limit_days']=2*ACCOUNT_EXPIRE_DAYS;
       $since_date=date('Y-m-d',strtotime("-".$data['limit_days']." days"));
        $data['user2_list']=$this->Usermodal->get_unlogin_account_expired($since_date);
//echo $this->db->last_query(); die;

        $data['user'] = $this->Homeview->get_total_user_count();
        $data['user_applied_coupon'] = $this->Homeview->get_total_user_count_apply_coupon();
		$data['all_data']=$this->Homeview->getAllBenefit();
		$data['all_data_member']=$this->Homeview->getAllMemberships();
       // $data['supplier'] = $this->Homeview->get_total_supplier_count();
       // $data['total_order'] = $this->Homeview->getTotalOrderCount();
         $data['paid'] = $this->Homeview->paid_members();
         $data['total'] = $this->Homeview->total_members();
         $data['total_mem'] = $this->Homeview->total_members_mebership();
        $data['total_files'] = $this->Homeview->total_members_file();
        $data['total_folder'] = $this->Homeview->total_number_folder();

        $data['current_month'] = get_sum_amount($this->Homeview->current_month_record());
     //   echo '<pre>',print_r($data['current_month']),'</pre>'; die;
        $data['last_year'] = get_sum_amount($this->Homeview->last_year_record());
        $data['last_year_mem'] = get_sum_amount($this->Homeview->last_year_record_membership());
        $data['previous_last_year'] = get_sum_amount($this->Homeview->last_year_record_membership('previous'));
     // dd($data['last_year']);
        $data['this_year_data'] = get_sum_amount($this->Homeview->this_year_record());
        $data['this_year_data_mem'] = get_sum_amount($this->Homeview->this_year_record_membrship());
        $data['this_year_sales'] = $this->Homeview->this_year_sales();


        $year = date('Y');
        $last_year = $year -1;

        $data['this_year_jan'] = get_sum_amount($this->Homeview->get_year_QUARTER($year,1));
        $data['this_year_april'] = get_sum_amount($this->Homeview->get_year_QUARTER($year,2));
        //$data['this_year_july'] = $this->Homeview->this_year_jan_to_march();
        $data['this_year_july'] = get_sum_amount($this->Homeview->get_year_QUARTER($year,3));
        $data['this_year_oct'] = get_sum_amount($this->Homeview->get_year_QUARTER($year,4));
//print_r($data['this_year_july']);
        $data['last_year_jan'] = get_sum_amount($this->Homeview->get_last_year_QUARTER($last_year,1));
        $data['last_year_april'] = get_sum_amount($this->Homeview->get_last_year_QUARTER($last_year,2));
        $data['last_year_july'] = get_sum_amount($this->Homeview->get_last_year_QUARTER($last_year,3));
        $data['last_year_oct'] = get_sum_amount($this->Homeview->get_last_year_QUARTER($last_year,4));

        // dd($data['last_year_jan']);
        // dd($data['last_year_april']);
        // dd($data['last_year_july']);
        // dd($data['last_year_oct']);
        // die;

        $data['paid_member'] = $this->Homeview->getTotalPaidMemberCount();
        $data['total_member'] = $this->Homeview->getTotalMemberCount();
        $data['title'] = 'Sheet Music International';
     //   dd($data); die();
        $data['new_dahsboard']['current_p']=$this->Homeview->get_month_userRecord();
        $data['new_dahsboard']['jan_p']=$this->Homeview->get_year_month_record($year,1);
        $data['new_dahsboard']['feb_p']=$this->Homeview->get_year_month_record($year,2);
        $data['new_dahsboard']['mar_p']=$this->Homeview->get_year_month_record($year,3);
        $data['new_dahsboard']['apr_p']=$this->Homeview->get_year_month_record($year,4);
        $data['new_dahsboard']['may_p']=$this->Homeview->get_year_month_record($year,5);
        $data['new_dahsboard']['jun_p']=$this->Homeview->get_year_month_record($year,6);
        $data['new_dahsboard']['jul_p']=$this->Homeview->get_year_month_record($year,7);
        $data['new_dahsboard']['aug_p']=$this->Homeview->get_year_month_record($year,8);
        $data['new_dahsboard']['sep_p']=$this->Homeview->get_year_month_record($year,9);
        $data['new_dahsboard']['oct_p']=$this->Homeview->get_year_month_record($year,10);
        $data['new_dahsboard']['nov_p']=$this->Homeview->get_year_month_record($year,11);
        $data['new_dahsboard']['dec_p']=$this->Homeview->get_year_month_record($year,12);

//dd($data['new_dahsboard']['may_p']);die;

        $data['new_dahsboard']['current']=$this->Homeview->get_month_record();
        $data['new_dahsboard']['jan']=$this->Homeview->get_year_month_record($last_year,1);
        $data['new_dahsboard']['feb']=$this->Homeview->get_year_month_record($last_year,2);
        $data['new_dahsboard']['mar']=$this->Homeview->get_year_month_record($last_year,3);
        $data['new_dahsboard']['apr']=$this->Homeview->get_year_month_record($last_year,4);
        $data['new_dahsboard']['may']=$this->Homeview->get_year_month_record($last_year,5);
        $data['new_dahsboard']['jun']=$this->Homeview->get_year_month_record($last_year,6);
        $data['new_dahsboard']['jul']=$this->Homeview->get_year_month_record($last_year,7);
        $data['new_dahsboard']['aug']=$this->Homeview->get_year_month_record($last_year,8);
        $data['new_dahsboard']['sep']=$this->Homeview->get_year_month_record($last_year,9);
        $data['new_dahsboard']['oct']=$this->Homeview->get_year_month_record($last_year,10);
        $data['new_dahsboard']['nov']=$this->Homeview->get_year_month_record($last_year,11);
        $data['new_dahsboard']['dec']=$this->Homeview->get_year_month_record($last_year,12);



        $data['new_dahsboard']['year_to_date']=$this->Homeview->year_finanace_C4(2);
        $data['new_dahsboard']['year_last']=$this->Homeview->year_finanace_C4(1);
        $data['new_dahsboard']['year_before']=$this->Homeview->year_finanace_C4(0);
        $data['new_dahsboard']['year_previous2']=$this->Homeview->year_finanace_C4(-1);
        $data['new_dahsboard']['year_previous3']=$this->Homeview->year_finanace_C4(-2);
//**********************Monthly report **************************************************//
        $data['totalm'] = $this->Homeview2->total_members();

        $data['last_yearm'] = get_sum_amount($this->Homeview2->last_year_record());
        $data['previous_last_yearm'] = get_sum_amount($this->Homeview2->last_year_record('previous'));
        // dd($data['last_year']);
        $data['this_year_datam'] = get_sum_amount($this->Homeview2->this_year_record());


        $data['new_dahsboardm']['current_p']=$this->Homeview2->get_month_userRecord();
        $data['new_dahsboardm']['jan_c_year']=$this->Homeview2->get_year_month_record($year,1);
        $data['new_dahsboardm']['feb_c_year']=$this->Homeview2->get_year_month_record($year,2);
        $data['new_dahsboardm']['mar_c_year']=$this->Homeview2->get_year_month_record($year,3);
        $data['new_dahsboardm']['apr_c_year']=$this->Homeview2->get_year_month_record($year,4);
        $data['new_dahsboardm']['may_c_year']=$this->Homeview2->get_year_month_record($year,5);
        $data['new_dahsboardm']['jun_c_year']=$this->Homeview2->get_year_month_record($year,6);
        $data['new_dahsboardm']['jul_c_year']=$this->Homeview2->get_year_month_record($year,7);
        $data['new_dahsboardm']['aug_c_year']=$this->Homeview2->get_year_month_record($year,8);
        $data['new_dahsboardm']['sep_c_year']=$this->Homeview2->get_year_month_record($year,9);
        $data['new_dahsboardm']['oct_c_year']=$this->Homeview2->get_year_month_record($year,10);
        $data['new_dahsboardm']['nov_c_year']=$this->Homeview2->get_year_month_record($year,11);
        $data['new_dahsboardm']['dec_c_year']=$this->Homeview2->get_year_month_record($year,12);

//dd($data['new_dahsboard']['may_p']);die;

        $data['new_dahsboardm']['current']=$this->Homeview2->get_month_record();
        $data['new_dahsboardm']['jan']=$this->Homeview2->get_year_month_record($last_year,1);
        $data['new_dahsboardm']['feb']=$this->Homeview2->get_year_month_record($last_year,2);
        $data['new_dahsboardm']['mar']=$this->Homeview2->get_year_month_record($last_year,3);
        $data['new_dahsboardm']['apr']=$this->Homeview2->get_year_month_record($last_year,4);
        $data['new_dahsboardm']['may']=$this->Homeview2->get_year_month_record($last_year,5);
        $data['new_dahsboardm']['jun']=$this->Homeview2->get_year_month_record($last_year,6);
        $data['new_dahsboardm']['jul']=$this->Homeview2->get_year_month_record($last_year,7);
        $data['new_dahsboardm']['aug']=$this->Homeview2->get_year_month_record($last_year,8);
        $data['new_dahsboardm']['sep']=$this->Homeview2->get_year_month_record($last_year,9);
        $data['new_dahsboardm']['oct']=$this->Homeview2->get_year_month_record($last_year,10);
        $data['new_dahsboardm']['nov']=$this->Homeview2->get_year_month_record($last_year,11);
        $data['new_dahsboardm']['dec']=$this->Homeview2->get_year_month_record($last_year,12);



        $data['new_dahsboardm']['year_to_date']=$this->Homeview2->year_finanace_C4(2);
        $data['new_dahsboardm']['year_last']=$this->Homeview2->year_finanace_C4(1);
        $data['new_dahsboardm']['year_before']=$this->Homeview2->year_finanace_C4(0);
        $data['new_dahsboardm']['year_previous2']=$this->Homeview2->year_finanace_C4(-1);
        $data['new_dahsboardm']['year_previous3']=$this->Homeview2->year_finanace_C4(-2);

        //*************************end monthly report*************************************//
//dd($data['new_dahsboard']['dec_p']);
//one year before login
        $data['new_dahsboard']['currentyearlogin']=$this->Homeview->currentyarlogin();
        $data['new_dahsboard']['previousyearlogin']=$this->Homeview->last_previous_yearlogin();
        //end

        $data['new_dahsboard']['user_thisMonth']=$this->Homeview->get_user_bymonth('thisMonth');
        $data['new_dahsboard']['user_lastMonth']=$this->Homeview->get_user_bymonth('lastMonth');

        $data['new_dahsboard']['paid_user_thisMonth']=$this->Homeview->get_user_bymonth('thisMonth','paid',1);
        $data['new_dahsboard']['new_paid_user_thisMonth']=$this->Homeview->get_user_bymonth('thisMonth','paid',0);
         //dd($data['new_dahsboard']['user_lastMonth']);die();
        $data['new_dahsboardm']['paid_user_thisMonth']=$this->Homeview2->get_user_bymonth('thisMonth','paid',1);
        $data['new_dahsboardm']['new_paid_user_thisMonth']=$this->Homeview2->get_user_bymonth('thisMonth','paid',0);
        $data['new_dahsboardm']['user_thisMonth']=$this->Homeview2->get_user_bymonth('thisMonth');
        $data['new_dahsboardm']['user_lastMonth']=$this->Homeview2->get_user_bymonth('lastMonth');
 




        _adminLayout('dashboard', $data);        
    }
    public function dashboardhome() {
        $data['title'] = 'Manage Home';
        _adminLayout('dashboard-home', $data);
    }	
	public function dashboardabout() {
        $data['title'] = 'Manage About';
        _adminLayout('dashboard-about', $data);
    }	
	public function dashboardreportviolationcr() {
		
        $data['title'] = 'Manage Report Violation CR';
        _adminLayout('dashboard-reportviolationcr', $data);
    }
	public function dashboarddonate() {
        
         $data['title'] = 'Manage Donate';
        _adminLayout('dashboard-donate', $data);
    }	
	public function managebenefit() {
        $data['id']=$this->uri->segment(3);
        $data['title'] = 'Manage';
		$data['all_data']=$this->Homeview->getAllBenefit();
		$data['all_data_member']=$this->Homeview->getAllMemberships();
        _adminLayout('manage-benefits', $data);
    }
	public function dashboardpricing() {
        $data['title'] = 'Manage Pricing';
        _adminLayout('dashboard-pricing', $data);
       
    }	
	public function dashboardrefundcancellation() {
        $data['title'] = ' Manage Refund or Cancellation ';
        _adminLayout('dashboard-refundorcancellation', $data);
       
    }
	public function managefeatures() {
        $data['id']=$this->uri->segment(3);
        $data['title'] = 'Manage';
        _adminLayout('manage-features', $data);
    }	
	public function privacypolicy() 
	{
        $data['title'] = 'Manage Privacy Policy';
        _adminLayout('dashboard-privacypolicy', $data);
    }
	public function training() 
	{
        $data['title'] = 'Training';
        _adminLayout('training', $data);
    }
	public function country() 
	{
        $data['title'] = 'Country';
        _adminLayout('country', $data);
    }
    public function faqs() 
    {
        $data['title'] = 'FAQs';
        _adminLayout('dashboard-faq', $data);
    }
    public function setting() 
    {
        $data['title'] = 'Setting';
        _adminLayout('dashboard-setting', $data);
    }
	public function usertype() 
	{
        $data['title'] = 'User Type';
        _adminLayout('user-type', $data);
    }
	
}

?>