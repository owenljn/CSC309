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
			<div id="content" class="checkout">
				
				<?php include("left.php"); ?>
                
				<div id="right">
                                    			<h1 class="bar">Order No: <?=$this->uri->segment(3);?></h1>
					<p>customer id: <?php echo $order->customer_id; ?></p>
					<p>Date: <?php echo $order->order_date; ?></p>
					<p>time: <?php echo $order->order_time; ?></p>
					<p>Order total: $<?php echo $order->total; ?></p>
					<p>credit card number: <?php echo $order->creditcard_number; ?></p>
					<p>credit card month: <?php echo $order->creditcard_month; ?></p>
					<p>credit card year: <?php echo $order->creditcard_year; ?></p>
					
		
				</div>		
				<div class="clear"></div>
				<div id="footer">
			</div>
			</div>
	
	</div>
</body>
</html>