<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
/**
 * Random String Generator : Helper File for Codeigniter 
 * 
 * @author      Paras Nath Chaudhary
 * @link        https://gist.github.com/opnchaudhary/4995012
 * 
 */
// ------------------------------------------------------------------------
/*
 Documentation:
 =============
  1.
  $this->load->helper('rand_helper');
  $randomString=generateRandomString();
  echo $randomString;    
  2. 
  $this->load->helper('rand_helper');
  $randomString=generateRandomString(14);
  echo $randomString;    
*/
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
/**
 * Random String Generator : Helper File for Codeigniter 
 * 
 * @author      Paras Nath Chaudhary
 * @link        https://gist.github.com/opnchaudhary/4995012
 * 
 */
// ------------------------------------------------------------------------
/*
 Documentation:
 =============
  1.
  $this->load->helper('rand_helper');
  $randomString=generateRandomString();
  echo $randomString;    
  2. 
  $this->load->helper('rand_helper');
  $randomString=generateRandomString(14);
  echo $randomString;    
*/
if ( ! function_exists('checkPermission'))
{
       function checkReminderPermission($user_id,$record_id=''){
           
           $ci =& get_instance();
           
           if(!empty($record_id)){
               $query=$ci->db->get_where('anb_crm_record',['id'=>$record_id]);
               $res=$query->row();
           }           
       } 
  
}

if ( ! function_exists('getOpener'))
{
       function getOpener($record_id){
           
           $ci =& get_instance();
           
           if(!empty($record_id)){
               $ci->db->where('record_id',$record_id);
               $ci->db->group_start();
               $ci->db->or_where('record_meta_id',22);
               $ci->db->or_where('record_meta_id',105);
               $ci->db->group_end();
               $query=$ci->db->get('anb_crm_record_meta_value'); 
               $opener_id=$query->row();

               $query=$ci->db->get_where('anb_crm_users_personal_info',['user_id'=>$opener_id->value]);
               return   $query->row()->first_name.' '.$query->row()->last_name;
           }           
       } 
  
}
if ( ! function_exists('getCloser'))
{
       function getCloser($record_id){
           
           $ci =& get_instance();
           
           if(!empty($record_id)){
               $ci->db->where('record_id',$record_id);
               $ci->db->group_start();
               $ci->db->or_where('record_meta_id',21);
               $ci->db->or_where('record_meta_id',104);
               $ci->db->group_end();
               $query=$ci->db->get('anb_crm_record_meta_value'); 
               $opener_id=$query->row();

               $query=$ci->db->get_where('anb_crm_users_personal_info',['user_id'=>$opener_id->value]);
               return $query->row()->first_name.' '.$query->row()->last_name;
           }           
       } 
  
}
if ( ! function_exists('getCompanyName'))
{
       function getCompanyName($record_id){
           
           $ci =& get_instance();
           
           if(!empty($record_id)){
               $ci->db->where('record_id',$record_id);
               $ci->db->group_start();
               $ci->db->or_where('record_meta_id',31);
               $ci->db->or_where('record_meta_id',84);
               $ci->db->or_where('record_meta_id',197);
               $ci->db->group_end();
               $query=$ci->db->get('anb_crm_record_meta_value'); 
               return $query->row()->value;

            }           
       } 
  
}
if ( ! function_exists('getFullName'))
{
       function getFullName($user_id){
           
           $ci =& get_instance();
           
           if(!empty($user_id)){
               $ci->db->where('user_id',$user_id);
               $query=$ci->db->get('anb_crm_users_personal_info'); 
               return $query->row()->first_name.' '.$query->row()->last_name;
           }           
       } 
  
}
if ( ! function_exists('getRemBookingCount'))
{
       function getRemBookingCount($id){
           
           $ci =& get_instance();
           
           if(!empty($id))
              return $ci->db->where('record_id',$id)->count_all_results('anb_crm_reminder');            
       } 
  
}
/* End of file rand_helper.php */

/* End of file rand_helper.php */