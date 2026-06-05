<?php
$CI = &get_Instance();
$CI->load->model("admin/common_model");
$tbl_name = 'exp_tbl_countries';
$all_countries = $CI->common_model->get_all_list($tbl_name);
?>
<main>
  <div class="container-fluid px-2">
    <h1 class="mt-4">Users</h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/users/add_user" class="btn btn-primary btn-xs float-end"><b>+</b> Add new User</a>

        <a href="#" onclick="delete_item('exp_tbl_users','u_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Items</a>

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
              <th>Name</th>
              <th>Country</th>
              <th>Email</th>
              <th>Status</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($users)) {
              $cnt = 1;
              foreach ($users as $u) {
                $id = $u['u_id'];
                if ($u['u_status'] == '1') {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_users\',\'u_status\',\'0\', \'u_id\',\'' . $id . '\');" />';
                } else {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_users\',\'u_status\',\'1\', \'u_id\',\'' . $id . '\');" />';
                }
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td>
                    <?php echo $cnt; ?>
                  </td>
                  <td>
                    <?php if (!empty($u['u_name'])) {
                      echo $u['u_name'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['u_country'])) {
                      foreach ($all_countries as $row) {
                        if ($row["country_id"] == $u['u_country']) {
                          echo ($row['country_name']);
                        }
                      }
                    } ?>

                  </td>
                  <td>
                    <?php if (!empty($u['u_email'])) {
                      echo $u['u_email'];
                    } ?>
                  </td>
                  <td align="center">
                    <?php echo $str; ?>
                  </td>
                  <td>
                    <?php if (!empty($u['create_at'])) {
                      echo $u['create_at'];
                    } ?>
                  </td>
                  <td align="center">
                    <a href="<?php echo base_url(); ?>admin/users/edit_user/<?php echo $id; ?>" class="btn btn-app">
                      <i class="fas fa-edit"></i> Edit
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