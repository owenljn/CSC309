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
					<h1 class="bar">Checkout</h1>
                    <?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
					<form action="<?=base_url();?>index.php/front/order_step2" method="post" enctype="multipart/form-data" id="admin">
						<h2>Payment Details</h2>

						<p>
							<label>CreditCard Number:</label>
							<input name="creditcard_number" type="text" id="creditcard_number" value="<?=set_value('credit card number');?>"> 
							</p>
							<p>
							<label>CreditCard month:</label>
							<input name="creditcard_month" type="text" id="creditcard_month" value="<?=set_value('credit card month');?>"> 
							</p>
							<label>CreditCard year:</label>
							<input name="creditcard_year" type="text" id="creditcard_year" value="<?=set_value('credit card year');?>"> 
							</p>
						
					<br />
					<h2>Order Summary</h2>
                    <?php
					if($products!='empty')
					{
					?>
					<table id="cart">
						<thead>
							<th>Product</th>
							<th class="qty-column">Qty</th>
							<th>Price</th>
							<th>Total</th>
						</thead>
						<tbody>
                        <?php 
						$total_price	=	0;
						foreach($products as $product) {	
						$total_price += intval($product["item_quantity"])*intval($product["item_price"]);
						?>
							<tr>
								<td><?=$product["item_name"];?></td>
								<td><?=$product["item_quantity"];?></td>
								<td>$<?=number_format($product["item_price"],2);?></td>
								<td>$<?=number_format($product["item_price"]*$product["item_quantity"],2);?></td>
							</tr>
                          <?php } ?>  
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>Sub Total</strong></td>
								<td>$<?=number_format($total_price,2);?></td>
							<tr>
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>TAX (13%)</strong></td>
								<td>$<?php $tax = ($total_price*(0.1316)); echo number_format($tax,2);?></td>
							<tr>
							<tr>
								<td colspan="2" class="hidden"></td>
								<td><strong>Total</strong></td>
								<td>$<?=number_format(($total_price+$tax),2);?></td>
							<tr>
						</tbody>
					</table>
                    <?php } 
					else header("Location:".base_url()); ?>
					<input name="tax" type="hidden" id="tax" value="<?=$tax;?>" />
                    <input name="sub_total" type="hidden" id="sub_total" value="<?=$total_price;?>" />
                    <input name="total_price" type="hidden" id="total_price" value="<?=$total_price+$tax;?>" />
                    <input name="checkout_action" type="hidden" id="checkout_action" value="true" />
<br />
					<input type="submit" value="Send Order">
					</form>
				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>