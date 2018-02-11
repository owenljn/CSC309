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
				  <h1 class="bar">Add New Product</h1>
                  	
					<?php if(validation_errors()) { ?><div id="errors"><?php echo validation_errors(); ?></div> <?php } ?>
                	<?php if($this->uri->segment(4)!='') { ?><div id="errors"> Sorry - Product Updation Failed</div> <?php } ?>
                    
				  <form action="<?php echo base_url();?>index.php/admin/edit_product" method="post" enctype="multipart/form-data" id="admin">
				  <p>
				      <label>Product Name:</label>
				      <input name="name" type="text" id="name"  value="<?php echo $product->name;?>"/>
			        </p>
				    <p>
				      <label>Product Description:</label>
				      <input name="description" type="text" id="description" value="<?php echo $product->description;?>"/>
			        </p>
				    <p>
				      <label>Photo Url:</label>
				      <input name="photo_url" type="text" id="photo_url" value="<?php echo $product->photo_url;?>" />
			        </p>
					<p>
				      <label>Price:</label>
				      <input name="price" type="text" id="price" value="<?php echo $product->price;?>" />
			        </p>
				    
				    <input type="submit" name="submit" value="Add Product" />
                    <input type="hidden" name="action" value="1" />
                    <input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>" />
			      </form>
			  </div>
<div class="clear"></div>
				<div id="footer">
			</div>
			</div>
	
	</div>
</body>
</html>