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
  <div class="container-fluid px-1">
    <h1 class="mt-4"><?php echo $title ?></h1>
    <div class="card mb-1">
      <div class="card-body">
        <form method="post" name="add_page" action="<?php echo base_url(); ?>admin/pages/update_page" enctype="multipart/form-data">
          <input type="hidden" name="page_id" value="<?php echo $page["page_id"]; ?>" />
          <input type="hidden" name="old_image" value="<?php echo $page['page_image']; ?>" />

          <div class="row d-flex align-items-stretch">
            <div class="col-md-6">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Page Name
                </label>
                <input type="text" name="page_name" class="form-control" value="<?php echo $page["page_name"]  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Title
                </label>
                <input type="text" name="page_title" class="form-control" value="<?php echo $page["page_title"]; ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Leyenda
                </label>
                <textarea name="page_leyenda" id="page_leyenda" cols="30" rows="3" class="form-control"><?php echo $page["page_leyenda"]; ?></textarea>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Meta Title
                </label>
                <input type="text" name="page_meta_title" value="<?php echo $page["page_meta_title"]  ?>" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Meta Description
                </label>
                <input type="text" name="page_meta_description" class="form-control" value="<?php echo $page["page_meta_description"]  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Meta Keywords
                </label>
                <input type="text" name="page_meta_keywords" class="form-control" value="<?php echo $page["page_meta_keywords"]  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Page Icono
                </label>
                <input type="text" name="page_icono" class="form-control" value="<?php echo $page["page_icono"]; ?>" />
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
                    <img src="<?php echo base_url(); ?>assets/images/admin/main_page_image/<?php echo $page['page_id'] ?>/<?php echo $page['page_image'] ?>" style="height:80px;width:80px;" />
                  </div>

                  <div class="mb-3">
                    <label for="input_post_slug" class="form-label">
                      Page Description
                    </label>
                    <?php
                    echo $this->ckeditor->editor("page_description", "page_description", $page['page_description']);
                    ?>
                  </div>

                  <div class="mb-3">
                    <label for="input_post_slug" class="form-label">
                      Status
                    </label>
                    <input type="checkbox" name="page_status" id="page_status" value="1" <?php if ($page['page_status'] == 1) echo "checked"; ?> />
                  </div>

                  <div class="mb-3">
                    <label for="input_post_slug" class="form-label">
                      Portada
                    </label>
                    <input type="checkbox" name="page_portada" id="page_portada" value="1" <?php if ($page['page_portada'] == 1) echo "checked"; ?> />
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div>

                <button type="submit" class="btn btn-primary btn-xs float-left">
                  Edit
                </button>

                <a class="btn btn-dark btn-xs float-end" href="<?php echo base_url(); ?>admin/pages">Back to Listing</a>

              </div>
            </div>
          </div>

        </form>

      </div>
    </div>

  </div>
</main>