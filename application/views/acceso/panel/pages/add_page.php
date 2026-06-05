<?php
if ($this->session->userdata("valid_box")) {
  echo "<div class='alert alert-success' role='alert'>";
  echo $this->session->userdata("success_message");
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("valid_box");
  echo "</div>";
} else if ($this->session->userdata("error_box")) {
  echo "<div class='alert alert-danger' role='alert'>";
  echo $this->session->userdata("success_message");
  $this->session->unset_userdata("success_message");
  $this->session->unset_userdata("error_box");
  echo "</div>";
}
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-4">
      <div class="card-body">
        <form method="post" name="add_page" id="add_page" action="<?php echo base_url(); ?>admin/pages/save_page" class="contact-form" enctype="multipart/form-data">
          <input type="hidden" name="page_id" value="<?php echo $this->uri->segment(4); ?>" />
          <div class="row d-flex align-items-stretch">
            <div class="col-md-6">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Page Name
                </label>
                <input type="text" name="page_name" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Title
                </label>
                <input type="text" name="page_title" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Leyenda
                </label>
                <textarea name="page_leyenda" id="page_leyenda" cols="30" rows="3" class="form-control"></textarea>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Meta Title
                </label>
                <input type="text" name="page_meta_title" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Meta Description
                </label>
                <input type="text" name="page_meta_description" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Meta Keywords
                </label>
                <input type="text" name="page_meta_keywords" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Icono
                </label>
                <input type="text" name="page_icono" class="form-control" />
              </div>

            </div>
            <div class="col-md-6">
              <!-- catgeory -->
              <div class="mb-3">
                <div class="form-control overflow-auto" style="height: 636px">
                  <div class="mb-3">
                    <label for="input_post_slug" class="form-label">
                      Page Imagen
                    </label>
                    <input type="file" name="page_image" class="form-control" />
                  </div>

                  <div class="mb-3">
                    <label for="input_post_slug" class="form-label">
                      Page Description
                    </label>
                    <?php
                    echo $this->ckeditor->editor("page_description", "");
                    ?>
                  </div>

                  <div class="mb-3">
                    <label for="input_post_slug" class="form-label">
                      Status
                    </label>
                    <input type="checkbox" name="page_status" id="page_status" value="1" />
                  </div>

                  <div class="mb-3">
                    <label for="input_post_slug" class="form-label">
                      Portada
                    </label>
                    <input type="checkbox" name="page_portada" id="page_portada" value="1" />
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="float-right">
                <a class="btn btn-warning px-4" href="<?php echo base_url(); ?>admin/pages">Back</a>
                <button type="submit" class="btn btn-primary px-4">
                  Save
                </button>
              </div>
            </div>
          </div>

        </form>

      </div>
    </div>

  </div>
</main>