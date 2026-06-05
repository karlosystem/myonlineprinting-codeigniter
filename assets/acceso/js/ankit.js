jQuery.noConflict();
jQuery(function($)
{

		
		
		 $('#subproduct_form').validate({
			rules: 
			{
				  product_id: 
				  {
					required: true
				  },
				  sub_name: 
				  {
					required: true
				  },
				  sub_image: 
				  {
					required: true
				  },
				 
			},
			
		
			});
			 $('#add_attribute_form').validate({
			
						rules: 
						{
							  att_name: 
							  {
								required: true
							  },
						},
							  submitHandler: function(form) 
							  {
									var att_name=$("#att_name").val();
									ajax_check_duplicate_attribute(att_name);
							  }
							 	
		
			});
			 $('#add_value_form').validate({
			
						rules: 
						{
							  att_id: 
							  {
								required: true
							  },
							   value_name: 
							  {
								required: true
							  },
						},
							  submitHandler: function(form) 
							  {
									var att_id=$("#att_id").val();
									var value_name=$("#value_name").val();
									ajax_check_duplicate_value(att_id,value_name);
							  }
							 
						
			
		
			});
			 $('#assign_attribute_form').validate({
			
						rules: 
						{
							  p_id: 
							  {
								required: true
							  },
							  att_id: 
							  {
								required: true
							  },
							   value_id: 
							  {
								required: true
							  },
						},
							  submitHandler: function(form) 
							  {
									var p_id=$("#p_id").val();
									var sp_id=$("#sp_id").val();
									var att_id=$("#att_id").val();
									var value_id=$("#value_id").val();									
									ajax_check_duplicate_assigned_attribute(p_id,sp_id,att_id,value_id);
							  }
							 
						
			
		
			});
			$('#add_pricing_form').validate({
			
						rules: 
						{
							  price: 
							  {
								required: true
							  },
							  value_array: 
							  {
								required: true
							  },
							 
						},
							  submitHandler: function(form) 
							  {
										var combination="";
										var value = document.getElementsByName("value_array[]");
											
										for(var i=0;i<value.length;i++)
										{
														//alert(('#value_array_'+i));
														var selectVal = $('#value_array_'+i).val();
														combination +=selectVal+",";
													
										}
										
										var price=$("#price").val();
										var p_id=$("#p_id").val();
										var sp_id=$("#sp_id").val();
										var qty=$("#quantity").val();
										var size=$("#size").val();
										
										ajax_check_duplicate_price(p_id,sp_id,price,combination,qty,size);
							  }
							 
						
			
		
			});
			
			
});

function ajax_check_duplicate_price(p_id,sp_id,price,combination,qty,size)
{
	url = base_url+"admin/pricing/check_duplicate_price";

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "p_id="+p_id+"&sp_id="+sp_id+"&price="+price+"&combination="+combination+"&qty="+qty+"&size="+size,
		success: function(msg) 
		{
			//alert(msg);
			//return false;
			if(msg==1)
			{ 
				
				alert("OOPS!!!!!!price already given for this qty and size");
				return false;
			} 
			else 
			{
				document.add_pricing_form.submit();
			}
		}								
	});	
}

function ajax_check_duplicate_attribute(att_name)
{
	
	url = base_url+"admin/attributes/check_duplicate_attribute";

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "att_name="+att_name,
		success: function(msg) 
		{
			if(msg==1)
			{ 
				alert("OOPS!!!!!entry already exists. Please try another");
				return false;
			} 
			else 
			{
				document.add_attribute_form.submit();
			}
		}								
	});	


}
function ajax_check_duplicate_value(att_id,value_name)
{
	url = base_url+"admin/values/check_duplicate_value";

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "att_id="+att_id+"&value_name="+value_name,
		success: function(msg) 
		{
			
			if(msg==1)
			{ 
				alert("OOPS!!!!!!Value already exists for this attribute. Please try another");
				return false;
			} 
			else 
			{
				document.add_value_form.submit();
			}
		}								
	});	

}
function ajax_check_duplicate_assigned_attribute(p_id,sp_id,att_id,value_id)
{
			url = base_url+"admin/assign_attributes/check_duplicate_assigned_attribute";

	jQuery.ajax({
					type: "POST",
					url: url,
					data: "p_id="+p_id+"&sp_id="+sp_id+"&att_id="+att_id+"&value_id="+value_id,
					success: function(msg) 
					{
						
						if(msg==1)
						{ 
							alert("OOPS!!!!!!Attribute Value already assigned for this subproduct. Please try another");
							return false;
						} 
						else 
						{
							document.assign_attribute_form.submit();
						}
					}								
	});	

}



