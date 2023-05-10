<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class App_model extends CI_Model {
    /*
     * Select row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Select array
     * para 3 - Where Condition array
     * para 4 - join => array(
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ],
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ]
     * )
     * para 5 - order by
     * para 6 - order => asc , desc
     * para 7 - Limit
     * para 8 - Offset
     * para 9 - or_like => array(
     *              columnname => search,
     *              columnname => search,
     *              columnname => search
     * )
     * 
     * This return the array of result data if no data found return blank array.
     */

    public function getData($tablename, $select = '*', $where = false, $join = false, $order_by = false, $order = 'DESC', $limit = false, $offset = false, $or_like = false,$group_by = false) {

        $this->db->select($select)
                ->from($tablename);

        if ($where != FALSE) {
            $this->db->where($where);
        }

        if ($join != false && is_array($join)) {

            foreach ($join as $value) {
                
                if(array_key_exists("join",$value)){
                    $this->db->join($value['table'], $value['on'], $value['join']);
                }
                else{
                    $this->db->join($value['table'], $value['on'], 'left');
                }
                
            }
        }

        if ($order_by != false) {
            $this->db->order_by($order_by, $order);
        }

        if ($limit != FALSE && $offset == FALSE) {
            $this->db->limit($limit);
        } elseif ($limit != FALSE && $offset != FALSE) {
            $this->db->limit($limit, $offset);
        }
        // 

        if ($or_like != FALSE) {
            $str = "";
            foreach ($or_like as $key => $val) {
                if (strlen($str) == 0)
                    $str .= "(`" . $key . "` LIKE '%" . $val . "%'";
                else
                    $str .= " OR `" . $key . "` LIKE '%" . $val . "%'";
            }
            $str .=')';

            $this->db->where($str);
        }
        
        if($group_by!=FALSE){
           $this->db->group_by($group_by); 
        }

        $res = $this->db->get();
       //echo $this->db->last_query();

        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    /*
     * Count row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Select array
     * para 3 - Where Condition array
     * para 4 - join => array(
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ],
     *          [
     *              "table"=>value,
     *              "on" => value
     *          ]
     * )
     * para 5 - order by
     * para 6 - order => asc , desc
     * para 7 - or_like => array(
     *              columnname => search,
     *              columnname => search,
     *              columnname => search
     * )
     * 
     * This return the array of result data if no data found return blank array.
     */

    public function getRowCount($tablename, $select = '*', $where = false, $join = false, $order_by = false, $order = 'desc', $or_like = false) {

        $this->db->select($select)
                ->from($tablename);

        if ($where != FALSE && is_array($where)) {
            $this->db->where($where);
        }

        if ($join != false && is_array($join)) {

            foreach ($join as $value) {
                $this->db->join($value['table'], $value['on'], 'left');
            }
        }

        if ($order_by != false) {
            $this->db->order_by($order_by, $order);
        }

         if ($or_like != FALSE) {
            $str = "";
            foreach ($or_like as $key => $val) {
                if (strlen($str) == 0)
                    $str .= "(`" . $key . "` LIKE '%" . $val . "%'";
                else
                    $str .= " OR `" . $key . "` LIKE '%" . $val . "%'";
            }
            $str .=')';

            $this->db->where($str);
        }

        return $this->db->count_all_results();
        ;
    }

    /*
     * Insert row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Data to insert
     */

    public function rowInsert($tablename, $data) {

        $query = $this->db->insert($tablename, $data);

        if ($query) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    /*
     * Insert row from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - Data to insert
     */

    public function rowUpdate($tablename, $data, $where) {

        $query = $this->db->where($where)
                ->update($tablename, $data);
        if ($query) {
            $affected_rows = $this->db->affected_rows();
            return true;
        } else {
            return false;
        }
    }

    /*
     * Delete rows from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - where condition
     */

    public function rowsDelete($tablename, $where) {

        if ($this->db->delete($tablename, $where)) {

            return true;
        } else {
            return false;
        }
    }

    /*
     * Delete rows from tabel and retun number of deleted rows
     * para 1 - Table name
     * para 2 - where condition
     * para 3 - Column name
     */

    public function rowsDeleteWhereIn($tablename, $where, $column_name) {

        $this->db->where_in($column_name, $where);
        if ($this->db->delete($tablename)) {
            return true;
        } else {
            return false;
        }
    }

    public function getWhereInData($tablename, $select, $where, $column_name,$join = false,$condition=False) {

        $this->db->select($select);
               $this->db->from($tablename);
        
               if ($join != false && is_array($join)) {

            foreach ($join as $value) {
                $this->db->join($value['table'], $value['on'], 'left');
            }
            }         
                $this->db->where_in($column_name, $where);
                if ($condition != FALSE && is_array($condition)) {
            $this->db->where($condition);
                }
                $res =$this->db->get();

        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }



    public function getAllData($tablename, $select = '*', $where = false,$or_where = false, $join = false, $order_by = false, $order = 'DESC', $limit = false, $offset = false, $or_like = false,$group_by = false) {

        $this->db->select($select)
                ->from($tablename);

        if ($where != FALSE) {
            $this->db->where($where);
        }

        if ($or_where != false && is_array($or_where)) {

          $this->db->group_start();  

            foreach ($or_where as $value) {
                
                $this->db->or_where($value['or_where'],$value['value']);
            }

          $this->db->group_end();  
        }

        if ($join != false && is_array($join)) {

            foreach ($join as $value) {
                
                if(array_key_exists("join",$value)){
                    $this->db->join($value['table'], $value['on'], $value['join']);
                }
                else{
                    $this->db->join($value['table'], $value['on'], 'left');
                }
                
            }
        }

        if ($order_by != false) {
            $this->db->order_by($order_by, $order);
        }

        if ($limit != FALSE && $offset == FALSE) {
            $this->db->limit($limit);
        } elseif ($limit != FALSE && $offset != FALSE) {
            $this->db->limit($limit, $offset);
        }
        // 

        if ($or_like != FALSE) {
            $str = "";
            foreach ($or_like as $key => $val) {
                if (strlen($str) == 0)
                    $str .= "(`" . $key . "` LIKE '%" . $val . "%'";
                else
                    $str .= " OR `" . $key . "` LIKE '%" . $val . "%'";
            }
            $str .=')';

            $this->db->where($str);
        }
        
        if($group_by!=FALSE){
           $this->db->group_by($group_by); 
        }

        $res = $this->db->get();
       //echo $this->db->last_query();

        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    public function leads_notes_search($data)
    {
        $id = $data['id'];
        $value = $data['value'];
        $current_record = $data['current_record'];
                 $this->db->select("n.*, p.first_name, p.last_name");
                 //$this->db->where('created_by',$id);
                 $this->db->where('record_id',$current_record);
                 $this->db->like('note', $value);
                 $this->db->join('anb_crm_users_personal_info p', 'p.user_id = n.created_by', 'left');
                 $this->db->order_by("id desc");
        $query = $this->db->get("anb_crm_note n");
        $result = $query->result_array();
        return $result;
    }

    public function recent_booking($id){
                 $this->db->where('record_id',$id);
        $query = $this->db->get("anb_crm_record_meta_value");
        $result = $query->result_array();
        return $result;
    }

    public function opener_chart($send)
    {
       $loggedUserId = $send['loggedUserId'];
       $role_id = $send['role_id'];

        if($role_id==4 or $role_id==3){
           $this->db->where('b.user_id',$loggedUserId);   
        }
//echo "<pre>"; print_r($send);

        $this->db->select('*');
        $this->db->join("(SELECT COUNT(c.assigned_officer_id) as total,c.assigned_officer_id FROM `anb_crm_users` `a` INNER JOIN `anb_crm_users_personal_info` `b` ON `a`.`id`=`b`.`user_id` LEFT JOIN `anb_crm_record` `c` ON `c`.`assigned_officer_id` = `a`.`id` WHERE `a`.`role_id` = 3 AND `a`.`status` = 1 AND `c`.`module_id` = 1 AND `c`.`record_status` = 3 GROUP BY c.assigned_officer_id) as t", 't.assigned_officer_id=b.user_id', 'inner');
        
        $query = $this->db->get("anb_crm_users_personal_info b");
        $result = $query->result_array();

     //   echo $this->db->last_query();
     //   die("test");
        
             $this->db->select('count(*) as total');
             $this->db->where('module_id',1);
             $this->db->where('record_status',3);
             $this->db->where('value !=','assigned to opener');
             $this->db->where('value !=','assigned to closer');
             $this->db->where('value !=','REASSIGNED TO CLOSER');
             $this->db->where('value !=','REASSIGNED TO OPENER');
             $this->db->where('record_meta_id',6);
             $this->db->join('anb_crm_record_meta_value b','a.id = b.record_id');
        $query1 = $this->db->get('anb_crm_record a');
         $result1 = $query1->result_array();

        return array("result"=>$result,"unassign"=>$result1);

    }
    public function closer_chart($send)
    {
       $loggedUserId = $send['loggedUserId'];
       $role_id = $send['role_id'];

        if($role_id==4 or $role_id==3){
           $this->db->where('b.user_id',$loggedUserId);   
        }
        
        $this->db->select('*');
        $this->db->join("(SELECT COUNT(c.assigned_officer_id) as total,c.assigned_officer_id FROM `anb_crm_users` `a` INNER JOIN `anb_crm_users_personal_info` `b` ON `a`.`id`=`b`.`user_id` LEFT JOIN `anb_crm_record` `c` ON `c`.`assigned_officer_id` = `a`.`id` WHERE `a`.`role_id` = 4 AND `a`.`status` = 1 AND `c`.`module_id` = 1 AND `c`.`record_status` = 3 GROUP BY c.assigned_officer_id) as t", 't.assigned_officer_id=b.user_id', 'inner');
        
        $query = $this->db->get("anb_crm_users_personal_info b");
        $result = $query->result_array();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $result;

    }
    public function add_hotcontract($id)
    {
                 $this->db->where('record_id',$key);
        $query = $this->db->get("anb_crm_record_meta_value");
        $result = $query->result_array();
        return $result;
    }

}
