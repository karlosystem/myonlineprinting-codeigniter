  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="<?php echo base_url(); ?>assets/acceso/images/banner_print.png" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="card-body">
            <?php
            if ($this->session->userdata("error_box")) {
              echo '<div class="alert alert-danger" role="alert">';
              echo $this->session->userdata("success_message");
              echo '</div>';
            }
            $this->session->unset_userdata("success_message");
            $this->session->unset_userdata("error_box");
            ?>
            <form method="post" class="contact-form" id="login_form" action="<?php echo base_url(); ?>admin/admin/check_login">
              <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <center>
                  <img src="<?php echo base_url(); ?>assets/acceso/images/logo_admin.png" class="img-fluid" style="width:50%">
                </center>
              </div>
              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0">Control de Acceso</p>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input class="form-control form-control-lg" name="username" placeholder="Enter a valid username" />
                <label class="form-label" for="form3Example3">Usuario</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-3">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" />
                <label class="form-label" for="form3Example4">Password</label>
              </div>



              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

              </div>

            </form>
          </div>
        </div>
      </div>

  </section>