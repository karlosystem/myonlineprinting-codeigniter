<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
?>
<main>
  <div class="container-fluid px-2">
    <h1 class="mt-4">Manage Assigned Attributes</h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/assign_attributes/assign_new_attribute" class="btn btn-primary btn-xs float-end"><b>+</b> Add new Atributo</a>
        <a href="#" onclick="delete_item('exp_tbl_assigned_attributes','id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Items</a>

      </div>
    </div>
    <div class="card mb-1">
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
              <th>Id</th>
              <th>Product Name</th>
              <th>Subproduct Name</th>
              <th>Attribute Name</th>
              <th>Value</th>
              <th>Date</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($assigned_attributes)) {
              $cnt = 1;
              foreach ($assigned_attributes as $v) {
                $id = $v['id'];
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td>
                    <?php echo $cnt; ?>
                  </td>
                  <td>
                    <?php if (!empty($v['p_id'])) {
                      $tbl_name = "exp_tbl_products";
                      $col = "p_id";
                      $value = $v['p_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['p_name'])) {
                        echo $result['p_name'];
                      }
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($v['sp_id'])) {
                      $tbl_name = "exp_tbl_sub_products";
                      $col = "sp_id";
                      $value = $v['sp_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['sp_name'])) {
                        echo $result['sp_name'];
                      }
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($v['att_id'])) {
                      $tbl_name = "exp_tbl_attributes";
                      $col = "att_id";
                      $value = $v['att_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['att_name'])) {
                        echo $result['att_name'];
                      }
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($v['val_id'])) {
                      $tbl_name = "exp_tbl_attribute_values";
                      $col = "value_id";
                      $value = $v['val_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['value_name'])) {
                        echo $result['value_name'];
                      }
                    } ?>
                  </td>

                  <td><?php if (!empty($v['date_add'])) {
                        echo $v['date_add'];
                      } ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url(); ?>admin/assign_attributes/edit/<?php if (!empty($id)) {
                                                                                      echo $id;
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