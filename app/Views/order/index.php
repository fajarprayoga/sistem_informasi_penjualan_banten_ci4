<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
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
                            Daftar Transaksi
                            <div class="btn-group float-right">
                                <form action="<?= base_url('admin/order/report')?>" method="GET">
                                    <div class="col-12">
                                        <div class="row" >
                                            <div class="col-1">
                                                <button type="submit" class="btn tbn-sm btn-info" >Laporan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                            <th>Pelanggan</th>
                                            <!-- <th>No Hp</th> -->
                                            <!-- <th>Di Pesan</th> -->
                                            <th>Pengambilan</th>
                                            <!-- <th>Tujuan</th> -->
                                            <!-- <th>Pembayaran</th> -->
                                            <th>Total(Rp)</th>
                                            <th>Status</th>
                                            <th>Bukti</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($orders as $key => $row){ ?>
                                            <?php 
                                                $bg_status = 'bg-warning';

                                                if($row['order_status'] == 'CANCEL'){
                                                    $bg_status = 'bg-danger';
                                                }else if($row['order_status'] == 'SENDING'){
                                                    $bg_status = 'bg-info';
                                                }else if($row['order_status'] == 'PROCESS'){
                                                    $bg_status = 'bg-primary';
                                                }else if($row['order_status'] == 'SUCCESS'){
                                                    $bg_status = 'bg-success';
                                                }
                                            ?>
                                        <tr style="background-color: <?php echo date('d-m-Y') == date("d-m-Y", strtotime($row['created_at'])) ? '#F8FAFD' : '' ?>;" >
                                            <td><?php echo $nomor+= 1; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <!-- <td><?php echo $row['phone']; ?></td> -->
                                            <!-- <td><?php echo date("d-m-Y", strtotime($row['created_at'])) ; ?></td> -->
                                            <td><?php echo date("d-m-Y", strtotime($row['order_pickup_date'])) ; ?></td>
                                            <!-- <td><?php echo $row['order_destination']; ?></td> -->
                                            <!-- <td><?php echo ($row['order_total'] - ($row['order_pay_1'] + $row['order_pay_2'])) <= 0 ? 'Lunas' : 'Belum Lunas'; ?></td> -->
                                            <td><?php echo number_format($row['order_total']); ?></td>
                                            <td> <span class="badge <?=$bg_status?>"><?php echo $row['order_status']; ?></span> </td>
                                            <td>
                                                <?php if(!empty($row['order_token'])){ ?>
                                                    <a href="<?php echo base_url('uploads/token/'.$row['order_token']) ?>"><img src="<?php echo base_url('uploads/token/'.$row['order_token']) ?>" style="height: 10vmin; width: 50%;" alt="Product"></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <!-- <div class="btn-group"> -->
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-change-status<?=$row['order_id']?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <a href="<?= base_url('admin/order-detail') .'/'. $row['order_id']  ?>" class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                <!-- </div> -->
                                            </td>
                                        </tr>
                                        </tr>
                                        <?php } 
                                        if(count($orders) == 0){ ?>
                                        <tr>
                                            <td class="text-center" colspan="9">Belum ada data transaksi.</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Pagination -->
                                        <nav aria-label="navigation">     <div class="d-flex justify-content-end">
                                        <?php if ($pager) :?>
                                            <?php echo $pager->links('order', 'bs_page') ?> 
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


<!-- modal edit -->
     <?php 
        foreach ($orders as $index => $order) {?>
            <div class="modal fade" id="modal-change-status<?=$order['order_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?= base_url('admin/order-status').'/'.$order['order_id'] ?>" method="post" >
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="order_status"  class="form-control">
                                        <?php if(empty($order['order_token'])){ ?>
                                            <option value="CANCEL" <?= $order['order_status'] == 'CANCEL' ? 'selected' : '' ?> >CANCEL</option>
                                        <?php } ?>
                                        <option value="PENDING" <?= $order['order_status'] == 'PENDING' ? 'selected' : '' ?> >PENDING</option>
                                        <option value="PROCESS" <?= $order['order_status'] == 'PROCESS' ? 'selected' : '' ?> >PROCESS</option>
                                        <option value="SENDING" <?= $order['order_status'] == 'SENDING' ? 'selected' : '' ?> >SENDING</option>
                                        <option value="SUCCESS" <?= $order['order_status'] == 'SUCCESS' ? 'selected' : '' ?> >SUCCESS</option>
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
<!-- modal -->

<?php echo view('_partials/footer'); ?>