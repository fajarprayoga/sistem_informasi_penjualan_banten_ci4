<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Produk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>">Home</a></li>
            <li class="breadcrumb-item active">Detail Produk</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
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
                </div>
                <div class="col-md-8">
                  <dl class="dl-horizontal">
                    <dt>SKU </dt>
                    <dd><?php echo $product['product_sku']; ?></dd>
                    <dt>Kategori Produk</dt>
                    <dd><?php echo $product['category_name']; ?></dd>
                    <!-- <dt>Sub Category Product</dt> -->
                    <dt>Nama Produk</dt>
                    <dd><?php echo $product['product_name']; ?></dd>
                    <dt>Harga Produk</dt>
                    <dd><?php echo 'Rp. '.number_format($product['product_price']); ?></dd>		
                    <dt>Status Produk</dt>
                    <dd><?php echo $product['product_status']; ?></dd>	   
                    <dt>Deskripsi Produk</dt>
                    <dd><?php echo $product['product_description']; ?></dd>             
                  </dl>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="<?php echo base_url('admin/product'); ?>" class="btn btn-outline-info float-right">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>