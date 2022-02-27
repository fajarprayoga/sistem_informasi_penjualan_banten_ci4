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
                    <td>Username</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Status</td>
                    <td>Level</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $user) { ?>
                    <tr>
                        <td><?php echo $index + 1 ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td><?= $user['status'] ?></td>
                        <td><?= $user['level'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p><?= 'jumlah data : '. count($users)?></p>
    </body>
</html>