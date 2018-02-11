<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
 		$this->load->model('admin_model');
                $this->load->model('cart_model');
		$this->load->library('form_validation');
		@session_start();
		
	}

        public function index()
        {
            
            redirect(base_url()."index.php/admin/orders");
        }
	public function customers()
	{
		
                    $data['customers'] = $this->admin_model->getCustomerList();
                    $data['total']     = $this->admin_model->getCustomerCountt();
                    $this->load->view("admin/home",$data);
                
	}
	
        
	function login()
	{
            $data['logincheck'] = '1';
            $this->load->view('admin/login',$data);
		
	}
	
	
	function check_login()
	{
		$data['logincheck'] = '1';
				$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|max_length[15]');	
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[15]');
               
				if ($this->form_validation->run() == FALSE)
                {
                   
                   $this->load->view("admin/login",$data);
                }
				else 
				{
						$login	= $this->admin_model->check_login($this->input->post());	
						
						if($login == 'true')
						{
							$loc = base_url()."index.php/admin";
							header("Location:$loc");
							exit();
						}
						else
						{
							
							$loc = base_url()."index.php/admin/login/failed";
							header("Location:$loc");
								
						}		
					
					}

	}
	
	
	
	
	
		
	function signout()
	{
		
		$sess_array = array(
				'admin'			=>	'',
				); 
				
				$this->session->set_userdata($sess_array);
				$loc = base_url();
				header("Location:$loc");
		}
	
	
	
		function products()
		{
                 
            	$data['products'] = $this->admin_model->getAllProducts();
                $data['total']    = $this->admin_model->getAllProductsCount();
		$this->load->view('admin/products',$data);
		
		}
                
               	function orders()
		{
		$data['orders'] = $this->admin_model->getOrderList();
                $data['total']  = $this->admin_model->getOrderCount();
                $this->load->view('admin/orders',$data);
		
		}
                function view_order()
		{
		$data['order']                          =       $this->admin_model->getOrderDetails($this->uri->segment(3));
                
		
		
		$this->load->view('admin/order_details',$data);
		
		}
                
                function cancel_order()
                {
                   if($this->session->userdata('admin')=='')
                            redirect(base_url()."index.php/admin/login");
                    $this->admin_model->cancel_order($this->uri->segment(3));
                    
                }
                function dispatch_order()
                {
                   if($this->session->userdata('admin')=='')
                            redirect(base_url()."index.php/admin/login");
                    $this->admin_model->dispatch_order($this->uri->segment(3));
                    
                }
 

	function cInfo()
        {
            
            $data['customer'] = $this->admin_model->getCustomerDetails($this->uri->segment(3));
            $this->load->view('admin/customer_details',$data);
        }
	
        function cOrders()
        {
                    $data['orders'] = $this->admin_model->getCustomerOrders($this->uri->segment(3));
                    $this->load->view('admin/orders',$data);
        }
        
        function cEdit()
        {
         
                if($this->input->post('update_action')=='')
                {
                        $data['customer'] = $this->admin_model->getCustomerDetails($this->uri->segment(3));
                        $this->load->view('admin/edit_customer',$data);
                }
                else
                    {
                                    	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
					$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
					$this->form_validation->set_rules('login', 'Login', 'trim|required');							
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[12]');		
					
						if ($this->form_validation->run() == FALSE)
						{
                                                    $data['customer'] = $this->admin_model->getCustomerDetails($this->uri->segment(3));
                                                    $this->load->view('admin/edit_customer',$data); 
                                                }	
						
						else
                                                    $this->admin_model->update_customer($this->input->post());
							
						
	
                    }   
        }
        
        function cDelete()
        {
            if($this->session->userdata('admin')=='')
                            redirect(base_url()."index.php/admin/login");
            $this->admin_model->delete_customer($this->uri->segment(3));
        }

	

	
	function add_product()
	{			
					
							
		if($this->input->post('action')=='') $this->load->view('admin/add_product');
		else 
		{
			
				$this->form_validation->set_rules('name', 'product name', 'trim|required|min_length[3]|max_length[30]');
				$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');	
					
				$this->form_validation->set_rules('photo_url', 'Photo url', 'trim|required');	
				$this->form_validation->set_rules('description', 'description', 'trim|required');		
				
				
				if ($this->form_validation->run() == FALSE)   $this->load->view("admin/add_product");
				else 
				{
					
					$id = $this->admin_model->add_product($this->input->post());
					
					$url = base_url()."index.php/admin/products";
					header("Location:$url");
					exit();
				}
			
		}
		
	}
	
	
	function delete_product()
	{			
                        if($this->session->userdata('admin')=='')
                            redirect(base_url()."index.php/admin/login");
			$this->admin_model->delete_product($this->uri->segment(3));			
	}



	function edit_product()
	{			
							
							
		if($this->input->post('action')=='') 
		{
				$data['product'] = $this->admin_model->getProductDetails($this->uri->segment(3));	
				$this->load->view('admin/edit_product',$data);
		}
		else 
		{
			
				$this->form_validation->set_rules('name', 'product name', 'trim|required|min_length[3]|max_length[30]');
				$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');	
					
				$this->form_validation->set_rules('photo_url', 'Photo url', 'trim|required');	
				$this->form_validation->set_rules('description', 'description', 'trim|required');		
	

				if ($this->form_validation->run() == FALSE)   $this->load->view("admin/edit_product");
				else 
				{
					$this->admin_model->update_product($this->input->post());
					
					
					$url = base_url()."index.php/admin/products";
					header("Location:$url");
					exit();
					
				}
				
			
		}
	}	
}