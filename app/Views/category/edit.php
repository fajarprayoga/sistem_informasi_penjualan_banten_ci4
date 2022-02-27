<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Kategori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Kategori</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <form action="<?php echo base_url('admin/category/update'); ?>" method="post">
              <div class="card">
                <div class="card-body">
                  <?php 
                  $errors = session()->getFlashdata('errors');
                  if(!empty($errors)){ ?>
                  <div class="alert alert-danger" role="alert">
                    Whoops! Kategori gagal di rubah::
                    <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                  </div>
                  <?php } ?>

                  <input type="hidden" name="category_id" value="<?php echo $category['category_id']; ?>">
                  <div class="form-group">
                      <label for="">Nama</label>
                      <input type="text" value="<?php echo $category['category_name']; ?>" class="form-control" name="category_name" placeholder="Enter category name">
                  </div>
                  <div class="form-group">
                      <label for="">Status</label>
                      <select name="category_status" id="" class="form-control">
                          <option value="">Pilih Status</option>
                          <option value="Active" <?php echo $category['category_status'] == "Active" ? 'selected' : '' ?>>Active</option>
                          <option value="Inactive" <?php echo $category['category_status'] == "Inactive" ? 'selected' : '' ?>>Inactive</option>
                      </select>
                  </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url('admin/category'); ?>" class="btn btn-outline-info">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Edit</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>

</div>
<?php echo view('_partials/footer'); ?>