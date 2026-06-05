<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("users_model");
		$this->load->model("products_model");
		$this->load->model("admin/common_model");
		$this->load->model("template_model");
		$this->load->model("order_model");
		$this->load->library('cart');
		$this->load->library('paypal_pro');
		$this->load->library('email');
		$this->load->library('authorize_net');
	}

	public function index()
	{

		$this->cart_items();
	}

	public function basket()
	{
		if ($this->input->post('custom_template') == 'custom_template') {
			//debug($_POST); die;
			$template_id = $this->input->post('temp_id');
			$instance_id = $this->input->post('instance_id');
			$template_qty = $this->input->post('temp_qty');
			$template_name = $this->input->post('temp_name');
			$total_price = $this->input->post('total_price');

			$data = array(
				'id'      => $template_id,
				'qty'    => $template_qty,
				'price'  => $total_price,
				'name' => $template_name,
				'custom_template' => $this->input->post('custom_template'),
				'options'   => array(
					"instance_id" => $instance_id,
					"template_options" => $this->input->post('template_options'),
					"temp_price" => $this->input->post('temp_price'),
				),
			);

			$this->cart->insert($data);
			$this->session->set_userdata("success_message", $template_name . " has been added to the cart.");
		} else if ($this->uri->segment(3, 0)) {

			$price_id = $this->uri->segment(3);

			if ($price_id) {
				//getting information of pricing of a product
				$tbl_name = 'exp_tbl_pricing';
				$col = "pricing_id";
				$value = $price_id;

				$cart_data = $this->common_model->get_item_by_id($tbl_name, $col, $value);

				$p_id = $cart_data["p_id"];
				$sp_id = $cart_data["sp_id"];
				$qty_id = $cart_data["quantity"];

				//getting information of a product

				$tbl_name1 = 'exp_tbl_products';
				$col1 = "p_id";
				$value1 = $p_id;
				$product_detail = $this->common_model->get_item_by_id($tbl_name1, $col1, $value1);

				//getting quantity name by id
				$tbl_name2 = 'exp_tbl_qty';
				$col2 = "qty_id";
				$value2 = $qty_id;
				$qty_detail = $this->common_model->get_item_by_id($tbl_name2, $col2, $value2);

				//geetin detail of subproduct
				$tbl_name3 = 'exp_tbl_sub_products';
				$col3 = "sp_id";
				$value3 = $sp_id;
				$subproduct_detail = $this->common_model->get_item_by_id($tbl_name3, $col3, $value3);

				//debug($subproduct_detail);die;
				$data = array(
					'id'      => $price_id,
					'qty'    => $qty_detail["qty_name"],
					'price'  => $cart_data['price'],
					'name' => $product_detail['p_name'],
					'custom_template' => '',
					'options'   => array(
						"p_id" => $cart_data["p_id"],
						'sp_id'   => $cart_data["sp_id"],
						'sp_image' => $subproduct_detail['sp_image'],
						'combination'   => $cart_data["combination"],	'size'   => $cart_data['size'],
					),

				);

				$this->cart->insert($data);
				$this->session->set_userdata("success_message", $qty_detail["qty_name"] . " quantity(s) has been added to the cart.");
			}
		} else {

			//getting information of pricing of a product
			$tbl_name = 'exp_tbl_pricing';
			$col = "pricing_id";
			$value = 904;

			//	$cart_data =$this->common_model->get_item_by_id($tbl_name, $col,$value);

			$p_id = $this->input->post('p_id');
			$sp_id = $this->input->post('s_p_id');
			$qty_id = $this->input->post('quantity');

			//getting information of a product

			$tbl_name1 = 'exp_tbl_products';
			$col1 = "p_id";
			$value1 = $p_id;
			$product_detail = $this->common_model->get_item_by_id($tbl_name1, $col1, $value1);


			//geetin detail of subproduct
			$tbl_name3 = 'exp_tbl_sub_products';
			$col3 = "sp_id";
			$value3 = $sp_id;
			$subproduct_detail = $this->common_model->get_item_by_id($tbl_name3, $col3, $value3);

			//debug($subproduct_detail);die;
			//$id = $p_id."-".$sp_id;
			$id = 904;
			$data = array(
				'id'      => 'p_' . $p_id,
				'qty'    => $qty_id,
				'price'  => 0.8,
				'name' => $product_detail['p_name'],
				'custom_template' => '',
				'options'   => array(
					"p_id" => $p_id,
					'sp_id'   => $sp_id,
					'sp_image' => $subproduct_detail['sp_image'],
					'combination'   => '',
					'size'   => $subproduct_detail['sp_name'],
					'add_info' => $this->input->post('additional_info'),
				),

			);
			//	debug($data);die;									
			$this->cart->insert($data);
			$this->session->set_userdata("success_message", $qty_id . " quantity(s) has been added to the cart.");
		}


		redirect(base_url() . "cart");
	}

	public function cart_items()
	{
		$data['title'] = "Shopping Basket";
		$data['description_header_page'] = 'description Shopping Basket';
		$data['keywords_header_page'] = 'keywords Shopping Basket';

		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();


		$this->load->view("template/header", $data);
		$this->load->view("template/basket");
		$this->load->view("template/footer");
	}

	public function update_items()
	{
		foreach ($this->cart->contents() as $cart_contents) {
			if ($cart_contents['custom_template'] == 'custom_template') {
				foreach ($this->input->post('qty') as $key =>  $val) {
					$qty = $val;
					$rowid = $key;
					$qty_arr = explode('~', $qty);
					$q = $qty_arr['0'];
					$id = $qty_arr['1'];


					$cart_data = $this->template_model->get_price($id);

					$tot_price = $cart_contents['options']['temp_price'] + $cart_data['price'];

					$data = array(
						'rowid' => $rowid,
						'qty'   => $qty_arr['0'],
						'price'  => $tot_price
					);


					$this->cart->update($data);
				}
			} else {
				foreach ($this->input->post('qty') as $key =>  $val) {
					$qty = $val;
					$rowid = $key;
					$qty_arr = explode('~', $qty);

					$p_id = $this->input->post('p_id');
					$sp_id = $this->input->post('sp_id');
					$combination = $this->input->post('combination');
					$size = $this->input->post('size');
					$size = $this->input->post('size');
					$q = $qty_arr['0'];



					$cart_data = $this->common_model->get_item_price($p_id, $sp_id, $combination, $size, $q);



					$data = array(
						'rowid' => $rowid,
						'qty'   => $qty_arr['1'],
						'price'  => $cart_data['price']
					);;


					$this->cart->update($data);
				}
			}
		}

		$this->session->set_userdata("success_message", "Cart has been updated.");
		redirect(base_url() . "cart");
	}

	public function delete_item()
	{
		$rowid = $this->uri->segment(3);

		$data = array(
			'rowid' =>  $rowid,
			'qty'   =>	0
		);

		$res = $this->cart->update($data);

		if ($res) {
			$this->common_model->delete_artwork($rowid);

			$this->session->set_userdata("success_message", "Cart item has been deleted!");

			redirect(base_url() . "cart/basket");
			exit;
		}
	}

	public function bill_ship_info()
	{
		if (!$this->session->userdata("u_id")) {
			redirect(base_url() . 'users/login');
			exit;
		}

		$data = array();
		$data['title'] = "Billing Shiping Info";
		$data['description_header_page'] = 'description Billing Shiping Info';
		$data['keywords_header_page'] = 'keywords Billing Shiping Info';

		$u_id = $this->session->userdata('u_id');

		$tbl_name = "exp_tbl_users";
		$col = "u_id";
		$value = $u_id;

		$data['user_info'] = $this->common_model->get_item_by_id($tbl_name, $col, $value);

		$data["allMonth"] = get_month_list();
		$data["allDate"] = get_date_list();
		$data["allYear"] = get_year_list();
		$data["creditCards"] = get_credit_card();

		/*Bussiness Card*/
		$data["bussinesscard"] = $this->products_model->get_products_bussiness_cards();
		/*end*/
		/*Productos Top 5*/
		$data["products_top5"] = $this->products_model->get_products_top5();
		/*end*/
		$data["pages"] = $this->products_model->get_paginas_portadas();

		$data["destacados"] = $this->products_model->get_products_destacados_portada();


		$this->load->view('template/header', $data);
		$this->load->view('template/bill_ship_info');
		$this->load->view('template/footer');
	}

	public function checkout()
	{
		if (!$this->session->userdata("u_id")) {
			redirect(base_url());
			exit;
		}

		$creditCards = get_credit_card();


		$pay_type = $this->input->post('pay_type');
		$order_date = date("Y-m-d H:i:s");
		$payment_type = 'Cardit Card';
		$payment_status = "panding";
		$cust_id = $this->session->userdata("u_id");
		$total_amt = $this->session->userdata("total_amount");
		$tempCardType = $this->input->post('card_type');
		$cardType = $creditCards[$tempCardType];
		$card_number = $this->input->post('card_number');
		$exp_month = $this->input->post('exp_month');
		$exp_year = $this->input->post('exp_year');
		$ccv_code = $this->input->post('ccv_code');
		$ship_checkbox_value = $this->input->post('ship_checkbox_value');
		$expiration_date = $exp_month . '/' . $exp_year;


		$same_biil_ship_array = array(
			'bill_f_name' => $this->input->post('u_name'),
			'bill_c_name' => $this->input->post('c_name'),
			'bill_address1' => $this->input->post('u_add_line1'),
			'bill_address2' => $this->input->post('u_add_line2'),
			'bill_country' => $this->input->post('u_country'),
			'bill_town' => $this->input->post('u_state'),
			'bill_postcode' => $this->input->post('u_postcode'),
			'bill_email' => $this->input->post('u_email'),
			'bill_phone' => $this->input->post('u_phone'),
			'ship_f_name' => $this->input->post('u_name'),
			'ship_c_name' => $this->input->post('c_name'),
			'ship_address1' => $this->input->post('u_add_line1'),
			'ship_address2' => $this->input->post('u_add_line2'),
			'ship_country' => $this->input->post('u_country'),
			'ship_town' => $this->input->post('u_state'),
			'ship_postcode' => $this->input->post('u_postcode'),
			'ship_email' => $this->input->post('u_email'),
			'ship_phone' => $this->input->post('u_phone'),
			'order_date' => $order_date,
			'payment_type' => $payment_type,
			'payment_status' => $payment_status,
			'cust_id' => $cust_id,
			'total_amt' => $total_amt,
			'card_type' => $cardType,
			'card_no' => $card_number,
			'exp_date' => $expiration_date,
			'ccv_code' => $ccv_code
		);

		$diff_billship_array = array(

			'bill_f_name' => $this->input->post('u_name'),
			'bill_c_name' => $this->input->post('c_name'),
			'bill_address1' => $this->input->post('u_add_line1'),
			'bill_address2' => $this->input->post('u_add_line2'),
			'bill_country' => $this->input->post('u_country'),
			'bill_town' => $this->input->post('u_state'),
			'bill_postcode' => $this->input->post('u_postcode'),
			'bill_email' => $this->input->post('u_email'),
			'bill_phone' => $this->input->post('u_phone'),
			'ship_f_name' => $this->input->post('su_name'),
			'ship_c_name' => $this->input->post('sc_name'),
			'ship_address1' => $this->input->post('su_add_line1'),
			'ship_address2' => $this->input->post('su_add_line2'),
			'ship_country' => $this->input->post('su_country'),
			'ship_town' => $this->input->post('su_state'),
			'ship_postcode' => $this->input->post('su_postcode'),
			'ship_email' => $this->input->post('su_email'),
			'ship_phone' => $this->input->post('su_phone'),
			'order_date' => $order_date,
			'payment_type' => $payment_type,
			'payment_status' => $payment_status,
			'cust_id' => $cust_id,
			'total_amt' => $total_amt,
			'card_type' => $cardType,
			// 'card_no'=>$card_number,
			// 'exp_date'=>$expiration_date,
			// 'ccv_code'=>$ccv_code
		);


		if ($ship_checkbox_value == 1) {
			$this->order_model->save_order($diff_billship_array);
			$order_id = $this->db->insert_id();
		} else {
			$this->order_model->save_order($same_biil_ship_array);
			$order_id = $this->db->insert_id();
		}

		if ($order_id) {

			foreach ($this->cart->contents() as $cart_item) {


				if ($cart_item['custom_template'] == 'custom_template') {

					$order_data = array(
						"o_id" => $order_id,
						"order_template_id" => $cart_item['id'],
						"order_template_name" => $cart_item['name'],
						"p_amount" => $cart_item['price'],
						"p_ship_amount" => 0,
						"qty" => $cart_item['qty'],
						"order_template_type" => $cart_item['custom_template'],
						"order_instance_id" => $cart_item['options']['instance_id'],
					);

					$this->order_model->save_order_item($order_data);
				} else {
					$att_combination = ($cart_item['options']['combination']);
					$att_arr = explode(',', $att_combination);

					$r_id = $cart_item['rowid'];

					$artwork_arr = $this->common_model->get_upload_artwork($r_id);
					if (!empty($artwork_arr)) {
						$file_name = $artwork_arr['file_name'];
					} else {
						$file_name = "";
					}
					if ($cart_item['id'] == 'p_35') {
						$add_info = $cart_item['options']['size'];
					} else {
						$add_info = "";
					}
					$order_data = array(
						"o_id" => $order_id,
						"p_id" => $cart_item['options']['p_id'],
						"sp_id" => $cart_item['options']['sp_id'],
						"size" => $cart_item['options']['size'],
						"p_amount" => $cart_item['price'],
						"p_ship_amount" => 0,
						"qty" => $cart_item['qty'],
						"artwork_file" => $file_name,
						'r_id' => $r_id,
						'additional_info' => $add_info

					);
					$this->order_model->save_order_item($order_data);
					if ($cart_item['id'] != 'p_35') {
						$order_items_id = $this->db->insert_id();
						for ($i = 0; $i < count($att_arr); $i++) {
							$order_att = array(
								"o_id" => $order_id,
								"oi_id" => $order_items_id,
								"att_id" => $att_arr[$i]
							);
							$this->order_model->save_order_att($order_att);
						}
					}
				}
			}
		}

		#####################################
		# 			AUTHORIZE>NET			#			
		#####################################

		$bill_name = $this->input->post('u_name');
		$address = $this->input->post('u_add_line1') . ", " . $this->input->post('u_add_line2');
		$bill_country = $this->input->post('u_country');
		$bill_state = $this->input->post('u_state');
		$bill_postcode = $this->input->post('u_postcode');
		$bill_email = $this->input->post('u_email');
		$bill_phone = $this->input->post('u_phone');

		$expDateMonth = $this->input->post('exp_month');
		$expDateYear = $this->input->post('exp_year');
		$creditCardType = urlencode($cardType);
		$creditCardNumber = urlencode($card_number);

		$firstName = urlencode($this->input->post('u_name'));
		$address = urlencode($this->input->post('u_add_line1'));
		$amount = urlencode($total_amt);
		$currencyID = urlencode('USD');
		$cvv2Number = urlencode($ccv_code);

		$x_exp_date = $expDateMonth . "/" . $expDateYear;

		if ($pay_type) {
			$auth_net = array(
				//'x_card_num'			=> '4111111111111111', // Visa
				'x_card_num'			=> $creditCardNumber, // Visa
				'x_exp_date'			=> $x_exp_date,
				'x_card_code'			=> $cvv2Number,
				'x_description'			=> 'Order transaction',
				'x_amount'				=> $amount,
				'x_first_name'			=> $bill_name,
				'x_last_name'			=> '',
				'x_address'				=> $address,
				'x_city'				=> '',
				'x_state'				=> $bill_state,
				'x_zip'					=> $bill_postcode,
				'x_country'				=> $bill_country,
				'x_phone'				=> $bill_phone,
				'x_email'				=> $bill_email,
				'x_customer_ip'			=> $this->input->ip_address(),
			);
			$this->authorize_net->setData($auth_net);

			// Try to AUTH_CAPTURE
			if ($this->authorize_net->authorizeAndCapture()) {
				// echo '<h2>Success!</h2>';
				// echo '<p>Transaction ID: ' . $this->authorize_net->getTransactionId() . '</p>';
				// echo '<p>Approval Code: ' . $this->authorize_net->getApprovalCode() . '</p>';


				$transactionid = $this->authorize_net->getTransactionId();

				$update = array(
					"transaction_id" => $transactionid,
					"payment_status" => 'Success'
				);

				$this->db->where('order_id', $order_id);
				$this->db->update('exp_tbl_orders', $update);


				####################################
				#  ORDER INFO EMAIL CONTANT  FOR   #
				#  CUSTOMER/ADMIN                  #	
				####################################

				$order = $this->order_model->get_orders($order_id);
				$att_info = $this->order_model->get_attribute_info($order_id);
				//$admin_info = $this->common_model->paypal_credentials();
				$cust_info = $this->order_model->get_customer_info($cust_id);

				$this->db->select('email');
				$query   =	$this->db->get('exp_tbl_admins');
				$result  =	$query->row();
				//debug($result);die;

				//$admin_email = $admin_info['business_email'];
				$admin_email = $result->email;
				$customer_email	= $cust_info['u_email'];
				$customer_name	= $cust_info['u_name'];
				//debug($customer_email);die;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from($admin_email, "My Online Printing");
				$this->email->to($customer_email);
				$this->email->subject("My Online Printing - Payment successfully processed.");

				$content = "";
				$content .= '
			<table width="100%"  border="0" cellspacing="3" cellpadding="0">
			<tr style="background:#01A4C5;color:#FFF;">
			<td class="heading" style="width:13%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;font-family: Conv_comic;padding-bottom:5px;">Item No.</td>
			<td class="heading1" align="center" style="width:15%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Product Type</td>
			<td class="heading1" align="center" style="width:24%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Product Name</td>
			<td class="heading2"  align="center" style="width:10%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Price</td>
			<td class="heading2"  align="center" style="width:9%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Qty</td>
			<td class="heading2"  align="center" style="width:15%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">ArtWork File</td>
			<td class="heading2"  align="center" style="width:34%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Sub Total</td>
			</tr>';
				//debug($order);
				//echo $order;

				//die;
				if (!empty($order)) {
					$tot_amount = '';
					$total_ship = '';
					foreach ($order as $items) {
						$tot_amount = $tot_amount + $items['p_amount'];
						$total_ship = $total_ship + $items['p_ship_amount'];
						if ($items['order_template_type'] == 'custom_template') {
							$content .= ' <tr>
						<td class="cntnt" align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' .
								strtoupper($items['id'])
								. '</td>';
							$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;"> Buisness Card';
							$content .= '</td>';
							$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . strtoupper($items['order_template_name']);
							$content .= '</td>
						<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . CURRENCY . ' ' . number_format($items['p_amount'], 2);

							$content .= '</td>
						<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . $items['qty'];
							$content .= '</td>
						<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;"> NO File ';
							$content .= '</td>
						<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . CURRENCY . ' ' . number_format($items['p_amount'], 2);
							$content .= '</td></tr>';
						} else {
							$p_id = $items["p_id"];
							$sp_id = $items["sp_id"];
							$size = $items["size"];

							if (!empty($items['artwork_file'])) {
								$src = '<a  href="' . base_url() . 'cart/download_file/' . $items['r_id'] . '/' . $items['artwork_file'] . '" > Download File </a>';
							} else {
								$src = 'No File';
							}


							$product_info = $this->order_model->get_product_name_with_id($p_id);
							$sp_product_info = $this->order_model->get_sub_product_name_with_id($sp_id);
							// $combination = $this->order_model->get_sub_product_name_with_id($combination);
							$size_name = $this->order_model->get_size_name_with_id($size);
							$content .= ' <tr>
					<td class="cntnt" align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' .
								strtoupper($items['id'])
								. '</td>';
							$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . strtoupper($product_info['p_name']);
							$content .= '</td>';
							$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . strtoupper($sp_product_info['sp_name']);
							$content .= '<table><tr><td colspan="2"><b><center>Product Attributes</center></b></td></tr>';
							if (!empty($att_info)) {
								foreach ($att_info as $att) {
									$content .= '	
							<tr>
									<td>Attribute Name:</td>
									<td>' . $att['att_name'] . '</td>
							</tr>
							<tr>
									<td>Attribute Value:</td>
									<td>' . $att['value_name'] . '</td>
							</tr>';
								}
							}
							$content .= '</table></td>';

							$content .= '<td class="cntnt2"  align="center" style="background:#CCCCCC;font-size:12px;line-height:30px;">' . CURRENCY . ' ' . number_format($items['p_amount'], 2);

							$content .= '</td>
					<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . $items['qty'];
							$content .= '</td>
					<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . $src;
							$content .= '</td>
					<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">' . CURRENCY . ' ' . number_format($items['p_amount'], 2);
							$content .= '</td></tr>';
						}
					}
				}
				$content .=  '<tr>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
				<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;" align="center">Sub Total(+)</td>
			<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >' . CURRENCY . " " . number_format($tot_amount, 2) . '</td>
		  </tr>
		   <tr>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
				<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;" align="center">Ship(+)</td>
			<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >' . CURRENCY . " " . number_format($total_ship, 2) . '</td>
		  </tr>
		  
		   <tr>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
				<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;" align="center">SALES TAX(7%)</td>
			<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >' . CURRENCY . " " . number_format((($tot_amount * 7) / 100), 2) . '</td>
		  </tr>
		  
		  <tr>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
				<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;">&nbsp;</td>
			<td class="total" style="background:#CCCCCC;" align="center">Total</td>
			<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >' . CURRENCY . " " . number_format(($tot_amount + $total_ship) + (($tot_amount * 20) / 100), 2) . '</td>
		  </tr></table>';

				$content2 = $content;
				$message  = "";
				$a_message  = "";
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$image_path = base_url() . "images/logo.png";

				if (!empty($customer_email)) {
					$message = @file_get_contents("templetes/payment_successful.html");
					$message = str_replace("[IMAGE_PATH]", $image_path, $message);
					$message = str_replace("[CUSTOMER_NAME]", $customer_name, $message);
					$message = str_replace("[MESSAGE]", 'Thank you, your Payment for following order has been processed successfully. Order will be dispatched at your shipping address within 2-3 days.', $message);
					$message = str_replace("[CONTENT]", $content2, $message);
					$this->email->to($customer_email);
					$this->email->from($admin_email, 'My Online Printing');
					$this->email->subject("My Online Printing - Payment processed successfully");
					//debug($message);
					$this->email->message($message);
					$this->email->send();
					//echo $this->email->print_debugger();die;
				}

				if (!empty($admin_email)) {

					$this->email->clear(TRUE);
					$a_message = @file_get_contents("templetes/payment_successful.html");
					$a_message = str_replace("[IMAGE_PATH]", $image_path, $a_message);
					$a_message = str_replace("[CUSTOMER_NAME]", 'Admin', $a_message);
					$a_message = str_replace("[MESSAGE]", 'An instant payment notification was successfully received from ' . ucfirst($customer_name) . ' for following order.', $a_message);
					$a_message = str_replace("[CONTENT]", $content2, $a_message);
					$this->email->to($admin_email);
					$this->email->from($admin_email, 'My Online Printing');
					$this->email->subject("Products Order");

					$this->email->message($a_message);
					$this->email->send();
					//debug($a_message);
					//echo $this->email->print_debugger();
				}
				//die;
				redirect("cart/success");
			} else {
				//	echo '<h2>Fail!</h2>';
				// Get error
				//	echo '<p>' . $this->authorize_net->getError() . '</p>';
				// Show debug data
				//$this->authorize_net->debug();

				$params = array();
				$params["transation_fail_msg"] = $this->authorize_net->getError();
				$params["title"] = 'Transaction Failure';
				//debug($params);
				$params['title'] = "";
				$params['description_header_page'] = "";
				$params['keywords_header_page'] = "";
				$this->load->view("template/header", $params);
				$this->load->view('template/transaction_failure_page');
				$this->load->view('template/footer');
			}
		}
	}

	public function old_pay_code()
	{

		/*	$expDateMonth=$this->input->post('exp_month');
				$expDateYear=$this->input->post('exp_year');

				$paypal = $this->common_model->paypal_credentials();
				$environment = $paypal['enviroment'];
					
					
					
					####################################
				  # SET REQUEST-SPECIFIC FIELDS      #			
				  ####################################
							
							$paymentType = urlencode('Sale');		
							$creditCardType = urlencode($cardType);
							$creditCardNumber = urlencode($card_number);
							$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
							$cvv2Number = urlencode($ccv_code );
							$firstName = urlencode($this->input->post('u_name'));	
							$address = urlencode($this->input->post('u_add_line1'));			
							$amount = urlencode($total_amt);
							$currencyID = urlencode('USD');
							
							####################################
							#	ADD REQUEST-SPECIFIC FIELDS    #
							#	TO THE REQUEST STRING          #			
							####################################
							
							$nvpStr = "&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber"."&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName"."&STREET=$address&CURRENCYCODE=$currencyID";
							$httpParsedResponseAr = $this->paypal_pro->PPHttpPost('DoDirectPayment', $nvpStr,0);
							if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
							{
							    
							    $transactionid = $httpParsedResponseAr['TRANSACTIONID'];
									
									$update = array(
										"transaction_id" => $transactionid,
										"payment_status" => 'Success'
									   );
						
									$this->db->where('order_id', $order_id);
									$this->db->update('exp_tbl_orders', $update); 
									
									
									####################################
									#  ORDER INFO EMAIL CONTANT  FOR   #
									#  CUSTOMER/ADMIN                  #	
									####################################
								
									$order = $this->order_model->get_orders($order_id);
									$att_info = $this->order_model->get_attribute_info($order_id);
									$admin_info = $this->common_model->paypal_credentials();
									$cust_info = $this->order_model->get_customer_info($cust_id);
								
									$admin_email = $admin_info['business_email'];
									$customer_email	= $cust_info['u_email'];
									$customer_name	= $cust_info['u_name'];
									
									$config['mailtype'] = 'html';
									$this->email->initialize($config);
									$this->email->from( $admin_email, "Copy Service" );
									$this->email->to( $customer_email );
									$this->email->subject("Copy Service - Your Payment is successful done.");

									$content = " ";
									$content .= '
									<table width="100%"  border="0" cellspacing="3" cellpadding="0">
									  <tr style="background:#01A4C5;color:#FFF;">
										<td class="heading" style="width:13%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;font-family: Conv_comic;padding-bottom:5px;">Item No.</td>
										<td class="heading1" align="center" style="width:15%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Product Type</td>
										<td class="heading1" align="center" style="width:24%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Product Name</td>
										<td class="heading2"  align="center" style="width:10%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Price</td>
										<td class="heading2"  align="center" style="width:9%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Qty</td>
										<td class="heading2"  align="center" style="width:15%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">ArtWork File</td>
										<td class="heading2"  align="center" style="width:34%;font-size:16px;text-decoration:underline;font-weight:bold;text-align:center;color:#FFF;line-height:30px;padding-bottom:5px;">Sub Total</td>
									  </tr>';	
														if($order)
		                        {
		                        
		                         $tot_amount='';
														 $total_ship='';
		                          foreach( $order as $items )
			                        {
																	$tot_amount = $tot_amount+$items['p_amount'];
																	$total_ship = $total_ship+$items['p_ship_amount'];
																	if($items['order_template_type'] == 'custom_template')
																	{
																			$content .= ' <tr>
																			<td class="cntnt" align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'.
																			 strtoupper($items['id'])
																			.'</td>';
																			$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;"> Buisness Card';
																			$content .= '</td>';
																			$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'.strtoupper( $items['order_template_name']);
																			$content .= '</td>
																			<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'.CURRENCY.' '.number_format($items['p_amount'],2); 
																		
																			$content .= '</td>
																			<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'. $items['qty']; 
																			$content .= '</td>
																			<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;"> NO File '; 
																			$content .= '</td>
																			<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'. CURRENCY.' '.number_format($items['p_amount'],2);
																			$content .= '</td></tr>';
																					
																				
																				
																				
																	}
																	else 
																	{
																			$p_id=$items["p_id"];
																			$sp_id=$items["sp_id"];
																			$size=$items["size"];
																			
																			if(!empty($items['artwork_file']))
																			{
																				 $src = '<a  href="'.base_url().'cart/download_file/'.$items['r_id'].'/'.$items['artwork_file'].'" > Download File </a>';
																			}
																			else
																			{
																				 $src = 'No File';
																			}
																			
																		 
																			$product_info = $this->order_model->get_product_name_with_id($p_id);
																			$sp_product_info = $this->order_model->get_sub_product_name_with_id($sp_id);
																		 // $combination = $this->order_model->get_sub_product_name_with_id($combination);
																			$size_name = $this->order_model->get_size_name_with_id($size);
																			$content .= ' <tr>
																			<td class="cntnt" align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'.
																			 strtoupper($items['id'])
																			.'</td>';
																			$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'.strtoupper( $product_info['p_name']);
																			$content .= '</td>';
																			$content .= '<td class="cntnt1"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'.strtoupper( $sp_product_info['sp_name']);
																			$content .= '<table>
																			<tr>
																				<td colspan="2"><b><center>Product Attributes</center></b></td>				
																				</tr>
																			';
																			if(!empty($att_info))
																			{
																				foreach( $att_info as $att )
																				{
																						$content .='	
																						<tr>
																								<td>Attribute Name:</td>
																								<td>'.$att['att_name'].'</td>
																						</tr>
																						<tr>
																								<td>Attribute Value:</td>
																								<td>'.$att['value_name'].'</td>
																						</tr>';
																					}}	
																				$content .='</table>
																			</td>';
																			
																			$content .= '<td class="cntnt2"  align="center" style="background:#CCCCCC;font-size:12px;line-height:30px;">'.CURRENCY.' '.number_format($items['p_amount'],2); 
																		
																			$content .= '</td>
																			<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'. $items['qty']; 
																			$content .= '</td>
																			<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'. $src; 
																			$content .= '</td>
																			<td class="cntnt2"  align="center" style="background:#CCCCCC;text-align:center !important;font-size:12px;line-height:30px;">'. CURRENCY.' '.number_format($items['p_amount'],2);
																			$content .= '</td></tr>';
																	}
														
													}	
														
														
													} 
													 $content .=  '
													  
											  <tr>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
													<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;" align="center">Sub Total(+)</td>
												<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >'.CURRENCY." ".number_format($tot_amount,2).'</td>
											  </tr>
											   <tr>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
													<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;" align="center">Ship(+)</td>
												<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >'.CURRENCY." ".number_format($total_ship,2).'</td>
											  </tr>
											  
											   <tr>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
													<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;" align="center">Vat(20%)</td>
												<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >'.CURRENCY." ".number_format((($tot_amount*20)/100),2).'</td>
											  </tr>
											  
											  <tr>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
													<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;">&nbsp;</td>
												<td class="total" style="background:#CCCCCC;" align="center">Total</td>
												<td class="total" style="background:#CCCCCC;text-align:center;font-size:bold;color:#0066FF;font-family: Conv_comic;" >'.CURRENCY." ".number_format(($tot_amount+$total_ship)+(($tot_amount*20)/100),2).'</td>
											  </tr>
													  
									</table>';
									
									
									
									
										$content2= $content;
									
										$message  = "";
										$a_message  = "";
										$this->load->library('email');
										$config['mailtype'] = 'html';
										$this->email->initialize($config);
										$image_path = base_url()."images/logo.png";
										
										if(!empty($customer_email))
										{
											$message = @file_get_contents("templetes/payment_successful.html");
											$message = str_replace("[IMAGE_PATH]", $image_path, $message);
											$message = str_replace("[CUSTOMER_NAME]", $customer_name, $message);
											$message = str_replace("[MESSAGE]", 'Thank you, your Payment for following order has been processed successfully. Order will be dispatched at your shipping address within 2-3 days.', $message);
											$message = str_replace("[CONTENT]", $content2, $message);
											$this->email->to($customer_email);
											$this->email->from($admin_email,'Copy Services');
											$this->email->subject("Copy Services:-Your Payment is successful done");
											
											$this->email->message($message);
											$mail = $this->email->send();
										}
										    
										 if(!empty($admin_email))
										 {
								
											$this->email->clear(TRUE);  
											$a_message = @file_get_contents("templetes/payment_successful.html");
											$a_message = str_replace("[IMAGE_PATH]", $image_path, $a_message);
											$a_message = str_replace("[CUSTOMER_NAME]",'Admin', $a_message);
											$a_message = str_replace("[MESSAGE]", 'An instant payment notification was successfully received from '.ucfirst($customer_name).' for following order.', $a_message);
											$a_message = str_replace("[CONTENT]", $content2, $a_message);
											$this->email->to($admin_email);
											$this->email->from($admin_email,'My Online Printing');
											$this->email->subject("Products Order");
											
											$this->email->message($a_message);
											$mail = $this->email->send();	
										}
									redirect("cart/success");
									}
									else
									{
									  	$params = array();									
									    $params["title"] = 'Transaction Failure';
									    $this->load->view('header',$params);
									    $this->load->view('transaction_failure_page');
									    $this->load->view('footer');
									
									}*/
	}

	public function success()
	{

		$params["title"] = 'Transaction Success';
		$params['description_header_page'] = 'description Transaction Success';
		$params['keywords_header_page'] = 'keywords Transaction Success';

		$this->session->unset_userdata('total_amount');
		$this->cart->destroy();
		$this->load->view('header', $params);
		$this->load->view('success');
		$this->load->view('footer');
	}


	public function download_file()
	{

		$r_id = $this->uri->segment(3);
		$file_name = $this->uri->segment(4);

		$file = base_url() . "uploads/artworks/" . $r_id . '/' . $file_name;



		$filename = urldecode($file);


		if (ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');

		$parsed_url = parse_url($filename);
		$fileinfo = pathinfo($filename);
		$parsed_url['extension'] = $fileinfo['extension'];
		$parsed_url['filename'] = $fileinfo['basename'];
		$parsed_url['localpath'] = $_SERVER['DOCUMENT_ROOT'] . $parsed_url['path'];
		// just in case there is a double slash created when joining document_root and path
		$parsed_url['localpath'] = preg_replace('/\/\//', '/', $parsed_url['localpath']);

		if (!file_exists($parsed_url['localpath'])) {
			die('File not found: ' . $parsed_url['localpath']);
		}
		$allowed_ext = array('txt', 'pdf', 'epub', 'mobi', 'prc', 'rtf', 'docx', 'doc');
		if (!in_array($parsed_url['extension'], $allowed_ext)) {
			die('This file type is forbidden.');
		}

		switch ($parsed_url['extension']) {
			case "txt":
				$ctype = "application/txt";
				break;
			case "pdf":
				$ctype = "application/pdf";
				break;
			case "epub":
				$ctype = "application/epub";
				break;
			case "mobi":
				$ctype = "application/mobi";
				break;
			case "prc":
				$ctype = "application/prc";
				break;
			case "rtf":
				$ctype = "application/rtf";
				break;
			case "gif":
				$ctype = "image/gif";
				break;

			default:
				$ctype = "application/force-download";
		}
		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false); // required for certain browsers
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"" . $parsed_url['filename'] . "\";");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($parsed_url['localpath']));
		readfile($parsed_url['localpath']);
		exit();
	}
}
