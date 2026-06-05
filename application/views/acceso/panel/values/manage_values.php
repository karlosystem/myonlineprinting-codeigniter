<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
?>
<main>
  <div class="container-fluid px-2">
    <h1 class="mt-4"><?php echo $title; ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/values/add_value" class="btn btn-primary btn-xs float-end"><b>+</b> Add new</a>

        <a href="#" onclick="delete_item('exp_tbl_attribute_values','value_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Items</a>

      </div>
      <div class="card mb-1">
        <div class="card-body">
          <table id="datatablesSimple" class="table table-custom table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">
                  <input type="checkbox" name="main_checkbox" id="main_checkbox" onclick="checkall();" />
                </th>
                <th scope="col">
                  Sr No
                </th>
                <th scope="col">
                  Attribute Name
                </th>
                <th scope="col">
                  Value Name
                </th>
                <th scope="col">
                  Edit
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($value)) {
                $cnt = 1;
                foreach ($value as $v) {
                  $id = $v['value_id'];
              ?>
                  <tr>
                    <td>
                      <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                    </td>
                    <td>
                      <?php echo $cnt; ?>
                    </td>
                    <td>
                      <?php

                      if (!empty($v['att_id'])) {
                        $tbl_name = 'exp_tbl_attributes';
                        $col = 'att_id';
                        $att_id = $v['att_id'];
                        $attribute_name = $this->common_model->get_item_by_id($tbl_name, $col, $att_id);
                        if (!empty($attribute_name['att_name'])) {
                          echo  $attribute_name['att_name'];
                        }
                      }
                      ?>
                    </td>
                    <td>
                      <?php if (!empty($v['value_name'])) {
                        echo $v['value_name'];
                      } ?>
                    </td>

                    <td align="center">
                      <a href="<?php echo base_url(); ?>admin/values/edit_value/<?php if (!empty($v['value_id'])) {
                                                                                  echo $v['value_id'];
                                                                                } ?>" class="btn btn-app">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                    </td>

                  </tr>
                <?php $cnt++;
                }
              } else { ?>
                <tr>
                  <td colspan="9" style="text-align:center">No record found</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</main>