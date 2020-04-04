<?php
class User extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(
            array(
                'admin/User_model' => 'user',
            )
        );
    }

    /**
     * user isting
     */
    public function listing()
    {
        $this->authenticate('admin');
        $data = array(
            "view" => 'admin/user/list',
            "title" => 'User Listing',
        );
        $this->load->view('admin/layout/template', $data);
    }
    
    /**
     * user isting
     */
    public function requests_report()
    {
        $this->authenticate('admin');
        $listing = array();
        if($this->input->post()){
            $from_date=$this->input->post('start_date')!=''?date('Y-m-d',strtotime($this->input->post('start_date'))):'';
            $end_date=$this->input->post('end_date')!=''?date('Y-m-d 23:59:59',strtotime($this->input->post('end_date'))):'';
            $code=$this->input->post('code');
            $listing = $this->user->requests_report($code,$from_date,$end_date);
            //echo "<pre>";print_r($this->db->last_query()); exit;
        }
        $data = array(
            "view" => 'admin/user/requests_report',
            "title" => 'Requesr Report',
            "listing" => $listing   
        );
        $this->load->view('admin/layout/template', $data);
    }
    
    public function account_expire()
    {
        $this->authenticate('admin');
        $this->user->account_expire_report('','','');
        echo $this->db->last_query();
        echo date('Y-m-01'),'...',date('Y-m-t'); exit;
        $listing = array();
        if($this->input->post()){
            $from_date=$this->input->post('start_date')!=''?date('Y-m-d',strtotime($this->input->post('start_date'))):'';
            $end_date=$this->input->post('end_date')!=''?date('Y-m-d 23:59:59',strtotime($this->input->post('end_date'))):'';
            $code=$this->input->post('code');
            $listing = $this->user->account_expire_report($code,$from_date,$end_date);
            //echo "<pre>";print_r($this->db->last_query()); exit;
        }
        $data = array(
            "view" => 'admin/user/account_expire_report',
            "title" => 'Account expire Report',
            "listing" => $listing   
        );
        $this->load->view('admin/layout/template', $data);
    }

    /**
     * user listing for data tables
     */
    public function getUsers()
    {
        $this->authenticate('admin');
        $search = $this->input->get('search')['value'];
        $orderBy = $this->input->get('order')[0]['column'];
        $orderByType = $this->input->get('order')[0]['dir'];
        $limit = $this->input->get('length');
        $offset = $this->input->get('start');

        switch ($orderBy) {
            case 0:
                $orderBy = 'id';
                break;
            case 1:
                $orderBy = 'id';
                break;        
            case 2:
                $orderBy = 'name';
                break;
            case 3:
                $orderBy = 'email';
                break;
            case 4:
                $orderBy = 'gender';
                break;
            case 5:
                $orderBy = 'type';
                break;
            case 6:
                $orderBy = 'payment_status';
                break;
            case 7:
                $orderBy = 'added_on';
                break;

            default:
                $orderBy = 'id';
                break;
        }
        $result = $this->user->getAllUsers($search, $orderBy, $orderByType, $limit, $offset);

        header('Content-Type: application/json');
        $data['data'] = $result;
        $data['recordsTotal'] = $this->user->getAllUserCount();
        $data['recordsFiltered'] = $search == "" ? $this->user->getAllUserCount() : count($result);
        echo json_encode($data);
    }

    /**
     * edit user profile
     *
     * @param integer $id
     * @return userDetails
     */
    public function edit($id = 0)
    {
        $this->authenticate('admin');

        $this->form_validation->set_rules('membership_type', 'Membership Type', 'trim|required');
        if ($this->input->post('membership_type') == 'prime') {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        }
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_is_unique_email');

        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('dob', 'Date of birth', 'trim|required');
        $this->form_validation->set_rules('birth_time', 'Birth time', 'trim|required');
        $this->form_validation->set_rules('birth_place', 'Birth place', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('education', 'Education', 'trim|required');
        $this->form_validation->set_rules('profession', 'Profession', 'trim|required');
        $this->form_validation->set_rules('designation', 'Designation', 'trim|required');
        $this->form_validation->set_rules('monthly_income', 'Monthly Income', 'trim|required');
        $this->form_validation->set_rules('native_place', 'Native Place', 'trim|required');
        $this->form_validation->set_rules('marital_status', 'Marital status', 'trim|required');
        if ($this->input->post('marital_status') == "divorce") {
            $this->form_validation->set_rules('first_marriage_issue', 'Marriage issue', 'trim|required');
        }
        $this->form_validation->set_rules('religion', 'Religion', 'trim|required');
        $this->form_validation->set_rules('cast', 'Cast', 'trim|required');
        $this->form_validation->set_rules('subcast', 'Sub-Cast', 'trim|required');
        $this->form_validation->set_rules('mother_tongue', 'Mother tongue', 'trim|required');
        $this->form_validation->set_rules('height', 'Height', 'trim|required');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        $this->form_validation->set_rules('complexion', 'Complexion', 'trim|required');
        $this->form_validation->set_rules('physical_problem', 'Physical Problems', 'trim|required');
        $this->form_validation->set_rules('believe_horoscope', 'Believe in horoscope', 'trim|required');
        $this->form_validation->set_rules('believe_cast', 'Believe in cast', 'trim|required');
        $this->form_validation->set_rules('mother_name', 'Mother Name', 'trim|required');
        $this->form_validation->set_rules('mother_occupation', 'Mother occupation', 'trim|required');
        $this->form_validation->set_rules('father_name', 'Father name', 'trim|required');
        $this->form_validation->set_rules('father_occupation', 'Father occupation', 'trim|required');
        $this->form_validation->set_rules('parent_mobile', 'Parent mobile', 'trim|required');
// $this->form_validation->set_rules('residence_phone', 'Residence phone', 'trim|required');
        // $this->form_validation->set_rules('office_phone', 'Office phone', 'trim|required');
        $this->form_validation->set_rules('brothers', 'Brother details', 'trim|required');
        $this->form_validation->set_rules('brothers_married', 'Number of Married brothers', 'trim|required');
        $this->form_validation->set_rules('brothers_unmarried', 'Number of unmarried brothers', 'trim|required');
        $this->form_validation->set_rules('sisters', 'Brother details', 'trim|required');
        $this->form_validation->set_rules('sisters_married', 'Number of Married sisters', 'trim|required');
        $this->form_validation->set_rules('sisters_unmarried', 'Number of unmarried sisters', 'trim|required');
        $this->form_validation->set_rules('residence_type', 'Residence type', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');

        if ($this->input->post('location') == "international") {
            $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
            $this->form_validation->set_rules('visa_type', 'Visa type', 'trim|required');
        }
        // if (empty($_FILES['photo']['name'])) {
        //     $this->form_validation->set_rules('photo', 'Profile Photo', 'required');
        // }
        $this->form_validation->set_rules('wish_to_settle', 'Wish to settle', 'trim|required');
        $this->form_validation->set_rules('wish_to_settle_country', 'Country you wish to settle', 'trim|required');
// echo validation_errors();exit;
        //if ($this->form_validation->run() && 1==1) {
        if ($this->input->post()) {
            // $_POST['dob'] = date("Y-m-d", strtotime($_POST['dob']));

            //unset($_POST['location']);
            unset($_POST['term']);
            if ($_POST['password'] != "") {
                $_POST['password'] = md5($_POST['password']);
            } else {
                unset($_POST['password']);
            }
            $result = $this->user->updateProfile($id, $this->input->post(), $_FILES);
            if ($result) {
                $this->session->set_flashdata('success', 'Profile updated : ' . $this->input->post('first_name'));
                redirect("admin/user/listing");exit;

            } else {
                $this->session->set_flashdata('error', 'Invalid Credentials');
                redirect("admin/user/listing");exit;
            }

        } else {
            $userDetails = $this->user->getUserById($id);
            $data = array(
                "userDetail" => $userDetails,
                "view" => 'admin/user/edit',
                "title" => 'Admin | Update User Details',
            );
            $this->load->view('admin/layout/template', $data);

        }

    }
    public function is_unique_email($email = "")
    {
        return true;
    }
    /**
     * get payment history
     *
     * @param integer $id
     * @return  payment history
     */
    public function payment_history($id = 0)
    {
        $this->authenticate('admin');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
        $this->form_validation->set_rules('type', 'Payment Mode', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
        $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
        $this->form_validation->set_rules('description', 'Payment Description', 'trim|required');
        // $this->form_validation->set_rules('status', 'Payment status', 'trim|required');
        //get payment history
        if ($this->form_validation->run()) {
            $data = array(
                "user_id" => $id,
                "amount" => $this->input->post('amount'),
                "type" => $this->input->post('type'),
                "description" => $this->input->post('description'),
                "status" => "success",
                "start_date" => date('Y-m-d H:i:s',strtotime($this->input->post('start_date'))),
                "end_date" => date('Y-m-d H:i:s',strtotime($this->input->post('end_date'))),
                "added_on" => date('Y-m-d h:i:s'),
            );
            $result = $this->user->addPaymentHistory($data);
            $this->session->set_flashdata('success', 'Payment addded successfully.');
            redirect('admin/user/payment_history/' . $id);
        } else {
            $paymentHistory = $this->user->getUserPaymentHistory($id);
            $data = array(
                "payment_history" => $paymentHistory,
                "view" => 'admin/user/payment_history',
                "title" => 'Admin | User Payment History',
            );
            $this->load->view('admin/layout/template', $data);
        }
    }
    
    public function update_payment($user_id,$payment_id)
    {
        $this->authenticate('admin');
        if($this->input->post()){
            //echo "<pre>";print_r($this->input->post()); exit;
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
            $this->form_validation->set_rules('type', 'Payment Mode', 'trim|required');
            $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
            $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
            $this->form_validation->set_rules('description', 'Payment Description', 'trim|required');
            // $this->form_validation->set_rules('status', 'Payment status', 'trim|required');
            //get payment history
            if ($this->form_validation->run()) {
                $data = array(
                    "amount" => $this->input->post('amount'),
                    "type" => $this->input->post('type'),
                    "description" => $this->input->post('description'),
                    "start_date" => date('Y-m-d H:i:s',strtotime($this->input->post('start_date'))),
                    "end_date" => date('Y-m-d H:i:s',strtotime($this->input->post('end_date'))),
                    "updated_on" => date('Y-m-d h:i:s'),
                );
                $result = $this->user->updateUserPaymentHistoryDetail($data,$payment_id);
                
                $this->session->set_flashdata('success', 'Payment updated successfully.');
                redirect('admin/user/payment_history/'.$user_id.'/'.$payment_id);
            } 
            
        }
        
        $paymentHistory = $this->user->getUserPaymentHistoryDetail($payment_id);
        
        $data = array(
            "payment_history" => $paymentHistory,
            "view" => 'admin/user/payment_history_update',
            "title" => 'Admin | User Payment History',
        );
        $this->load->view('admin/layout/template', $data);
    }

    public function delete_payment($userId = 0, $paymentId = 0)
    {

        if ($this->user->deletePayment($userId, $paymentId)) {
            $this->session->set_flashdata('success', 'Payment history deleted.');
        } else {
            $this->session->set_flashdata('error', 'Error while deleting payment history.');
        }
        redirect('admin/user/payment_history/' . $userId);

    }

    public function requests($userId = 0)
    {
        $this->authenticate('admin');
        $profiles = $this->user->getRequestedProfilesByUserId($userId);

        $data = array(
            "profiles" => $profiles,
            "user_details" => $this->userdata,
            "view" => 'admin/user/requestProfiles',
            "title" => 'Admin | User Profile Requests',
        );
        $this->load->view('admin/layout/template', $data);

    }
    
    function delete($u_id){
        $this->user->deleteUser($u_id);
        $this->session->set_flashdata('success', 'User deleted successfully');
        redirect('admin/user/listing');exit;
    }
    
    public function approveRequestDelete($id){
        $this->user->approveRequestDelete($id);
        $this->session->set_flashdata('success', 'Request deleted successfully');
        redirect('admin/user/requests/');exit;
    }
    
    public function updateContactUsRequestDelete($id){
        $this->user->contactUsRequestDelete($id);
        $this->session->set_flashdata('success', 'Request deleted successfully');
        redirect('admin/user/contact_us/');exit;
    }

    public function approveRequest($userId = 0, $reqId = 0)
    {
        $this->authenticate('admin');
        //get req details

        if ($this->user->approveRequest($reqId)) {
            $this->session->set_flashdata('success', 'Request approved.');
        } else {
            $this->session->set_flashdata('error', 'Error while approving request.');
        }
        if ($userId) {
            redirect('admin/user/requests/' . $userId);exit;
        }
        redirect('admin/user/requests/');exit;
    }

    public function contact_us()
    {
        $this->authenticate('admin');
        $requests = $this->user->getContactUsRequests();

        $data = array(
            "requests" => $requests,
            "user_details" => $this->userdata,
            "view" => 'admin/user/contactUsRequests',
            "title" => 'Admin | User Profile Requests',
        );
        $this->load->view('admin/layout/template', $data);

    }

    public function updateContactUsRequest($id = 0)
    {
        $this->authenticate('admin');
        $result = $this->user->markRead($id);

        if ($result) {
            $this->session->set_flashdata('success', 'Mark read');
        } else {
            $this->session->set_flashdata('error', 'error while Marking read');
        }
        redirect('admin/user/contact_us');
    }

    public function activate($userId = 0)
    {
        $this->authenticate('admin');
        $result = $this->user->markUserActive($userId);

        if ($result) {
            $this->session->set_flashdata('success', 'Mark active');
        } else {
            $this->session->set_flashdata('error', 'error while Marking active');
        }
        redirect('admin/user/listing');

    }
    public function deactivate($userId = 0)
    {
        $this->authenticate('admin');
        $result = $this->user->markUserDeActive($userId);

        if ($result) {
            $this->session->set_flashdata('success', 'Mark inactive');
        } else {
            $this->session->set_flashdata('error', 'error while Marking inactive');
        }
        redirect('admin/user/listing');

    }

    public function updateProfile()
    {

        $this->authenticate('admin');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'New Password', 'trim');
        if ($this->input->post('password') != '') {
            $this->form_validation->set_rules('old_password', 'Current Password', 'trim|callback_check_old_password');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|matches[password]');
        }

        if ($this->form_validation->run()) {
            $data = array(
                "name" => $this->input->post('name'),
                "email" => $this->input->post('email'),
                "updated_on" => date('Y-m-d h:i:s'),
            );
            if ($this->input->post('password') != '') {
                $data['password'] = md5($this->input->post('password'));
            }
            $result = $this->user->updateAdminProfile($this->session->userdata('user_id'), $data);
            $this->session->set_flashdata('success', 'Profile updated.');
            redirect('admin/user/updateProfile');
        } else {
            $userDetail = $this->user->getAdminDetails($this->session->userdata('user_id'));
            $data = array(
                "userDetail" => $userDetail,
                "view" => 'admin/user/updateProfile',
                "title" => 'Admin | Profile Update',
            );
            $this->load->view('admin/layout/template', $data);
        }

    }

    public function check_old_password($password)
    {
        $check = $this->user->checkOldPassword($this->session->userdata('user_id'), md5($password));
        if (!empty($check)) {
            return true;
        } else {
            $this->form_validation->set_message('check_old_password', 'Current password does not matched!');
            return false;
        }
    }

}
