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
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title; ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/common/add_quantity" class="btn btn-primary btn-xs float-end"><b>+</b> Add new Quantity</a>

        <a href="#" onclick="delete_item('exp_tbl_qty','qty_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Quantity</a>

      </div>
    </div>
    <div class="card mb-2">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Mantenimiento
      </div>
      <div class="card-body">
        <table id="datatablesSimple" class="table table-custom table-hover ">
          <thead class="table-dark">
            <tr>
              <th align="center" scope="col">
                <input type="checkbox" name="main_checkbox" id="main_checkbox" onclick="checkall();" />
              </th>
              <th>Sr. No.</th>
              <th>Quantity</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($qty_array)) {
              $cnt = 1;
              foreach ($qty_array as $qty) {
                $id = $qty['qty_id'];
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td>
                    <?php echo $cnt; ?>
                  </td>
                  <td>
                    <?php if (!empty($qty['qty_name'])) {
                      echo $qty['qty_name'];
                    } ?>
                  </td>
                  <td align="center">
                    <a href="<?php echo base_url(); ?>admin/common/edit_quantity/<?php echo $id; ?>"><img src="<?php echo base_url(); ?>assets/images/admin/user_edit.png" /></a>
                  </td>
                </tr>
              <?php $cnt++;
              }
            } else { ?>
              <tr>
                <td colspan='7' style='text-align:center'><b>No Record Found</b></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
</main>