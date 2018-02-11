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
					<h1 class="bar">Cards</h1>
					<?php 
						$i=1;
						foreach ($all_products as $product)
						{
						
							?>
							<div class="item <?php if($i%3==0) echo 'no-margin-right';?>">
							<div class="photo"><img src="<?php echo base_url();?>images/<?php echo $product->photo_url;?>.jpg" alt="<?php echo $product->name; ?>" height="220" width="220" /></div>
							<div class="title"><a href="<?php echo base_url();?>index.php/details/<?php echo $product->id; ?>/<?php echo strtolower(url_title($product->name)); ?>">
							<?php echo $product->name; ?></a></div>
							<p><span>$<?php echo $product->price; ?></span> per card</p>
							<div class="actions">
								<a href="<?php echo base_url();?>index.php/buy/<?php echo $product->id; ?>" class="add">Add to cart</a>
							</div>
						</div>
                        <?php $i++;} ?>
						
						

				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>