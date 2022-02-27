<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Produk </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php 
            $inputs = session()->getFlashdata('inputs');
            $errors = session()->getFlashdata('errors');
            if(!empty($errors)){ ?>
            <div class="alert alert-danger" role="alert">
              Whoops! Gagal menambahkan produk::
              <ul>
              <?php foreach ($errors as $error) : ?>
                  <li><?= esc($error) ?></li>
              <?php endforeach ?>
              </ul>
            </div>
          <?php } ?>
          <?php echo form_open_multipart('admin/product/store'); ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                 <!-- categiry -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group"> 
                        <?php 
                          echo form_label('Kategori', 'Category');
                          echo form_dropdown('category_id', $categories, $inputs == null ? '' : $inputs['category_id'], ['class' => 'form-control']); 
                        ?>
                      </div>
                      </div>
                  </div>
                 <!-- catgeoyr -->
                  <div class="form-group">
                    <?php 
                      echo form_label('Nama Produk');
                      $product_name = [
                        'type'  => 'text',
                        'name'  => 'product_name',
                        'id'    => 'product_name',
                        'value' => $inputs == null ? '' : $inputs['product_name'],
                        'class' => 'form-control',
                        'placeholder' => 'Nama Produk'
                      ];
                      echo form_input($product_name); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Harga');
                      $product_price = [
                        'type'  => 'number',
                        'name'  => 'product_price',
                        'id'    => 'product_price',
                        'value' => $inputs == null ? '' : $inputs['product_price'],
                        'class' => 'form-control',
                        'placeholder' => '0'
                      ];
                      echo form_input($product_price); 
                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php 
                      echo form_label('SKU');
                      $product_sku = [
                        'type'  => 'text',
                        'name'  => 'product_sku',
                        'id'    => 'product_sku',
                        'value' => $inputs == null ? '' : $inputs['product_sku'],
                        'class' => 'form-control',
                        'placeholder' => 'SKU Produk'
                      ];
                      echo form_input($product_sku); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Status', 'Status');
                      echo form_dropdown('product_status', ['' => 'Pilih Status', 'Active' => 'Active', 'Inactive' => 'Inactive'], $inputs == null ? '' : $inputs['product_status'], ['class' => 'form-control']); 
                    ?>
                  </div>
                  <div class="form-group">
                      <label for="Image">Foto</label>
                      <input type="file" name="product_image[]" multiple class="form-control"   accept="image/png, image/gif, image/jpeg">
                    <!-- <?php 
                      echo form_label('Image');
                      echo form_upload('product_image', '', ['class' => 'form-control']); 
                    ?> -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <?php 
                      echo form_label('Deskripsi'); 
                      $product_desc = [
                        'type'  => 'text',
                        'name'  => 'product_description',
                        'id'    => 'product_description',
                        'value' => $inputs == null ? '' : $inputs['product_description'],
                        'class' => 'form-control',
                        'placeholder' => 'Deskripsi Produk'
                      ];
                      echo form_textarea($product_desc);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('admin/product'); ?>" class="btn btn-outline-info">Kembali</a>
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('themes/plugins'); ?>/jquery/jquery-3.6.0.min.js"></script>

<?php echo view('_partials/footer'); ?>