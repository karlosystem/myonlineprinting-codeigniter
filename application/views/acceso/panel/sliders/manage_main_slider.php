<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php if (!empty($title)) {
                        echo $title;
                      } ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="<?php echo base_url(); ?>admin/slider/add_main_slider" class="btn btn-primary btn-xs float-end"><b>+</b> Add new Slider</a>

        <a href="#" onclick="delete_main_slider('exp_tbl_main_slider','banner_id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Slider</a>
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
              <th>Id</th>
              <th>Name</th>
              <th>Photo</th>
              <th>Status</th>
              <th>Order</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($slider)) {
              $cnt = 1;
              foreach ($slider as $u) {
                $id = $u['banner_id'];
                if ($u['status'] == '1') {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/yes.gif" title="Unpublish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_main_slider\',\'status\',\'0\', \'banner_id\',\'' . $id . '\');" />';
                } else {
                  $str = '<img style="cursor:pointer;" src="' . base_url() . 'assets/images/admin/cross.gif" title="Publish" width="16" height="16" alt="" onclick="return changeStatus(\'exp_tbl_main_slider\',\'status\',\'1\', \'banner_id\',\'' . $id . '\');" />';
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
                    <?php if (!empty($u['banner_title'])) {
                      echo $u['banner_title'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['banner_image'])) {
                    ?>
                      <img src="<?php echo base_url(); ?>assets/images/admin/main_slider_image/<?php echo $u['banner_id'] ?>/<?php echo $u['banner_image'] ?>" style="height:80px;width:180px;" />

                    <?php } ?>
                  </td>
                  <td align="center">
                    <?php echo $str; ?>
                  </td>
                  <td align="center">
                    <?php if (!empty($u['orden'])) {
                      echo $u['orden'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['date_add'])) {
                      echo $u['date_add'];
                    } ?>
                  </td>
                  <td align="center">
                    <a href="<?php echo base_url(); ?>admin/slider/edit_main_slider/<?php echo $id; ?>" class="btn btn-app">
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