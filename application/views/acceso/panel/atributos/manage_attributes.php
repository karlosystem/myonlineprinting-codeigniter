<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title; ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/attributes/add_attribute" class="btn btn-primary btn-xs float-end"><b>+</b> Add Attribute</a>

        <a href="#" onclick="delete_item('exp_tbl_attributes','att_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Attribute</a>

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
              <th>Name</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($attributes)) {
              $cnt = 1;
              foreach ($attributes as $a) {
                $id = $a['att_id'];
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td>
                    <?php echo $cnt; ?>
                  </td>
                  <td>
                    <?php if (!empty($a['att_name'])) {
                      echo $a['att_name'];
                    } ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url(); ?>admin/attributes/edit_attribute/<?php if (!empty($a['att_id'])) {
                                                                                        echo $a['att_id'];
                                                                                      } ?>" class="btn btn-app">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                  </td>
                </tr>
              <?php $cnt++;
              }
            } else { ?>
              <tr>
                <td colspan="5" style="text-align:center">No record found</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>