$(document).ready(function () {

	var ship_checkbox_value = $("#ship_checkbox_value").val();
	//alert(ship_checkbox_value)
	$('#forgot_form').validate({

		rules: {
			email: {

				required: true
			},

		},
		submitHandler: function (form) {

			ajax_check_forgot_email();
		}



	});


	$('#contact-form').validate({

		rules: {
			name: {
				required: true
			},
			mobile:
			{
				required: true,
				phoneUS: true
			},
			email:
			{
				required: true,
				email: true
			},
			enquiry:
			{
				required: true,
			},
			dept:
			{
				required: true,
			}
		},
	});


	$('#login_form').validate({

		rules: {
			username: {

				required: true
			},
			password:
			{
				required: true,

			},


		},



	});



	$('#register_form').validate({

		rules: {
			u_name: {

				required: true
			},
			u_password:
			{
				required: true,

			},
			u_country:
			{
				required: true,

			},
			u_state:
			{
				required: true,

			},
			u_postcode:
			{
				required: true,

			},
			u_email:
			{
				required: true,

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



	$('#biil_ship_form').validate({
		rules: {
			su_name: ship_checkbox_value == 1 ? {} : { required: true },
			su_add_line1: ship_checkbox_value == 1 ? {} : { required: true },
			su_country: ship_checkbox_value == 1 ? {} : { required: true },
			su_state: ship_checkbox_value == 1 ? {} : { required: true },
			su_email: ship_checkbox_value == 1 ? {} : { required: true },
			su_phone: ship_checkbox_value == 1 ? {} : { required: true },
			u_name: {
				required: true
			},
			su_add_line1: {
				required: true
			},
			u_country:
			{
				required: true,

			},
			u_state:
			{
				required: true,

			},
			u_email:
			{
				required: true,

			},
			u_phone:
			{
				required: true,
				number: true

			},
			card_name:
			{
				required: true

			},
			card_type:
			{
				required: true

			},

			card_number:
			{
				required: true,
				number: true,
				creditcard: true
			},
			exp_month:
			{
				required: true

			},
			exp_year:
			{
				required: true

			},
			ccv_code:
			{
				required: true

			}

		}


	});





});

function ajax_check_duplicate_email() {
	var email = $("#u_email").val();
	url = base_url + "admin/users/check_duplicate_email";
	$.ajax({
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
				document.register_form.submit();

			}


		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});


}

function get_states(c_id) {
	$(".loader").css("display", "block");
	var value = c_id;
	url = base_url + 'common/get_states';
	$.ajax({
		type: "POST",
		url: url,
		data: "value=" + value,
		async: true,
		success: function (msg) {
			//alert(msg);
			if (msg) {
				$(".loader").css("display", "none");
				$("#u_state").html(msg);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}
	});
}

function ajax_check_forgot_email() {
	var email = $("#forgot_email").val();

	url = base_url + "admin/users/check_duplicate_email";
	$.ajax({
		type: "POST",
		url: url,
		data: "email=" + email,
		async: true,
		success: function (msg) {
			if (msg == 1) {
				document.forgot_form.submit();

			}
			else {
				alert("Oops !!! Email Address does not exists.");
				return false;

			}


		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});


}
function remember_me() {

	var check_remember = $("#remember").is(":checked");

	if (check_remember === true) {

		$("#remember").val('1');

	}

	else {

		$("#remember").val('0');

	}


}
function get_templates() {
	$(".modal").show();
	var sortby = $('#hidden_sort').val();
	var size = $('#hidden_size').val();
	var page = $('#hidden_page').val();
	var groups = $('#hidden_groups').val();
	var type = $('#hidden_type').val();
	var industry = $('#hidden_industry').val();
	var style = $('#hidden_style').val();
	var colour = $('#hidden_colour').val();
	var colour_highlight = $('#hidden_colour_highlight').val();

	url = base_url + "templates/get_templates";
	$.ajax({
		type: "POST",
		url: url,
		data: "sortby=" + sortby + "&size=" + size + "&page=" + page + "&groups=" + groups + "&type=" + type + "&industry=" + industry + "&style=" + style + "&colour=" + colour + "&colour_highlight=" + colour_highlight,
		async: true,
		success: function (msg) {
			$('.center1').html(msg);
			$(".modal").hide();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}


function change_template_colour() {

	var sortby = $('#hidden_sort').val();
	var size = $('#hidden_size').val();
	var page = $('#hidden_page').val();
	var groups = $('#hidden_groups').val();
	var type = $('#hidden_type').val();
	var industry = $('#hidden_industry').val();
	var style = $('#hidden_style').val();
	var colour = $('#hidden_colour').val();
	var colour_highlight = $('#hidden_colour_highlight').val();
	$(".modal").show();
	url = base_url + "templates/change_template_colour";
	$.ajax({
		type: "POST",
		url: url,
		data: "sortby=" + sortby + "&size=" + size + "&page=" + page + "&groups=" + groups + "&type=" + type + "&industry=" + industry + "&style=" + style + "&colour=" + colour + "&colour_highlight=" + colour_highlight,
		async: true,
		success: function (msg) {
			$('.center1').html(msg);
			$(".modal").hide();

		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});



}


function get_by_id(c_id) {
	$(".loader").css("display", "block");
	var value = c_id;
	var table = "exp_tbl_states";
	var col = "country_id";

	url = base_url + 'admin/common/fetch_by_id';
	$.ajax({
		type: "POST",
		url: url,
		data: "table=" + table + "&col=" + col + "&value=" + value,
		async: true,
		success: function (msg) {
			alert(msg);
			if (msg) {
				$(".loader").css("display", "none");
				$("#u_state").html(msg);
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}
	});
}

function change_template_colour() {

	var sortby = $('#hidden_sort').val();
	var size = $('#hidden_size').val();
	var page = $('#hidden_page').val();
	var groups = $('#hidden_groups').val();
	var type = $('#hidden_type').val();
	var industry = $('#hidden_industry').val();
	var style = $('#hidden_style').val();
	var colour = $('#hidden_colour').val();
	var colour_highlight = $('#hidden_colour_highlight').val();
	$(".modal").show();
	url = base_url + "templates/change_template_colour";
	$.ajax({
		type: "POST",
		url: url,
		data: "sortby=" + sortby + "&size=" + size + "&page=" + page + "&groups=" + groups + "&type=" + type + "&industry=" + industry + "&style=" + style + "&colour=" + colour + "&colour_highlight=" + colour_highlight,
		async: true,
		success: function (msg) {
			$('.center1').html(msg);
			$(".modal").hide();

		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});



}


function get_by_id(c_id) {
	$("#loader").css("display", "block");
	var table = "exp_tbl_states";
	var col = "country_id";
	var value = c_id;

	url = base_url + 'admin/common/fetch_by_id';

	$.ajax({
		type: "POST",
		url: url,
		data: "table=" + table + "&col=" + col + "&value=" + value,
		async: true,
		success: function (msg) {
			if (msg) {	//alert (msg);
				$("#loader").css("display", "none");
				$("#u_state").html(msg);

			}



		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}


function change_template_colour() {

	var sortby = $('#hidden_sort').val();
	var size = $('#hidden_size').val();
	var page = $('#hidden_page').val();
	var groups = $('#hidden_groups').val();
	var type = $('#hidden_type').val();
	var industry = $('#hidden_industry').val();
	var style = $('#hidden_style').val();
	var colour = $('#hidden_colour').val();
	var colour_highlight = $('#hidden_colour_highlight').val();
	$(".modal").show();
	url = base_url + "templates/change_template_colour";
	$.ajax({
		type: "POST",
		url: url,
		data: "sortby=" + sortby + "&size=" + size + "&page=" + page + "&groups=" + groups + "&type=" + type + "&industry=" + industry + "&style=" + style + "&colour=" + colour + "&colour_highlight=" + colour_highlight,
		async: true,
		success: function (msg) {
			$('.center1').html(msg);
			$(".modal").hide();

		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});



}


function get_by_ids(c_id) {
	$("#loader").css("display", "block");
	var table = "exp_tbl_states";
	var col = "country_id";
	var value = c_id;


	url = base_url + 'admin/common/fetch_by_id';

	$.ajax({
		type: "POST",
		url: url,
		data: "table=" + table + "&col=" + col + "&value=" + value,
		async: true,
		success: function (msg) {
			if (msg) {	//alert (msg);
				$("#loader").css("display", "none");
				$("#su_state").html(msg);

			}



		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}

function get_att_values(att_id) {

	var att_id = att_id;
	var templ_price = $('#temp_price').val();
	if (att_id == '') {
		alert('Please select one of Product/Paper type. !');
		return false;
	}
	url = base_url + 'templates/get_att_values';

	$.ajax({
		type: "POST",
		url: url,
		data: "att_id=" + att_id,
		async: true,
		success: function (msg) {
			if (msg) {
				var res = msg.split("~");
				var str1 = res[0];
				var str2 = res[1];
				var str3 = res[2];
				var str4 = res[3];
				var str5 = res[4];
				var str6 = res[5];
				var price = parseFloat(str6) + parseFloat(templ_price);
				$("#turn_around_time").html(str1);
				$("#api_boxselectfield").html(str2);
				$("#full_color").html(str3);
				$("#all_mix").html(str4);
				$('#qty').html(str5);
				$('#tot_price').html(price);

			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});

}

function fill_qty(qty_id) {
	var templ_price = $('#temp_price').val();
	var qt_id = qty_id.split('_');
	var qty = qt_id[0];
	var id = qt_id[1];
	$('#qty').html(qty);
	$('#temp_qty').val(qty);
	url = base_url + 'templates/get_price';
	$.ajax({
		type: "POST",
		url: url,
		data: "id=" + id,
		async: true,
		success: function (msg) {
			if (msg) {
				var price = parseFloat(msg) + parseFloat(templ_price);
				$('#tot_price').text(price);
				$('#total_price').val(price);

			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}

	});



}

function get_template_attributes(temp_attr_id) {
	url = base_url + 'templates/get_template_attributes';
	var templ_price = $('#temp_price').val();

	if (temp_attr_id == '') {
		alert('Please select one of Product/Paper type. !');
		$('.selct_desnsec2').html('');
		return false;
	}
	$.ajax({
		type: "POST",
		url: url,
		data: "temp_attr_id=" + temp_attr_id,
		async: true,
		success: function (msg) {
			if (msg) {
				var res = msg.split("~");
				var str1 = res[0];
				var str2 = res[1];
				var str3 = res[2];
				var str4 = res[3];
				var str5 = res[4];
				var str6 = res[5];
				var price = parseFloat(str6) + parseFloat(templ_price);
				$('.selct_desnsec2').html(str1);
				$('.selct_desnsec3').html(str2);
				$('.selct_desnsec4').html(str3);
				$("#all_mix").html(str4);
				$('#qty').html(str5);
				$('#tot_price').text(price);
				$('#temp_qty').val(str5);
				$('#total_price').val(price);
				$('.edit_btnsec').show();
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Error occured. Please try again later.");
		}
	});

}
