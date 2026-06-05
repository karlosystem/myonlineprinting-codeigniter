<main>
  <div class="container-fluid px-2">
    <div class="row">
      <div class="col-md-6">
        <h1 class="mt-4"><?php echo $title; ?></h1>

        <div class="card mb-1">
          <div class="card-body">
            <table id="datatablesSimple" class="table table-custom table-hover">
              <thead class="table-dark">
                <tr>
                  <th scope="col">
                    Sr No
                  </th>
                  <th scope="col">
                    Subproduct Name
                  </th>
                  <th scope="col">
                    Assign Pricing
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($sub_products)) {
                  $cnt = 1;
                  foreach ($sub_products as $a) {
                    $id = $a['sp_id'];
                ?>
                    <tr>
                      <td>
                        <?php echo $cnt; ?>
                      </td>

                      <td>
                        <?php if (!empty($a['sp_name'])) {
                          echo $a['sp_name'];
                        } ?>
                      </td>

                      <td align="center">
                        <a class="btn btn-success" href="<?php echo base_url(); ?>admin/pricing/set_price/<?php if (!empty($a['p_id'])) {
                                                                                                            echo $a['p_id'];
                                                                                                          } ?>/<?php if (!empty($a['sp_id'])) {
                                                                                                                  echo $a['sp_id'];
                                                                                                                } ?>">Select</a>
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