<script>
  $(document).ready(function() {
    var sp_id = "";
    var a = $('input:radio[name="subproduct_radio"]:checked').val();
    //alert(a);
    if (a) {
      sp_id = a;
    } else {
      sp_id = '<?php echo $s_p_id ?>';
    }
    var att_length = $("#length").html();
    var combination = "";
    var p_id = '<?php echo $p_id ?>';
    for (var i = 0; i < att_length; i++) {
      $('input:radio[name=attribute_' + i + ' ]:checked').addClass("check");
      var value = $('input:radio[name=attribute_' + i + ' ]:checked').val();
      combination += value + ",";
    }

    $.ajax({
      type: "POST",
      url: base_url + "common/calculate_price",
      data: "combination=" + combination + "&p_id=" + p_id + "&sp_id=" + sp_id,
      success: function(msg) {
        //alert(msg + "=msg");
        if ($.trim(msg) != "") {
          $("#dynamic_gid").html(msg);
          $("#dynamic_gid").hide().fadeIn("slow");
        } else {

          $("#dynamic_gid").html("<tr><td>No prices available</td></tr>");

        }
      }
    });
    combination = '';
  });

  function getCombination() {
    var sp_id = "";
    var a = $('input:radio[name="subproduct_radio"]:checked').val();
    if (a) {
      sp_id = a;
    } else {
      sp_id = '<?php echo $s_p_id ?>';
    }
    var p_id = '<?php echo $p_id ?>';
    var value = '';
    var combination = ''
    var att_length = $("#length").html();
    for (var i = 0; i < att_length; i++) {
      var value = $('input:radio[name="attribute_' + i + '"]:checked').val();
      combination += value + ",";
    }
    $.ajax({
      type: "POST",
      url: base_url + "common/calculate_price",
      data: "combination=" + combination + "&p_id=" + p_id + "&sp_id=" + sp_id,
      success: function(msg) {
        //alert(msg);
        if ($.trim(msg) != "") {
          $("#dynamic_gid").html(msg);
          $("#dynamic_gid").hide().fadeIn("slow");
        } else {

          $("#dynamic_gid").html("<tr><td>No prices available</td></tr>");

        }
      }
    });
  }

  function calculate_subproduct_price(s_p_id) {
    var p_id = '<?php echo $p_id ?>';
    var sp_id = s_p_id
    location.href = base_url + "printing/order_print/" + p_id + "/" + sp_id + "/status";
  }

  function submitCADfrm() {
    $("#qty_frm").submit();
  }
</script>
<?php

$CI = &get_Instance();
$CI->load->model("admin/common_model");

//p_id  and sp_id coming from controller
$p_id = $p_id;
$s_p_id = $s_p_id;

//getting subproduct detail
$tbl = "exp_tbl_sub_products";
$col = "sp_id";
$sub_product = $this->common_model->get_item_by_id($tbl, $col, $s_p_id);

//getting product detail for some purpose
$tbl1 = "exp_tbl_products";
$col1 = "p_id";
$product = $this->common_model->get_item_by_id($tbl1, $col1, $p_id);

//getting details of all subproducts
$tbl_name4 = "exp_tbl_sub_products";
$col4 = "p_id";
$value4 = $p_id;
$sub_pro_detail = $this->common_model->get_result_array_by_id($tbl_name4, $col4, $value4);

$CI->load->model("admin/common_model");
$att_array = $CI->common_model->get_subproduct_attributes($p_id, $s_p_id);
?>

