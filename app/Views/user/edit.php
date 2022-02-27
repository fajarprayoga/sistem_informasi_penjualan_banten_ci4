<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/user') ?>">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <?php 
            $errors = session()->getFlashdata('errors');
            if(!empty($errors)){ ?>
            <div class="alert alert-danger" role="alert">
              Whoops! Gagal Melakukan Perintah::
              <ul>
              <?php foreach ($errors as $error) : ?>
                  <li><?= esc($error) ?></li>
              <?php endforeach ?>
              </ul>
            </div>
          <?php } ?>
          <div class="card">
            <?php echo form_open('admin/user/update'); ?>
              <div class="card-header">Data User</div>
                <div class="card-body">
                <?php echo form_hidden('id', $user['id']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php echo form_label('Username', 'username'); ?>
                        <?php echo form_input('username', $user['username'], ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required']); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php echo form_label('Nama Lengkap', 'name'); ?>
                        <?php echo form_input('name', $user['name'], ['class' => 'form-control', 'placeholder' => 'name', 'required' => 'required']); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php echo form_label('Email', 'email'); ?>
                        <?php echo form_input('email', $user['email'], ['class' => 'form-control', 'placeholder' => 'email', 'required' => 'required']); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php echo form_label('Password', 'password'); ?>    <span>(Optional)</span>
                        <?php echo form_input('password', '', ['class' => 'form-control', 'placeholder' => 'password'], 'password'); ?>
                     
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php echo form_label('No Hp ', 'phone'); ?>
                        <?php echo form_input('phone', $user['phone'], ['class' => 'form-control', 'placeholder' => 'phone', 'required' => 'required']); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php echo form_label('level', 'level'); ?>
                        <select name="level" id="level" class="form-control" required>
                            <option value="Admin" <?= $user['level'] =='Admin' ? 'selected' :'' ?>>Admin</option>
                            <option value="User" <?= $user['level'] =='User' ? 'selected' :''?>>User</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php echo form_label('status', 'status'); ?>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Active" <?= $user['status'] =='Active' ? 'selected' :'' ?>>Active</option>
                            <option value="Inactive" <?= $user['status'] =='Inactive' ? 'selected' :''?>>Inactive</option>
                        </select>
                        </div>
                    </div>
                </div>
                 </div>
              <div class="card-footer">
                  <a href="<?php echo base_url('admin/user'); ?>" class="btn btn-outline-info">Kembali</a>
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
<script type="text/javascript" >
    $('select[name="category_id"]').on('change', function(){
      let categoryId = $(this).val();
      $('select[name="sub_category_id"]').empty();
      $.ajax({
          type: "get",
          url: "<?=base_url('admin/sub_category');?>/" + categoryId,
          // data: "id="+1,
          dataType: "json",
          success: function (data) {
            $.each(data, function(key, value){
              console.log(data[1]);
                $('select[name="sub_category_id"]').append('<option value =' + value['sub_category_id'] +'>' + value['sub_category_name'] +'</option>');
              });
          }
      });
    })
   
</script>

<?php echo view('_partials/footer'); ?>