<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_model extends CI_Model {
	
        public function check_where($table,$array)
            {
               $query = $this->db->where($array)
                         ->get($table);
                if($query->num_rows())
                    {
                        return $query->row();
                    }
                else
                {
                    return false;
                }
            }
            public function check_where_num($table,$array)
            {
               $query = $this->db->where($array)
                         ->get($table);
                if($query->num_rows())
                    {
                        return $query->num_rows();
                    }
                else
                {
                    return false;
                }
            }
            public function select_where($table,$array,$select)
            {
               $query = $this->db->where($array)
                         ->select($select)
                         ->get($table);
                if($query->num_rows()>0)
                    {
                        return $query->result_array();
                    }
                    else {
                        return false;
                    }
            }

            public function select_where_obj($table,$array,$select)
            {
               $query = $this->db->where($array)
                         ->select($select)
                         ->get($table);
                if($query->num_rows()>0)
                    {
                        return $query;
                    }
                    else {
                        return false;
                    }
            }
            public function update_where($table,$array,$data)
            {
               $query = $this->db->where($array)
                         ->update($table,$data);
                if($query)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
            }
           
          
}