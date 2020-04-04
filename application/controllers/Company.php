<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Company_model');
    }

	public function profile()
	{
		$id = $this->session->userdata['user_data']['id'];

		if($this->input->post())
		{
			if(empty($_FILES["file"]['name']))
            {
                $filename = $this->input->post('profile');
            }
            else
            {
				$config['upload_path']          = './uploads/profile/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $config['overwrite']            = TRUE;

	            $this->load->library('upload', $config);

	            if ( ! $this->upload->do_upload('file'))
	            {
	               $this->session->set_flashdata('delete_message', $this->upload->display_errors());
					redirect(base_url('company/details'));
	            }
	            else
	            {
	                $files = $this->upload->data();

	                $filepath = $files['full_path'];
	                $filename = $files['file_name'];
	            }
	        }

			$data = array(
				'id'				=> 	$id,
				'name'				=>	$this->input->post('name'),
				'email'				=>	$this->input->post('email'),
				'number'			=>	$this->input->post('number'),
				'gstin'				=>	$this->input->post('gstin'),
				'country'			=>	$this->input->post('country'),
				'state'				=>	$this->input->post('state'),
				'city'				=>	$this->input->post('city'),
				'street'			=>	$this->input->post('street'),
				'zipcode'			=>	$this->input->post('zipcode'),
				'profile'			=>	$filename,
				'update_on'			=>	date('Y-m-d')
			);


			$log_data_xss = $this->security->xss_clean($data);
			$this->database_class->update_record($log_data_xss,'users',$id,'id');
			
			$this->session->set_flashdata('success_message', 'ucAdmin Details Update Scessfully');
			redirect(base_url('company/profile'));
		}

		$data['page_title'] = 'Profile';

		$data['details']=$this->database_class->select_single_record('users','id',$id);

        $data['service'] = $this->Company_model->getService();
		$data['middle_view'] = "profile";
		$this->load->view('template/main_template',$data);
	}

	public function details()
	{
		$id = $this->session->userdata['user_data']['id'];

		$data['details']=$this->database_class->select_single_record('company','user_id',$id);

		if(empty($data['details'])) 
		{
			if($this->input->post())
			{

				$config['upload_path']          = './uploads/company/';
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            // $config['max_size']             = 100;
	            // $config['max_width']            = 1024;
	            // $config['max_height']           = 768;
	            $config['overwrite']            = TRUE;

	            $this->load->library('upload', $config);

	            if ( ! $this->upload->do_upload('file'))
	            {
	               $this->session->set_flashdata('delete_message', $this->upload->display_errors());
					redirect(base_url('company/details'));
	            }
	            else
	            {
	                $files = $this->upload->data();

	                $filepath = $files['full_path'];
	                $filename = $files['file_name'];
	            }

				$data = array(
					'user_id'			=> 	$id,
					'company_name'		=>	$this->input->post('company_name'),
					'site_short_name'	=>	$this->input->post('site_short_name'),
					'company_email'		=>	$this->input->post('company_email'),
					'company_phone'		=>	$this->input->post('company_phone'),
					'company_gstin'		=>	$this->input->post('company_gstin'),
					'country'			=>	$this->input->post('country'),
					'state'				=>	$this->input->post('state'),
					'city'				=>	$this->input->post('city'),
					'street'			=>	$this->input->post('street'),
					'zipcode'			=>	$this->input->post('zipcode'),
					'company_logo'		=>	$filename,
					'update_on'			=>	date('Y-m-d')
				);


				$log_data_xss = $this->security->xss_clean($data);
				$this->database_class->insert_record($log_data_xss,'company');
				
				$this->session->set_flashdata('success_message', ' Company Details Added Successfully');
				redirect(base_url('company/details'));
			}
		}
		else if(!empty($data['details']))
		{
			if($this->input->post())
			{
				if(empty($_FILES["file"]['name']))
                {
                    $filename = $this->input->post('file_name');
                }
                else
                {
					$config['upload_path']          = './uploads/company/';
		            $config['allowed_types']        = 'gif|jpg|png|jpeg';
		            // $config['max_size']             = 100;
		            // $config['max_width']            = 1024;
		            // $config['max_height']           = 768;
		            $config['overwrite']            = TRUE;

		            $this->load->library('upload', $config);

		            if ( ! $this->upload->do_upload('file'))
		            {
		               $this->session->set_flashdata('delete_message', $this->upload->display_errors());
						redirect(base_url('company/details'));
		            }
		            else
		            {
		                $files = $this->upload->data();

		                $filepath = $files['full_path'];
		                $filename = $files['file_name'];
		            }
		        }

				$data = array(
					'user_id'			=> 	$id,
					'company_name'		=>	$this->input->post('company_name'),
					'site_short_name'	=>	$this->input->post('site_short_name'),
					'company_email'		=>	$this->input->post('company_email'),
					'company_phone'		=>	$this->input->post('company_phone'),
					'company_gstin'		=>	$this->input->post('company_gstin'),
					'country'			=>	$this->input->post('country'),
					'state'				=>	$this->input->post('state'),
					'city'				=>	$this->input->post('city'),
					'street'			=>	$this->input->post('street'),
					'zipcode'			=>	$this->input->post('zipcode'),
					'company_logo'		=>	$filename,
					'added_on'			=>	date('Y-m-d')
				);


				$log_data_xss = $this->security->xss_clean($data);
				$this->database_class->update_record($log_data_xss,'company',$id,'user_id');
				
				$this->session->set_flashdata('success_message', ' Company Details Update Successfully');
				redirect(base_url('company/details'));
			}
		}

		$data['page_title'] = 'Company Details';
        $data['service'] = $this->Company_model->getService();

		$data['middle_view'] = "company_details";
		$this->load->view('template/main_template',$data);
	}

	public function location()
	{
		$data['page_title'] = 'Location Details';
		$data['lists'] = $this->Company_model->get();
        $data['service'] = $this->Company_model->getService();
		$data['middle_view'] = "location";
		$this->load->view('template/main_template',$data);
	}

	public function ajaxlist()
	{
		$data_list = $this->Company_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('company/edit/'.$r['id']) .'" class="btn paddd btn-xs btn-success"><i class="icon-pencil"></i></a>';
        $delete = anchor("company/delete/".$r['id'],"<i class='icon-trash'>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger"));

        $data[] = array(
            $r['name'],
            $r['address'],
            $r['is_default']=='1'?'Yes':'No',
            $r['phone'],
            $edit .' '. $delete,
            );
        }

        $output = array(
            "data" => $data
        );
        
        echo json_encode($output);
        exit();
	}

	public function add()
	{
		if($this->input->post())
		{
			$data = array(
                'name'          =>  $this->input->post('name'),
                'address'       =>  $this->input->post('address'),
                'phone'         =>  $this->input->post('phone'),
                'email'         =>  $this->input->post('email'),
                'is_default'    =>  $this->input->post('is_default'),
                'added_on'      =>  date('Y-m-d H:i:s')
            );

            $data = $this->security->xss_clean($data);
            $result = $this->Company_model->save($data);
            $this->session->set_flashdata('success_message', 'Location <b><u>'.$this->input->post('name').'</u></b> added successfully');
            redirect(base_url('company/location'));
		}

		$data['branches'] = $this->Company_model->get_default();
		$data['page_title'] = 'Location Details';

		$data['middle_view'] = "location_add";
		$this->load->view('template/main_template',$data);
	}

	public function edit($id)
	{
		$data['id'] = $id;
		if($this->input->post())
		{
			$data = array(
				'id'			=>	$id,
                'name'          =>  $this->input->post('name'),
                'address'       =>  $this->input->post('address'),
                'phone'         =>  $this->input->post('phone'),
                'email'         =>  $this->input->post('email'),
                'is_default'    =>  $this->input->post('is_default'),
                'update_on'     =>  date('Y-m-d H:i:s')
            );

            $data = $this->security->xss_clean($data);
            $result = $this->Company_model->update($data);
            $this->session->set_flashdata('success_message', 'Location <b><u>'.$this->input->post('name').'</u></b> added successfully');
            redirect(base_url('company/location'));
		}

		$data['details'] = $this->Company_model->get_branches($id);
		$data['is_default'] = $this->Company_model->get_default();
		$data['page_title'] = 'Location Details';

		$data['middle_view'] = "location_edit";
		$this->load->view('template/main_template',$data);
	}

	public function delete($id)
	{
		$this->Company_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Branche deleted successfully');
        redirect(base_url('company/location'));
	}

	public function change_password()
	{
		$id = $this->session->userdata['user_data']['id'];

		if($this->input->post())
		{
			$cpass=$this->input->post('cpass');
			$result=$this->Company_model->change($cpass, $id);
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
        $data['service'] = $this->Company_model->getService();
		$data['page_title'] = 'Change Password';
		$data['middle_view'] = "change_password";
		$this->load->view('template/main_template',$data);
	}
}