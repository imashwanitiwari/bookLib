<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Custom_model extends CI_Model {
    public function custom_insert($tbl = null , $data = null)
    {
        $tbl = (!$tbl == null) ? $tbl : FALSE;
        $data = (is_array($data)) ? $data : FALSE;
        if ($tbl != FALSE && $data!= FALSE):
            $this->db->insert($tbl, $data);
            return $this->db->insert_id();
        endif;
    }

    public function custom_select($table,$array,$select)
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

          
}