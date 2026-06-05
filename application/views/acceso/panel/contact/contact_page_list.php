<main>
  <div class="container-fluid px-2">
    <h1 class="mt-4">Contacts Form</h1>
    <div class="card mb-1">
      <div class="card-body">
        <a href="#" onclick="delete_item('exp_tbl_contact','id')" class="btn btn-danger btn-xs float-left"><b>-</b> Delete Items</a>
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
              <th>Mobile</th>
              <th>Email</th>
              <th>Status</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($contacts)) {
              $cnt = 1;
              foreach ($contacts as $u) {
                $id = $u['id'];
            ?>
                <tr>
                  <td>
                    <input type="checkbox" name="child_checkbox" value="<?php echo $id; ?>" />
                  </td>
                  <td>
                    <?php echo $cnt; ?>
                  </td>
                  <td>
                    <?php if (!empty($u['name'])) {
                      echo $u['name'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['mobile'])) {
                      echo $u['mobile'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['email'])) {
                      echo $u['email'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['status'])) {
                      echo $u['status'];
                    } ?>
                  </td>
                  <td>
                    <?php if (!empty($u['create_at'])) {
                      echo $u['create_at'];
                    } ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url(); ?>admin/copyservice/preview_contact/<?php echo $id; ?>" class="btn btn-app">
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