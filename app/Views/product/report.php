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
        <h2>Data Product </h2>
        <!-- <a href="<?php echo base_url('PdfController/generate') ?>">
            Download PDF
        </a> -->
        <table class="table" border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">
            <thead>
                <tr bgcolor=#dee2e6 align=center>
                    <td >No</td>
                    <td>Name</td>
                    <td>Category</td>
                    <td>Price</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $index => $product) { ?>
                    <tr>
                        <td><?php echo $index + 1 ?></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['category_name'] ?></td>
                        <td><?= "Rp. ".number_format($product['product_price']);  ?></td>
                        <td><?= $product['product_status'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p><?= 'jumlah data : '. count($products)?></p>
    </body>
</html>