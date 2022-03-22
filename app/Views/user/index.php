<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                        <div class="card-header">
                            Daftar User
  
                        </div>
                        <div class="card-body">
                        
                            <?php
                            if(!empty(session()->getFlashdata('success'))){ ?>
                            <div class="alert alert-success">
                                <?php echo session()->getFlashdata('success');?>
                            </div>     
                            <?php } ?>

                            <?php if(!empty(session()->getFlashdata('info'))){ ?>
                            <div class="alert alert-info">
                                <?php echo session()->getFlashdata('info');?>
                            </div>
                            <?php } ?>

                            <?php if(!empty(session()->getFlashdata('warning'))){ ?>
                            <div class="alert alert-warning">
                                <?php echo session()->getFlashdata('warning');?>
                            </div>
                            <?php } ?>

                    
                             <!-- <a href="<?php echo base_url('admin/category/create'); ?>" class="btn btn-primary float-right my-2">Tambah</a> -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th width="10px">No</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No Hp </th>
                                            <th>Status</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($users as $index => $user):?>
                                            <tr>
                                                <td> <?= $no++ ?> </td>
                                                <td> <?= $user['username'] ?> </td>
                                                <td> <?= $user['name'] ?> </td>
                                                <td> <?= $user['email'] ?> </td>
                                                <td> <?= $user['phone'] ?> </td>
                                                <td> 
                                                    <span class="badge <?= $user['status'] =='Active' ? 'bg-primary' : 'bg-danger' ?> "><?= $user['status'] ?></span>
                                                </td>
                                                <td> <?= $user['level'] ?> </td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/user/edit') . '/'.$user['id']; ?>" class="btn btn-sm btn-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                       <?php endforeach?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Pagination -->
                                        <nav aria-label="navigation">     <div class="d-flex justify-content-end">
                                        <?php if ($pager) :?>
                                            <?php echo $pager->links('jq', 'bs_page') ?> 
                                        <?php endif ?>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>