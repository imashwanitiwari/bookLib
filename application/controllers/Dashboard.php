<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller{
    public function index(){
        $this->load->view('include/header');
        $this->load->view('dashboard');
        $this->load->view('include/footer');
    }
    public function get_jobs(){
        $this->load->model("main_model");
        if($data = $this->main_model->get_jobs())
        {
            $i = 0;
            foreach((array)$data as $data):
                $i++;
                $data['ACTION'] = ($data['USER_ID'] == $_SESSION['user_id']) ? "<a href='action/inbox/".$data['ID']."'>Inbox</a>":"<a href='action/contact/".$data['USER_ID']."/".$data['ID']."'>Contact</a>";
                $data['SR'] = $i;
                $response['data'][] = $data;
            endforeach;
            echo json_encode($response);
        }
        else{
            return json_encode(array("data"=>false));
        }
    }
}
