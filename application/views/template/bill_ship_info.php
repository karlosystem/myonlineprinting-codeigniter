<script type="text/javascript">
  function show_ship_form() {
    if ($("#ship_checkbox").is(":checked")) {
      $('#ship_form').show();
      $("#ship_checkbox_value").val('1');
    } else {
      $('#ship_form').hide();
      $("#ship_checkbox_value").val('0');
    }
  }
</script>
<style>
  .payment_form {
    width: 100%;
    margin: 12px 0;
  }

  .payment_selectfield {
    border: 1px solid #CCCCCC;
    float: left;
    height: 26px;
    padding: 3px;
    width: 99%;
    margin: 0 9px 0 0px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
  }

  .visa_sec {
    width: auto;
    float: left;
    margin: 19px 0 10px;
  }

  .visa_sec span {
    width: auto;
    float: left;
    margin: 0 18px 0 0px;
  }

  .visa_sec span input {
    float: left;
    margin: 18px 7px 0 0;
    width: auto;
  }

  .termscond_sec {
    float: left;
    margin: 6px 0 16px;
    width: auto;
  }

  .ordertotal_sec {
    width: 662px;
    float: left;
    margin: 16px 0;
  }

  .ordertotal_sec h4 {
    color: #01A4C5;
    font-family: 'oswaldlight';
    font-size: 16px;
    width: 100%;
    float: left;
  }

  .ordertotal_sec span {
    width: auto;
    float: left;
  }

  .productdesign_sec {
    float: left;
    width: 980px;
  }

  .print_headingsec {
    width: 980px;
    float: left;
    margin: 11px 0px;
  }

  .col_textfield {
    color: #000000;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    font-weight: bold;
  }


  .col_inputfield input {
    border: 1px solid #CCCCCC;
    /*color: #000000;*/
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    padding: 5px;
    width: 100%;
  }

  .col_inputfield2 input {
    border: 1px solid #CCCCCC;
    color: #999999;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    padding: 5px;
    width: 150px;
  }


  .reg_inputfield select {
    border: 1px solid #CCCCCC;
    float: left;
    padding: 5px;
    width: 100%;

  }

  .inlineimage {
    max-width: 470px;
    margin-right: 8px;
    margin-left: 10px
  }

  .images {
    display: inline-block;
    max-width: 98%;
    height: auto;
    width: 22%;
    margin: 1%;
    left: 20px;
    text-align: center
  }
