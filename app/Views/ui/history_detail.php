<?php echo view('_partials/ui/header')?>

<style>
    .custome-alert {
        color: #dc3545;
        font-size: smaller
    }
    .form-control-custom{
        background-color: #f5f7fa;
        padding: 30px;
        color: #6b6b6b;
        font-size: 18px;
        border: none;
        display: block;
        font-family: inherit;
    }
    .form-control-custom:focus{
        outline:solid 3px whitesmoke;
        background-color: white;
    }
</style>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cart-title mt-50">
                    <h2>Histori Order Detail</h2>
                </div>
                <button type="button" class="btn btn-sm  btn-primary mb-2" data-toggle="modal" data-target="#modal-change-status">Rincian Pemesanan</button>
                <!-- <a href="https://api.whatsapp.com/send?phone=<?= substr_replace($order['phone'], '62','0',1)?>" class="btn btn-sm  btn-success mb-2" >Whatsapp</a> -->

                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama Produk</th>
                                <th>Jumlah </th>
                                <th>Harga</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($order_details) > 0) {?>
                                <?php foreach ($order_details as $detail) : ?>
                                    <tr style="font-size: 2.5vmin;">
                                        <td class="cart_product_img" >
                                            <a href="<?php echo base_url('uploads/'.json_decode($detail['product_image'])[0]) ?>"><img src="<?php echo base_url('uploads/'.json_decode($detail['product_image'])[0]) ?>" style="height: 15vmin; width: 100%;" alt="Product"></a>
                                        </td>
                                        <td>
                                            <?= $detail['product_name'] ?>
                                        </td>
                                        <td>
                                            <?= $detail['order_detail_quantity'] ?>
                                        </td>
                                        <td>
                                            <?php echo 'Rp. '.number_format($detail['order_detail_price']); ?>
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

<script>
    $('#nota').on('click', () => {
        alert('jalo')
    })
</script>

<?php echo view('_partials/ui/footer');?>


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
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td><?= $order['order_description'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('market/nota/' . $order['order_id']) ?>" target="__blank" class="btn btn-primary">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>