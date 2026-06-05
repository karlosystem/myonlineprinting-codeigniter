<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Control de Acceso</h3>
          </div>
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
              <div class="form-floating mb-3">
                <input class="form-control" name="username" placeholder="User" />
                <label for="inputEmail">Usuario</label>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" name="password" type="password" placeholder="Password" />
                <label for="inputPassword">Password</label>
              </div>

              <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <input type="submit" value="Login" class="btn btn-primary" />
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>