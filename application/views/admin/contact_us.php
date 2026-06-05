<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">  


var map;

function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var myOptions = {
    zoom: 14,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);    
var address = 'B10 0BL';
arr_pcode =new Array();
arr_pcode = Array('B10 0BL');
for(var i=0;i<arr_pcode.length;i++)
	{
		var address = arr_pcode[i];

		geocoder.geocode({'address': address}, function(results, status) {
				  if (status == google.maps.GeocoderStatus.OK) {
					 map.setCenter(results[0].geometry.location);
					 var marker = new google.maps.Marker({
						  map: map, 
						  position: results[0].geometry.location
					 });
				  } else {
					 		//alert("Geocode was not successful for the following reason: " + status);
				  }
				}); 

	}

 }  
</script>
<style>
.valid_box{
	width:85%;
}
.error_box{
	width:85%;
}
.contact_leftsec{
	width:446px;
}
.contact_mainsec{
	width:100%;

}
.cont_form{
width:100%;

}
</style>
<?php

//getting the contact address ans other information
$tbl_name="exp_tbl_contact_address";
$contact_array = $this->common_model->get_all_list($tbl_name);
//debug($contact_array);

//getting all countries
$tblname="exp_tbl_countries";
$CI=&get_Instance();
$CI->load->model("admin/common_model");
$country=$CI->common_model->get_all_list($tblname);
//debug($result);

?>
	<div id="center_con">
		<div class="center1">
		<div class="contact_leftsec" style="width:618px !important;">
				
				<div class="breadcrumbs">
					<ul>
						<li><a title="Go to Home Page" href="#">Home</a> &nbsp;<span>></span>&nbsp; </li>
						<li><strong><?php if(!empty($title)) { echo $title;}  ?></strong></li>
					</ul>
				</div>
				<div class="contact_mainsec">
					<h1>Contact</h1>
					
					<?php
						   if($this->session->userdata("error_box"))
						   {
									echo '<div class="error_box">';
									echo $this->session->userdata("success_message");
									echo '</div>';
									$this->session->unset_userdata("success_message");
									$this->session->unset_userdata("error_box");
						   
						   }
						   
						   
						   
							if($this->session->userdata("valid_box"))
						   {
									echo '<div class="valid_box">';
									echo $this->session->userdata("success_message");
									echo '</div>';
									$this->session->unset_userdata("success_message");
									$this->session->unset_userdata("valid_box");
						   
						   }
						   
						   
					?>
					
					<form name="contact_form" id="contact_form" method="POST" action="<?php  echo base_url(); ?>contact/save">
					<table class="cont_form">
					<tr>
						<td class="cont_textfield">
							Department:
						</td>
						<td class="cont_selectfield">
							<select  name="dept">
								<option value="">select department</option>
								<option value="a">dept1</option>
								<option value="b">dept2</option>
								<option value="c">dept3</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="height:4px;">
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td class="cont_textfield">
							Your Name:
						</td>
						<td class="cont_inputfield">
							<input type="text" name="name">
						</td>
					</tr>
					<tr>
						<td style="height:4px;">
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td class="cont_textfield">
							Mobile:
						</td>
						<td class="cont_inputfield">
							<input type="text" name="mobile">
						</td>
					</tr>
					<tr>
						<td style="height:4px;">
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td class="cont_textfield">
							Email:
						</td>
						<td class="cont_inputfield">
							<input type="text" name="email">
						</td>
					</tr>
					<tr>
						<td style="height:4px;">
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td style="vertical-align:top;" class="cont_textfield">
							Your Enquiry:
						</td>
						<td>
							<textarea class="cont_textarea" name="enquiry"></textarea>
						</td>
					</tr>
					<tr>
						<td style="height:5px;">
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input type="image" src="<?php echo base_url(); ?>images/submitbtn.png" alt="">
						</td>
					</tr>
					</table>
					</form>
				</div>
			</div>
			<div class="contact_rightsec" style="width:351px !important;">
				<p>
						<?php 
							if(!empty($contact_array[0]['heading']))
							{
								echo $contact_array[0]['heading'];
							}
						?>
				</p>
				<p>
					<strong>Customer Service Opening Hours:</strong><br/>
						<?php 
							if(!empty($contact_array[0]['opening_hours']))
							{
								echo $contact_array[0]['opening_hours'];
							}
						?>
				</p>
				<p>
					<strong>Address</strong><br/>
					<?php 
							if(!empty($contact_array[0]['address']))
							{
								echo $contact_array[0]['address'];
							}
					?>
					
						
					
				</p>
				<p>
					<strong>Tel:</strong> 
							<?php 
							if(!empty($contact_array[0]['tel']))
							{
								echo $contact_array[0]['tel'];
							}
							?>
				</p>
				<p>
					<strong>Fax:</strong> 
							<?php 
							if(!empty($contact_array[0]['fax']))
							{
								echo $contact_array[0]['fax'];
							}
							?>
				</p>
				<p>
					<strong>E-Mail:</strong>
						<?php 
							if(!empty($contact_array[0]['email']))
							{
								echo $contact_array[0]['email'];
							}
							?>
				</p>
				<span id="map_canvas" style="width:300px; height:301px"></span>
			</div>
	</div>
</div>
