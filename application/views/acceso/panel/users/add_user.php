<?php
$tblname = "exp_tbl_countries";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$country = $CI->common_model->get_all_list($tblname);
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-4">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/users/save_user" id="add_user_form" name="add_user_form" method="POST">
          <div class="row d-flex align-items-stretch">

            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Username
                </label>
                <input type="text" name="u_name" id="u_name" class="form-control">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Password
                </label>
                <input type="text" name="u_password" id="u_password" class="form-control">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Company
                </label>
                <input type="text" name="u_comp" id="u_comp" class="form-control">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Country
                </label>
                <select name="u_country" id="u_country" class="form-select" onchange="get_by_id(this.value);">
                  <option value="">select country</option>
                  <?php
                  foreach ($country as $c) {
                    echo '<option value=' . $c["country_id"] . '>' . $c["country_name"] . '</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  User State
                </label>
                <select name="u_state" id="u_state" class="form-control">
                  <option value="">select state</option>
                </select>
                <p id="loader" style="margin-left:20px;margin-top:-4px;display:none"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif" /></p>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Address Line1
                </label>
                <textarea name="u_address1" id="u_address1" class="form-control"></textarea>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Address Line2
                </label>
                <textarea name="u_address2" id="u_address2" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Postcode
                </label>
                <input type="text" name="u_postcode" id="u_postcode" class="form-control">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Email
                </label>
                <input type="text" name="u_email" id="u_email" class="form-control">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Phone
                </label>
                <input type="text" name="u_phone" id="u_phone" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <div class="float-right">
                    <input type="submit" value="Save" class="btn btn-info" />
                  </div>
                </div>

              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</main>