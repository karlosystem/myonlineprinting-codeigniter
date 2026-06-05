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
        <form action="<?php echo base_url(); ?>admin/products/update_product" id="add_product_form" name="add_product_form" method="POST" enctype="multipart/form-data">
          <div class="row d-flex align-items-stretch">
            <input type="hidden" name="p_id" value="<?php echo $result['p_id'] ?>">
            <input type="hidden" id="	old_image" name="old_image" value="<?php echo $result['p_image']; ?>" />
            <div class="col-md-6">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Product Name
                </label>
                <input type="text" name="p_name" id="p_name" class="form-control" value="<?php if (!empty($result['p_name'])) {
                                                                                            echo $result['p_name'];
                                                                                          } ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Order (Ingrese un numero)
                </label>
                <input type="text" name="p_order" id="p_order" class="form-control" value="<?php if (!empty($result['p_order'])) {
                                                                                              echo $result['p_order'];
                                                                                            } ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Meta Title (Programador)
                </label>
                <input type="text" name="p_metatitle" id="p_metatitle" class="form-control" value="<?php if (!empty($result['p_meta_title'])) {
                                                                                                      echo $result['p_meta_title'];
                                                                                                    } ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Meta Description (Programador)
                </label>
                <textarea class="form-control" name="p_metadescription" id="p_metadescription"><?php if (!empty($result['p_meta_description'])) {
                                                                                                  echo $result['p_meta_description'];
                                                                                                } ?></textarea>
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Meta Keywords (Programador)
                </label>
                <textarea class="form-control" name="p_metakeywords" id="p_metakeywords"><?php if (!empty($result['p_meta_keywords'])) {
                                                                                            echo $result['p_meta_keywords'];
                                                                                          } ?></textarea>
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Product Image *.jpg (800px ancho - 500px alto)
                </label>
                <input type="file" name="p_image" id="p_image" class="form-control">
              </div>

              <div class="mb-3">
                <img src="<?php echo base_url(); ?>assets/images/products/<?php echo $result['p_id']; ?>/thumbs/<?php echo $result['p_image'] ?>" style="width:80px;">
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Date
                </label>
                <input type="text" name="p_date" id="p_date" readonly class="form-control" value="<?php if (!empty($result['date'])) {
                                                                                                    echo $result['date'];
                                                                                                  } ?>">
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Destacado
                </label>
                <input type="checkbox" name="p_destacado" id="p_destacado" value="1" <?php if ($result['p_destacado'] == 1) echo "checked"; ?> />
              </div>

              <div class="mb-3">
                <label for="input_post_order" class="form-label">
                  Promocion
                </label>
                <input type="checkbox" name="p_promocion" id="p_promocion" value="1" <?php if ($result['p_promocion'] == 1) echo "checked"; ?> />
              </div>

              <div class="mb-3">
                <div>
                  <input type="submit" value="Editar" class="btn btn-primary btn-xs float-left" />

                  <a href="<?php echo base_url(); ?>admin/products/" class="btn btn-dark btn-xs float-end">
                    Back to Listing</a>

                </div>
              </div>

            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Product Description
                </label>
                <?php
                echo $this->ckeditor->editor("p_desc", 'p_desc2', $result['p_discription']);
                ?>
              </div>
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Product About
                </label>
                <?php
                echo $this->ckeditor->editor("p_about", 'p_about2', $result['p_about']);
                ?>
              </div>
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Paper Type
                </label>
                <?php
                echo $this->ckeditor->editor("p_paper", 'p_paper2', $result['p_paper_type']);
                ?>
              </div>
              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Product Turnaround
                </label>
                <?php
                echo $this->ckeditor->editor("p_artwork", 'p_artwork2', $result['p_free_artwork_guide']);
                ?>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>

  </div>
</main>

<script>
  CKEDITOR.replace('p_desc2', {
    extraPlugins: 'colorbutton',
  });
</script>