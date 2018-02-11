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
				<h1 class="bar">Login to Admin Area</h1>
                <?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
                <?php if($this->uri->segment(3)!='') { ?><div id="errors"> Sorry - Invalid Username/Password</div> <?php } ?>
				<form id="login" method="post" action="<?php echo base_url();?>index.php/admin/check_login">
					<p>
						<label>Username:</label>
						<input type="text" name="username" value="<?=set_value('username');?>"> 
					</p>
	  <p>
						<label>Password:</label>
		  <input type="password" name="password" value="<?=set_value('password');?>"> 

		</p>
					<p>
						<input type="submit" value="Login">
					<p>
				</form>
				<div class="clear"></div>
				<?php include("footer.php");?>
			</div>
	
	</div>
</body>
</html>