<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" type="text/css">
	</head>
<body>
	<div id="wrapper">
			<?php include("header.php"); ?>
			<div id="content">
				
				<div id="right">
					<h1 class="bar">Your Shopping Basket</h1>
                    <?php 
					
					if($cart_products!='empty')
					{
                        			?>
                                      <?php if($this->uri->segment(2)=='added')
                                      {
                                          ?>
                                        <div id="success"> Product is added to the cart</div>
                                            
                                        <?php
                                      }
                                      ?>
					<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/front/update_cart">
					<table id="cart">
						<thead>
							
							<th>Product</th>
							<th class="qty-column">Qty</th>
							<th>Price</th>
							
						</thead>
						<tbody>
                        <?php 
						$total_price = 0;
						foreach($cart_products as $product)
						{
							$total_price += intval($product["item_quantity"])*intval($product["item_price"]);//$product->item_total_price;
								
							?>
                            <input type="hidden" name="items[]" value="<?php echo $product["item_id"];?>" />
 							<tr>
								
								<td><?php echo $product["item_name"];?></td>
								
								<td><input type="text" name="qty[]" value="<?php echo $product["item_quantity"];?>"</td>
								<td>$ <?php echo number_format($product["item_price"],2);?></td>
								
							</tr>
                          <?php } ?>  
							
							<tr>
								<td colspan="1" class="hidden"></td>
								<td><strong>Sub Total</strong></td>
								<td>$<?php echo number_format($total_price,2); ?></td>
							<tr>
							<tr>
								<td colspan="1" class="hidden"></td>
								<td><strong>TAX (13%)</strong></td>
								<td>$<?php $tax = ($total_price*(0.1316)); echo number_format($tax,2);?></td>
							<tr>
							<tr>
								<td colspan="1" class="hidden"></td>
								<td><strong>Total</strong></td>
								<td>$<?php 
								$total_price = $total_price + $tax; 
								$this->session->set_userdata('total_price',$total_price);
								echo number_format($total_price,2);
								?></td>
							<tr>
						</tbody>
					</table>
					<div id="actions">
						<a style="float:right;" href="<?php echo base_url();?>index.php/checkout">Checkout</a>
					 <input type="submit" name="submit" value="Update Cart">
                     <input type="hidden" name="update_action" value="1"  />
					</div>
					</form> 
                    <?php } 
					else echo ' Sorry - Cart is empty';?>
				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>