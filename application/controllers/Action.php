<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Action extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
    }
    public function inbox($job_id = null)
    {
        if($job_id == null):
            return redirect('dashboard');
        endif;
        $data['data'] = $this->main_model->get_jobs($job_id);
        $this->load->view('include/header');
        $this->load->view('inbox',$data);
        $this->load->view('include/footer');
    }
    public function contact($person_id =null,$job_id = null)
    {
        if($job_id == null):
            return redirect('dashboard');
        endif;
        $this->main_model->update_status($person_id,$job_id);
        $data['data'] = $this->main_model->get_cont_details($person_id,$job_id);
        $data['user_details'] = $this->main_model->get_user_detail($person_id);
        $data['job_details'] = $this->main_model->get_job_poster($job_id);
        $this->load->view('include/header');
        $this->load->view('contact',$data);
        $this->load->view('include/footer');
    }
    public function get_inbox($id = null)
    {
        $data = $this->main_model->get_inbox($id);
        $i = 0;
        foreach((array)$data as $data):
            $i++;
            $data['SR'] = $i;
            $data['NAME'] = ($data['IS_READ'] == 0) ? "<B>".$data['NAME']."</B>":$data['NAME'];
            $data['MSG'] = ($data['IS_READ'] == 0) ? "<B>".$data['MSG']."</B>":$data['MSG'];
            $data['TIME'] = ($data['IS_READ'] == 0) ? "<B>".$data['TIME']."</B>":$data['TIME'];
            $data['ACTION'] = "<a href='../contact/".$data['SENDER_ID']."/".$id."'>Read</a>";
            $response['data'][] = $data;
        endforeach;
        echo json_encode($response);
    }
    public function insert_chat($j_id, $p_id)
    {
        $entry = $this->main_model->insert_chat($p_id, $j_id);
    }
}
    