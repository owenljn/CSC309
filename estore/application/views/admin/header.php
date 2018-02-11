<?php
//if($this->session->userdata('admin')=='')
   // header("Location:".base_url()."index.php/admin/");
?>
<div id="header">
				<div id="logo">
					<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" alt="The Baseball Cards Store" /></a>
				</div>
			</div>
			<div id="menu">
				<ul>
					
                    <?php if($this->session->userdata('admin')!='')
					{
					?>
                    <li><a href="<?php echo base_url();?>index.php/admin/signout">Signout</a></li>
                    <?php } ?>
				</ul>
			</div>