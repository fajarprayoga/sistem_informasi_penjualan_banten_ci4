<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ulasan dan Rate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rate</li>
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
                            Daftar Ulasan dan Rate
                            <!-- <a href="<?php echo base_url('admin/category/create'); ?>" class="btn btn-primary float-right">Tambah</a> -->
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

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th width="10px">No</th>
                                            <th>Nama User</th>
                                            <th>Ulasan</th>
                                            <th>Rate</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  foreach ($rates as $key => $rate) {
                                            ?>
                                        <tr>
                                            <td><?= $key+=1 ?></td>
                                            <td><?= $rate['email'] ?></td>
                                            <td><?= $rate['rate_review'] ?></td>
                                            <td>

                                                <div id="rating_div">
                                                    <div class="star-rating">
                                                        <?php
                                                            $totalRate = 0;
                                                            for($i = 0; $i<=$rate['rate_star']; $i++){ 
                                                        ?>
                                                            <span class="fa fa-star fa-2x star-input" data-index="0" style="font-size:20px; color: yellow;"></span>
                                                            <?php
                                                            $totalRate = $i;
                                                        } ?>

                                                        <?php  for($i=0; $i< (4 - $totalRate); $i++) {?>
                                                            <span class="fa fa-star fa-2x star-input" data-index="0" style="font-size:20px;"></span>
                                                        <?php } ?>
                                                    </div>
                                                    <br>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-change-status<?=$rate['rate_id']?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<?php 
    foreach ($rates as $index => $rate) {?>
        <div class="modal fade" id="modal-change-status<?=$rate['rate_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('admin/rate').'/'.$rate['rate_id'] ?>" method="post" >
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="rate_status"><?=$rate['email']?></label>
                                <select name="rate_status"  class="form-control">
                                    <option value="1" <?= $rate['rate_status'] == 1 ? 'selected' : '' ?> >Terima</option>
                                    <option value="0" <?= $rate['rate_status'] == 0 ? 'selected' : '' ?> >Tolak</option>
                                </select>
                            </div>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    <?php } ?>

<?php echo view('_partials/footer'); ?>