</style>
<?php
$tblname = "exp_tbl_countries";
$tblname1 = "exp_tbl_states";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$country = $CI->common_model->get_all_list($tblname);
$cntry_id = $user_info['u_country'];
$state = $CI->common_model->get_all_state($tblname1, $cntry_id);
?>
<main class="main">
  <section class="header-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 hidden-xs">
          <h1 class="mh-title">Place My Order</h1>
        </div>
        <div class="breadcrumb-w col-sm-9">
          <span class="hidden-xs">You are here:</span>
          <ul class="breadcrumb">
            <li>
              <a href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li>
              <span>Secure Checkout</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="checkout" class="pr-main">
    <div class="container">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="cart-top">
          <img src="<?php echo base_url(); ?>assets/images/banner/cart/top-banner.jpg">
        </div>
      </div>

      <div class="cart-view-top">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <h1>Secure Checkout</h1>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 right">
          <h1><a href="<?php echo base_url(); ?>products">Continue Shopping</a></h1>
        </div>
      </div>

      <div class="onepage">
        <form method="post" action="<?php echo base_url(); ?>cart/checkout" name="biil_ship_form" id="biil_ship_form">
          <input type="hidden" name="pay_type" id="pay_type" value="cardit_card">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div id="div_billto">
              <div class="pane round-box">
                <h3 class="title"><span class="icon icon-one">1</span>BILLING DETAILS</h3>
                <div class="pane-inner">
                  <ul id="table_billto" class="adminform user-details no-border">
                    <li class="short">
                      <div class="field-wrapper">
                        <label for="company_field" class="company">Company Name </label>
                        <br>
                        <input type="text" name="c_name" id="c_name" value="<?php if ($user_info['u_comp']) {
                                                                              echo $user_info['u_comp'];
                                                                            } ?>">
                      </div>
                    </li>

                    <li class="short right">
                      <div class="field-wrapper">

                        <label for="email_field" class="email">
                          Your name<em>*</em> </label>
                        <br>
                        <input type="text" name="u_name" id="u_name" value="<?php if ($user_info['u_name']) {
                                                                              echo $user_info['u_name'];
                                                                            } ?>">
                      </div>
                    </li>


                    <li class="long">
                      <div class="field-wrapper">

                        <label for="address_1_field" class="address_1">
                          Address 1<em>*</em> </label>
                        <br>
                        <input type="text" name="u_add_line1" id="u_add_line1" value="<?php if ($user_info['u_add_line1']) {
                                                                                        echo $user_info['u_add_line1'];
                                                                                      } ?>">
                      </div>
                    </li>
                    <br>
                    <li class="long">
                      <div class="field-wrapper">

                        <label for="address_1_field" class="address_1">
                          Address 2 </label>
                        <input type="text" name="u_add_line2" id="u_add_line2" value="<?php if ($user_info['u_add_line2']) {
                                                                                        echo $user_info['u_add_line2'];
                                                                                      } ?>">
                      </div>
                    </li>
                    <br>
                    <li class="short">
                      <div class="field-wrapper">

                        <label for="virtuemart_city" class="virtuemart_state_id">
                          City<em>*</em> </label>
                        <br>
                        <select style="width: 210px" name="u_country" id="u_country" class="vm-chzn-select" onchange="get_by_id(this.value);">
                          <option value="">select country</option>
                          <?php
                          foreach ($country as $c) {
                          ?>
                            <option value="<?php echo $c['country_id']; ?>" <?php if ($user_info['u_country'] == $c['country_id']) {
                                                                              echo "selected='selected'";
                                                                            } ?>><?php echo $c['country_name']; ?></option>;
                          <?php }
                          ?>
                        </select>
                      </div>
                    </li>

                    <li class="short right">
                      <div class="field-wrapper">

                        <label for="virtuemart_state_id_field" class="virtuemart_state_id">
                          State / Province / Region<em>*</em> </label>
                        <br>

                        <select style="width: 210px" name="u_state" id="u_state" class="vm-chzn-select" id="virtuemart_state_id">
                          <option value="">select state</option>
                          <?php
                          foreach ($state as $s) {
                          ?>
                            <option value="<?php echo $s['state_id']; ?>" <?php if ($user_info['u_state'] == $s['state_id']) {
                                                                            echo "selected='selected'";
                                                                          } ?>><?php echo $s['state_name']; ?></option>;

                          <?php }
                          ?>
                        </select>
                      </div>
                    </li>

                    <li class="short">
                      <div class="field-wrapper">

                        <label for="phone_1_field" class="phone_1">
                          Zip Code:</label>
                        <br>
                        <input type="text" name="u_postcode" id="u_postcode" value="<?php if ($user_info['u_postcode']) {
                                                                                      echo $user_info['u_postcode'];
                                                                                    } ?>">
                      </div>
                    </li>

                    <li class="short right">
                      <div class="field-wrapper">

                        <label for="phone_2_field" class="phone_2">
                          Mobile phone </label>
                        <br>
                        <input type="text" name="u_phone" id="u_phone" value="<?php if ($user_info['u_phone']) {
                                                                                echo $user_info['u_phone'];
                                                                              } ?>">
                      </div>
                    </li>
                    <li class="long">
                      <div class="field-wrapper">

                        <label for="address_1_field" class="address_1">
                          Email<em>*</em> </label>
                        <br>
                        <input type="text" name="u_email" id="u_email" value="<?php if ($user_info['u_email']) {
                                                                                echo $user_info['u_email'];
                                                                              } ?>">
                      </div>
                    </li>
                    <br>
                    <li class="long">
                      <div class="field-wrapper agreed">
                        <label for="agreed_field" class="agreed">
                          My shipping address is different to billing address.
                          <em>*</em>
                          <input type="checkbox" name="ship_checkbox" id="ship_checkbox" onClick="show_ship_form();" value="">
                        </label>

                        <input type="hidden" name="ship_checkbox_value" id="ship_checkbox_value" value="0">
                      </div>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div id="right-pane-top" class="col-md-12 col-sm-12 col-xs-12">
              <div id="shipping_method" class="col-md-12 col-sm-12 col-xs-12">
                <span style="display:none;" id="ship_form" name="ship_form">
                  <div class="shipment-pane">
                    <div class="pane round-box">
                      <h3 class="title">
                        <span class="icon icon-three">2</span>
                        SHIPPING DETAILS
                      </h3>
                      <div id="table_shipto" class="pane-inner">
                        <ul id="table_billto" class="adminform user-details no-border">
                          <li class="short">
                            <div class="field-wrapper">
                              <label for="company_field" class="company">Company Name </label>
                              <br>
                              <input type="text" name="sc_name" id="sc_name" value="">
                            </div>
                          </li>

                          <li class="short right">
                            <div class="field-wrapper">

                              <label for="email_field" class="email">
                                Your name<em>*</em> </label>
                              <br>
                              <input type="text" name="su_name" id="su_name" value="">
                            </div>
                          </li>


                          <li class="long">
                            <div class="field-wrapper">

                              <label for="address_1_field" class="address_1">
                                Address 1<em>*</em> </label>
                              <br>
                              <input type="text" name="su_add_line1" id="su_add_line1" value="">
                            </div>
                          </li>

                          <li class="long">
                            <div class="field-wrapper">

                              <label for="address_1_field" class="address_1">
                                Address 2 </label>
                              <input type="text" name="su_add_line2" id="su_add_line2" value="">
                            </div>
                          </li>

                          <li class="short">
                            <div class="field-wrapper">
                              <label for="virtuemart_city" class="virtuemart_state_id">
                                Country<em>*</em> </label>
                              <br>
                              <select name="su_country" id="su_country" onchange="get_by_ids(this.value);">
                                <option value="">select country</option>
                                <?php
                                foreach ($country as $c) {
                                ?>
                                  <option value="<?php echo $c['country_id']; ?>"><?php echo $c['country_name']; ?></option>;
                                <?php }
                                ?>
                              </select>
                            </div>
                          </li>

                          <li class="short right">
                            <div class="field-wrapper">

                              <label for="virtuemart_state_id_field" class="virtuemart_state_id">
                                State / Province / Region<em>*</em> </label>
                              <br>
                              <select name="su_state" id="su_state" class="input-xlarge text">
                                <option value="">select state</option>
                              </select>
                            </div>
                          </li>

                          <li class="short">
                            <div class="field-wrapper">

                              <label for="phone_1_field" class="phone_1">
                                Zip Code:</label>
                              <br>
                              <input type="text" name="su_postcode" id="su_postcode" value="">
                            </div>
                          </li>

                          <li class="short right">
                            <div class="field-wrapper">

                              <label for="phone_2_field" class="phone_2">
                                Mobile phone </label>
                              <br>
                              <input type="text" name="su_phone" id="su_phone" value="">
                            </div>
                          </li>
                          <li class="long">
                            <div class="field-wrapper">

                              <label for="address_1_field" class="address_1">
                                Email<em>*</em> </label>
                              <br>
                              <input type="text" name="su_email" id="su_email" value="">
                            </div>
                          </li>

                        </ul>
                      </div>
                    </div>
                  </div>
                </span>
                </li>
                </ul>
              </div>


            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">

            <div class="onepage">
              <div class="delivery-time-pane col-md-12 col-sm-12 col-xs-12">
                <h3 class="title">
                  <span class="icon icon-five">3</span>
                  Payment Details
                </h3>
                <div id="table_shipto" class="pane-inner">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        <div class="inlineimage"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Mastercard-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Discover-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/Paypal-Curved.png"> <img class="img-responsive images" src="https://cdn0.iconfinder.com/data/icons/credit-card-debit-card-payment-PNG/128/American-Express-Curved.png"> </div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="form-group">
                            <label>Credit Card Type:</label>

                            <select class="form-control" name="card_type" id="card_type">
                              <option value="">select</option>
                              <option value="vis">Visa</option>
                              <option value="mcd">Mastercard</option>
                              <option value="dis">Discover</option>
                              <option value="amx">AMEX</option>
                            </select>

                          </div>

                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="form-group"> <label>CARD NUMBER</label>
                            <div class="input-group">
                              <input type="text" name="card_number" id="card_number" autocomplete="off" class="form-control" placeholder="Valid Card Number" />
                              <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-7 col-md-7">
                          <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> MONTH</label>
                            <select class="form-control" name="exp_month" id="exp_month">
                              <?php foreach ($allMonth as $key => $month) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $month; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-5 col-md-5 pull-right">
                          <div class="form-group"> <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> YEAR</label>
                            <select class="form-control" name="exp_year" id="exp_year">
                              <option value="">Year</option>
                              <?php foreach ($allYear as $key => $year) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $year; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="form-group">
                            <label>Security code:</label>
                            <input type="text" class="form-control" name="ccv_code" id="ccv_code" value="" maxlength="3" autocomplete="off">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="form-group">

                            <ul class="nav nav-pills nav-stacked">
                              <li class="active"><a href="#">
                                  <span class="badge pull-right">
                                    <span class="fa fa-usd" aria-hidden="true"></span>
                                    <?php
                                    $total_amt = $this->session->userdata("total_amount");
                                    echo number_format($total_amt, '2', '.', '');
                                    ?>
                                  </span> Final Payment</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="panel-footer">
                      <div class="row">
                        <div class="col-xs-12"> <button class="btn btn-success btn-lg btn-block">Confirm Payment</button> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </form>
      </div><!-- shipping_method -->

    </div>
    </div>
  </section>
</main>