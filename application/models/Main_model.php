<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_model extends CI_Model {
    public function get_jobs($id = null)
    {
        $where_clause = ($id != null) ? ["USER_ID" => $_SESSION['user_id'], "j.ID" => (int)$id] : "j.ID!=''";
        $data = $this->db->select("j.ID,  j.JOB_TITLE, CONCAT(DAY(j.DATE),'/',MONTH(j.DATE),'/',YEAR(j.DATE),' - ',TIME(j.DATE)) AS DATE,j.USER_ID, CONCAT(u.FIRST_NAME,' ',u.LAST_NAME) AS NAME, u.USERNAME")
                 ->from("jobs j")
                 ->join("users u", "j.USER_ID = u.ID")
                 ->where($where_clause)
                 ->get();
                if($data->num_rows()>0){
                    return $data->result_array();
                }
            else
            {
                return false;
            }
    }
    public function get_user_detail($id = null)
    {
        $data = $this->db->select("CONCAT(u.FIRST_NAME,' ',u.LAST_NAME) AS NAME, u.USERNAME")
                 ->from("users u")
                 ->where(["u.ID"=>$id])
                 ->get();
                if($data->num_rows()>0){
                    return $data->row();
                }
            else
            {
                return false;
            }
    }
    public function get_inbox($job_id=null)
    {
        $data = $this->db->select("c.ID, c.MSG, c.TIME, c.CONTACT_USER_ID AS SENDER_ID, c.IS_READ, CONCAT(u.FIRST_NAME,' ', u.LAST_NAME) AS NAME")
                                ->from("chats c")
                                ->join("users u", "c.CONTACT_USER_ID = u.ID")
                                ->where(["JOB_ID" => $job_id])
                                ->order_by("c.TIME","ASC")
                                ->group_by("CONTACT_USER_ID")
                                ->get();
                return $data->result_array();
    }
    public function get_job_poster($j_id)
    {
        $data = $this->db->select("u.ID,j.JOB_TITLE")
        ->from("users u")
        ->join("jobs j", "u.ID = j.USER_ID")
        ->where(["j.ID" => $j_id])
        ->get();
        return $data->row();
    }
    public function get_cont_details($person_id = null , $job_id = null)
    {
        $p_id = $this->get_job_poster($job_id);
        $data = $this->db->select("c.ID, c.JOB_ID, c.MSG, c.CONTACT_USER_ID, c.IS_REPLY, TIME(c.TIME) AS TIME,  CONCAT(u.FIRST_NAME,' ', u.LAST_NAME) AS NAME, u.USERNAME")
        ->from("chats c")
        ->join("users u", "c.CONTACT_USER_ID = u.ID")
        ->where(["JOB_ID" => $job_id , "CONTACT_USER_ID"=>($p_id->ID == $_SESSION['user_id']) ? $person_id :$_SESSION['user_id']])
        ->order_by("c.TIME","ASC")
        ->get();
            return $data->result_array();
    }
    public function insert_chat($p_id, $j_id)
    {
        $data = $this->get_job_poster($j_id);
        $values = array(
            "JOB_ID" => $j_id,
            "CONTACT_USER_ID" => ($data->ID == $_SESSION['user_id']) ? $p_id :$_SESSION['user_id'] ,
            "MSG" => $_POST['msg'],
            "IS_READ" => 0,
            "IS_REPLY" => ($data->ID == $_SESSION['user_id']) ? 1 : 0

        );
        $this->db->insert("chats",$values);
    }
    public function update_status($p_id,$j_id){
        $this->db->where(["JOB_ID"=>$j_id, "CONTACT_USER_ID"=>$p_id])
        ->update("chats",["IS_READ"=>1]);
    }
}
