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
				<div id="breadcrumb">
					<a href="#">Our Products</a>
				</div>
				<?php include("left.php"); ?>
				<div id="right">
					<h1 class="bar"><?php echo str_replace('-',' ',$this->uri->segment(4)); ?></h1>
						
						<?php 
						$i=1;
						if($category_products!='empty')
						{
						foreach ($category_products as $product)
						{
						
							?>
							<div class="item <?php if($i%3==0) echo 'no-margin-right';?>">
							<div class="photo"><img src="<?php echo base_url().$product->medium_image;?>" alt="<?php echo $product->item_name; ?>" /></div>
							<div class="title"><a href="<?php echo base_url();?>index.php/front/details/<?php echo $product->item_id; ?>/<?php echo $product->item_name; ?>">
							<?php echo $product->item_name; ?></a></div>
							<p><span>£<?php echo $product->item_price; ?></span> per case</p>
							<div class="actions">
								<a href="<?php echo base_url();?>index.php/front/buy/<?php echo $product->item_id; ?>" class="add">Add to cart</a>
							</div>
						</div>
                        <?php $i++;
						} // end for each
						} // end if
						else  echo "Nothing Found"; 
						?>

				</div>		
				<div class="clear"></div>
				<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>