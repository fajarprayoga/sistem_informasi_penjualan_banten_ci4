<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Generate PDF CodeIgniter 4 - qadrLabs</title>
        
        <style type="text/css">
            .table{
                border: 1px solid #dee2e6;
            }
        </style>
    </head>

    <body style="text-align: center;">
        <h2>Data Orders </h2>
        <!-- <a href="<?php echo base_url('PdfController/generate') ?>">
            Download PDF
        </a> -->
        <table class="table" border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">
            <thead>
                <tr bgcolor=#dee2e6 align=center>
                    <td >No</td>
                    <td>Name</td>
                    <td>Pelanggan</td>
                    <td>Phone</td>
                    <td>Product</td>
                    <td>Status</td>
                    <td>Total</td>
                    <td>Date</td>
                    <td>Destination</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $index => $order) { ?>
                    <tr>
                        <td><?php echo $index + 1 ?></td>
                        <td><?= '#order'.$order['order_id'] ?></td>
                        <td><?= $order['username'] ?></td>
                        <td><?= $order['phone'] ?></td>
                        <td style="text-align: left;">
                            <ul>
                                <?php foreach ($order_details->getOrderDetail($order['order_id']) as $index => $detail) { ?>
                                   <li>
                                        <?php echo $detail['product_name'];?> <?=$detail['order_detail_quantity']?>
                                   </li>
                                <?php } ?>
                            </ul>
                        </td>
                        <td>
                            <?= $order['order_status'] ?>
                        </td>
                        <td><?= "Rp. ".number_format($order['order_total']); ?></td>
                        <td><?= date("d-m-Y", strtotime($order['created_at']))  ?></td>
                        <td><?= $order['order_destination'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p><?= 'jumlah data : '. count($orders)?></p>
    </body>
</html>