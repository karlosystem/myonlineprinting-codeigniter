<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends CI_Controller
{

	public function __construct() 
	{
			parent::__construct();
			$this->load->model("users_model");
			$this->load->model("template_model");
			$this->load->model("admin/common_model");
		
	}
	
	public function template_designs()
	{
		$data["title"]="Template Designs";
		$data['description_header_page'] = "Template Designs";
		$data['keywords_header_page'] = "Template Designs";

		$this->load->view("header",$data);
		$this->load->view("template_design");
		$this->load->view("footer");		
	}
	
	public function more_template_details()
	{
		$data["title"]="Template Details";
		$data['description_header_page'] = "Template Designs";
		$data['keywords_header_page'] = "Template Designs";

		$this->load->view("header",$data);
		$this->load->view("more_template_details");
		$this->load->view("footer");
	}
	
	public function get_templates()
	{
			$type=$this->input->post('type');
			$size=$this->input->post('size');
			$style=$this->input->post('style');
			$colour=$this->input->post('colour');
			$all_saved_design= count($this->template_model->get_all_saved_design());
			
			
			require('Pest/PestJSON.php');
			$apiClient = new PestJSON( API_LINK );
			$apiClient->setupAuth( API_USERNAME, API_PASSWORD );
			$tcapi_key=API_KEY;
				try {
					
					$result = $apiClient->get('/templates/?user_key='.$tcapi_key.'&format=json&include=tags%2Csize%2Ccolour%2Ctags%2Ctag_group%2Cimages&filter_options=0&tag_groups='.$type.'&sizes='.$size.'&colour='.$colour.'&exclusive_tag_types=0');
					
					}
				catch (Exception $e)
					{
					die( $e->getMessage() );
					}
					
				try {
						
					$left = $apiClient->get('/templates/?user_key='.$tcapi_key.'&format=json&include=tags%2Csize%2Ccolour%2Ctags%2Ctag_group%2Cimages&filter_options=1&tag_groups='.$type.'&sizes='.$size.'&colour='.$colour.'&exclusive_tag_types=0');
					
						}
					catch (Exception $e)
						{
						die( $e->getMessage() );
						}	
				//debug($left);
				$str='';
				$str .='<div class="design_topsec">
									<div class="desing_headingleftsec">
										<div class="breadcrumbs">
											<ul>
												<li><a title="Go to Home Page" href="#">Home</a> &nbsp;<span>»</span>&nbsp; </li>
												<li><strong>Who we are</strong></li>
											</ul>
										</div>
										<h1>Found Business Card designs for you to choose from...</h1>
										</div>
										<div class="results_saved">
											<a href="'.base_url().'templates/saved_design_templates">Saved Designs : '.$all_saved_design.'</a>
										</div>
								</div>
								<div class="content_leftsec">';
				$str .='<div class="left_bar">
								<div class="colours">
									<span class="search">Filter results by colour:</span>
										<ul>';
										foreach($left['colours'] as $colour_name ){
										
										$str .='<li class="'.str_replace(' ','-',strtolower($colour_name['name'])).'"><a href="javascript:void(0)" onclick=colour_set("'.strtolower($colour_name['colour']).'","'.str_replace(' ','-',strtolower($colour_name['name'])).'") title="'.$colour_name['name'].'"></a></li>';
										
										}
				$str .='		</ul>
								</div>
								<div class="template_results">';
				foreach($result as $templates){
					for($i=0;$i<count($templates)-1;$i++){
						$str .='<div class="latestProd" style="margin-right:6px;">
											<h1>'.substr($templates[$i]['name'],0,22).'</h1>
												<div class="prod_secondsec">
													<div class="prodIcons">
														<img src="'.base_url().'images/templates_icon_information.png"/><img src="'.base_url().'images/templates_icon_zoom.png" alt="" />
												  </div>
													<div class="selct_desnsec">
															<a href="'.base_url().'templates/more_template_details/'.$templates[$i]["id"].'">Select Design</a>
													</div>
											</div>';
										 $r=$templates[$i]['images'];
											foreach($r as $res)	
											{	
												if($res['_attrs']['size_code'] == 'M')
												{
														
													$str .='<div class="prod_imgsec">
																	<img src="'.$res[0].'" alt="" style=" width:200px; height:132px" />
																 </div>';
												}
											}
								$str .='<div class="prod_moreinfobtn">
								<a href="'.base_url().'templates/more_template_details/'.$templates[$i]["id"].'"><img src="'.base_url().'images/moreinfo_btn.png" alt=""></a>
										</div>
									</div>';						
					}
				}
			
			$str .='</div></div></div>';
			$str .='<div class="content_rightsec">
								<div class="right_bar">
									<div class="indust_sec">
											<h1>'.$left['tags'][0]['title'].'</h1>
											<div class="results">
												<fieldset>
													<ul>';
													foreach($left['tags'][0]['tags'] as $tags_name) 
													{
															if($tags_name['name']=='Business Cards'){
															$str .='
																				<li>
																				<input type="checkbox" onclick="get_templates()" checked="checked">
																				<label>'.$tags_name['name'].'</label>
																				</li>';
													}}
									$str .='</ul>
												</fieldset>
											</div>
										</div>';
									
			
			$str .='<div class="indust_sec">
									<h1>Sizes &nbsp;<a href="javascript:void(0);" onclick="clear_colours();">[clear filter]</a></h1>
									<div class="results">
										<fieldset>
											<ul>';
											foreach($left['sizes'] as $tag_size){
												if($tag_size['name']=='Business Card (55x85mm)') {
													if($tag_size['selected']==1){
																$class='checked="checked"';
													}
													else {
																$class='';
													}
												$str .='<li>
												<input type="checkbox"'.$class.' onclick=size_set("'.$tag_size['code'].'");>
												<label>'.$tag_size['name'].'</label>
												</li>';
												 }}
											$str .='</ul>
										</fieldset>
									</div>
								</div>';
			
			/*$str .='<div class="indust_sec">
								<h1>'.$left['tags'][2]['title'].'</h1>
								<div class="results">
									<fieldset>
										<ul>';
										foreach($left['tags'][2]['tags'] as $style_name) 
											{ 
											
											$str .='<li>
											<input type="checkbox" onclick=style_set("'.$style_name['code'].'");>
											<label>'.$style_name['name'].'</label>
											</li>';
											 }
										$str .='</ul>
									</fieldset>
								</div>
							</div>';*/
				
			
			$str .='</div>
			</div>';	
			echo $str;
					

	}
	
	
	public function change_template_colour()
	{
			$sortby=$this->input->post('sortby');
			$size=$this->input->post('size');
			$page=$this->input->post('page');
			$groups=$this->input->post('groups');
			$type=$this->input->post('type');
			$industry=$this->input->post('industry');
			$style=$this->input->post('style');
			$colour=$this->input->post('colour');
			$colour_highlight=$this->input->post('colour_highlight');
			$all_saved_design= count($this->template_model->get_all_saved_design());
			require('Pest/PestJSON.php');
			$apiClient = new PestJSON( 'http://api.templatecloud.com/sandbox' );
			$apiClient->setupAuth( 'manoj123', 'admin123' );
			$tcapi_key='d5f111e77c683150cb80860e197a66d0';
				try {
					
					$result = $apiClient->get('/templates/?user_key='.$tcapi_key.'&format=json&include=tags%2Csize%2Ccolour%2Ctags%2Ctag_group%2Cimages&filter_options=0&tag_groups='.$type.'&sizes='.$size.'&colour='.$colour.'&exclusive_tag_types=0');
					
					}
				catch (Exception $e)
					{
					die( $e->getMessage() );
					}
					
				try {
					
					$left = $apiClient->get('/templates/?user_key='.$tcapi_key.'&format=json&include=tags%2Csize%2Ccolour%2Ctags%2Ctag_group%2Cimages&filter_options=1&tag_groups='.$type.'&sizes='.$size.'&colour='.$colour.'&exclusive_tag_types=0');
					

					}
				catch (Exception $e)
					{
					die( $e->getMessage() );
					}	
				//debug($left);
				$str='';
				$str .='<div class="design_topsec">
									<div class="desing_headingleftsec">
										<div class="breadcrumbs">
											<ul>
												<li><a title="Go to Home Page" href="#">Home</a> &nbsp;<span>»</span>&nbsp; </li>
												<li><strong>Who we are</strong></li>
											</ul>
										</div>
										<h1>Found 2670 Business Card designs for you to choose from...</h1>
									</div>
									<div class="results_saved">
											<a href="'.base_url().'templates/saved_design_templates">Saved Designs : '.$all_saved_design.'</a>
										</div>
								</div>
								<div class="content_leftsec">';
				$str .='<div class="left_bar">
								<div class="colours">
									<span class="search">You are filtering by colour: <a href="javascript:void(0);" onclick="clear_colours();">[clear filter]</a></span>
										<ul>';
										foreach($left['colours'] as $colour_name ){
										if(isset($colour_name['selected']) && $colour_name['selected']==1){
										$str .='<li class="'.str_replace(' ','-',strtolower($colour_name['name'])).'"><a href="javascript:void(0)" onclick=colour_set("'.strtolower($colour_name['colour']).'","'.str_replace(' ','-',strtolower($colour_name['name'])).'") title="'.$colour_name['name'].'"></a></li>';
										
										}}
				$str .='		</ul>
								</div>
								<div class="template_results">';
				foreach($result as $templates){
					for($i=0;$i<count($templates)-1;$i++){
						$str .='<div class="latestProd" style="margin-right:6px;">
											<h1>'.substr($templates[$i]['name'],0,22).'</h1>
												<div class="prod_secondsec">
													<div class="prodIcons">
														<img src="'.base_url().'images/templates_icon_information.png"/><img src="'.base_url().'images/templates_icon_zoom.png" alt="" />
												  </div>
													<div class="selct_desnsec">
															<a href="'.base_url().'templates/more_template_details/'.$templates[$i]["id"].'">Select Design</a>
													</div>
											</div>';
										 $r=$templates[$i]['images'];
											foreach($r as $res)	
											{	
												if($res['_attrs']['size_code'] == 'M')
												{
														
													$str .='<div class="prod_imgsec">
																	<img src="'.$res[0].'" alt="" style=" width:200px; height:132px" />
																 </div>';
												}
											}
								$str .='<div class="prod_moreinfobtn">
								<a href="'.base_url().'templates/more_template_details/'.$templates[$i]["id"].'"><img src="'.base_url().'images/moreinfo_btn.png" alt=""></a>
										</div>
									</div>';						
					}
				}
				
			$str .='</div></div></div>';
			$str .='<div class="content_rightsec">
								<div class="right_bar">
									<div class="indust_sec">
											<h1>'.$left['tags'][0]['title'].'</h1>
											<div class="results">
												<fieldset>
													<ul>';
													foreach($left['tags'][0]['tags'] as $tags_name) 
													{
													if($tags_name['name']=='Business Cards'){
															$str .='
																				<li>
																				<input type="checkbox" checked="checked" onclick="get_templates()">
																				<label>'.$tags_name['name'].'</label>
																				</li>';
													}}
									$str .='</ul>
												</fieldset>
											</div>
										</div>';
									
			
			$str .='<div class="indust_sec">
									<h1>Sizes</h1>
									<div class="results">
										<fieldset>
											<ul>';
											foreach($left['sizes'] as $tag_size){
												if($tag_size['name']=='Business Card (55x85mm)') {
												$str .='<li>
												<input type="checkbox">
												<label>'.$tag_size['name'].'</label>
												</li>';
												 }}
											$str .='</ul>
										</fieldset>
									</div>
								</div>';
			
			/*$str .='<div class="indust_sec">
								<h1>'.$left['tags'][2]['title'].'</h1>
								<div class="results">
									<fieldset>
										<ul>';
										foreach($left['tags'][2]['tags'] as $style_name) 
											{ 
											$str .='<li>
											<input type="checkbox">
											<label>'.$style_name['name'].'</label>
											</li>';
											 }
										$str .='</ul>
									</fieldset>
								</div>
							</div>';
				
			
			$str .='</div>
			</div>';		
				*/
			
			
			echo $str;
			
			
	
	
	}
	
	
		
	public function editor()
	{
		$data["title"]="Template Editor";
		$data['description_header_page'] = "Template Designs";
		$data['keywords_header_page'] = "Template Designs";

		$this->load->view("header",$data);
		$this->load->view("template_editor");
		$this->load->view("footer");
	}
	
	public function product_options()
	{
		$data['all_template_options']= $this->template_model->get_template_opt_name();
		$data["title"]="Product Options";
		$data['description_header_page'] = "Template Designs";
		$data['keywords_header_page'] = "Template Designs";

		$this->load->view("header",$data);
		$this->load->view("product_options");
		$this->load->view("footer");
	
	}
	
	
	public function get_att_values()
	{	
			$att_id=$this->input->post('att_id');
			$get_turn_name=$this->template_model->get_att_values($att_id);
			$get_qty=$this->template_model->get_qty($att_id);
			
			$str1='';
			if(!empty($get_turn_name)) {
			$str1 .='<input type="radio" name="turn_time" id="turn_time">&nbsp;'.$get_turn_name['template_option_name'];
			}
			else {
					$str1 ='No turnaround time';
			}
			$str2='';
			$str2 .='<select onchange="fill_qty(this.value);">';
			if($get_qty)
			{
				foreach($get_qty as $qty)
				{
						
						$str2 .='<option value="'.$qty['template_quantity'].'_'.$qty['template_option_attribute_id'].'">'.$qty['template_quantity'].'</option>';
				
				}
			}
			else {
							$str2 .='<option>Select Quantity</option>';
			}
			$str2 .='</select>';
			
			$str3 ='<input type="radio" checked="checked" name="color" id="color"> Full Colour 1 Side';
			
			if(!empty($get_turn_name)) {
			$str4 =$get_turn_name['template_option_name'].' - Full Colour 1 Side';
			}
			else {
			$str4 ='No Paper Type - Full Colour 1 Side';
			}
			
			$str5=$get_qty[0]['template_quantity'];
			$str6=$get_qty[0]['price'];
			
			$str=$str1.'~'.$str2.'~'.$str3.'~'.$str4.'~'.$str5.'~'.$str6;
			echo $str;
		
	
	}
	
	public function get_template_attributes()
	{
			$temp_attr_id=$this->input->post('temp_attr_id');
			$get_turn_name=$this->template_model->get_att_values($temp_attr_id);
			$get_qty=$this->template_model->get_qty($temp_attr_id);
			
			$str1='';
			if(!empty($get_turn_name)) {
			$str1 .='<input type="radio" name="turn_time" id="turn_time">&nbsp;'.$get_turn_name['template_option_name'];
			}
			else {
					$str1 ='No turnaround time';
			}
			
			$str2='';
			$str2 .='<select onchange="fill_qty(this.value);">';
			if($get_qty)
			{
				foreach($get_qty as $qty)
				{
						
						$str2 .='<option value="'.$qty['template_quantity'].'_'.$qty['template_option_attribute_id'].'">'.$qty['template_quantity'].'</option>';
				
				}
			}
			else {
							$str2 .='<option>Select Quantity</option>';
			}
			$str2 .='</select>';
			
			$str3 ='<input type="radio" checked="checked" name="color" id="color"> Full Colour 1 Side';
			
			if(!empty($get_turn_name)) {
			$str4 =$get_turn_name['template_option_name'].' - Full Colour 1 Side';
			}
			else {
			$str4 ='No Paper Type - Full Colour 1 Side';
			}
			
			$str5=$get_qty[0]['template_quantity'];
			$str6=$get_qty[0]['price'];
			$str=$str1.'~'.$str2.'~'.$str3.'~'.$str4.'~'.$str5.'~'.$str6;
			echo $str;
	
	}
	
	public function saved_design_templates()
	{
			$data['all_saved_design']= $this->template_model->get_all_saved_design();
			$data["title"]="Saved Designs";
			$data['description_header_page'] = "Template Designs";
			$data['keywords_header_page'] = "Template Designs";
			
			$this->load->view("header",$data);
			$this->load->view("saved_design_templates");
			$this->load->view("footer");
	
	}
	
	public function edit_template()
	{
		$data["title"]="Edit Template";
		$data['description_header_page'] = "Template Designs";
		$data['keywords_header_page'] = "Template Designs";
		
		$this->load->view("header",$data);
		$this->load->view("edit_template");
		$this->load->view("footer");
	}
	
	public function delete_saved_design()
	{
			$design_id=$this->uri->segment(3);
			$res= $this->template_model->delete_saved_design($design_id);
			if($res)
			{
					redirect(base_url()."templates/saved_design_templates");
			
			}
	
	}
	
	public function get_price()
	{
		$id=$this->input->post('id');
		$get_price=$this->template_model->get_price($id);
		echo $get_price['price'];
	
	
	}
	

	
}


