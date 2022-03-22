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

    @media only screen and (max-width: 768px) {
  /* For desktop: */
        .font-list{
            font-size: 7px;
        }
        .date-pengambilan{
            max-width: 20%;
        }
        .btn-custom{
            width: 10px;
        }
    }

</style>

<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="cart-title mt-50">
                    <h2>Histori Order</h2>
                         <p style="color: black;">
                         Silahkan melakukan pembayaran  <span id="total_desc" >0</span> Ke <strong>Rekening BNI a/n <?= getenv('rek_bni') ?></strong> 
                            atas Nama  <strong> <?= getenv('nama_rek_bni') ?></strong> dan Upload bukti pembayaran di histori order
                        </p>
                    <strong class="mb-3" style="font-style: oblique ; color: red;">Silahkan kontak pemilik jika ingin batalkan orderan</strong>
                    <!-- <a href="<?= base_url('market/account-number')  ?>" class="text-primary " style="font-size: 20px;" target="_blank">Please click to check account number</a> -->
                </div>

                <div class="cart-table clearfix mb-3">
                    <?php 
                        $errors = session()->getFlashdata('errors');
                        if(!empty($errors)){ ?>
                        <div class="alert alert-danger" role="alert">
                        Whoops! Gagal ::
                        <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                        </ul>
                        </div>
                    <?php } ?>
                    <?php
                        if(!empty(session()->getFlashdata('success'))){ ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('success');?>
                        </div>     
                        <?php } ?>
                   
                    <div class="col-12 mx-0 px-0">
                    <table class="table">
                        <thead >
                            <tr>
                                <th style="max-width:15%;" class="font-list" >No Orderan</th>
                                <th style="max-width:15%;" class="font-list" >Total</th>
                                <th style="max-width:15%;" class="font-list" >Status</th>
                                <th style="max-width:15%;" class="font-list date-pengambilan" >Tanggal Pengambilan</th>
                                <th style="max-width:15%;" class="font-list" >Bukti</th>
                                <th style="max-width:20%;" class="font-list"></th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody >
                            <?php if (count($orders) > 0) {?>
                                <?php foreach ($orders as $order) : ?>
                                    <tr>
                                        <td style="max-width:15%;" class="font-list" >
                                            #Order<?= $order['order_id'] ?>
                                        </td>
                                        <td style="max-width:15%;" class="font-list" >
                                            <?php echo 'Rp. '.number_format($order['order_total']); ?>
                                        </td>
                                        <td style="max-width:15%;" class="font-list" >
                                            <?= $order['order_status'] ?>
                                        </td>
                                        <td style="max-width:15%;" class="font-list" >
                                            <?= date('d-m-Y', strtotime($order['order_pickup_date'])) ?>
                                        </td>
                                        <td style="max-width:20%;" class="font-list" >
                                            <?php if(!empty($order['order_token'])){ ?>
                                                <a href="<?php echo base_url('uploads/token/'.$order['order_token']) ?>"><img src="<?php echo base_url('uploads/token/'.$order['order_token']) ?>" style="height: 10vmin; width: 50%;" alt="Product"></a>
                                            <?php } ?>
                                        </td>
                                        <td style="max-width:20%;" >
                                            <!-- <a href="#" class="btn btn-sm btn-primary">Upload</a> -->
                                            <?php 
                                                if($order['order_status'] == 'CANCEL') {
                                                    ?>
                                                        <span class="bedge bedge-danger">CANCEL</span>
                                                    <?php
                                                }else{
                                                    ?>
                                                         <button type="button" class="btn btn-sm btn-custom btn-primary" style="height: 25px; width: 60px; font-size: 12px;" data-toggle="modal" data-target="#modal-change-status<?=$order['order_id']?>">Upload</button>
                                                         <a href="<?= base_url('market/history-detail') .'/'. $order['order_id'] ?>" class="btn btn-sm btn-custom btn-info"  style="height: 25px; width: 60px; font-size: 12px;">Detail</a>
                                                    <?php
                                                }
                                            ?>
                                           
                                            <?php if((($order['order_status'] !='SENDING' && $order['order_status'] !='SUCCESS') && $order['order_status'] != 'CANCEL')){ ?>
                                               <?php 
                                                if($order['order_type'] == 'Dp'){
                                                    ?>
                                                         <button type="button" class="btn btn-sm btn-custom btn-danger btnCancel"  style="height: 25px; width: 60px; font-size: 12px;"  data-id="<?= $order['order_id'] ?>" >Cancel</button>
                                                    <?php
                                                }
                                                ?>
                                            <?php } ?>
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
<?php echo view('_partials/ui/footer');?>
    <?php 
    foreach ($orders as $index => $order) {?>
        <div class="modal fade" id="modal-change-status<?=$order['order_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('market/upload-token').'/'.$order['order_id'] ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="token">Upload</label>
                                <input type="file" class="form-control" id="token" name="order_token" required>
                            </div>       
                            <div class="form-group">
                                <label for="nominal">Sisa Pembayaran    <?php echo 'Rp. '.number_format($order['order_total'] - ($order['order_pay_1'] + $order['order_pay_2'])); ?> </label>
                                <input type="number"  min="<?= $order['order_total'] - ($order['order_pay_1'] + $order['order_pay_2']) ?>" max="<?= $order['order_total'] - ($order['order_pay_1'] + $order['order_pay_2']) ?>" class="form-control" id="nominal" name="nominal" required>
                            </div>                          
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    <?php } ?>

<script type="text/javascript" >
    $(document).ready(function (){
        $('.btnCancel').on('click', function(){
            var id = $(this).attr("data-id");

            // base_url('admin/order-status').'/'.$order['order_id'] 
            $.ajax({
                type: "post",
                url: "<?=base_url('market/order-status-market');?>/" + id,
                data: {
                    'order_status' : 'CANCEL'
                },
                dataType: "html",
                success: function (data) {
                    // console.log(data);
                    alert(data);
                    location.reload()
                }
            });
        })
    })
</script>
