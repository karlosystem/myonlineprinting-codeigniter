jQuery.noConflict();
jQuery(function ($) {
	$('#add_product_form').validate({
		rules:
		{

			p_name:
			{
				required: true
			},
			p_image:
			{
				accept: 'jpeg|gif|png|jpg'
			},



		},

		messages:
		{
			p_image:
			{
				accept: 'Only JPEG , GIF , PNG , JPG are allowed.'
			}
		}

	});



	$('#add_template_option_attribute_form').validate({
		rules:
		{
			template_option_id:
			{
				required: true
			},
			turnaround_time:
			{
				required: true
			},
			qty:
			{
				required: true,
				number: true
			},
			price:
			{
				required: true,
				number: true
			}


		},


	});

	$('#add_template_option_form').validate({
		rules:
		{
			template_option_name:
			{
				required: true
			}


		},


	});

	$('#add_main_slider').validate({
		rules:
		{
			slider_name:
			{
				required: true
			},
			slider_image:
			{
				required: true
			}
		},


	});


	$('#admin_detail_form').validate({
		rules:
		{
			user_name:
			{
				required: true
			},
			email:
			{
				required: true,
				email: true
			}
		},


	});

	$('#add_user_form').validate({

		rules: {
			u_name: {

				required: true
			},
			u_password:
			{
				required: true,

			},
			u_comp:
			{
				required: true,

			},
			u_country:
			{
				required: true
			},
			u_state:
			{
				required: true
			},
			u_postcode:
			{
				required: true,
			},
			u_email:
			{
				required: true
			},
			u_phone:
			{
				required: true,
				phoneUS: true
			}

		},


		submitHandler: function (form) {
			ajax_check_duplicate_email();
		}


	});




	$('#add_page').validate({

		rules: {
			page_name: {

				required: true
			},
			page_title:
			{
				required: true,

			}


		}


	});

	$('#setting_form').validate({

		rules: {
			b_email: {

				required: true
			},
			api_username:
			{
				required: true,

			},
			api_password:
			{
				required: true,

			},
			api_signature:
			{
				required: true
			},
			environment:
			{
				required: true
			}

		}


	});


	$('#password_form').validate({
		rules: {
			old_password: {

				required: true
			},
			new_password:
			{
				required: true,

			},
			confirm_password:
			{
				required: true
			}
		}


	});





	$('#p_cat_form').validate({
		rules:
		{
			p_cat_name:
			{
				required: true
			}
		},

		submitHandler: function (form) {
			var p_cat_name = $("#p_cat_name").val();
			var p_cat_id = $("#p_cat_id").val();
			ajax_product_cat_name_chk(p_cat_name, p_cat_id);
		}

	});


	$('#p_attribute_form').validate({
		rules:
		{
			p_a_image:
			{
				required: true,
				accept: "jpg|jpeg|png|bmp"
			},
			p_cat_id:
			{
				required: true
			},
			p_a_name:
			{
				required: true
			},
			p_turnaround:
			{
				required: true
			},
			color_side: {
				required: true
			}

		},

		submitHandler: function (form) {
			var p_a_name = $("#p_a_name").val();
			var p_a_id = $("#p_a_id").val();
			var p_cat_id = $("#p_cat_id").val();
			ajax_product_attribute_name_chk(p_a_name, p_a_id, p_cat_id);
		}

	});


	/*$('#p_qty_price_form').validate({
	rules: 
	{
			p_cat_id: 
			{
			required: true
			}
		  
	},
	
submitHandler: function(form) 
{
	var p_a_name = $("#p_a_name").val(); 
	var p_a_id = $("#p_a_id").val(); 
	var p_cat_id = $("#p_cat_id").val();
	ajax_product_attribute_name_chk(p_a_name,p_a_id,p_cat_id);
}
	
});*/

	$('#p_qty_form').validate({
		rules:
		{

			p_cat_id:
			{
				required: true
			},
			p_qty_name:
			{
				required: true
			}

		},

		submitHandler: function (form) {
			var p_qty_name = $("#p_qty_name").val();
			var p_qty_option_id = $("#p_qty_option_id").val();
			var p_cat_id = $("#p_cat_id").val();
			ajax_product_qty_option_chk(p_qty_name, p_qty_option_id, p_cat_id);
		}

	});

	$('#p_attribute_editform').validate({
		rules:
		{

			p_cat_id:
			{
				required: true

			},
			p_a_name:
			{
				required: true
			}

		},

		submitHandler: function (form) {
			var p_a_name = $("#p_a_name").val();
			var p_a_id = $("#p_a_id").val();
			var p_cat_id = $("#p_cat_id").val();
			ajax_product_attribute_name_chk(p_a_name, p_a_id, p_cat_id);
		}

	});



	$('#p_cat_editform').validate({
		rules:
		{
			p_cat_name:
			{
				required: true
			}
		},

		submitHandler: function (form) {
			var p_cat_name = $("#p_cat_name").val();
			var p_cat_id = $("#p_cat_id").val();
			ajax_product_cat_name_chk(p_cat_name, p_cat_id);
		}

	});

});


