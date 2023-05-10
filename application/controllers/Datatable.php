<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';
class Datatable extends Base {

    public function __construct(){
    	parent::__construct();
        // $this->redirectPublicUser();
        // $this->load->model("ModuleModel");
        // $this->load->model("DashboardModel");
        // $this->load->model("BookingModel");
        // $this->load->model("UserModel");
        // $this->load->model("App_model");
        // $this->load->helper('common_helper');
    }
    public function index()
    { 
 		// 	date_default_timezone_set('Europe/London');

			// $datetime = new DateTime('2008-08-03 12:35:23');
			// echo $datetime->format('Y-m-d H:i:s') . "<br>";
			// $la_time = new DateTimeZone('America/Los_Angeles');
			// $datetime->setTimezone($la_time);
			// echo $datetime->format('Y-m-d H:i:s');

        $this->load->view('table_test');
    }  

    public function test()
    {   
        
           
       // $monthly_target = $this->input->post("monthly_target");

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if(!empty($order))
        {
             foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

       
        $valid_columns = array(
            0=>'b.value', 
            1=>'c.value',
            2=>'d.value',
            3=>'e.value',
            4=>'f.value',
            5=>'g.value',
            6=>'h.value',
            7=>'i.value'
        );
        
        if(!isset($valid_columns[$col]))
        {   $order = null; }
        else
        {  $order = $valid_columns[$col]; }

        if($order !=null)
        { $this->db->order_by($order, $dir); }

         if(isset($monthly_target) && !empty($monthly_target))
        {  $this->db->where('module_id',$monthly_target);  }
        
        if(!empty($search))
        {
            //$x=0;
            $where = '( ';
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                 $where .=" $sterm LIKE '%$search%'";
                }
                else
                {
                 $where .=" OR  $sterm LIKE '%$search%'";
               }
                $x++;
            }      

            $where .= ') ';
         $this->db->where($where); 
        }

       $this->db->limit($length,$start);

        $this->db->where('b.record_meta_id',1); 
        $this->db->where('c.record_meta_id',2); 
        $this->db->where('d.record_meta_id',31);    
        $this->db->where('e.record_meta_id',4); 
        $this->db->where('f.record_meta_id',32);    
        $this->db->where('g.record_meta_id',35);    
        $this->db->where('h.record_meta_id',40);    
        $this->db->where('i.record_meta_id',37);    
        // $this->db->where('j.record_meta_id',6); 
           //  $this->db->select("a.id,a.module_id,a.record_status,a.modified_by,a.modified_time,b.value as fname,c.value as lname,d.value as c_name,e.value as email, f.value as phone,g.value as city,h.value as state,i.value as country,j.value as lead_status");

        $this->db->select("a.id,a.module_id,a.record_status,a.modified_by,a.modified_time,b.value as fname,c.value as lname,d.value as c_name,e.value as email, f.value as phone,g.value as city,h.value as state,i.value as country");

        $this->db->join("anb_crm_record_meta_value b","a.id=b.record_id","left");
        $this->db->join("anb_crm_record_meta_value c","a.id=c.record_id","left");
        $this->db->join("anb_crm_record_meta_value d","a.id=d.record_id","left");
        $this->db->join("anb_crm_record_meta_value e","a.id=e.record_id","left");
        $this->db->join("anb_crm_record_meta_value f","a.id=f.record_id","left");
        $this->db->join("anb_crm_record_meta_value g","a.id=g.record_id","left");
        $this->db->join("anb_crm_record_meta_value h","a.id=h.record_id","left");
        $this->db->join("anb_crm_record_meta_value i","a.id=i.record_id","left");
        // $this->db->join("anb_crm_record_meta_value j","a.id=j.record_id","left");

        $employees = $this->db->get("anb_crm_record a");
        $total_employees = $employees->num_rows();
// echo $this->db->last_query();
// die("ok");
        $data = array();
        foreach($employees->result() as $rows)
        {
            $data[]= array(
                $rows->fname,
                $rows->lname,
                $rows->c_name,
                $rows->email,
                $rows->phone,
                $rows->city,
                $rows->state,
                $rows->country
                // $rows->lead_status
            );     
        }
       // echo "<pre>";print_r($data);die;
   // for filter    
        // if(isset($monthly_target) && !empty($monthly_target))
        // { $this->db->where('module_id',$monthly_target); }
        if(!empty($search))
        { $x=0;
            $where = '( ';
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                 $where .=" $sterm LIKE '%$search%'";
                }
                else
                {
                 $where .=" OR  $sterm LIKE '%$search%'";
               }
                $x++;
            }      

            $where .= ') ';
         $this->db->where($where);             
        }
        $this->db->where('b.record_meta_id',1); 
        $this->db->where('c.record_meta_id',2); 
        $this->db->where('d.record_meta_id',31);    
        $this->db->where('e.record_meta_id',4); 
        $this->db->where('f.record_meta_id',32);    
        $this->db->where('g.record_meta_id',35);    
        $this->db->where('h.record_meta_id',40);    
        $this->db->where('i.record_meta_id',37);   
        $this->db->select("a.id,a.module_id,a.record_status,a.modified_by,a.modified_time,b.value as fname,c.value as lname,d.value as c_name,e.value as email, f.value as phone,g.value as city,h.value as state,i.value as country");

        $this->db->join("anb_crm_record_meta_value b","a.id=b.record_id","left");
        $this->db->join("anb_crm_record_meta_value c","a.id=c.record_id","left");
        $this->db->join("anb_crm_record_meta_value d","a.id=d.record_id","left");
        $this->db->join("anb_crm_record_meta_value e","a.id=e.record_id","left");
        $this->db->join("anb_crm_record_meta_value f","a.id=f.record_id","left");
        $this->db->join("anb_crm_record_meta_value g","a.id=g.record_id","left");
        $this->db->join("anb_crm_record_meta_value h","a.id=h.record_id","left");
        $this->db->join("anb_crm_record_meta_value i","a.id=i.record_id","left");
        $x = $this->db->get("anb_crm_record a");
        $total_employeesx = $x->num_rows();
    //for filter end    

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employeesx,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }



}
?>