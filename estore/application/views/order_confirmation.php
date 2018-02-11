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
					<h1 class="bar">Order Confirmatin</h1>
					<h2>Thank you very much for shopping at base ball card store</h2>
					<h2>Your Order Number is: <?php echo $this->session->userdata('order_id'); ?></h2>
					<p>You will receive an email shortly with the the order details and invoice.</p>
					<br />
					<p><strong>Note:</strong> You can track the status order from the dashboard.</p>
				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>