<main class="main">
  <section class="header-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 hidden-xs">
          <h1 class="mh-title">
            <a class="text-primary" href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $product['p_name']);  ?>/<?php echo $product['p_id'];  ?>"><?php if (!empty($product['p_name'])) {
                                                                                                                                                                                          echo $product['p_name'];
                                                                                                                                                                                        } ?></a>
            >
            <?php if (!empty($sub_product['sp_name'])) {
              echo $sub_product['sp_name'];
            }  ?>
          </h1>
        </div>
        <div class="breadcrumb-w col-sm-6">
          <span class="hidden-xs">You are here:</span>
          <ul class="breadcrumb">
            <li>
              <a href="<?php echo base_url(); ?>products">Home</a>
            </li>
            <li>
              <span>
                <a href="<?php echo base_url(); ?>printing/printing_cards/<?php echo str_replace(' ', '-', $product['p_name']);  ?>/<?php echo $product['p_id'];  ?>">
                  <?php if (!empty($product['p_name'])) {
                    echo $product['p_name'];
                  } ?> </a> /
                <?php if (!empty($sub_product['sp_name'])) {
                  echo $sub_product['sp_name'];
                }  ?>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="aboutus" class="pr-main" style="padding: 0px;">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <img class="img-fluid" src="<?php echo base_url(); ?>assets/images/subproducts/<?php if (!empty($sub_product['sp_id'])) {
                                                                                            echo $sub_product['sp_id'];
                                                                                          } ?>/profile/<?php if (!empty($sub_product['sp_image'])) {
                                                                                                          echo $sub_product['sp_image'];
                                                                                                        } ?>">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="top">
            <h2><span>Order <?php if (!empty($sub_product['sp_name'])) {
                              echo $sub_product['sp_name'];
                            }  ?></span></h2>
            <?php if (!empty($sub_product['sp_description'])) {
              echo $sub_product['sp_description'];
            }  ?>

            <div class="table-responsive">

              <table>
                <caption>
                  <div class="timersec">
                    <div id="countdown"></div>
                  </div>

                  <!-----showing all subproducts dynamically--->
                  <div class="turnaround_sec">
                    <ul>
                      <li>
                        <?php
                        if ($status != '') {
                          if (!empty($sub_pro_detail)) {

                            echo "Select Paper/Product type";
                            foreach ($sub_pro_detail as $a) { ?>
                              <div class="product_type"><?php echo $a['sp_name'] ?></div>
                              <p class="product_type_p">
                                <input type="radio" class="att_radio" value="<?php echo $a['sp_id']; ?>" name="subproduct_radio" id="subproduct_radio" <?php if ($a['sp_id'] == $sub_product['sp_id']) {
                                                                                                                                                          echo 'checked';
                                                                                                                                                        } ?> onclick="calculate_subproduct_price('<?php echo $a['sp_id']; ?>')" />
                              </p>
                        <?php
                            }
                          }
                        } ?>
                      </li>
                      <!----------- getting attributes of a subproduct------------------>
                      <?php
                      $CI->load->model("admin/common_model");
                      $att_array = $CI->common_model->get_subproduct_attributes($p_id, $s_p_id);
                      $i = 0;
                      foreach ($att_array as $row) {
                      ?>
                        <li>
                          <?php echo $row["att_name"]; ?>
                          <ul style="list-style-type:none">
                            <?php
                            $value_array = $CI->common_model->get_subproduct_attribute_values($p_id, $s_p_id, $row["att_id"]);
                            $chk = 0;
                            foreach ($value_array as $v) {
                            ?>
                              <li style="list-style:none">
                                <input type="radio" class="att_radio" name="attribute_<?php echo $i; ?>" id="attribute_<?php echo $i; ?>" <?php if ($chk == 0) {
                                                                                                                                            echo "checked";
                                                                                                                                          } ?> value="<?php echo $v["val_id"]; ?>" onClick="getCombination()">
                                <span>
                                  <?php echo $v["value_name"]; ?>
                                </span>
                              </li>
                            <?php
                              $chk++;
                            } ?>

                          </ul>
                        </li>
                      <?php $i++;
                      } ?>
                      <?php if ($p_id == '35') { ?>
                        <li class="qty">
                          Enter Quantity<br />
                          <form name="qty_frm" id="qty_frm" method="post" action="<?php echo base_url(); ?>cart/basket/">
                            <input type="text" name="quantity" id="quantity" value="" style="width:76px;" /><br><textarea name="additional_info" placeholder="Additional Information" style="width: 60%;height: 100px;padding: 4px;"></textarea><br /><a href="javascript:void(0);" onclick="submitCADfrm();">Add To Cart</a>
                            <input type="hidden" name="p_id" value="<?php echo $p_id; ?>" />
                            <input type="hidden" name="s_p_id" value="<?php echo $s_p_id; ?>" />
                          </form>
                        </li>
                      <?php } ?>
                      <li class="click_next">
                        Click on price below to order...
                      </li>
                    </ul>
                    <span style="visibility:hidden" id="length"><?php echo $i; ?></span>
                  </div><!---------end of attributes--------->

                </caption>
              </table>


            </div> <!-- fin de table-responsive -->

          </div>
          <!-----showing all subproducts dynamically--->

          <div>

          </div>

          <!-----------------end of attributes------------------------>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <p> <strong> Most popular quantities below... Enter custom quantity above to order any amount in between</strong></p>
        </div>
      </div>

    </div>
    <div class="col-md-4 col-md-offset-4 col-sm-4 col-xs-12">
      <table class="table table-bordered" id="dynamic_gid">
        <tr>
          <td>
          </td>
        </tr>
      </table>
    </div>
    </div>
    </div>
  </section>
</main>
<?php
$arrive_date = Date('Y-m-d', strtotime('+1 days'));
$date = explode('-', $arrive_date);
$years = $date[0];
$months = $date[1];
$days = substr($date[2], 0, 2);
?>
<script>
  jQuery(function() {
    var austDay = new Date();
    var day = '<?php echo $days; ?>';
    var month = '<?php echo $months; ?>';
    var year = '<?php echo $years; ?>';
    austDay = new Date(year, month - 1, day, 12, 00, 00);
    jQuery('#countdown').countdown({
      until: austDay,
      format: 'HMS',
      layout: '<h1 class="countdown_title">Order within:</h1>' +
        '<div class="time_left" id="time_left">' +
        '<p id="timer_hours" class="blackbg_inside_main_top_1_blackcircle count-down-item"><span>{hnn}</span><span style="font-size: 12px !important;"> hours</span></p>' +
        '<p id="timer_mins" class="blackbg_inside_main_top_1_blackcircle count-down-item"><span>{mnn}</span><span style="font-size: 12px !important;"> minutes</span></p>' +
        '<p id="timer_seconds" class="blackbg_inside_main_top_1_blackcircle count-down-item"><span>{snn}</span><span style="font-size: 12px !important;"> seconds</span></p>' +
        '</div>'
    });
    var countDownObj = document.getElementById("countdown");
  });
</script>