<?php

$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_countries';
$all_countries = $CI->common_model->get_all_list($tbl_name);

?>
<?php
require('Pest/PestJSON.php');
$apiClient = new PestJSON('http://api.templatecloud.com/sandbox');
$apiClient->setupAuth('manoj123', 'admin123');
$tcapi_key = 'd5f111e77c683150cb80860e197a66d0';
//debug($all_saved_design);
?>
<main>
  <div class="container-fluid px-4 mt-2">
    <div class="row">
      <div class="col-12">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-globe"></i> MyOnlinePrinting.net
                <small class="float-right">Date: <?php echo ($order['order_date']); ?></small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-3 invoice-col">
              <b class="text-primary">BILLING INFORMATION</b>
              <address>
                <strong>User Name :</strong> <?php echo ($order['bill_f_name'] != "") ? $order['bill_f_name'] : "Not bentioned"; ?><br>
                <strong>Company</strong>: <?php echo $order['bill_c_name'] == "" ? "Not Mentioned" : $order['bill_c_name']; ?><br>
                <strong>Country :</strong>
                <?php if (!empty($order["bill_country"])) {
                  foreach ($all_countries as $row) {
                    if ($row["country_id"] == $order["bill_country"]) {
                      echo ($row['country_name']);
                    }
                  }
                } ?>
                <br>
                <strong>Street1 :</strong> <?php echo ($order['bill_address1'] != "") ? $order['bill_address1'] : "Not Mentioned"; ?>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
              --
              <address>
                <strong>Street2 :</strong> <?php echo ($order['bill_address2'] != "") ? $order['bill_address2'] : "Not Mentioned"; ?><br>
                <strong>ZIP :</strong><?php echo ($order['bill_postcode'] != "") ? $order['bill_postcode'] : "Not Mentioned"; ?><br>
                <strong>State : </strong>
                <?php
                $state_id = $order['bill_town'];
                $tbl = "exp_tbl_states";
                $col = "state_id";
                $state_name = $this->common_model->get_item_by_id($tbl, $col, $state_id);
                if (!empty($state_name)) {
                  echo $state_name["state_name"];
                } else {
                  echo "Not Mentioned";
                }
                ?>
                <br>
                <strong>Phone :</strong>
                <?php echo ($order['bill_phone'] != "") ? $order['bill_phone'] : "Not Mentioned"; ?><br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
              <b class="text-primary">SHIPPING INFORMATION</b><br>
              <b>User Name:</b> <?php echo ($order['ship_f_name'] != "") ? $order['ship_f_name'] : "Not Mentioned"; ?><br>
              <b>Company:</b> <?php echo $order['ship_c_name'] == "" ? "Not Mentioned" : $order['ship_c_name']; ?><br>
              <b>Country:</b>
              <?php if (!empty($order["ship_country"])) {
                foreach ($all_countries as $row) {
                  if ($row["country_id"] == $order["ship_country"]) {
                    echo ($row['country_name']);
                  }
                }
              } ?><br>
              <b>Street1: </b>
              <?php echo ($order['ship_address1'] != "") ? $order['ship_address1'] : "Not Mentioned"; ?>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
              <br>
              <b>Street2 : </b> <?php echo ($order['ship_address2'] != "") ? $order['ship_address2'] : "Not Mentioned"; ?><br>
              <b>ZIP:</b> <?php echo ($order['ship_postcode'] != "") ? $order['ship_postcode'] : "Not Mentioned"; ?><br>
              <b>State :</b>
              <?php
              $state_id = $order['ship_town'];
              $tbl = "exp_tbl_states";
              $col = "state_id";
              $state_name = $this->common_model->get_item_by_id($tbl, $col, $state_id);
              if (!empty($state_name)) {
                echo $state_name["state_name"];
              }
              ?>
              <br>
              <b>Phone: </b>
              <?php echo ($order['ship_phone'] != "") ? $order['ship_phone'] : "Not Mentioned"; ?>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>SubProduct</th>
                    <th>Attributes</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Shipping</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total_amount = 0;
                  $total_shipping = 0;
                  $overall = 0;
                  $order_id = $order['order_id'];
                  $tbl_name = 'exp_tbl_order_items';
                  $col = "o_id";
                  $items_array = $CI->common_model->get_result_array_by_id($tbl_name, $col, $order_id);
                  //debug($items_array);
                  if (!empty($items_array)) {
                    foreach ($items_array as $row) {
                      if ($row['order_template_type'] == 'custom_template') {

                        $template_id = $row['order_template_id'];
                        $instance_id = $row['order_instance_id'];
                        try {

                          $result = $apiClient->get('/templates/' . $template_id . '?user_key=' . $tcapi_key . '&format=json&include=tags%2Csize%2Ccolour%2Ctags%2Ctag_group%2Cimages&filter_options=0&exclusive_tag_types=0');
                        } catch (Exception $e) {
                          die($e->getMessage());
                        }
                        //debug($result);

                  ?>
                        <tr>
                          <td><a href="<?php echo base_url(); ?>admin/template/edit_template/<?php echo $template_id; ?>/<?php echo $instance_id; ?>" target="_blank"><img src="<?php echo $result['template']['images'][0][0]; ?>" style="height: 70px;width: 100%;"></a></td>
                          <td>Buisness Card</td>
                          <td><?php echo $row['order_template_name']; ?></td>
                          <td>NA</td>
                          <td>NA</td>
                          <td><?php echo $row['qty']; ?></td>
                          <td><?php echo $row['p_amount']; ?></td>
                          <td>
                            <?php echo $row["p_ship_amount"];
                            $total_shipping += (int)$row["p_ship_amount"]; ?>
                          </td>
                        </tr>
                      <?php } else { ?>
                        <tr>
                          <td style="width:16%;">
                            <?php
                            $tbl_name = "exp_tbl_sub_products";
                            $col = "sp_id";
                            $subproduct = $CI->common_model->get_item_by_id($tbl_name, $col, $row["sp_id"]);
                            if (!empty($subproduct)) { ?>
                              <img src="<?php echo base_url() ?>assets/images/subproducts/<?php echo $subproduct['sp_id'] ?>/thumbs/<?php echo $subproduct['sp_image'] ?>" style="height:70px;width:70%;">
                              <br />
                              <a href="<?php echo base_url(); ?>cart/download_file/<?php echo $row['r_id'] ?>/<?php echo $row['artwork_file'] ?>">Download File</a>
                            <?php   }
                            ?>
                          </td>
                          <td>
                            <?php
                            $tbl_name = "exp_tbl_products";
                            $col = "p_id";
                            $product_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["p_id"]);
                            if (!empty($product_name)) {
                              echo $product_name['p_name'];
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            $tbl_name = "exp_tbl_sub_products";
                            $col = "sp_id";
                            $subproduct_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["sp_id"]);
                            if (!empty($subproduct_name)) {
                              echo $subproduct_name['sp_name'];
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            $value_array =  explode(",", $row["att_combination"]);
                            foreach ($value_array as $val) {
                              $tbl_name = "exp_tbl_attribute_values";
                              $col = "value_id";
                              $value_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["sp_id"]);
                              if (!empty($value_name)) {
                                echo $value_name['value_name'] . ",";
                              } else {
                                echo 'NA';
                              }
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            $tbl_name = "tbl_size";
                            $col = "size_id";
                            $size_name = $CI->common_model->get_item_by_id($tbl_name, $col, $row["size"]);
                            if (!empty($size_name)) {
                              echo $size_name['size_name'];
                            }
                            ?>
                          </td>
                          <td>
                            <?php echo $row["qty"]; ?>
                          </td>
                          <td>
                            <?php echo $row["p_amount"]; ?>
                          </td>
                          <td>
                            <?php

                            echo $row["p_ship_amount"];
                            $total_shipping += (int)$row["p_ship_amount"];
                            ?>
                          </td>
                        </tr>
                  <?php

                      }
                      $total_amount += (int)$row["p_amount"];
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              <!-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
              </p> -->
            </div>
            <!-- /.col -->
            <div class="col-6">
              <p class="lead">Calculos</p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td><?php echo CURRENCY . $total_amount;  ?></td>
                  </tr>
                  <tr>
                    <th>Vat (20%)</th>
                    <td>
                      <?php
                      $total = (int)$order["total_amt"];
                      $vat = ($total_amount * 20) / 100;
                      echo CURRENCY . $vat;
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Total Shipping:</th>
                    <td><?php echo CURRENCY . $total_shipping; ?></td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td>
                      <?php
                      $overall = $total_amount + $vat + $total_shipping;
                      echo CURRENCY . number_format($overall, 2);
                      ?>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <a class="btn btn-warning px-4" href="<?php echo base_url(); ?>admin/order">Back to Listing</a>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</main>