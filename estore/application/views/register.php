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
					<h1 class="bar">Register to The Baseball Card Store </h1>
                    <?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
                <?php if($this->uri->segment(2)!='') { ?><div id="errors"> Sorry - Email is already in use!</div> <?php } ?>
				
		  <form action="<?=base_url();?>index.php/register" method="post" enctype="multipart/form-data" id="admin">
			<p>
			  <label>First Name:</label>
				<input name="first_name" type="text" id="last_name" value="<?=set_value('first');?>"> 
			  </p>
			  <p>
			  <label>Last Name:</label>
				<input name="last_name" type="text" id="last_name" value="<?=set_value('last');?>"> 
			  </p>
			  <p>
			  <label>Email Address:</label>
				<input name="email" type="text" id="email" value="<?=set_value('email');?>"> 
			  </p>
			  <p>
			  <label>Login:</label>
				<input name="login" type="text" id="login" value="<?=set_value('login');?>"> 
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
						<input type="submit" name="submit" value="Sign Up">
					</form>
				
			  </div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html> 