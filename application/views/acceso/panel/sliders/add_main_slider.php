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
    <h1 class="mt-4"><?php if (!empty($title)) {
                        echo $title;
                      } ?></h1>

    <div class="card mb-1">
      <div class="card-body">

        <form method="post" name="add_main_slider" id="add_main_slider" action="<?php echo base_url(); ?>admin/slider/save_main_slider" enctype="multipart/form-data">
          <input type="hidden" name="page_id" value="<?php echo $this->uri->segment(4); ?>" />
          <div class="row d-flex align-items-stretch">
            <div class="col-md-6">
              <!-- title -->
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Name TextColor
                </label>
                <input type="text" name="slider_name" class="form-control" />
              </div>
              <!-- slug -->
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Name Gray
                </label>
                <input type="text" name="slider_name_gray" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Link
                </label>
                <input type="text" name="banner_link" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Data-X
                </label>
                <select name="banner_data-x-1" id="banner_data-x-1" class="form-select">
                  <option value="">select direction</option>
                  <option value="right">Right</option>
                  <option value="left">Left</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Hoffset
                </label>
                <input type="text" name="banner_data-hoffset" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Data-Y
                </label>
                <input type="text" name="banner_data-y-1" class="form-control" />
              </div>

            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Image(1920px-598px)
                </label>
                <input type="file" name="slider_image" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Description
                </label>
                <?php
                echo $this->ckeditor->editor("banner_description", 'banner_description2');
                ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div>
                <button type="submit" class="btn btn-primary btn-xs float-left">
                  Agregar
                </button>
                <a href="<?php echo base_url(); ?>admin/slider/" class="btn btn-dark btn-xs float-end">
                  Back to Listing</a>
              </div>
            </div>
          </div>

        </form>


      </div>
    </div>

  </div>
</main>