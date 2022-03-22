<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>
<style>
    .titik {
        width: 20px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Detail Transaksi Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Transkasi Produk</li>
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
                            Daftar Produk 
                            <?php 
                                $bg_status = 'bg-warning';

                                if($order['order_status'] == 'CANCEL'){
                                    $bg_status = 'bg-danger';
                                }else if($order['order_status'] == 'SENDING'){
                                    $bg_status = 'bg-info';
                                }else if($order['order_status'] == 'PROCESS'){
                                    $bg_status = 'bg-primary';
                                }else if($order['order_status'] == 'SUCCESS'){
                                    $bg_status = 'bg-success';
                                }
                            ?>
                            <span class="badge <?=$bg_status?>"><?php echo $order['order_status']; ?></span> 
                            
                            <div class="btn-group float-right">
                            <!-- <a href="<?php echo base_url('transaction/import'); ?>" class="btn btn-primary btn-sm">Import</a>
                            <a href="<?php echo base_url('transaction/export'); ?>" class="btn btn-success btn-sm">Export</a> -->
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
                            <table class="mb-3">
                                <tr>
                                    <td>Pembayaran</td>
                                    <td class="titik" >:</td>
                                    <td><?php echo "Rp. ".number_format(($order['order_pay_1'] + $order['order_pay_2']), false, false, "."); ?></td>
                                </tr>
                                <tr>
                                    <td>Sisa Pembayaran </td>
                                    <td class="titik" >:</td>
                                    <td><?php echo "Rp. ".number_format(($order['order_total'] - ($order['order_pay_1'] + $order['order_pay_2'])), false, false, "."); ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Di pesan</td>
                                    <td class="titik" >:</td>
                                    <td><?php echo date("d-m-Y", strtotime($order['order_created_at'])) ; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengambilan</td>
                                    <td class="titik" >:</td>
                                    <td><?php echo date("d-m-Y", strtotime($order['order_pickup_date'])) ; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;" >Deskripsi pesanan</td>
                                    <!-- <td> : </td> -->
                                </tr>
                                <tr>
                                    <td style="max-width: 300px;" ><?= $order['order_description'] ?></td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-sm  btn-primary mb-2" data-toggle="modal" data-target="#modal-change-status">Rincian Pemesanan</button>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th></th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Harga (Rp)</th>
                                            <th>Total (Rp)</th>
                                            <!-- <th></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($order_details) > 0) {?>
                                            <?php foreach ($order_details as $item) : ?>
                                                <tr style="font-size: 2.5vmin;">
                                                    <td class="cart_product_img" >
                                                        <a href="<?php echo base_url('uploads/'.json_decode($item['product_image'])[0]) ?>"><img src="<?php echo base_url('uploads/'.json_decode($item['product_image'])[0]) ?>" style="height: 10vmin; width: 50%;" alt="Product"></a>
                                                    </td>
                                                    <td>
                                                        <?= $item['product_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['order_detail_quantity'] ?>
                                                    </td>
                                                    <td align="right" >
                                                        <?php echo number_format($item['order_detail_price']); ?>
                                                    </td>
                                                    <td align="right" >
                                                        <?php echo number_format($item['order_detail_price'] * $item['order_detail_quantity']); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } ?>
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




<?php echo view('_partials/footer'); ?>
<div class="modal fade" id="modal-change-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail :  <?= $order['order_total'] - ($order['order_pay_1'] + $order['order_pay_2']) <= 0 ? 'Lunas' : 'Belum Lunas' ?> </h5>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>:</td>
                            <td><?= $order['username'] ?></td>
                        </tr>
                        <tr>
                            <td>No Hp </td>
                            <td>:</td>
                            <td><?= $order['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Pemesanan</td>
                            <td>:</td>
                            <td><?php echo date("d-m-Y", strtotime($order['order_created_at'])) ; ?></td>
                        </tr>
                        <tr>
                            <td>Pengambilan</td>
                            <td>:</td>
                            <td><?php echo date("d-m-Y", strtotime($order['order_pickup_date'])) ; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?= $order['order_status'] ?></td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>:</td>
                            <td><?= $order['order_destination'] ?></td>
                        </tr>
                        <tr>
                            <td>Tipe</td>
                            <td>:</td>
                            <td> <?php echo ($order['order_type']); ?></td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td>:</td>
                            <td>
                                <?php echo 'Rp. '.number_format($order['order_pay_1'] + $order['order_pay_2']); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sisa Pembayaran</td>
                            <td>:</td>
                            <td> <?php echo 'Rp. '.number_format($order['order_total']- ($order['order_pay_1'] + $order['order_pay_2'])); ?></td>
                        </tr> align="right" 
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td><?= $order['order_description'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('market/nota/' . $order['order_id']) ?>" target="__blank" class="btn btn-primary">Cetak</a>
                </div>
            </div>
        </div>
    </div>
</div>