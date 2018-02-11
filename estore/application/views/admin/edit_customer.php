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
				<div id="breadcrumb">
					<a href="#">Our Products</a>
				</div>
				<?php include("left.php"); ?>
				<div id="right">
				  <h1 class="bar">Update Customer Details</h1>
                  	
			<?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
                	<?php if($this->uri->segment(4)=='success') { ?><div id="success"> Information Saved</div> <?php } ?>
                         <form action="<?=base_url();?>index.php/admin/cEdit/<?php echo $this->uri->segment(3);?>" method="post" enctype="multipart/form-data" id="admin">
						 <p>
			  <label>First Name:</label>
				<input name="first_name" type="text" id="last_name" value="<?php echo $customer->first;?>"> 
			  </p>
			  <p>
			  <label>Last Name:</label>
				<input name="last_name" type="text" id="last_name" value="<?php echo $customer->last;?>"> 
			  </p>
			  <p>
			  <label>Email Address:</label>
				<input name="email" type="text" id="email" value="<?php echo $customer->email;?>"> 
			  </p>
			  <p>
			  <label>Login:</label>
				<input name="login" type="text" id="login" value="<?php echo $customer->login;?>"> 
			  </p>
			  <p>
			  <label>Password:</label>
				<input name="password" type="password" id="password" value="<?php echo $customer->password;?>"> 
			  </p>		
			
			
                        <input name="update_action" type="hidden" id="update_action" value="true" />
                        <input name="customer_id" type="hidden" id="customer_id" value="<?php echo $this->uri->segment(3);?>" />
			</p>
                         <input type="submit" name="submit" value="Update Account" />
			</form>
				
	
				  
			  </div>
<div class="clear"></div>
				<div id="footer">
			</div>
			</div>
	
	</div>
</body>
</html>