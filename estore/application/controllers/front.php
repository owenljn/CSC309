<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->model('main_model');
		$this->load->model('admin_model');
                $this->load->model('email_model');
		$this->load->model('cart_model');
		$this->load->library('form_validation');
		
		session_start();
		@$cart_session= session_id();
		if($this->session->userdata('cart_session')=='')	$this->session->set_userdata('cart_session',$cart_session);	
		
	}

	public function index()
	{
		$data['all_products'] 		= $this->main_model->getLatestProducts();
		$this->load->view("home",$data); 
		
	}
	
	
	
	function signout()
	{
		
		$sess_array = array(
				'first_name'			=>	'',
				'last_name'			=>	'',
				'email'				=>	'',
				'id'			=>	'',
				'login'                  =>	'',
				'company_name'                  =>	'',
                'cart_items_count'		=>	'0',
                'total_price'                   =>	'0',
				'cart_data' => '',
				); 
				$this->session->set_userdata($sess_array);
				$loc = base_url()."index.php";
				header("Location:$loc");
		}	
	
	function details()
	{
		
		$pid 				= 	$this->uri->segment(2);
		$data['product']	= 	$this->admin_model->getProductDetails($pid);
		$this->load->view('product_details',$data);
		
	}
	
	function cart()
	{
		$data['cart_products']	= 	$this->cart_model->getCartProducts();
		$this->load->view('cart',$data);
		
	}
	
	function buy()
	{
		
			$pid = $this->uri->segment(2);
			$this->cart_model->add2cart($pid);
			
                        $total_products_cart 	= $this->cart_model->getTotalCartProducts();
			$total_price 		 	= $this->cart_model->getTotalCartPrice();
                        
			$this->session->set_userdata('cart_items_count',$total_products_cart);
			$this->session->set_userdata('total_price',$total_price);
                        redirect(base_url()."index.php/cart/added");
			exit();
	}
	
	function update_cart()
	{
		
		if($this->input->post('update_action')!='')
		{
			$this->cart_model->update_cart($this->input->post());
			
			$total_products_cart 	 = $this->cart_model->getTotalCartProducts();
			$total_price 		 = $this->cart_model->getTotalCartPrice();
			$this->session->set_userdata('cart_items_count',$total_products_cart);
			$this->session->set_userdata('total_price',$total_price);
			
			
			redirect(base_url()."index.php/cart");
			exit();
		}	
		
	}
	
	
	function checkout()
	{
		$this->cart_model->saveCart();
	}
	
	
	
	function register()
	{
	
		if($this->session->userdata('id')!='')
			{
				$target	=	base_url()."index.php/front/account";
				header("Location:$target");
			}
		
		else if($this->session->userdata('id')=='' && $this->input->post('register_action')!='true')
		{	
					$this->load->view('register');

		}
		
		else if ($this->input->post('register_action')=='true')
		{
				
					$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
					$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
					$this->form_validation->set_rules('login', 'Login', 'trim|required');							
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[password2]');	
					$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]');
					
						if ($this->form_validation->run() == FALSE)
						{
								$this->load->view('register');	
						}
						else
						{
							
							$this->main_model->register($this->input->post());
							
						}
            
		}
		

	}
	
	function login()
	{
            
           if($this->session->userdata('id')=='' && $this->input->post('login_action')!='true')
		{
			$this->load->view('login');	
		}
		else if ($this->input->post('login_action')=='true')
		{
			
					
                	$this->form_validation->set_rules('login', 'Login', 'trim|required');	
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|xss_clean');

						if ($this->form_validation->run() == FALSE)
						{
								$this->load->view('login');	
						}
						else
						{
							$this->main_model->check_login($this->input->post());
							
						}
            
		}
		else
		{
			$this->load->view('login');	

		}
		
		
	}
	
	function order_step2()
	{
					if($this->session->userdata('id')=='')
                                            header("Location:".base_url()."index.php/login");
                                        
                                        if($this->session->userdata('total_price')=='0')
                                            header("Location:".base_url()."index.php/user");
                                        
					else if($this->input->post('checkout_action')=='')
					{
							$data['products']		=	$this->cart_model->getCheckoutDetails();
							$this->load->view('checkout',$data);	
					}
					else if($this->input->post('checkout_action')=='true')
					{
						
						$this->form_validation->set_rules('creditcard_number', 'number', 'trim|required|numeric|exact_length[16]');
						$this->form_validation->set_rules('creditcard_month', 'month', 'trim|required|numeric|exact_length[2]|greater_than[0]|less_than[13]');
						$this->form_validation->set_rules('creditcard_year', 'year', 'trim|required|numeric|exact_length[2]|greater_than[13]');
						
						
						
						if ($this->form_validation->run() == FALSE)
						{
								$data['products']		=	$this->cart_model->getCheckoutDetails();
								$this->load->view('checkout',$data);
						}
						else
						{
							$order_id = $this->cart_model->save_order($this->input->post());
							$url = base_url()."index.php/confirm";
							header("Location:$url");
						}

						
					}
					
	}
	
	
	
	function confirm()
	{
		if($this->session->userdata('order_id')!='')
		{
                        $this->email_model->order_confirmation();
			$this->load->view('order_confirmation');
			
		}
		else
		header("Location:".base_url());
		
	}
}