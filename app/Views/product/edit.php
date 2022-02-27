<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>">Home</a></li>
            <li class="breadcrumb-item active">Edit Produk</li>
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
            $errors = session()->getFlashdata('errors');
            if(!empty($errors)){ ?>
            <div class="alert alert-danger" role="alert">
              Whoops! Gagal merubah produk::
              <ul>
              <?php foreach ($errors as $error) : ?>
                  <li><?= esc($error) ?></li>
              <?php endforeach ?>
              </ul>
            </div>
          <?php } ?>
          <div class="card">
            <?php echo form_open_multipart('admin/product/update'); ?>
              <div class="card-header">Data Produk</div>
              <div class="card-body">
                <?php echo form_hidden('product_id', $product['product_id']); ?>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <?php echo form_label('Foto', 'Image'); ?>
                      <br>
                      <!-- <img src="<?php echo base_url('uploads/'.json_decode($product['product_image'])[0]) ?>" class="img-fluid"> -->
                     
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <?php foreach(json_decode($product['product_image'] ) as $index => $image ) : ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?=$index?>" class="<?= $index == 0 ? 'active' : '' ?>"></li>
                                <?php endforeach?>
                            </ol>
                            <div class="carousel-inner">
                              <?php foreach(json_decode($product['product_image'] ) as $index => $image ) : ?>
                                <div class="carousel-item <?= $index==0 ? 'active' : ''?>">
                                  <img src="<?php echo base_url('uploads/'.$image) ?>" class="d-block w-100" alt="..." height="300px">
                                </div>
                              <?php endforeach?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                      <br>
                      <br>
                      <?php echo form_label('Ubah Foto', 'Change Image'); ?>
                      <?php echo form_upload('product_image[]','', ['class' => 'form-control', 'multiple' => 'multiple', "accept"=>"image/png, image/gif, image/jpeg"]); ?>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <!-- <div class="row col-md-12"> -->
                      <!-- <div class="col-md-12"> -->
                        <div class="form-group"> 
                          <?php echo form_label('Kategeori', 'Category'); ?>
                          <?php echo form_dropdown('category_id', $categories, $product['category_id'], ['class' => 'form-control']); ?>
                        </div>
                      <!-- </div>
                    </div> -->
                    <div class="form-group">
                      <?php echo form_label('Nama Produk', 'Name'); ?>
                      <?php echo form_input('product_name', $product['product_name'], ['class' => 'form-control', 'placeholder' => 'Product Name']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Harga ', 'Price'); ?>
                      <?php echo form_input('product_price', $product['product_price'], ['class' => 'form-control', 'placeholder' => 'Product Price', 'type' => 'number']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('SKU', 'SKU'); ?>
                      <?php echo form_input('product_sku', $product['product_sku'], ['class' => 'form-control', 'placeholder' => 'Product SKU']); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <?php echo form_label('Status', 'Status'); ?>
                      <?php echo form_dropdown('product_status', ['' => 'Pilih', 'Active' => 'Active', 'Inactive' => 'Inactieve'], $product['product_status'], ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Deskripsi ', 'Description'); ?>
                      <?php echo form_textarea('product_description', $product['product_description'], ['class' => 'form-control', 'placeholder' => 'Product Description']); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                  <a href="<?php echo base_url('admin/product'); ?>" class="btn btn-outline-info">Kembali</a>
                  <button type="submit" class="btn btn-primary float-right">Edit</button>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url('themes/plugins'); ?>/jquery/jquery-3.6.0.min.js"></script>

<?php echo view('_partials/footer'); ?>