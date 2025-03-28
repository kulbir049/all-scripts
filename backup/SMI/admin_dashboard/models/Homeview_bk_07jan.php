<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Homeview extends CI_Model
{
    private $benefit_cms = 'benefit_cms';
    private $member_ship = 'member_ship';
    // private $users = "users";
    public function __construct()
    {
        parent::__construct();
    }

    //Total number user count
    public function get_total_user_count()
    {
        $query = $this->db->query("SELECT COUNT(*) as countuser FROM user WHERE `role_id`='2'");
        return $query->result_array();
    }

    public function get_total_supplier_count()
    {
        $query = $this->db->query("SELECT COUNT(*) as countsupp FROM user WHERE `role_id`='3'");
        return $query->result_array();
    }

    public function getTotalOrderCount()
    {
        $query = $this->db->query("SELECT COUNT(*) as countOrder FROM orders");
        return $query->row_object();
    }

    public function getTotalPaidMemberCount()
    {
        $query = $this->db->query("SELECT DISTINCT user_id FROM transaction WHERE payment_status='completed'");
        return count($query->result());
    }

    public function getTotalMemberCount()
    {
        $query = $this->db->query("SELECT DISTINCT user_id FROM transaction WHERE payment_status='completed'");
        return count($query->result());
    }

    /**
     * get All
     * @return all homepage
     * @since 0.1
     * @author Devendra Tiwari
     */
    public function getAllBenefit()
    {
        try {
            //$select_field = array('id','pkg_type_id', 'name', 'description', 'price', 'status', 'created_on', 'updated_on', 'created_by', 'updated_by');
            $this->db->select('*');
            $this->db->order_by("id", "ASC");
            $this->db->where("cms_type", "benefit");
            $this->db->from($this->benefit_cms);
            $arr_data = $this->db->get()->result_object();
            //echo get_query(); die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	
    public function getAllFeatures()
    {
        try {
            $this->db->select('*');
            $this->db->order_by("id", "ASC");
            $this->db->where("cms_type", "features");
            $this->db->from($this->benefit_cms);
            $arr_data = $this->db->get()->result_object();
            //echo get_query(); die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
	
	
	
	 public function getAllMemberships()
    {
        try {
            $this->db->select('*');
            $this->db->from($this->member_ship);
            $arr_data = $this->db->get()->result_object();
            //echo get_query(); die;
            return (isset($arr_data) && !empty($arr_data) ? $arr_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


     public function paid_members()
     {
        $this->db->select('*');
        $this->db->where('role_id','3');
        $this->db->where('status','1');
        $this->db->from('user');
        $paid = $this->db->get()->result_array();
        return $paid;
     }

     public function total_members()
     {
        $this->db->select('*');
        $this->db->where('status','1');
        $this->db->from('user');
        $total = $this->db->get()->result_array();
        return $total;
     }


    public function total_members_file()
     {
        $this->db->select('*');
        $this->db->where('delete_status','0');
        $this->db->from('category_image');
        $total_files = $this->db->get()->result_array();
        return $total_files;
     }

     public function total_number_folder()
     {
        $this->db->select('*');
        $this->db->where('delete_status!=','2');
        $this->db->from('categories');
        $total_folder = $this->db->get()->result_array();
        return $total_folder;
     }


      public function current_month_record()
     {

          $month = date('Y-m');
          //echo $month; die;
         $this->db->where("DATE_FORMAT(smp.subscribe_date,'%Y-%m') ", $month);
         $this->db->where_in("smp.plan_id",[2,3]);
        $this->db->join('user u','u.user_id=smp.user_id');
        $this->db->select('SUM(smp.price) as this_month_price');
        // $timestamp = strtotime('Today');
        // $first = date('y-m-01 00:00:00',$timestamp);
        // $last = date('Y-m-t 12:59:59',$timestamp);
        // $this->db->select('smp.*');
        //  $this->db->where('subscribe_date>=',$first);
        //  $this->db->where('subscribe_date<=',$last);
        $this->db->from('subscribe_membership_plan smp');
        //$this->db->join('user u','u.user_id=smp.user_id');
        $current_month = $this->db->get()->result_array();
    //    echo $this->db->last_query();

        return $current_month;
     }


     

  public function this_year_record()
     {
        $year = date('Y');
         $this->db->where("DATE_FORMAT(smp.subscribe_date,'%Y') ", $year);
        $this->db->join('user u','u.user_id=smp.user_id');
        $this->db->where_in("smp.plan_id",[2,3]);
        $this->db->select('SUM(smp.price) as this_year_price');
        $this->db->from('subscribe_membership_plan smp');

        $this_year_data = $this->db->get()->result_array();
        return $this_year_data;
     }



public function this_year_sales()
     {
        $year = date('Y');
         $this->db->where("DATE_FORMAT(o.created_on,'%Y') ", $year);
         $this->db->where('payment_status','Success');
        $this->db->join('user u','u.user_id=o.user_id');
        $this->db->select('SUM(o.grand_total) as this_year_sales');
        $this->db->from('orders o');

        $this_year_sales = $this->db->get()->result_array();
        
        return $this_year_sales;
     }


     public function this_year_jan_to_march()
     {
        $january = strtotime('now');
        $jan = date('Y-7-1 00:00:00',$january);
        $march = date('Y-9-t 12:59:59',$january);
        $this->db->select('SUM(smp.price) as this_year_price');
        $this->db->where('subscribe_date>=',$jan);
        $this->db->where('subscribe_date<=',$march);
        $this->db->from('subscribe_membership_plan smp');
        $this->db->join('user u','u.user_id=smp.user_id');
        $this_year_jan = $this->db->get()->result_array();
      //  echo $this->db->last_query(); 
        return $this_year_jan;
     }

     public function get_year_QUARTER($year,$QUARTER_id)
     {
       
      $this->db->where("YEAR(subscribe_date)", $year);
      //$this->db->where("DATE_FORMAT(smp.subscribe_date,'%Y')",$year);
      $this->db->where("QUARTER(subscribe_date)", $QUARTER_id);
      $this->db->where_in("smp.plan_id",[2,3]);
        $this->db->join('user u','u.user_id=smp.user_id');
        $this->db->select('SUM(smp.price) as this_year_price');
        $this->db->from('subscribe_membership_plan smp');

        $this_year_data = $this->db->get()->result_array();
          //echo $this->db->last_query(); die;
        return $this_year_data;
     }

      public function get_last_year_QUARTER($last_year,$QUARTER_id)
     {
       
      $this->db->where("YEAR(subscribe_date)", $last_year);
      $this->db->where("QUARTER(subscribe_date)", $QUARTER_id);
        $this->db->join('user u','u.user_id=smp.user_id');
        $this->db->select('SUM(smp.price) as this_year_price');
        $this->db->from('subscribe_membership_plan smp');
//echo "<br/>";
        $last_year_data = $this->db->get()->result_array();
      //  echo $this->db->last_query();
        return $last_year_data;
     }
public function last_year_record()
     {
        $year = date('Y');
        $last_year = $year -1;
       
        //$this->db->where("DATE_FORMAT(smp.subscribe_date,'%Y') ", $last_year);
        $this->db->where("YEAR(subscribe_date)", $last_year);
        $this->db->join('user u','u.user_id=smp.user_id');
        $this->db->select('SUM(smp.price) as last_year_price');
        $this->db->from('subscribe_membership_plan smp');
        $last_year = $this->db->get()->result_array();
       // echo $this->db->last_query();
        return $last_year;
     }

    //  public function this_year_april_to_june()
    //  {
    //     $year = date('Y'); 
    //     $month1 = '04';
    //     $month3 = '06';
       
    //      $this->db->where("DATE_FORMAT(smp.subscribe_date,'%Y-%M')",$year.'BETWEEN $month1 AND $month3');
    //     $this->db->join('user u','u.user_id=smp.user_id');
    //     $this->db->select('SUM(smp.price) as april_to_june_price');
    //     $ap = strtotime('now');
    //     $april = date('Y-4-1 00:00:00',$ap);
    //     $june = date('Y-6-t 12:59:59',$ap);
    //      $this->db->select('smp.*');
       
    //     // $this->db->where('subscribe_date>=',$april);
    //     // $this->db->where('subscribe_date<=',$june);
    //     $this->db->from('subscribe_membership_plan smp');
    //     //$this->db->join('user u','u.user_id=smp.user_id');
    //     $this_year_april = $this->db->get()->result_array();
    //     return $this_year_april;
    //  }

    // public function this_year_july_to_sept()
    //  {
    //     $july = strtotime('now');
    //     $julyy = date('Y-7-1 00:00:00',$july);
    //     $sept = date('Y-9-t 12:59:59',$july);
    //      $this->db->select('smp.*');
       
    //     $this->db->where('subscribe_date>=',$julyy);
    //     $this->db->where('subscribe_date<=',$sept);
    //     $this->db->from('subscribe_membership_plan smp');
    //     $this->db->join('user u','u.user_id = smp.user_id');
    //     $this_year_july = $this->db->get()->result_array();
    //     return $this_year_july;
    //  }   

    //  public function this_year_oct_to_dec()
    //  {
    //     $oct = strtotime('now');
    //     $octo = date('Y-10-1 00:00:00',$oct);
    //     $dec = date('Y-12-t 12:59:59',$oct);
    //      $this->db->select('smp.*');
       
    //     $this->db->where('subscribe_date>=',$octo);
    //     $this->db->where('subscribe_date<=',$dec);
    //     $this->db->from('subscribe_membership_plan smp');
    //     $this->db->join('user u','u.user_id=smp.user_id');
    //     $this_year_oct = $this->db->get()->result_array();
    //     return $this_year_oct;
    //  }

    //  public function last_year_jan_to_march()
    //  {
    //     $january = strtotime('-1 Year');
    //     $jan = date('Y-1-1 00:00:00',$january);
    //     //echo $jan; die;
    //     $march = date('Y-3-t 12:59:59',$january);
    //     $this->db->select('smp.*');
    //     $this->db->where('subscribe_date>=',$jan);
    //     $this->db->where('subscribe_date<=',$march);
    //     $this->db->from('subscribe_membership_plan smp');
    //     $this->db->join('user u','u.user_id=smp.user_id');
        
    //     $last_year_jan = $this->db->get()->result_array();
    //     return $last_year_jan;
    //  }

    //  public function last_year_april_to_june()
    //  {
    //     $ap = strtotime('-1 Year');
    //     $april = date('Y-4-1 00:00:00',$ap);
    //     $june = date('Y-6-t 12:59:59',$ap);
    //      $this->db->select('smp.*');
       
    //     $this->db->where('subscribe_date>=',$april);
    //    $this->db->where('subscribe_date<=',$june);
    //     $this->db->from('subscribe_membership_plan smp');
    //     $this->db->join('user u','u.user_id=smp.user_id');
    //     $last_year_april = $this->db->get()->result_array();
    //     return $last_year_april;
    //  }

    //     public function last_year_july_to_sept()
    //  {
    //     $july = strtotime('-1 Year');
    //     $julyy = date('Y-7-1 00:00:00',$july);
    //     $sept = date('Y-9-t 12:59:59',$july);
    //      $this->db->select('smp.*');
       
    //     $this->db->where('subscribe_date>=',$julyy);
    //     $this->db->where('subscribe_date<=',$sept);
    //     $this->db->from('subscribe_membership_plan smp');
    //     $this->db->join('user u','u.user_id=smp.user_id');
    //     $last_year_july = $this->db->get()->result_array();
    //     return $last_year_july;
    //  } 

    //   public function last_year_oct_to_dec()
    //  {
    //     $oct = strtotime('-1 Year');
    //     $octo = date('Y-10-1 00:00:00',$oct);
    //     $dec = date('Y-12-t 12:59:59',$oct);
    //      $this->db->select('smp.*');
       
    //     $this->db->where('subscribe_date>=',$octo);
    //     $this->db->where('subscribe_date<=',$dec);
    //     $this->db->from('subscribe_membership_plan smp');
    //     $this->db->join('user u','u.user_id=smp.user_id');
    //     $last_year_oct = $this->db->get()->result_array();
    //     return $last_year_oct;
    //  }
    // public function getTotalPaidMemberCount(){
    //     try {
            
    //         $this->db->select('COUNT(user_id)');
           
    //         $this->db->distinct();
    //         $this->db->where('payment_status', 'completed');
    //         $query = $this->db->get('transaction');
    //         //return count($query->num_rows());
    //         //$query->num_rows();
    //         return count($query->result());
    //         //dd($query->result()); die();
    //     } catch (Exception $ex) {
    //         var_dump($ex->getMessage());
    //     }
    // }

}

?>