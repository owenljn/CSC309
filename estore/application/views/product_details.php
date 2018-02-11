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
					<div id="product-left">
						<img src="<?php echo base_url();?>images/<?php echo $product->photo_url;?>.jpg" alt="<?php echo $product->name; ?>" height="220" width="220"/>
					</div>
					<div id="product-right">
						<h1><?php echo $product->name;?></h1>
						<p><span class="large">$<?php echo number_format($product->price,2);?></span> per card</p><br />
						
						<div id="description">
							<p><?php echo $product->description;?></p>
						</div>
						<div id="actions">
							<a href="<?php echo base_url();?>index.php/buy/<?php echo $product->id; ?>" class="add">Add to cart</a>
						</div>
					</div>
				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>