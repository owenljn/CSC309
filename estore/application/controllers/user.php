<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->model('main_model');
		$this->load->model('admin_model');
		$this->load->model('cart_model');
		$this->load->library('form_validation');
		
		session_start();
		@$cart_session= session_id();
		if($this->session->userdata('cart_session')=='')	$this->session->set_userdata('cart_session',$cart_session);	
		
	}

	public function index()
	{
		if($this->session->userdata('id')=='')
		redirect(base_url()."index.php/login");
		
		$data['orders'] 	= 		$this->cart_model->getUserOrders();
		$this->load->view("dashboard/dashboard",$data); 
		
	}
	
	public function view()
	{
		if($this->session->userdata('id')=='')
		redirect(base_url()."index.php/login");
		$wer=array(array(1,2,3),array(4,5,6));
		$this->session->set_userdata('test',$wer);
		$data['test1']=$this->session->userdata('test');
		$data['order'] 					= 	$this->cart_model->getOrderDetails($this->uri->segment(3));
		$data['order_details'] = $this->cart_model->getOrderitemDetails($this->uri->segment(3));
		
		
		$this->load->view("dashboard/order_details",$data); 
		
	}
	
	public function cancel()
	{
         
                if($this->session->userdata('id')=='' || $this->uri->segment(3)=='')
		redirect(base_url()."index.php/login");
		$this->cart_model->cancel_order($this->uri->segment(3));
	}



	public function account()
	{
					
					
		if($this->session->userdata('id')=='')
		redirect(base_url()."index.php/login");
		
		
		if($this->input->post('update_action')=='')
			$this->load->view("dashboard/account");

		else
		{
						
					$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
					$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
					$this->form_validation->set_rules('login', 'Login', 'trim|required');							
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
					if($this->input->post('password')!='' || $this->input->post('password2')!='' )
					{
						$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[password2]');	
						$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]');
					}
					
						if ($this->form_validation->run() == FALSE)
						{
								
								$this->load->view('dashboard/account');	
						}
						else
						{
							
							$this->main_model->update_user($this->input->post());
							
						}
	
			
		}
	}
}