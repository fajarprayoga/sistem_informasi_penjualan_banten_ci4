<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_transaction; ?></h3>

                            <p>Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="<?php echo base_url('admin/order'); ?>" class="small-box-footer">Info detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_product; ?></h3>

                            <p>Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cart-plus"></i>
                        </div>
                        <a href="<?php echo base_url('admin/product'); ?>" class="small-box-footer">Info detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $total_category; ?></h3>

                            <p>Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url('admin/category'); ?>" class="small-box-footer">Info detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $total_user; ?></h3>

                            <p>User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?php echo base_url('admin/user'); ?>" class="small-box-footer">Info detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Sales Graph</h5>
                        </div>
                        <div class="card-body">
                            <?php if($get_grafik > 0){ ?>
                                <canvas id="myChart" width="100%" height="45"></canvas>
                            <?php } else { ?>
                            Belum ada transaksi.
                            <?php 
                            } ?>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Transaksi Terakhir</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover table-stripped">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th width="10px">No</th>
                                            <th>Orderan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>No Hp </th>
                                            <th>Tanggal Dipesan</th>
                                            <th>Tanggal Pengambilan</th>
                                            <th>Harga + Biaya Pengiriman</th>
                                            <th>Pembayaran</th>
                                            <th>Sisa Pembayaran</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($latest_trx as $key => $row){ ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo '#'.$row['order_id']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['phone']; ?></td>
                                            <td><?php echo date('j F Y', strtotime($row['created_at'])); ?></td>
                                            <td><?php echo date('j F Y', strtotime($row['order_pickup_date'])); ?></td>
                                            <td><?php echo "Rp. ".number_format($row['order_total'], false, false, "."); ?></td>
                                            <td><?php echo "Rp. ".number_format(($row['order_pay_1'] + $row['order_pay_2']), false, false, "."); ?></td>
                                            <td><?php echo "Rp. ".number_format(($row['order_total'] - ($row['order_pay_1'] + $row['order_pay_2'])), false, false, "."); ?></td>
                                            <td><?php echo $row['order_status']; ?></td>
                                        </tr>
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