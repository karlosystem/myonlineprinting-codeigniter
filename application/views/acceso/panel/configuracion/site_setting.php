<?php
$tblname = "exp_tbl_paypal_setting";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$result = $CI->common_model->get_all_list($tblname);

if ($this->session->userdata("valid_box")) {
  echo "<div class='alert alert-success' role='alert'>";
  echo $this->session->userdata("success_message");
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("valid_box");
  echo "</div>";
} else if ($this->session->userdata("error_box")) {
  echo "<div class='alert alert-danger' role='alert'>";
  echo $this->session->userdata("success_message");
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("error_box");
  echo "</div>";
}
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-4">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/admin/update_site_setting" id="setting_form" name="setting_form" method="POST">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-3">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Business Email
                </label>
                <input type="text" value="<?php if (!empty($result[0]['business_email'])) {
                                            echo $result[0]['business_email'];
                                          } ?>" name="b_email" id="b_email" class="form-control">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  api username
                </label>
                <input type="text" value="<?php if (!empty($result[0]['api_username'])) {
                                            echo $result[0]['api_username'];
                                          } ?>" name="api_username" id="api_username" class="form-control">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  api password
                </label>
                <input type="password" value="<?php if (!empty($result[0]['api_password'])) {
                                                echo $result[0]['api_password'];
                                              } ?>" name="api_password" id="api_password" class="form-control">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  api signature
                </label>
                <input type="text" value="<?php if (!empty($result[0]['api_signature'])) {
                                            echo $result[0]['api_signature'];
                                          } ?>" name="api_signature" id="api_signature" class="form-control">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Environment
                </label>
                <select name="environment" id="environment" class="form-select">
                  <option value="test" <?php if ($result[0]['enviroment'] == "test") {
                                          echo "selected";
                                        } ?>>test</option>
                  <option value="live" <?php if ($result[0]['enviroment'] == "live") {
                                          echo "selected";
                                        } ?>>live</option>
                </select>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-3 float-left">
              <div class="float-left">
                <input type="submit" value="Save" class="btn btn-info" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>