function delete_subproduct(table,uniqueNameCol)
{
	
	var s=document.getElementsByName("child_checkbox");
	//alert(s);
	var value = '';
	var j=0;
	var count = 0;
		for(var i=0;i<s.length;i++)
        {
			j++;
		  if(s[i].checked == true)
            {
                count++;
                if(value == '')
                {
                        var value = s[i].value;
                }
                else
                {
                                value = value + ',' + s[i].value;
                }
            }
        }
		//alert(j);
        if(count<1)
        {
               alert("Please select at least one record.");
                return false;
        }
        
        var ret=confirm("Are you sure to delete selected record(s).");
        if(!ret)
		{
			
			return false;
			
		}
				jQuery(".loader").css("display","block");
				url = base_url+'admin/sub_products/delete_subproduct';
				//alert(url);
				jQuery.ajax({
					type: "POST",
					url: url,
					data: "table="+table+"&uniqueNameCol="+uniqueNameCol+"&value="+value,
					async: true,
					success: function(msg)
					{ 
							//alert (msg);
							if(msg==1)
							{
								
								jQuery('#warning_box1').html('Item deleted successfully.');
								jQuery('#warning_box1').addClass('valid_box');
								jQuery(".loader").css("display","none");
								
							}
							window.setTimeout(function(){location.reload()},3000);
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert("Error occured. Please try again later.");
					}
				
				});
		
}
function delete_product(table,uniqueNameCol)
{
	
	var s=document.getElementsByName("child_checkbox");
	//alert(s);
	var value = '';
	var j=0;
	var count = 0;
		for(var i=0;i<s.length;i++)
        {
			j++;
		  if(s[i].checked == true)
            {
                count++;
                if(value == '')
                {
                        var value = s[i].value;
                }
                else
                {
                                value = value + ',' + s[i].value;
                }
            }
        }
		//alert(j);
        if(count<1)
        {
               alert("Please select at least one record.");
                return false;
        }
        
        var ret=confirm("Are you sure to delete selected record(s).");
        if(!ret)
		{
			
			return false;
			
		}
				jQuery(".loader").css("display","block");
				url = base_url+'admin/products/delete_product';
				//alert(url);
				jQuery.ajax({
					type: "POST",
					url: url,
					data: "table="+table+"&uniqueNameCol="+uniqueNameCol+"&value="+value,
					async: true,
					success: function(msg)
					{ 
							//alert (msg);
							if(msg==1)
							{
								
								jQuery('#warning_box1').html('Item deleted successfully.');
								jQuery('#warning_box1').addClass('valid_box');
								jQuery(".loader").css("display","none");
								
							}
							window.setTimeout(function(){location.reload()},3000);
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert("Error occured. Please try again later.");
					}
				
				});
		
}
function get_subproducts(p_id)
{
	jQuery(".loader").css("display","block");
	url = base_url+'admin/dynamic_dropdown/get_subproducts';
		jQuery.ajax({
					type: "POST",
					url: url,
					data: "p_id="+p_id,
					async: true,
					success: function(msg)
					{ 
							
							if(msg)
							{
								jQuery(".loader").css("display","none");
								jQuery("#sp_id").html(msg);
							}
							
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert("Error occured. Please try again later.");
					}
				
				});
	
}
function get_attrib_value(att_id)
{
			jQuery(".loader").css("display","block");
			url = base_url+'admin/dynamic_dropdown/get_attrib_value';
		jQuery.ajax({
					type: "POST",
					url: url,
					data: "att_id="+att_id,
					async: true,
					success: function(msg)
					{ 
							
							if(msg)
							{
								//alert(msg);
								jQuery(".loader").css("display","none");
								jQuery("#value_id").html(msg);
							}
							
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert("Error occured. Please try again later.");
					}
				
				});

}



