<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

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
                                    <td>:</td>
                                    <td><?php echo "Rp. ".number_format(($order['order_pay_1'] + $order['order_pay_2']), false, false, "."); ?></td>
                                </tr>
                                <tr>
                                    <td>Sisa Pembayaran</td>
                                    <td>:</td>
                                    <td><?php echo "Rp. ".number_format(($order['order_total'] - ($order['order_pay_1'] + $order['order_pay_2'])), false, false, "."); ?></td>
                                </tr>
                            </table>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-stripped">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th></th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah Pesanan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <!-- <th></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($order_details) > 0) {?>
                                            <?php foreach ($order_details as $order) : ?>
                                                <tr style="font-size: 2.5vmin;">
                                                    <td class="cart_product_img" >
                                                        <a href="<?php echo base_url('uploads/'.json_decode($order['product_image'])[0]) ?>"><img src="<?php echo base_url('uploads/'.json_decode($order['product_image'])[0]) ?>" style="height: 10vmin; width: 50%;" alt="Product"></a>
                                                    </td>
                                                    <td>
                                                        <?= $order['product_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $order['order_detail_quantity'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo 'Rp. '.number_format($order['order_detail_price']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo 'Rp. '.number_format($order['order_detail_price'] * $order['order_detail_quantity']); ?>
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