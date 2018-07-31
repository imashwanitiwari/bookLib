<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {



	public function index()
	{
		
		$this->load->helper('form');
		$this->load->view('include/header');
		$this->load->view('add_lib');
		$this->load->view('include/footer');
		
	}
	public function add_lib()
	{
			$this->load->helper('form');
			$this->load->model('Custom_model');
			$directory = urlencode('Uploads/' . $this->input->post('NAME')) ;
			$data = array(
				"NAME" => $this->input->post('NAME'),
				"PATH" => $directory
			);
			if (!is_dir($directory)) :
					mkdir($directory, 0777);
					$insert_id  = $this->Custom_model->custom_insert("library",$data);
					$this->session->set_flashdata("DIR_CREATED",true);
					$this->load->view('include/header');
					$data['data'] = $data;
					$data['data']['ID'] = $insert_id;
					$this->load->view('add_lib_properity' , $data);
					$this->load->view('include/footer');
			else :
					$this->session->set_flashdata("DIR_EXIST",true);
					$this->load->view('include/header');
					$this->load->view('add_lib');
					$this->load->view('include/footer');
			endif;

	}

	public function files()
	{
		$this->load->helper('custom_helper');
		$this->load->helper('form');
		$this->load->view('include/header');
		$this->load->view('add_files');
		$this->load->view('include/footer');
	}

	public function upload_file()
	{
		$this->load->model('Custom_model');
		$this->load->helper('form');
		if($data = $this->Custom_model->custom_select("library",["ID" => $this->input->post('LIBRARY')], 'ID,PATH')):
			$config['upload_path'] = $path = $data[0]['PATH'];
			$config['encrypt_name'] = true;
			$config['allowed_types'] = '*';
			$parm['data']			= $data;
			$parm['data']['NAME']	= $this->input->post('FILE_NAME');
			$parm['data']['lib_prop'] = $this->Custom_model->custom_select("lib_prop",["LIB_ID" => $this->input->post('LIBRARY')], '*');
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
					$error = array('error' => $this->upload->display_errors());
					echo "NOT";
					print_r($error);
			}
			else
			{
					$data = array('upload_data' => $this->upload->data());
					$insert_array = array(
						"NAME" => $_POST['FILE_NAME'],
						"PATH" => $path . '/' .$data['upload_data']['file_name'] ,
						"LIB_ID" => $_POST['LIBRARY']
					);
					$parm['data']['FILE_ID'] = $this->Custom_model->custom_insert("files",$insert_array);
					print_r($data);
					$this->load->view('add_file_meta',$parm);
			}
		endif;
	}

	public function add_prop(){
		$this->load->model('Custom_model');
		if(!$data = $this->Custom_model->custom_select("lib_prop",$_POST, 'ID')):
			$id = $this->Custom_model->custom_insert("lib_prop",$_POST);
			echo json_encode(array("status"=>1,"ID"=>$id));
		else:
			echo json_encode(array("status"=>0,"ID"=>null));
		endif;
	}

	public function add_file_meta(){
		$this->load->model('Custom_model');
		$keys = array_keys($_POST);
		print_r($keys);
		for($i = 0; $i<=count($keys)-1 ; $i++):
			if($keys[$i]!="FILE_ID"):
				($_POST[$keys[$i]] !="") ? $this->Custom_model->custom_insert("files_meta",["META"=> $keys[$i], "VALUE" =>$_POST[$keys[$i]], "FILE_ID"=>$_POST['FILE_ID']]): FALSE;
			endif;
		endfor;
	}
	public function browser()
	{
		$this->load->model('Custom_model');
		if($data = $this->Custom_model->custom_select("library",1,'*')):
			$this->load->view('browser');
		endif;
	}
}
