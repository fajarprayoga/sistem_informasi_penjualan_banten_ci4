<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <link rel="stylesheet" href="<?php echo base_url('ui-amado'); ?>/css/core-style.css">
    <link rel="stylesheet" href="<?php echo base_url('ui-amado'); ?>/style.css">
</head>
<body >
    <h1>Nikasa <?= '#'.$order['order_id'] ?> </h1>
        <h5 class="card-title">Detail :  <?= $order['order_total'] - ($order['order_pay_1'] + $order['order_pay_2']) <= 0 ? 'Lunas' : 'Belum Lunas' ?> </h5>
        <div style="width: 100%;" >
            <table class="table" style="width: 100%;">
                <tbody>
                <tr>
                    <td>Nama Pemesan</td>
                    <td>:</td>
                    <td><?= $order['username'] ?></td>
                </tr>
                <tr>
                    <td>No Hp</td>
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
                    <td>Total Pembayarn</td>
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
        </div>
</body>
</html>