function ajax_product_qty_option_chk(p_qty_name, p_qty_option_id, p_cat_id) {
	url = base_url + "admin/products/check_duplicate_p_qty_option";

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "p_qty_name=" + p_qty_name + "&p_qty_option_id=" + p_qty_option_id + "&p_cat_id=" + p_cat_id,
		success: function (msg) {
			if (jQuery.trim(msg) == "exist") {
				jQuery('#warning_box1').html('This product qty option under this product categories already exits, please try another.');
				jQuery('#warning_box1').addClass('warning_box');
				jQuery('#p_cat_name').select();
			}
			else {
				document.p_qty_form.submit();
			}
		}
	});
}

function ajax_product_cat_name_chk(p_cat_name, p_cat_id) {
	url = base_url + "admin/products/check_duplicate_p_cat";

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "p_cat_name=" + p_cat_name + "&p_cat_id=" + p_cat_id,
		success: function (msg) {
			if (jQuery.trim(msg) == "exist") {
				jQuery('#warning_box1').html('This product categories already exits, please try another.');
				jQuery('#warning_box1').addClass('warning_box');
				jQuery('#p_cat_name').select();
			}
			else {
				document.p_cat_form.submit();
			}
		}
	});
}


function ajax_product_attribute_name_chk(p_a_name, p_a_id, p_cat_id) {
	url = base_url + "admin/products/check_duplicate_p_attribute";

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "p_a_name=" + p_a_name + "&p_a_id=" + p_a_id + "&p_cat_id=" + p_cat_id,
		success: function (msg) {
			if (jQuery.trim(msg) == "exist") {
				jQuery('#warning_box1').html('This product attribute already exits under this product categories, please try another.');
				jQuery('#warning_box1').addClass('warning_box');
				jQuery('#p_a_name').select();
			}
			else {
				document.p_attribute_form.submit();
			}
		}
	});
}

/**
 * Function to change status of records 
 *
*/

function changeStatus(table, column, value, uniqueNameCol, uniqueColValue) {

	jQuery.ajax({
		type: "POST",
		url: base_url + "admin/common/change_status",
		data: "table=" + table + "&column=" + column + "&value=" + value + "&uniqueNameCol=" + uniqueNameCol + "&uniqueColValue=" + uniqueColValue,
		async: true,
		success: function (msg) {
			window.location.reload();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}
	});

}



