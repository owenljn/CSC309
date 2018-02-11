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
					<h1 class="bar">Register to The Baseball Cards Store</h1>
                    <?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
                <?php if($this->uri->segment(3)!='') { ?><div id="success"> Account Information is Updated!</div> <?php } ?>
				
		  <form action="<?=base_url();?>index.php/user/account" method="post" enctype="multipart/form-data" id="admin">
		  <p>
			  <label>First Name:</label>
				<input name="first_name" type="text" id="last_name" value="<?=$this->session->userdata('first_name');?>"> 
			  </p>
			  <p>
			  <label>Last Name:</label>
				<input name="last_name" type="text" id="last_name" value="<?=$this->session->userdata('last_name');?>"> 
			  </p>
			  <p>
			  <label>Email Address:</label>
				<input name="email" type="text" id="email" value="<?=$this->session->userdata('email');?>"> 
			  </p>
			  <p>
			  <label>Login:</label>
				<input name="login" type="text" id="login" value="<?=$this->session->userdata('login');?>"> 
			  </p>
			  <p>
			  <label>Password:</label>
				<input name="password" type="password" id="password" value="<?=set_value('password');?>"> 
			  </p>		
			<p>
			  <label>Confirm Password:</label>
				<input name="password2" type="password2" id="password2" value="<?=set_value('password2');?>"> 
		      <input name="register_action" type="hidden" id="register_action" value="true" />
			</p>
			
						 <input type="submit" name="submit" value="Update" />
					</form>
				
			  </div>
			  <div class="clear"></div>
			  <?php $this->load->view("footer"); ?>
	  </div>
	</div>
</body>
</html>