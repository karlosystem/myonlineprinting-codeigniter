<main class="main">
  <section class="header-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 hidden-xs">
          <h1 class="mh-title">FAQ</h1>
        </div>
        <div class="breadcrumb-w col-sm-9">
          <span class="hidden-xs">You are here:</span>
          <ul class="breadcrumb">
            <li>
              <a href="/">Home</a>
            </li>
            <li>
              <span>FAQ</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="faq" class="pr-main">
    <div class="container">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h1 class="ct-header">FAQ</h1>
        <p class="titler">Here are some of examples of frequently asked question built using Visual Composer “FAQ” element. You can add any text, images or
          any other element into this page.</p>
        <div id="CMStab">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>Sr No</th>
                <th>Username</th>
                <th>Useremail</th>
                <th>Total Amount</th>
                <th>Date</th>
                <th>Detail</th>
              </tr>
            </thead>
            <?php
            if (!empty($get_order_by_user_id)) {
              $i = 1;
              foreach ($get_order_by_user_id as $orders) { ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $orders['u_name']; ?></td>
                  <td><?php echo $orders['u_email']; ?></td>
                  <td><?php echo $orders['total_amt']; ?></td>
                  <td><?php echo $orders['order_date']; ?></td>
                  <td><a href="<?php echo base_url(); ?>users/cust_order_detail/<?php echo $orders['order_id']; ?>"><img src="<?php echo base_url(); ?>images/admin/user_edit.png" /></a></td>
                </tr>
            <?php $i++;
              }
            } ?>


          </table>
        </div>
      </div>
    </div>
  </section>
</main>