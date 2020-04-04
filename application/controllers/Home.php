<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
    }

    public function index()
	{
		$data['caption'] = "Control panel";
		$data['page_title'] = 'Dashboard';
		$data['middle_view'] = "home";
		$this->load->view('template/main_template',$data);
	}

	// public function profile()
	// {
	// 	$id = $this->session->userdata['user_data']['id'];

	// 	if($this->input->post())
	// 	{
	// 		$update['name']=$this->input->post('name');
	// 		$update['email']=$this->input->post('email');
	// 		$this->database_class->update_record($update,'users',$id,'id');
			
	// 		$this->session->set_flashdata('success_message', 'User Update');
	// 		redirect(base_url('home/profile'));
	// 	}

	// 	$data['page_title'] = 'Profile';

	// 	$data['details']=$this->database_class->select_single_record('users','id',$id);

	// 	$data['middle_view'] = "profile";
	// 	$this->load->view('template/main_template',$data);
	// }

	public function change_password()
	{
		$id = $this->session->userdata['user_data']['id'];

		if($this->input->post())
		{
			$cpass=$this->input->post('cpass');
			$result=$this->Home_model->change($cpass, $id);
			if(count($result)>0)
			{
				$npass=$this->input->post('npass');
				$conpass=$this->input->post('conpass');
				if($npass === $conpass)
				{
					$update['password']=md5($npass);
					$this->database_class->update_record($update,'users',$id,'id');
					$this->session->set_flashdata('success_message', 'Password Change Successfully');
					redirect(base_url('login/logout/'.$id));
				}
				else
				{
					$this->session->set_flashdata('failed_message', 'Password Mismatch');
					redirect(base_url('home/change_password'));
				}
			}
			else
			{
				$this->session->set_flashdata('failed_message', 'Incorrect Password. try again!');
				redirect(base_url('home/change_password'));
			}
		}
		$data['page_title'] = 'Change Password';
		$data['middle_view'] = "change_password";
		$this->load->view('template/main_template',$data);
	}
}