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
  <div class="container-fluid px-2">
    <h1 class="mt-4"><?php echo $title ?></h1>

    <div class="card mb-1">
      <div class="card-body">

        <form action="<?php echo base_url(); ?>admin/products/save_product" id="add_product_form" name="add_product_form" method="POST" enctype="multipart/form-data">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-6">

              <div class="mb-3">
                <label for="input_post_title" class="form-label">
                  Product Name <code>(*)</code>
                </label>
                <input name="p_name" id="p_name" type="text" class="form-control" placeholder="Enter Your Product Name" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Order (Ingrese un numero)
                </label>
                <input name="p_order" id="p_order" type="text" class="form-control" placeholder="Enter Order" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Meta Title (Programador)
                </label>
                <input name="p_metatitle" id="p_metatitle" type="text" class="form-control " placeholder="Enter Meta Title" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Meta Description (Programador)
                </label>
                <input name="p_metadescription" id="p_metadescription" type="text" class="form-control " placeholder="Enter Meta Description" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Meta Keywords (Programador)
                </label>
                <input name="p_metakeywords" id="p_metakeywords" type="text" class="form-control " placeholder="Enter Meta Keywords" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Product Image *.jpg (800px ancho - 500px alto)
                </label>
                <input type="file" name="p_image" id="p_image" class="form-control" placeholder="Enter Image" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Product Description
                </label>
                <?php
                echo $this->ckeditor->editor("p_desc", '');
                ?>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Date (Autogenerado - No obligatorio)
                </label>
                <input type="text" name="p_date" id="p_date" class="form-control" readonly placeholder="Enter Date" />
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Destacado
                </label>
                <div class="form-check">
                  <input type="checkbox" name="p_destacado" id="p_destacado" class="form-check-input" value="1" />
                </div>
              </div>

              <div class="mb-3">
                <label for="input_post_slug" class="form-label">
                  Promocion
                </label>
                <div class="form-check">
                  <input type="checkbox" name="p_promocion" id="p_promocion" class="form-check-input" value="1" />
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <!-- catgeory -->
              <div class="mb-3">

                <div class="form-control overflow-auto">
                  <div class="mb-3">
                    <label for="input_post_description" class="form-label">
                      About
                    </label>
                    <?php
                    echo $this->ckeditor->editor("p_about", '');
                    ?>
                  </div>
                  <div class="mb-3">
                    <label for="input_post_description" class="form-label">
                      Paper Type
                    </label>
                    <?php
                    echo $this->ckeditor->editor("p_paper", '');
                    ?>
                  </div>
                  <div class="mb-3">
                    <label for="input_post_description" class="form-label">
                      Product Turnaround
                    </label>
                    <?php
                    echo $this->ckeditor->editor("p_turnaround", '');
                    ?>
                  </div>
                  <div class="mb-3">
                    <label for="input_post_description" class="form-label">
                      Artwork Guide
                    </label>
                    <?php
                    echo $this->ckeditor->editor("p_artwork", '');
                    ?>
                  </div>

                </div>
              </div>
            </div>


          </div>

          <div class="row">
            <div class="col-md-12">
              <div>
                <input type="submit" value="Save" class="btn btn-primary btn-xs float-left" />
                <a href="<?php echo base_url(); ?>admin/products/" class="btn btn-dark btn-xs float-end">
                  Back to Listing</a>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>

  </div>
</main>