<main>
  <div class="container-fluid px-2">
    <h1 class="mt-4">Pages</h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/pages/add_page" class="btn btn-primary btn-xs float-end"><b>+</b> Add new Page</a>

        <a href="#" onclick="delete_item('exp_tbl_static_pages','page_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Pages</a>

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
              <th>Page Name</th>
              <th>Page Title</th>
              <th>Status</th>
              <th>Order</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($pages)) {
              $cnt = 1;
              foreach ($pages as $u) {
                $id = $u['page_id'];
                if ($u['page_status'] == '1') {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_static_pages\',\'page_status\',\'0\', \'page_id\',\'' . $id . '\');" />';
                } else {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_static_pages\',\'page_status\',\'1\', \'page_id\',\'' . $id . '\');" />';
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
                    <?php if (!empty($u['page_name'])) {
                      echo $u['page_name'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['page_title'])) {
                      echo $u['page_title'];
                    } ?>
                  </td>
                  <td align="center">
                    <?php echo $str; ?>
                  </td>
                  <td align="center">
                    <?php if (!empty($u['page_order'])) {
                      echo $u['page_order'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['page_date'])) {
                      echo $u['page_date'];
                    } ?>
                  </td>
                  <td align="center">
                    <a href="<?php echo base_url(); ?>admin/pages/edit_page/<?php echo $id; ?>" class="btn btn-app">
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