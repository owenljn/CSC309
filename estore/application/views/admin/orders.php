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
				<h1 class="bar">Orders</h1>
					 <?php if($orders!='empty')
				{
					?>
			    <table id="cart">
			      <thead>

			      <tr>
			        <th>Order No</th>
			        <th>Order Date</th>
			        <th>Total Price</th>
			        <th>Actions</th>
			         </tr>
                  </thead>
			      <tbody>
                  <?php foreach($orders as $order)
				  {
					  ?>
			        <tr>
			          <td><?=$order->id;?></td>
			          <td><?=$order->order_date;?></td>
					  <td><?=$order->total;?></td>
			          
			          <td><a href="<?=base_url();?>index.php/admin/view_order/<?=$order->id;?>">View</a>
                      
					  | <a href="<?=base_url();?>index.php/admin/cancel_order/<?=$order->id;?>">Cancel Order</a>
                                          
                      <?php } ?>
                      </td>
		            </tr>
                    <?php ?>
			        
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
                                                            ?><a class="<?php if($this->uri->segment(3)==$i) echo 'active';?>" href="<?php 
                                                            echo base_url();?>index.php/admin/orders/<?=$i;?>"><?php echo $i;?></a>
                                                            
                                                          <?php } ?>  
							<a href="">&raquo;</a>
						</div>
                                           <?php } ?>       
                <?php } else echo "No Record"; ?>
	  
					</div>	
				</div>		
				<div class="clear"></div>
				<div id="footer">
			</div>
			</div>
	
	</div>
</body>
</html>