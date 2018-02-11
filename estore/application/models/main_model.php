<?php
class main_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
		
		
		function getLatestProducts()
		{
				
				$this->db->select("*");
				$this->db->limit(5,0);
				$this->db->order_by('id','DESC');
				$result = $this->db->get('products');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
				
		}	
		

		
		function check_login($options)
		{
				
				
				$this->db->select("*");
				$this->db->where("login",$options['login']);
				$this->db->where("password",$options['password']);
				$result = $this->db->get('customers');
				if($result->num_rows()>0)
				{
				$row = $result->row();
						
						$sess_array = array(
						"first_name"             =>      $row->first,
						"email" 		=>	$row->email,
						"last_name"  	=>	$row->last,
						"login"          =>	$row->login,
						"id"		=>	$row->id);
						
						$this->session->set_userdata($sess_array);
						if($this->session->userdata('total_price')!='')
                                                $url = base_url()."index.php/order_step2";
                                                else
                                                $url = base_url()."index.php/user";    
						header("Location:$url");
						exit();
				}
				else
				{
					$url = base_url()."index.php/login/failed";
					header("Location:$url");
					exit();
				}
				
		}
		
	function register($options)
	{
		
		$data = array(
		"first"	 	=> $options['first_name'],
		"last"	 	=> $options['last_name'],
		"email"			=> $options['email'],	
		
		"login" 		=> $options['login'],
		"password" 		=> $options['password'],
		);
		
		$email_exist = $this->check_if_email_exists($options['email']);
		$login_exist = $this->check_if_login_exists($options['login']);
		if($email_exist=='0' && $login_exist=='0')
		{
			
			$this->db->insert('customers',$data);
						
			$this->session->set_userdata($data);
			$this->session->set_userdata('id',$this->db->insert_id());
			$url = base_url()."index.php/order_step2";
			header("Location:$url");

		}
		else
		{
				$url = base_url()."index.php/register/failed";
				header("Location:$url");
				
		}
		
	}
	
	function check_if_email_exists($email)
	{
		
				$this->db->select("*");
				$this->db->where("email",$email);
				$result = $this->db->get('customers');
				if($result->num_rows()>0)
				return "1";
				else
				return "0";
	}

	function check_if_login_exists($login)
	{
		
				$this->db->select("*");
				$this->db->where("login",$login);
				$result = $this->db->get('customers');
				if($result->num_rows()>0)
				return "1";
				else
				return "0";
	}
	
	
	function update_user($options)
	{
		if($_POST['password']!='')
		$data = array(
		"first_name"	 	=> $options['first_name'],
		"last_name"	 	=> $options['last_name'],
		"email"			=> $options['email'],	
		"login" 		=> $options['login'],
		"password" 		=> $options['password']
		);
		else
		$data = array(
		"first_name"	 	=> $options['first_name'],
		"last_name"	 	=> $options['last_name'],
		"email"			=> $options['email'],	
		"login" 		=> $options['login']);
		
		$this->db->where('id',$this->session->userdata('id'));
		$this->db->update('customers',$data);
		$this->session->set_userdata($data);
		header("Location:".base_url()."index.php/user/account/success");	
		
		
	}
}