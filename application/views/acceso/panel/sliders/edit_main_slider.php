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
    <div class="card mb-1">
      <div class="card-body">
        <form method="post" name="edit_main_slider" action="<?php echo base_url(); ?>admin/slider/update_main_slider" enctype="multipart/form-data">
          <div class="row d-flex align-items-stretch">
            <input type="hidden" name="slider_id" value="<?php echo $slider['banner_id']; ?>" />
            <input type="hidden" name="old_image" value="<?php echo $slider['banner_image']; ?>" />
            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Name TextColor
                </label>
                <input type="text" name="slider_name" class="form-control" value="<?php if (!empty($slider['banner_title'])) {
                                                                                    echo  $slider['banner_title'];
                                                                                  }  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Name Gray
                </label>
                <input type="text" name="slider_name_gray" class="form-control" value="<?php if (!empty($slider['banner_title_gray'])) {
                                                                                          echo  $slider['banner_title_gray'];
                                                                                        }  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Slider Link
                </label>
                <input type="text" name="banner_link" class="form-control" value="<?php if (!empty($slider['banner_link'])) {
                                                                                    echo $slider['banner_link'];
                                                                                  }  ?>" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Description
                </label>
                <?php
                echo $this->ckeditor->editor("banner_description", 'banner_description2', $slider['banner_description']);
                ?>
              </div>

            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Slider Hoffset
                </label>
                <input type="text" name="banner_data-hoffset" value="<?php if (!empty($slider['banner_data-hoffset'])) {
                                                                        echo  $slider['banner_data-hoffset'];
                                                                      }  ?>" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Slider Image (1920px-598px)
                </label>
                <input type="file" name="slider_image" class="form-control" />
              </div>

              <div class="mb-3">
                <img src="<?php echo base_url(); ?>assets/images/admin/main_slider_image/<?php echo $slider['banner_id'] ?>/<?php echo $slider['banner_image'] ?>" style="height:80px;width:220px;" />
              </div>

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Slider Data-X
                </label>
                <select name="banner_data-x-1" class="form-select">
                  <option value="">select direction</option>
                  <option value="right" <?php echo $select = ($slider['banner_data-x-1'] == "right") ? "selected" : ""; ?>>Right</option>
                  <option value="left" <?php echo $select = ($slider['banner_data-x-1'] == "left") ? "selected" : ""; ?>>Left</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Slider Data Y
                </label>
                <input type="text" name="banner_data-y-1" value="<?php if (!empty($slider['banner_data-y-1'])) {
                                                                    echo  $slider['banner_data-y-1'];
                                                                  } ?>" class="form-control" />
              </div>



            </div>

            <div class="mb-3">
              <div>
                <input type="submit" value="Editar" class="btn btn-primary btn-xs float-left" />
                <a href="<?php echo base_url(); ?>admin/slider" class="btn btn-dark btn-xs float-end"><b>+</b> Back to Listing</a>

              </div>

            </div>

          </div>
        </form>
      </div>

    </div>
  </div>
</main>