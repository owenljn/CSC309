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
                    <p>You must be logged in in order to checkout</p>
                    <?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
                <?php if($this->uri->segment(2)=='failed') { ?><div id="errors"> Sorry - Invalid Username/Password</div> <?php } ?>
				
		  <form action="<?=base_url();?>index.php/login" method="post" enctype="multipart/form-data" id="login">
					<p>
						<label>Login:</label>
						<input type="text" name="login" value="<?=set_value('username');?>"> 
				</p>
			<p>
			  <label>Password:</label>
				<input type="password" name="password" value="<?=set_value('password');?>"> 

		      <input name="login_action" type="hidden" id="login_action" value="true" />
			  </p>
				<p>
					<input type="submit" value="Login">
		    <p>Don't have an account? <a href="<?=base_url();?>index.php/register">Click here to register</a></p>
				</form>
				
			  </div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>