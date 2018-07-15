<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{

    public function user_login()
    {
        $data['data'] = array("title"=> "USER LOGIN");
       // $this->load->view('include/header');
        $this->load->view('login');
        $this->load->view('include/footer');
    }
    public function validate_login()
    {
        $this->load->model('custom_model');
        if(isset($_POST['USERNAME'], $_POST['PASSWORD']))
        {    
            $validate = array("USERNAME"=>$_POST['USERNAME'],"PASSWORD"=>sha1($_POST['PASSWORD']));
            if($login = $this->custom_model->check_where("users",$validate))
            {
                $session_array=array (

                    'user_signed_in' => true,
                    'name' => $login->FIRST_NAME,
                    'user_id' => $login->ID,
                    'username' => $login->USERNAME
                );
                $this->session->set_userdata($session_array);
                
              return redirect('dashboard');
            }
            else{
                $this->session->set_flashdata("login_failed",true);
                return redirect('login/user_login');
            }
        }
        else{
            return redirect('login/user_login');
        }
    }
    public function logout()
    {
        session_destroy();
        return redirect('login/user_login');
    }
}