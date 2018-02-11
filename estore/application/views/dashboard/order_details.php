<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type="text/css">
	</head>
<body>
	<div id="wrapper">
			<?php $this->load->view("header"); ?>
	  <div id="content" class="checkout">
			  
			  <div id="left">
			    <h1 class="bar">Customer Dashboard</h1>
			    <ul id="cats">
			      <li><a href="<?=base_url();?>index.php/user">My Orders</a></li>
			      <li><a href="<?=base_url();?>index.php/user/account">Update My Details</a></li>
		        </ul>
	    </div>
			  <div id="right">
					<h1 class="bar">Order No: <?=$this->uri->segment(3);?></h1>
					
					<p>customer id: <?php echo $order->customer_id; ?></p>
					<p>Date: <?php echo $order->order_date; ?></p>
					<p>time: <?php echo $order->order_time; ?></p>
					<p>Order total: $<?php echo $order->total; ?></p>
					<p>credit card number: <?php echo $order->creditcard_number; ?></p>
					<p>credit card month: <?php echo $order->creditcard_month; ?></p>
					<p>credit card year: <?php echo $order->creditcard_year; ?></p>
					<table id="cart">
						<thead>
							
							<th>Product</th>
							<th class="qty-column">Qty</th>
							<th>Price</th>
							<th>Total</th>
						</thead>
						<tbody>
                        <?php 
						//var_dump($test1);
						$total_price = 0;
						foreach($order_details as $product)
						{
							
							$total_price += intval($product->price) * intval($product->quantity);
								
							?>
                            
 							<tr>
								
								<td><?php echo $product->name;?></td>
								<td><?php echo $product->quantity;?></td>
								<td>£ <?php echo number_format($product->price,2);?></td>
								<td>£ <?php echo number_format((intval($product->price) * intval($product->quantity)),2);?></td>
							</tr>
                          <?php } ?>  
							
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>Sub Total</strong></td>
								<td>£<?php echo number_format($total_price,2); ?></td>
							<tr>
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>TAX (13%)</strong></td>
								<td>£<?php $tax = ($total_price*(0.1316)); echo number_format($tax,2);?></td>
							<tr>
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>Total</strong></td>
								<td>£<?php 
								$total_price = $total_price + $tax; 
								
								echo number_format($total_price,2);
								?></td>
							<tr>
						</tbody>
					</table>
				</div>
			  <div class="clear"></div>
			  <?php $this->load->view("footer"); ?>
	  </div>
	</div>
</body>
</html>