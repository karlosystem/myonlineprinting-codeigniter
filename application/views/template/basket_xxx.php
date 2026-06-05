<script>
        function update_cart_qty(qty, rowid) {
                $.ajax({
                        type: "post",
                        url: base_url + "cart/update_item",
                        data: "rowid=" + rowid + "&qty=" + qty,
                        success: function(msg) {
                                alert(msg);
                                if (msg == 1) {
                                        alert("item updated successfully");
                                        location.href = location.href;
                                } else {
                                        alert("Error occurred");
                                }
                        }
                });
        }

        function LTrim(value) {
                var re = /\s*((\S+\s*)*)/;
                return value.replace(re, "$1");
        }

        function RTrim(value) {
                var re = /((\s*\S+)*)\s*/;
                return value.replace(re, "$1");
        }

        function trim(value) {

                return LTrim(RTrim(value));

        }

        function check_upload_form() {
                var str = document.upload_form.artwork_file.value;
                var ext = str.split(/[\s.]+/);
                var ext_value = trim(ext[ext.length - 1]);

                if (document.upload_form.artwork_file.value == "") {
                        alert("Select upload file");
                        document.upload_form.artwork_file.focus();
                        return false;
                } else if (!(ext_value && /^(pdf|txt|docx|doc)$/.test(ext_value))) {

                        alert('Only PDF,Doc,Docx or TEXT files are allowed');
                        document.upload_form.artwork_file.focus();
                        return false;
                }

                return true;
        }
