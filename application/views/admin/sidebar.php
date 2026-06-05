<div class="left_content">
	<div class="sidebar_search">
		<form>
			<input type="text" name="" id="search_input" placeholder="Search keyword" style="background:#D2E7F0;margin:5px 0 0 5px;"/>
			<input type="image" class="search_submit" src="<?php echo base_url ()?>images/admin/search.png" />
		</form>
	</div>
	<div class="sidebarmenu">
		<a class="menuitem submenuheader" href="javascript:void(0)">Manage Products</a>
		<div class="submenu">
			<ul>
				<li><a href="<?php echo base_url(); ?>admin/products/manage_products" title="">All Products</a></li>
				<li><a href="<?php echo base_url(); ?>admin/sub_products/manage_subproducts" title="">Sub Products</a></li>
				<li><a href="<?php echo base_url(); ?>admin/assign_attributes" title="">Assign Attributes</a></li>
				<li><a href="<?php echo base_url(); ?>admin/pricing/manage_price" title="">Assign Prices</a></li>
				
			</ul>
		</div>
		
				<a class="menuitem submenuheader" href="javascript:void(0)">Manage Attributes</a>
				<div class="submenu">
					<ul>
						<li><a href="<?php echo base_url(); ?>admin/attributes/manage_attributes" title="">All Attributes</a></li>
						<li><a href="<?php echo base_url(); ?>admin/values/manage_values" title="">All Attribute Values</a></li>
					
					</ul>
				</div>
	
		<a class="menuitem submenuheader" href="">Manage Orders</a>
		<div class="submenu">
			<ul>
				<li><a href="<?php echo base_url();?>admin/order">All Orders</a></li>
				
			</ul>
		</div>
		<a class="menuitem submenuheader" href="">Manage Users</a>
		<div class="submenu">
			<ul>
				<li><a href="<?php  echo base_url();?>admin/users">All Users</a></li>
		
			</ul>
		</div>
		
		<a class="menuitem submenuheader" href="">Manage Templetes</a>
		<div class="submenu">
			<ul>
				
				<li><a href="<?php echo base_url(); ?>admin/template/manage_template_options" title="">Template Options Name</a></li>
				<li><a href="<?php echo base_url(); ?>admin/template/manage_template_options_attributes" title="">Template Options Attrib.</a></li>
			<li><a href="<?php echo base_url(); ?>admin/template/manage_turnaround_time" title="">Manage Turnaround time</a></li>
			

			
			</ul>
		</div>
		
		<a class="menuitem submenuheader" href="">Manage Right Sidebar</a>
		<div class="submenu">
			<ul>
				
				<li><a href="<?php echo base_url(); ?>admin/right_sidebar/edit_sidebar/1" title="">Right Sidebar 1</a></li>
				<li><a href="<?php echo base_url(); ?>admin/right_sidebar/edit_sidebar/2" title="">Right Sidebar 2</a></li>
				<li><a href="<?php echo base_url(); ?>admin/right_sidebar/edit_sidebar/3" title="">Right Sidebar 3</a></li>
	
			</ul>
		</div>
		<a class="menuitem submenuheader" href="">Manage Contact Us Page</a>
		<div class="submenu">
			<ul>				
				<li><a href="<?php echo base_url(); ?>admin/copyservice/change_contact_address" title="">Contact Us Page</a></li>
				<li><a href="<?php echo base_url(); ?>admin/copyservice/list_contact_us" title="">Contact Us List</a></li>
			</ul>
		</div>		

		<a class="menuitem submenuheader" href="">Others</a>
		<div class="submenu">
			<ul>
				<li><a href="<?php  echo base_url();?>admin/common/manage_quantities">Manage Quantities</a></li>

				<li><a href="<?php  echo base_url();?>admin/common/manage_sizes">Manage Sizes</a></li>
		
			</ul>
		</div>
	</div>
</div>
