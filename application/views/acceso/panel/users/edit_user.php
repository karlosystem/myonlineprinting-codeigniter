<script>
  $(document).ready(function() {
    $('#edit_user_form').validate({
      rules: {
        u_name: {
          required: true
        },
        u_password: {
          required: true,
        },
        u_comp: {
          required: true,
        },
        u_country: {
          required: true
        },
        u_state: {
          required: true
        },
        u_postcode: {
          required: true,
          number: true
        },
        u_email: {
          required: true
        },
        u_phone: {
          required: true,
          phoneUS: true
        }
      },
      submitHandler: function(form) {
        check_duplicate_email_update();
      }
    });
  });

  function check_duplicate_email_update() {
    var email = $("#u_email").val();
    var user_id = $("#user_id").val();
    //alert(user_id);
    url = base_url + "admin/users/check_duplicate_email_update";
    $.ajax({
      type: "POST",
      url: url,
      data: "email=" + email + "&user_id=" + user_id,
      async: true,
      success: function(msg) {
        //alert(msg);
        if (msg == 1) {
          alert("email already exists.try another email");
          location.href = location.href;
          return false;
        } else {
          document.edit_user_form.submit();
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert("Error occured. Please try again later.");
      }
    });
  }
</script>
<?php
//code for getting all countries
$tblname = "exp_tbl_countries";
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$country = $CI->common_model->get_all_list($tblname);

//code for getting value of state
$tbl_state = "exp_tbl_states";
$s_col = "state_id";
$s_value = $result['u_state'];
$state = $CI->common_model->get_item_by_id($tbl_state, $s_col, $s_value);
//debug($state);

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
        <form action="<?php echo base_url(); ?>admin/users/update_user" id="edit_user_form" name="edit_user_form" method="POST">
          <div class="row d-flex align-items-stretch">
            <input type="hidden" name="user_id" id="user_id" value="<?php if (!empty($result['u_id'])) {
                                                                      echo $result['u_id'];
                                                                    }  ?>" />

            <div class="col-md-6">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Username
                </label>
                <input type="text" name="u_name" id="u_name" class="form-control" value="<?php if (!empty($result['u_name'])) {
                                                                                            echo $result['u_name'];
                                                                                          } ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Company
                </label>
                <input type="text" name="u_comp" id="u_comp" class="form-control" value="<?php if (!empty($result['u_comp'])) {
                                                                                            echo $result['u_comp'];
                                                                                          } ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Country
                </label>
                <select name="u_country" id="u_country" class="form-select" onchange="get_by_id(this.value);">
                  <option value="">select country</option>
                  <?php
                  foreach ($country as $c) { ?>
                    <option value=<?php echo $c["country_id"]; ?> <?php if ($c["country_id"] == $result['u_country']) {
                                                                    echo "selected";
                                                                  } ?>><?php echo $c["country_name"]; ?></option>

                  <?php }
                  ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  State
                </label>
                <select name="u_state" id="u_state" class="form-select">
                  <option value="<?php if (!empty($result['u_state'])) echo $result['u_state'];  ?>"><?php if (!empty($state['state_name'])) echo $state['state_name'] ?></option>
                </select>
                <p id="loader" style="margin-left:20px;margin-top:-4px;display:none"><img src="<?php echo base_url(); ?>images/admin/ajax-loader.gif" /></p>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Address Line1
                </label>
                <textarea name="u_address1" id="u_address1" class="form-control"><?php if (!empty($result['u_add_line1'])) {
                                                                                    echo $result['u_add_line1'];
                                                                                  } ?></textarea>
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Address Line2
                </label>
                <textarea name="u_address2" id="u_address2" class="form-control"><?php if (!empty($result['u_add_line2'])) {
                                                                                    echo $result['u_add_line2'];
                                                                                  } ?></textarea>
              </div>


            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Postcode
                </label>
                <input type="text" name="u_postcode" id="u_postcode" class="form-control" value="<?php if (!empty($result['u_postcode'])) {
                                                                                                    echo $result['u_postcode'];
                                                                                                  } ?>">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Email
                </label>
                <input type="text" name="u_email" id="u_email" class="form-control" value="<?php if (!empty($result['u_email'])) {
                                                                                              echo $result['u_email'];
                                                                                            } ?>">
              </div>
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Phone
                </label>
                <input type="text" name="u_phone" id="u_phone" class="form-control" value="<?php if (!empty($result['u_phone'])) {
                                                                                              echo $result['u_phone'];
                                                                                            } ?>">
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <div>
                    <input type="submit" value="Editar" class="btn btn-primary btn-xs float-left" />
                    <a href="<?php echo base_url(); ?>admin/users/" class="btn btn-dark btn-xs float-end">
                      Back to Listing</a>
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