<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct() {
        parent::__construct();
        
		$this->load->model('Login_model');
	}

	public function index()
	{
		if($this->session->userdata['user_data']['role'] == 'admin'){
            redirect(base_url('home'));
        }
        if($this->session->userdata['user_data']['role'] == 'sub_admin')
        {
        	redirect(base_url('dashboard'));
        }
		if($this->input->post())
		{
			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
			);

			$result = $this->Login_model->login($data);

			if(count($result)>0)
			{
			    foreach($result as $row)
				{
					$ids = $row['id'];
				}
				
				date_default_timezone_set('Asia/Kolkata');
				$up['last_login'] = date('Y-m-d H:i:s');
				
				$f_data_xss = $this->security->xss_clean($up);
				$update = $this->database_class->update_record($f_data_xss,TB_USER,$ids,'id');
				if($update['affected_row']>0)
				{
					$role = $result[0]['role'];
					$log['event'] = 'login';
					$log['ip_address'] = $this->input->ip_address();
					$log['date_time'] = date('Y-m-d H:i:s');

				    $log['user_id'] = $result[0]['id'];
					$log_data_xss = $this->security->xss_clean($log);
					$login_history = $this->database_class->insert_record($log_data_xss,TB_LOGIN_HISTORY);

					$final = $this->Login_model->login($data);

    				$this->session->set_userdata('role',$final[0]['role']);
    				$session_data = $this->session->set_userdata('user_data',$final[0]);
    				
    				if($role == 'admin') 
    				{
						redirect(base_url('home'));
    				}
    				else
    				{
    					redirect(base_url('dashboard'));
    				}
				}
				else
				{
					$data['login_error']='<b>Invalid login credential</b>'; 
				}
			}
			else
			{
				$data['login_error']='<b>Invalid login credential'; 
			}
		}
        $data['middle_view'] = "login";
		$this->load->view('login',$data);
	}

	public function forgot_password()
	{
		if($this->input->post())
		{
			//echo "<pre>";print_r($this->input->post()); exit;
			if($this->input->post('email')!='')
			{
				$email= $this->security->xss_clean($this->input->post('email'));

				$result=$this->database_class->select_single_record(TB_USER,'email',$email);
				//print_r($result); exit;
				if(count($result)>0){

					$pass=rand(11111,99999);

					$update['password']=md5($pass);
					$record = $this->database_class->update_record($update,TB_USER,$result[0]['id'],'id');
					if($record)
					{
						$this->session->set_flashdata('success_message', 'New Password: '.$pass);
						redirect(base_url('login'));
					}

				}
				else
				{
					$data['error']='Invalid details';
				}
			}else{
				$data['error']='Provide correct details';
			}
		}
		else
		{
			$data['enter'] = "enter email";
		}
		$this->load->view('login',$data);
	}

	public function otp()
	{
		if(get_cookie('login_timout')!=''){
			if($this->input->post()){
				
				$otp=$this->input->post('otp');
				if($otp==$this->session->userdata('otp')){
					$this->session->set_userdata('user_login',1);
					
					$this->session->unset_userdata('otp');
					delete_cookie('login_timout');

					redirect(base_url('home'));
				}else{
					$data['login_error']='Invalid OTP'; 
				}
			}
			$data['middle_view'] = "otp";
			//echo "<pre>";print_r($data);exit;
			$this->load->view('otp',$data);
		}else{
			$this->session->unset_userdata('otp');
			$this->session->set_flashdata('error_message', 'Session expire');
			redirect(base_url('login'));
		}
	}

	public function logout($id)
	{
		date_default_timezone_set('Asia/Kolkata');
		$up['last_logout'] = date('Y-m-d H:i:s');

		$result=$this->database_class->select_single_record('users','id',$id);

		$f_data_xss = $this->security->xss_clean($up);
		$update = $this->database_class->update_record($f_data_xss,TB_USER,$id,'id');


		if($update['affected_row']>0){
			
			$role = $result[0]['role'];
			$log['event'] = 'logout';
			$log['ip_address'] = $this->input->ip_address();
			$log['date_time'] = date('Y-m-d H:i:s');

			if($role == 'admin')
			{
			    $log['user_id'] = $result[0]['id'];
				$log_data_xss = $this->security->xss_clean($log);
				$login_history = $this->database_class->insert_record($log_data_xss,TB_LOGIN_HISTORY);
			}
			
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}
}