</script>
<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$CI->load->model("template_model");
$dispatch_date = Date('M d, Y', strtotime("+1 days"));
$arrive_date = Date('M d, Y', strtotime("+4 days"));
?>
<!--Main category : Begin-->
<main id="main" class="cart">
        <section class="header-page">
                <div class="container">
                        <div class="row">
                                <div class="col-sm-3 hidden-xs">
                                        <h1 class="mh-title">Shopping Basket</h1>
                                </div>
                                <div class="breadcrumb-w col-sm-9">
                                        <span class="hidden-xs">You are here:</span>
                                        <ul class="breadcrumb">
                                                <li>
                                                        <a href="<?php echo base_url(); ?>">Home</a>
                                                </li>
                                                <li>
                                                        <span>Shopping Basket</span>
                                                </li>
                                        </ul>
                                </div>
                        </div>
                </div>
        </section>

        <section class="cart-content parten-bg">
                <div class="container">
                        <!--Cart top banner -->
                        <div class="row">
                                <div class="col-md-12 cart-banner-top hidden-xs">
                                        <a href="#" title="cart top banner">
                                                <img src="<?php echo base_url(); ?>assets/images/banner/cart/top-banner.jpg" alt="Cart top banner" />
                                        </a>
                                </div>
                        </div>
                        <!--Cart top banner : End-->
                        <!-- Cart title-->
                        <div class="row cart-header hidden-xs">
                                <div class="col-md-6 col-sm-10 cart-title">
                                        <h1>Shopping cart (2)</h1>
                                        <p>If you have any queries, our Customer Services team will be happy to help — just call (305) 495-7881</p>
                                        <?php if ($this->session->userdata("success_message")) { ?>
                                                <div class="alert alert-success" role="alert">
                                                        <?php echo $this->session->userdata("success_message"); ?>
                                                </div>
                                        <?php $this->session->unset_userdata("success_message");
                                        } ?>
                                </div>
                                <div class="col-md-3 col-sm-2 continue-shopping">
                                        <a href="<?php echo base_url(); ?>products" title="Continue shopping">
                                                Continue Shopping
                                                <i class="fa fa-arrow-circle-o-right"></i>
                                        </a>
                                </div>
                        </div><!-- Cart title : End -->
                        <div class="row">
                                <!--Cart main content : Begin -->
                                <section class="cart-main col-md-9 col-xs-12">
                                        <!--Cart Item-->
                                        <p class="visible-xs mobile-cart-title">There are 2 items in your cart.</p>

                                        <div class="table-responsive">
                                                <table cellspacing="0" class="table-cart table">
                                                        <thead class="hidden-xs">
                                                                <tr>
                                                                        <th>Image</th>
                                                                        <th class="product-price">Product</th>
                                                                        <th>Qty</th>
                                                                        <th class="product-discount">Price</th>
                                                                        <th class="product-wishlist">Delete</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                                <?php
                                                                if ($this->cart->total_items() > 0) {
                                                                        $i = 1;
                                                                        $ttl_sub_total = 0;
                                                                        foreach ($this->cart->contents() as $row) {
                                                                                if ($row['custom_template'] == 'custom_template') {
                                                                                        $qty_id = $row['options']['template_options'];
                                                                                        $qty_array = $CI->template_model->get_all_quantities($qty_id);
                                                                                } else {
                                                                                        //getting all quantites in dropdown
                                                                                        $p_id = $row["options"]["p_id"];
                                                                                        $sp_id = $row["options"]["sp_id"];
                                                                                        $combination = $row["options"]["combination"];
                                                                                        $size = $row["options"]["size"];
                                                                                        $qty_array = $CI->common_model->get_all_quantities_of_product($p_id, $sp_id, $combination, $size);
                                                                                        $r_id = $row['rowid'];
                                                                                        $artwork_arr = $CI->common_model->get_upload_artwork($r_id);
                                                                                }
                                                                                $ttl_sub_total = $ttl_sub_total + $row['price'];
                                                                ?>
                                                                                <form method="post" action="<?php echo base_url(); ?>cart/update_items">
                                                                                        <?php if ($row['custom_template'] != 'custom_template') { ?>
                                                                                                <input name="row_id[]" id="row_id" type="hidden" value="<?php echo  $row['rowid']; ?>" />
                                                                                                <input name="price_id" id="price_id" type="hidden" value="<?php echo  $row['id']; ?>" />
                                                                                                <input name="sp_id" id="sp_id" type="hidden" value="<?php echo  $sp_id; ?>" />
                                                                                                <input name="combination" id="combination" type="hidden" value="<?php echo  $combination; ?>" />
                                                                                                <input name="size" id="size" type="hidden" value="<?php echo  $size; ?>" />
                                                                                                <input name="p_id" id="p_id" type="hidden" value="<?php echo  $p_id; ?>" /> <?php  } ?>
                                                                                        <tr>
                                                                                                <td></td>
                                                                                                <td><?php if (!empty($row["name"])) {
                                                                                                                echo $row["name"];
                                                                                                        } ?></td>
                                                                                                <td>
                                                                                                        <?php if ($row['custom_template'] == 'custom_template') { ?>
                                                                                                                <select class="form-control input-sm" name="qty[<?php echo  $row['rowid']; ?>]" id="qty_<?php echo $i; ?>" onchange="this.form.submit();">
                                                                                                                        <?php
                                                                                                                        if (!empty($qty_array)) {
                                                                                                                                foreach ($qty_array  as $q) { ?>
                                                                                                                                        <option value="<?php echo $q['template_quantity'] . '~' . $q['template_option_attribute_id']; ?>" <?php if ($q["template_quantity"] == $row["qty"]) {
                                                                                                                                                                                                                                                        echo "selected";
                                                                                                                                                                                                                                                } ?>>
                                                                                                                                                <?php echo $q["template_quantity"]; ?>
                                                                                                                                        </option>
                                                                                                                        <?php }
                                                                                                                        } ?>
                                                                                                                </select>
                                                                                                        <?php } else { ?>
                                                                                                                <select class="form-control input-sm" name="qty[<?php echo  $row['rowid']; ?>]" id="qty_<?php echo $i; ?>" onchange="this.form.submit();">
                                                                                                                        <?php
                                                                                                                        if (!empty($qty_array)) {
                                                                                                                                foreach ($qty_array  as $q) { ?>
                                                                                                                                        <option value="<?php echo $q['quantity'] . '~' . $q['qty_name']; ?>" <?php if ($q["qty_name"] == $row["qty"]) {
                                                                                                                                                                                                                        echo "selected";
                                                                                                                                                                                                                } ?>><?php echo $q["qty_name"]; ?>
                                                                                                                                        </option>
                                                                                                                        <?php }
                                                                                                                        } ?>
                                                                                                                </select>
                                                                                                        <?php } ?>
                                                                                                </td>
                                                                                                <td><?php if (!empty($row["price"])) {
                                                                                                                echo CURRENCY . ' ' . $row["price"];
                                                                                                        } ?></td>
                                                                                                <td>
                                                                                                        <a class="btn btn-warning" href="<?php echo base_url(); ?>cart/delete_item/<?php echo $row['rowid']; ?>" onclick="return confirm('Are you sure, you want to remove this item from cart?');">
                                                                                                                Delete
                                                                                                        </a>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td>
                                                                                                        <?php
                                                                                                        if ($row['custom_template'] == 'custom_template') {
                                                                                                                $template_id = $row['id'];
                                                                                                                try {
                                                                                                                        $result = $apiClient->get('/templates/' . $template_id . '?user_key=' . $tcapi_key . '&format=json&include=tags%2Csize%2Ccolour%2Ctags%2Ctag_group%2Cimages&filter_options=0&exclusive_tag_types=0');
                                                                                                                } catch (Exception $e) {
                                                                                                                        die($e->getMessage());
                                                                                                                }
                                                                                                        ?>
                                                                                                                <a href="<?php echo base_url(); ?>templates/more_template_details/<?php echo $template_id; ?>"><img src="<?php echo $result['template']['images'][0][0]; ?>" alt="" style="height:50px;width:50px"></a>
                                                                                                        <?php } else { ?>
                                                                                                                <a href="#">
                                                                                                                        <img src="<?php echo base_url(); ?>assets/images/subproducts/<?php echo $row['options']['sp_id'] ?>/thumbs/<?php echo $row['options']['sp_image'] ?>" alt="" style="height:50px;width:50px"></a>
                                                                                                        <?php } ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                        <span><?php if (!empty($artwork_arr)) {
                                                                                                                        echo $artwork_arr['file_name'] . '    (<a href="' . base_url() . 'copyservice/delete_artwork/' . $artwork_arr['up_id'] . '"><b>Delete</b></a>)';
                                                                                                                } ?></span>
                                                                                                        <?php if ($row['custom_template'] == 'custom_template') { ?>
                                                                                                                <a href="<?php echo base_url(); ?>templates/edit_template/<?php echo $row['id']; ?>/<?php echo $row['options']['instance_id']; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/editdesign_btn.png" alt=""></a>
                                                                                                        <?php } else { ?>

                                                                                                        <?php } ?>
                                                                                                </td>
                                                                                                <td colspan="4">
                                                                                                        Estimated dispatch: <?php echo $dispatch_date; ?> &nbsp;&nbsp; | &nbsp;&nbsp; Estimated arrive: <?php echo $arrive_date; ?>
                                                                                                </td>
                                                                                        </tr>
                                                                                </form>
                                                                                <?php if ($row['custom_template'] != 'custom_template') { ?>
                                                                                        <!------- POP UP START--------->
                                                                                        <div style="display:none">
                                                                                                <div id="artwork<?php echo $i;  ?>">
                                                                                                        <h1>Upload your artwork</h1>
                                                                                                        <form method="POST" name="upload_form" action="<?php echo base_url(); ?>copyservice/upload_artwork" enctype="multipart/form-data">
                                                                                                                <input name="r_id" id="r_id" type="hidden" value="<?php echo  $row['rowid']; ?>" />
                                                                                                                <input name="sp_id" id="sp_id" type="hidden" value="<?php echo  $sp_id; ?>" />
                                                                                                                <input name="p_id" id="p_id" type="hidden" value="<?php echo  $p_id; ?>" />
                                                                                                                <input type="file" name="artwork_file" id="artwork_file" /><br />
                                                                                                                <br>
                                                                                                                <center><input onclick="return check_upload_form();" type="image" src="<?php echo base_url(); ?>images/submitbtn.png"></center>
                                                                                                        </form>
                                                                                                </div>
                                                                                        </div>
                                                                                <?php } ?>
                                                                        <?php
                                                                                $i++;
                                                                        }
                                                                } else {
                                                                        ?>
                                                                        <tr>
                                                                                <td colspan="7">
                                                                                        <strong>Carrito Vacion</strong>
                                                                                </td>
                                                                        </tr>
                                                                <?php } ?>

                                                        </tbody>
                                                </table>
                                        </div>
                                        <!--Cart Item-->
                                        <div class="row update-wishlist">
                                                <div class="col-sm-12 hidden-xs">

                                                </div>
                                        </div>
                                        <div class="row cart-bottom">
                                                <!--Estimate Shipping : Begin-->
                                                <div class="col-sm-4 estimate-shipping clearfix">

                                                </div>
                                                <!--Estimate Shipping : End-->
                                                <!--Discount Code: Begin-->
                                                <div class="col-sm-4 discount-code clearfix">

                                                </div>
                                                <!--Discount Code: End-->
                                                <?php
                                                if ($this->cart->total_items() > 0) {
                                                ?>
                                                        <div class="col-sm-4 subtotal clearfix">
                                                                <h3>Sub total</h3>
                                                                <p>
                                                                        <strong>
                                                                                <?php
                                                                                echo CURRENCY . '' . number_format($ttl_sub_total, '2', '.', '');
                                                                                ?>
                                                                        </strong>
                                                                </p>
                                                                <ul>
                                                                        <li>


                                                                                <span class="sub-title">
                                                                                        Tax 7% :</span>
                                                                                <span class="sub-value"><strong>
                                                                                                <?php
                                                                                                $vat_price = ($ttl_sub_total * 7) / 100;
                                                                                                echo CURRENCY . '' . number_format($vat_price, '2', '.', '');
                                                                                                ?>
                                                                                        </strong>
                                                                                </span>

                                                                        </li>
                                                                        <li class="grand-total">
                                                                                <span class="sub-title">Grand Total</span>
                                                                                <span class="sub-value">
                                                                                        <?php
                                                                                        $total_amount = $vat_price + $ttl_sub_total;
                                                                                        $this->session->set_userdata("total_amount", $total_amount);
                                                                                        echo CURRENCY . ' ' . number_format($total_amount, '2', '.', ''); ?>
                                                                                </span>
                                                                        </li>
                                                                </ul>
                                                                <a class="btn btn-info" href="<?php echo base_url(); ?>cart/bill_ship_info">Proceed Checkout</a>
                                                        </div>
                                                <?php } ?>
                                        </div>

                                </section><!-- Cart main content : End -->
                                <!--Cart right banner: Begin-->
                                <section class="col-sm-3 cart-right-banner hidden-sm hidden-xs">
                                        <div class="cart-right-banner">
                                                <a href="#" title="cart right banner">
                                                        <img src="<?php echo base_url(); ?>assets/images/banner/cart/cart-right-banner.jpg" alt="cart right banner">
                                                </a>
                                        </div>
                                </section>
                                <!--Cart right banner: End-->
                        </div>

                </div>
        </section>

</main>