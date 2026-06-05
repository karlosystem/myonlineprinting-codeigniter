<main>
  <div class="container-fluid px-4">
    <div class="row">
      <div class="col-md-6">
        <h1 class="mt-4"><?php echo $title; ?></h1>
        <div class="card mb-2">
          <div class="card-body">
            <table id="datatablesSimple" class="table table-custom table-hover">
              <thead class="table-dark">
                <tr>
                  <th>
                    Sr No
                  </th>
                  <th>
                    Name Product
                  </th>
                  <th>
                    Subproducts
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($product_array)) {
                  $cnt = 1;
                  foreach ($product_array as $a) {
                    $id = $a['p_id'];
                ?>
                    <tr>
                      <td>
                        <?php echo $cnt; ?>
                      </td>
                      <td>
                        <?php if (!empty($a['p_name'])) {
                          echo $a['p_name'];
                        } ?>
                      </td>
                      <td>
                        <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/pricing/all_subproducts/<?php if (!empty($a['p_id'])) {
                                                                                                                  echo $a['p_id'];
                                                                                                                } ?>">
                          Select SubProduct</a>
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
    </div>
  </div>
</main>