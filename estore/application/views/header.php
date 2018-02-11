<div id="header">
				<div id="logo">
					<a href="<?php echo base_url();?>index.php/"><img src="<?php echo base_url();?>images/logo.png" alt="Galaxy Wines Ltd." /></a>
				</div>
				<div id="summary">
					<div id="summary-details">
						<!-- <h2>Shopping Basket</h2> -->
						<?php if($this->session->userdata('cart_items_count')=='')	{ ?>	
	                    <p>0 Item(s) - $0.00</p>
						<?php } else { ?>
	               
	                    <p><?php echo $this->session->userdata('cart_items_count'); ?> Item(s) - $<?php echo number_format($this->session->userdata('total_price'),2);?></p>
	                        <?php } ?>	
							
						<br />
						<a href="<?php echo base_url();?>index.php/cart">View Cart</a>
					</div>
				</div>
			</div>
			<div id="menu">
				<ul>
					<li><a href="<?=base_url();?>index.php">Home</a></li>
					
                    <?php
					if($this->session->userdata('id')=='')
					{
						?>
					<li><a href="<?=base_url();?>index.php/login">Login</a></li>
                    <?php }
					else
					{
					 ?>
                     <li><a href="<?=base_url();?>index.php/user/">Dashboard</a></li> 
                    <li><a href="<?=base_url();?>index.php/signout">Signout</a></li> 
                     <?php } ?>
					
				</ul>
			</div>