function delete_item(table, uniqueNameCol) {
	var s = document.getElementsByName("child_checkbox");
	//alert(s);
	var value = '';
	var j = 0;
	var count = 0;
	for (var i = 0; i < s.length; i++) {
		j++;
		if (s[i].checked == true) {
			count++;
			if (value == '') {
				var value = s[i].value;
			}
			else {
				value = value + ',' + s[i].value;
			}
		}
	}
	//alert(j);
	if (count < 1) {
		alert("Por favor seleccione un registro para eliminar.");
		return false;
	}

	var ret = confirm("Realmente deseas eliminar los registro(s) seleccionado(s).");
	if (!ret) { return false; }

	jQuery(".loader").css("display", "block");

	url = base_url + 'admin/common/delete_item';
	//alert(url);
	jQuery.ajax({
		type: "POST",
		url: url,
		data: "table=" + table + "&uniqueNameCol=" + uniqueNameCol + "&value=" + value,
		async: true,
		success: function (msg) {
			//alert (msg);
			if (msg == 1) {
				jQuery(".loader").css("display", "none");
				jQuery('#warning_box1').html('Item deleted successfully.');
				jQuery('#warning_box1').addClass('valid_box');

			}
			window.setTimeout(function () { location.reload() }, 3000);

		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});
}



function checkall() {
	var is_check = document.getElementById('main_checkbox').checked;
	var s = document.getElementsByName("child_checkbox");
	if (is_check == true) {

		var value = '';
		var count = 0;
		for (var i = 0; i < s.length; i++) {

			s[i].checked = true;

		}
	}
	else {
		for (var i = 0; i < s.length; i++) {

			s[i].checked = false;

		}


	}
}

function ajax_check_duplicate_email() {
	var email = jQuery("#u_email").val();
	url = base_url + "admin/users/check_duplicate_email";
	jQuery.ajax({
		type: "POST",
		url: url,
		data: "email=" + email,
		async: true,
		success: function (msg) {
			if (msg == 1) {
				alert("email already exists.try another email");
				return false;
			}
			else {
				document.add_user_form.submit();

			}


		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});


}


function get_by_id(c_id) {
	jQuery("#loader").css("display", "block");
	var table = "exp_tbl_states";
	var col = "country_id";
	var value = c_id;

	url = base_url + 'admin/common/fetch_by_id';

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "table=" + table + "&col=" + col + "&value=" + value,
		async: true,
		success: function (msg) {
			if (msg) {	//alert (msg);
				jQuery("#loader").css("display", "none");
				jQuery("#u_state").html(msg);

			}



		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}



function get_attribute_qty_id(p_c_id) {

	url = base_url + 'admin/products/get_all_attribute';

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "p_c_id=" + p_c_id,
		async: true,
		success: function (msg) {
			//alert (msg);
			if (msg) {
				jQuery("#loader").css("display", "none");
				jQuery("#u_attribute").html(msg);

			}



		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}

function get_other_attibute(p_a_id, p_c_id) {

	url = base_url + 'admin/products/get_other_attribute';

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "p_a_id=" + p_a_id + "&p_c_id=" + p_c_id,
		async: true,
		success: function (msg) {
			//alert (msg);
			if (msg) {
				jQuery("#loader").css("display", "none");
				var all_arr = msg.split("~");
				jQuery("#u_p_turnaround").html(all_arr[0]);
				jQuery("#u_p_color").html(all_arr[1]);
				jQuery("#u_p_qty").html(all_arr[2]);

			}



		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}

function save_all_attr_qty_option() {

	var p_cat_id = jQuery("#p_cat_id").val();
	var p_a_type = jQuery("#p_a_type").val();

	var p_turnaround = jQuery("#p_turnaround").val();
	var p_color = jQuery("#p_color").val();
	var p_o_qty = jQuery("#p_o_qty").val();
	var p_qty = jQuery("#p_qty").val();
	var p_price = jQuery("#p_price").val();

	url = base_url + 'admin/products/save_attribute_qty_price';

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "p_cat_id=" + p_cat_id + "&p_a_type=" + p_a_type + "&p_turnaround=" + p_turnaround + "&p_color=" + p_color + "&p_o_qty=" + p_o_qty + "&p_qty=" + p_qty + "&p_price=" + p_price,
		async: true,
		success: function (msg) {

			if (jQuery.trim(msg) == "exist") {
				jQuery("#loader").css("display", "none");
				//jQuery('#insert_box').html('Error in  saved price.');
				//jQuery('#insert_box').addClass('valid_box');
			}
			else {
				jQuery("#loader").css("display", "none");
				//jQuery('#insert_box').html('Price saved successfully. ');
				//jQuery('#insert_box').addClass('valid_box');
			}
		}

	});

}


function delete_main_slider(table, uniqueNameCol) {

	var s = document.getElementsByName("child_checkbox");
	//alert(s);
	var value = '';
	var j = 0;
	var count = 0;
	for (var i = 0; i < s.length; i++) {
		j++;
		if (s[i].checked == true) {
			count++;
			if (value == '') {
				var value = s[i].value;
			}
			else {
				value = value + ',' + s[i].value;
			}
		}
	}
	//alert(j);
	if (count < 1) {
		alert("Please select at least one record.");
		return false;
	}

	var ret = confirm("Are you sure to delete selected record(s).");
	if (!ret) {

		return false;

	}
	jQuery(".loader").css("display", "block");
	url = base_url + 'admin/slider/delete_main_slider';
	//alert(url);
	jQuery.ajax({
		type: "POST",
		url: url,
		data: "table=" + table + "&uniqueNameCol=" + uniqueNameCol + "&value=" + value,
		async: true,
		success: function (msg) {
			//alert (msg);
			if (msg == 1) {

				jQuery('#warning_box1').html('Item deleted successfully.');
				jQuery('#warning_box1').addClass('valid_box');
				jQuery(".loader").css("display", "none");

			}
			window.setTimeout(function () { location.reload() }, 3000);

		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}
jQuery(function (jQuery) {
	jQuery('#search_input').keyup(function () {
		searchTable(jQuery(this).val());
	});
});

function searchTable(inputVal) {
	var table = jQuery('#rounded-corner');
	table.find('tr').each(function (index, row) {
		var allCells = jQuery(row).find('td');
		if (allCells.length > 0) {
			var found = false;
			allCells.each(function (index, td) {
				var regExp = new RegExp(inputVal, 'i');
				if (regExp.test(jQuery(td).text())) {
					found = true;
					return false;
				}
			});
			if (found == true) jQuery(row).show(); else jQuery(row).hide();
		}
	});
}
function get_attributes(cat_id) {
	jQuery(".loader").css("display", "block");
	url = base_url + 'admin/common/get_attributes';

	jQuery.ajax({
		type: "POST",
		url: url,
		data: "cat_id=" + cat_id,
		async: true,
		success: function (msg) {
			if (msg) {
				jQuery(".loader").css("display", "none");
				jQuery("#p_attribute").html(msg);

			}

		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}


