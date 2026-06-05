<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php if (!empty($title)) {
                        echo $title;
                      } ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="javascript:void(0)" onclick="delete_item('exp_tbl_orders','order_id')" class="btn btn-warning btn-xs float-end"><b>+</b> Delete</a>
      </div>
    </div>

    <div class="card mb-2">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Mantenimiento
      </div>
      <div class="card-body">
        <table id="datatablesSimple" class="table table-custom table-hover">
          <thead class="table-dark">
            <tr>
              <th align="center" scope="col">
                <input type="checkbox" name="main_checkbox" id="main_checkbox" onclick="checkall();" />
              </th>
              <th>Sr No</th>
              <th>User Name</th>
              <th>User Email</th>
              <th>Total Amount (<?php echo CURRENCY; ?>)</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($order_array)) {
              $cnt = 1;
              foreach ($order_array as $order) {
                $id = $order['order_id'];
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td><?php echo $cnt; ?></td>
                  <td>
                    <?php if (!empty($order['cust_id'])) {
                      $tbl_name = "exp_tbl_users";
                      $col = "u_id";
                      $value = $order['cust_id'];
                      $result = $this->common_model->get_item_by_id($tbl_name, $col, $value);
                      if (!empty($result['u_name'])) {
                        echo $result['u_name'];
                      }
                    } ?></td>
                  <td><?php if (!empty($order['bill_email'])) {
                        echo $order['bill_email'];
                      } ?></td>
                  <td><?php if (!empty($order['total_amt'])) {
                        echo $order['total_amt'];
                      } ?>
                  </td>
                  <td><?php if (!empty($order['order_date'])) {
                        echo $order['order_date'];
                      } ?></td>

                  <td><?php if (!empty($order['delivery_status'])) {
                        echo $order['delivery_status'];
                      } ?></td>
                  <td>
                    <a href="<?php echo base_url(); ?>admin/order/order_detail/<?php echo $id; ?>" class="btn btn-app">
                      <i class="fas fa-edit"></i> View
                    </a>
                  </td>
                </tr>
              <?php $cnt++;
              }
            } else { ?>
              <tr>
                <td colspan='8' style='text-align:center'><b>No Record Found</b></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>