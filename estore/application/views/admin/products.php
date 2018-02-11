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
					<h1 class="bar">Products<a  style="float:right;" href="<?php echo base_url();?>index.php/admin/add_product">Add New Product</a></h1>
                    <?php if($products=='empty')
					echo " Sorry - No Products Found";
					else
					{
						?>
					<table id="cart">
						<thead>
							<th class="thumb-column">Pic</th>
							<th>Title</th>
							<th>Stock</th>
							<th>Price</th>
							<th>Actions</th>
						</thead>
						<tbody>
                        <?php foreach($products as $product)
						{
							?>
							<tr>
								<td><img src="<?php echo base_url();?>images/<?php echo $product->photo_url;?>.jpg" alt="<?php echo $product->name;?>" height="20" width="17"/></td>
								<td><?php echo $product->name;?></td>
								<td><?php echo "unlimited";?></td>
								<td>$<?php echo $product->price;?></td>
								<td><a href="<?php echo base_url();?>">Veiw</a> | 
                                <a href="<?php echo base_url();?>index.php/admin/edit_product/<?php echo $product->id;?>">Edit</a> | 
                                <a href="<?php echo base_url();?>index.php/admin/delete_product/<?php echo $product->id;?>">Delete</a></td>
							</tr>
                            <?php } ?>
							
						</tbody>
					</table>
                                        <?php 
                                        if($total>RECORDS_PER_PAGE)
                                        {
                                        $pages = ceil($total/RECORDS_PER_PAGE);
                                        
                                        ?>
					<div id="actions">
						<div id="pagination">
							<a href="">&laquo;</a>
							<?php for($i=1; $i<=$pages;$i++)
                                                        {
                                                            ?><a class="<?php if($this->uri->segment(3)==$i) echo 'active';?>" href="<?php echo base_url();?>index.php/admin/products/<?=$i;?>"><?php echo $i;?></a>
                                                            
                                                          <?php } ?>  
							<a href="">&raquo;</a>
						</div>
                                           <?php } ?> 
                        	<?php } ?>
					</div>
				</div>
<div class="clear"></div>
			<?php include("footer.php"); ?>
			</div>
	
	</div>
</body>
</html>