<?php
class cart_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
		function getCartProducts()
		{
				if($this->session->userdata('cart_data')!='')
				{
				
				$result = $this->session->userdata('cart_data');
				
				return $result;
				}
				else
				return 'empty';
				
		}
		
		function getCheckoutDetails()
		{
				if($this->session->userdata('cart_data')!='')
				{
				
				$result = $this->session->userdata('cart_data');
				return $result;
				}
				else
				return 'empty';
				
		}
		
		function save_order($options)
		{
				
			$data = array(
			"customer_id" 		=>	$this->session->userdata('id'),
            "order_date"            =>      date("Y-m-d"),
			"order_time"  	=> date("H:i:s"),
			"creditcard_number" => $options['creditcard_number'],
			"creditcard_month" => $options['creditcard_month'],
			"creditcard_year" => $options['creditcard_year'],
			"total"		=>	$options['total_price']
			
			);
			
			$this->db->insert('orders',$data);			
			$this->session->set_userdata('order_id',$this->db->insert_id());
			if($this->session->userdata('cart_data')!='')
				{
				$result = $this->session->userdata('cart_data');
				foreach($result as $it){
				
				$dat = array(
				"order_id" => $this->session->userdata('order_id'),
				"product_id" => $it["item_id"],
				"quantity" => $it["item_quantity"]
				);
				$this->db->insert('order_items',$dat);	
				}
				
				}
                        $this->update_cart_order();
						
		}
		
		function update_cart_order()
                {
                    
                    $this->session->set_userdata('cart_data','');
                    $this->session->set_userdata('cart_items_count','');
                    $this->session->set_userdata('total_price','');
                    
                }
		
		
		
		function add2cart($pid)
		{   
		
			
                                $product_exists = $this->checkProductInCart($pid);
				
				if($product_exists=='No')
					$this->add_product_in_cart($pid);	
				else
					
                                {
                                          $qty = $this->get_cart_product_quantity($pid);
                                          $this->update_quantity_in_cart($pid,($qty+1));
                                }
				
		}
                
                function get_cart_product_quantity($pid)
		{
			foreach ($this->session->userdata('cart_data') as $cart_itm) //loop through session array
			{				
					if($cart_itm["item_id"]==$pid)
					return $cart_itm["item_quantity"];				
			}
			return 0;

		}
		
                
		
		function checkProductInCart($pid)
		{
			foreach ($this->session->userdata('cart_data') as $cart_itm) //loop through session array
			{				
					if($cart_itm["item_id"]==$pid)
					return "YES";				
			}
			
			return "No";

		}
		
		function add_product_in_cart($pid)
		{
			
			$product = $this->admin_model->getProductDetails($pid);
			$data = array(array(
			'item_id' => $product->id,
			'item_price' => $product->price,
			'item_name' => $product->name,
			'item_quantity' => '1'
			));
			if($this->session->userdata('cart_data')!=''){
			foreach ($this->session->userdata('cart_data') as $cart_itm) //loop through session array
			{
				
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$new_product[] = array(
					'item_id'=>$cart_itm["item_id"],
					'item_price'=>$cart_itm["item_price"],
					'item_name'=>$cart_itm["item_name"],
					'item_quantity'=>$cart_itm["item_quantity"]);
				
			}
			
			//$dat=$this->session->userdata('cart_data');
			//array_push($dat,$data);
			$this->session->set_userdata('cart_data',array_merge($new_product, $data));}
			else{
			$this->session->set_userdata('cart_data',$data);}
			$this->updatepq();
		}
			
		function getTotalCartProducts()
		{
			if ($this->session->userdata('cart_items_count')!='')
			return $this->session->userdata('cart_items_count');
			else
			return "0";
		}
		function getTotalCartPrice()
		{
			if ($this->session->userdata('total_price')!='')
			return $this->session->userdata('total_price');
			else
			return "0";
		}
		
		
		function update_cart($options)
		{
			
			$items 	= 	$options['items'];
			$qty 	=	$options['qty'];
			
				for($i=0;$i<sizeof($items); $i++)
				{
                                    if($qty[$i]>=0)
                                    {
					if($qty[$i]=='0')
					$this->remove_product_from_cart($items[$i]);
					else
					$this->update_quantity_in_cart($items[$i],$qty[$i]);
                                    }      
				}
			
		}
		
		function remove_product_from_cart($pid)
		{
			foreach ($this->session->userdata('cart_data') as $cart_itm) //loop through session array
			{
				
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					if($cart_itm["item_id"]!=$pid){
					$new_product[] = array(
					'item_id'=>$cart_itm["item_id"],
					'item_price'=>$cart_itm["item_price"],
					'item_name'=>$cart_itm["item_name"],
					'item_quantity'=>$cart_itm["item_quantity"]);
					}
					
					
				
			}
			$this->session->set_userdata('cart_data',$new_product);
			
			
			
			$this->updatepq();
		}
		
		function update_quantity_in_cart($item_id,$qty)
		{
			foreach ($this->session->userdata('cart_data') as $cart_itm) //loop through session array
			{
				
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					if($cart_itm["item_id"]!=$item_id){
					$new_product[] = array(
					'item_id'=>$cart_itm["item_id"],
					'item_price'=>$cart_itm["item_price"],
					'item_name'=>$cart_itm["item_name"],
					'item_quantity'=>$cart_itm["item_quantity"]);
					}
					else{
					$new_product[] = array(
					'item_id'=>$cart_itm["item_id"],
					'item_price'=>$cart_itm["item_price"],
					'item_name'=>$cart_itm["item_name"],
					'item_quantity'=>$qty);
					}
					}
					
				$this->session->set_userdata('cart_data',$new_product);
			
			
			
			$this->updatepq();	
				
			}
		
		
		function saveCart()
		{
			
			if($this->session->userdata('cart_data')=='')
                        header("Location:".base_url());
							  
			
			
                        if($this->session->userdata('id')=='')
                            $url = base_url()."index.php/login";
                        else
                            $url = base_url()."index.php/order_step2";
                        
			header("Location:$url");
			
		}
		
		function getUserOrders()
		{
				$this->db->select("*");
				$this->db->where("customer_id",$this->session->userdata('id'));
				$this->db->order_by('id','DESC');
				$result = $this->db->get('orders');
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
		}
		
		function getOrderDetails($order_id)
		{
				
				$this->db->select("*");
				$this->db->where("customer_id",$this->session->userdata('id'));
				$this->db->where("id",$order_id);
				$result = $this->db->get('orders');
				if($result->num_rows()>0)
				return $result->row();
				else
				return 'empty';

		}
		
		function getOrderitemDetails($order_id)
		{
			$this->db->select('order_items.quantity');
    		$this->db->select('products.name, products.price');
    		$this->db->from('order_items,products');
    		$this->db->where('order_items.order_id', $order_id);
    		$where = 'products.id = order_items.product_id';
    		$this->db->where($where);
    		$result = $this->db->get();
				if($result->num_rows()>0)
				return $result->result();
				else
				return 'empty';
		}
		
		
		
		function getOrderProducts($cart_session)
		{
			
				if($this->session->userdata('cart_data')!='')
				{
				
				$result = $this->session->userdata('cart_data');
				return $result;
				}
				else
				return 'empty';
		}
		
		function cancel_order($order_id)
		{
			
			$this->db->where('customer_id',$this->session->userdata('id'));	
			$this->db->where('id',$order_id);
			
			$this->db->delete('orders');
			$url = base_url()."index.php/user";
			header("Location:$url");
			
		}

		function updatepq()
		{
		$price=0;
		$qty=0;
		foreach ($this->session->userdata('cart_data') as $cart_itm) //loop through session array
			{
				
					$price+=intval($cart_itm["item_price"])*intval($cart_itm["item_quantity"]);
					$qty+=intval($cart_itm["item_quantity"]);				
				
			}
			$this->session->set_userdata('cart_items_count',$qty);
                    $this->session->set_userdata('total_price',$price);
		}

}