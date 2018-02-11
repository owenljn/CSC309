<?php
class admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
		

		
		function check_login($options)
		{
		
			 $username		= $options['username'];
			 $password		= $options['password'];
			 if($username=="csc309A3"){
			 $data = array(
   							'login' 		=> $username,
   							'password' 		=> $password);
							
			 $result	=	$this->db->get_where('customers', $data);				
			if($result->num_rows()>0)
			{
				$row =	$result->row();

				$sess_array = array(
				'admin'			=>	$row->login,
				); 
				
				$this->session->set_userdata($sess_array);
				return 'true';
			}
			else 
			return 'failed';}
			else
			return 'failed';
		}
	
		function check_email_exists($email)
		{
			$this->db->select('*');
			$this->db->where('member_email',$email);
			$result = $this->db->get('members');
			
			if($result->num_rows()>0)
			return "1";
			else
			return "0";
			
		}
                
                
                	
				
			
			
		
		
		function getAllProducts()
		{
				$page = $this->uri->segment(3);
                                if($page=='')
                                    $page=1;
                                
                                $start = ($page-1)*RECORDS_PER_PAGE;
                                $end = RECORDS_PER_PAGE;
                                
				$this->db->select("*");
                                $this->db->limit($end,$start);
                                $this->db->order_by('id','desc');
				$result = $this->db->get('products');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
				
		}
                
                
                function getAllProductsCount()
		{
				
				$this->db->select("*");
				$result = $this->db->get('products');
				if($result->num_rows()>0)
				return $result->num_rows();
				else
				return 'empty';
				
		}
	
	
	
		
		function getProductDetails($id)
		{
				
				$this->db->select("*");
				$this->db->where('id',$id);
				$result = $this->db->get('products');
				if($result->num_rows()>0)
				return $result->row();
				else
				return 'empty';
				
		}
	
	
	
	
	function add_product($options)
		{
			$data = array(
			
			"name" 	=> $options['name'],
			"price" 	=> $options['price'],
			"description" 	=> $options['description'],
			"photo_url" 	=> $options['photo_url']
			);
		
					$this->db->insert('products',$data);
					return $this->db->insert_id();
			
		}
		
		
	function delete_product($product_id)
	{
		
		$this->db->where('id',$product_id);
		$this->db->delete('products');
		
		$url = base_url()."index.php/admin/products";
		header("Location:$url");
		
	}
	
	function update_product($options)
	{
		$item_id = $options['id'];
		$data = array(
			"id" 		=> $options['id'],
			"name" 	=> $options['name'],
			"price" 	=> $options['price'],
			"description" 	=> $options['description'],
			"photo_url" 	=> $options['photo_url']
			);
			$this->db->where('id',$item_id);
			$this->db->update('products',$data);
		
		
	}
        
        
        function getCustomerList()
		{
            $page = $this->uri->segment(3);
                                if($page=='')
                                    $page=1;
                                
                                $start = ($page-1)*RECORDS_PER_PAGE;
                                $end = RECORDS_PER_PAGE;
                                
			$this->db->select('*');
                        $this->db->limit($end,$start);
			$this->db->order_by("id","desc");
			$result = $this->db->get('customers');
			
			if($result->num_rows()>0)
			return $result->result();
			else
			return "empty";
			
		}
        
                
            function getCustomerCountt()
		{
			$this->db->select('*');
			$this->db->order_by("id","desc");
			$result = $this->db->get('customers');
			if($result->num_rows()>0)
                            return $result->num_rows();
			else
			return "empty";
			
		}
            
         function getOrderList()
		{
                                $page = $this->uri->segment(3);
                                if($page=='')
                                    $page=1;
                                
                                $start = ($page-1)*RECORDS_PER_PAGE;
                                $end = RECORDS_PER_PAGE;
                                
				$this->db->select("*");
                                $this->db->limit($end,$start);
                               
				$this->db->order_by('id','DESC');
				$result = $this->db->get('orders');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
		}
        
                
            function getOrderCount()
		{
				$this->db->select("*");
				$this->db->order_by('id','DESC');
				$result = $this->db->get('orders');
				if($result->num_rows()>0)
				return $result->num_rows();
				else
				return 'empty';
		}
             
                
          function getOrderDetails($order_id)
		{
				
				$this->db->select("*");
				$this->db->where("id",$order_id);
				$result = $this->db->get('orders');
				if($result->num_rows()>0)
				return $result->row();
				else
				return 'empty';

		}
                
           function cancel_order($order_id)
		{
			
			$this->db->where('id',$order_id);
			$this->db->delete('orders');
			$url = base_url()."index.php/admin/orders";
			header("Location:$url");
			
		}     
	function dispatch_order($order_id)
		{
			
			$this->db->where('id',$order_id);
			$this->db->delete('orders');
			$this->db->where('order_id',$order_id);
			$this->db->delete('order_items');
			$url = base_url()."index.php/admin/orders";
			header("Location:$url");
			
		}     
		      
	function getCustomerOrders($user_id)
		{
				$this->db->select("*");
                                $this->db->where('customer_id',$user_id);
				$this->db->order_by('id','DESC');
				$result = $this->db->get('orders');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
		}
                
            function getCustomerDetails($user_id)
		{
				$this->db->select("*");
                                $this->db->where('id',$user_id);
				$result = $this->db->get('customers');
				if($result->num_rows()>0)
				return $result->row();
				else
				return 'empty';
		}
                
             function delete_customer($user_id)
		{
				$this->db->select("*");
                                $this->db->where('id',$user_id);
				$this->db->delete('customers');
				header("Location:".  base_url()."index.php/admin/");
		}
                
             
        function update_customer($options)
	{
		
		$data = array(
		"first"	 	=> $options['first_name'],
		"last"	 	=> $options['last_name'],
		"email"			=> $options['email'],	
		"login" 		=> $options['login'],
		"password" 		=> $options['password']
		);
		
		$this->db->where('id',$options['customer_id']);
		$this->db->update('customers',$data);
		$this->session->set_userdata($data);
		header("Location:".base_url()."index.php/admin/cEdit/".$options['customer_id']."/success");	
		
		
	}
}