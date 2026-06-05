<?php
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
<script>
  $(document).ready(function() {
    $('#add_quantity_form').validate({
      rules: {
        qty_name: {
          required: true
        },
      },
      submitHandler: function(form) {
        var qty_name = $("#qty_name").val();
        ajax_check_duplicate_quantity(qty_name);
      }
    });
  })

  function ajax_check_duplicate_quantity(qty_name) {
    url = base_url + "admin/common/check_duplicate_quantity";
    $.ajax({
      type: "POST",
      url: url,
      data: "qty_name=" + qty_name,
      success: function(msg) {
        if (msg == 1) {
          alert("OOPS!!!!!quantity already exists. Please try another");
          return false;
        } else {
          document.add_quantity_form.submit();
        }
      }
    });
  }
</script>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-4">
      <div class="card-body">
        <form action="<?php echo base_url(); ?>admin/common/save_quantity" id="add_quantity_form" name="add_quantity_form" method="POST" enctype="multipart/form-data">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-2 offset-md-3 text-center">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Quantity
                </label>
                <input type="text" name="qty_name" id="qty_name" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 offset-md-3 text-center">
              <div class="float-right">
                <input type="submit" value="Save" class="btn btn-info" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>