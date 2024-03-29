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
        <form id="formcheckout" action="<?php echo base_url('market/checkout-process'); ?>" method="post" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-title">
                            <h2>Checkout</h2>
                            <!-- <a href="<?= base_url('market/account-number')  ?>" class="text-primary " style="font-size: 20px;" target="_blank">Please click to check account number</a> -->
                        </div>
                        <p style="color: black;">
                            Silahkan melakukan pembayaran ke <strong>Rekening BNI a/n <?= getenv('rek_bni') ?></strong> 
                            atas Nama  <strong> <?= getenv('nama_rek_bni') ?></strong> dan Upload bukti pembayaran di histori order
                        </p>
                        <div class="row">
                       
                            <?php
                            $errors = session()->getFlashdata('errors');
                            if(!empty($errors)){ ?>
                            <div class="alert alert-danger w-100" role="alert">
                                Whoops! Failed your data::
                                <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                                </ul>
                            </div>
                            <?php } ?>
                            <div class="col-12 mb-3">
                                <label for="pickup_date">Tanggal Pengambilan </label>
                                <?php $tgl1 = date('Y-m-d'); ?>
                                <input style="height: 10px;" min="<?=date("Y-m-d", strtotime('+7 days'))?>" required type="date"  name="order_pickup_date" class="form-control-custom w-100  " id="pickup_date"></input>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description">Deskripsi</label>
                                <textarea required  name="order_description" class="form-control-custom w-100  " id="description" cols="30" rows="3" placeholder="Isi Deskripsi"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description">Tujuan</label>
                                <textarea required name="order_destination" class="form-control-custom w-100    " id="destination" cols="30" rows="3" placeholder="Jl. Angasoka kediri"></textarea>
                            </div>     
                            <!-- <div class="col-12 mb-3">
                                <label for="pay">Nominal Pembayaran</label>
                                <select name="type" id="type"class='form-control w-100' style="background-color: red;">
                                    <option value="">Pilih</option>
                                    <option value="Dp"> DP</option>
                                    <option value="Full"> Full</option>
                                </select>
                            </div>                -->
                            <div class="col-12 mb-3">
                                <label for="pay">Nominal Pembayaran</label>
                                <div>
                                    <select  name="type_pembayaran" id="type_pembayaran" class='form-control w-25 mb-2' >
                                        <option value="">Pilih Tipe Pembayaran</option>
                                        <option value="Dp"> DP</option>
                                        <option value="Full"> Full</option>
                                    </select>
                                    <input  required type="number"  placeholder="0" min="0" name="pay" class="form-control-custom w-100  " id="pay" ></input>
                                </div>
                            </div>         
                            <div class="col-12 mb-3">
                                <label for="token">Upload Bukti </label>
                                <input  required type="file"  name="order_token" class="form-control-custom w-100  " id="token" accept="image/png, image/gif, image/jpeg" ></input>
                            </div>     
                        </div>
                    
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Total Order</h5>
                        <ul class="summary-table">
                            <li><span>Sub Total Produk:</span> <span><?php echo 'Rp. '.number_format($total ); ?></span></li>
                            <!-- <li><span>Ongkos Kirim:</span> <span><?php echo 'Rp. '.number_format(getenv('delivery') ); ?></span></li> -->
                            <li><span>Total:</span> <span><?php echo 'Rp. '.number_format( $total ); ?></span></li>
                        </ul>
                        <!-- <input type="text" class="form-control is-invalid" id="validationServer03" aria-describedby="validationServer03Feedback" required> -->
                        <div class="cart-btn mt-100">
                            <div class="custome-alert">
                            Belum termasuk ongkir<br/>
                            Pesanan yang sudah dibayar tidak dapat dibatalkan & Mohon nomor telepon yang diisi sudah benar
                            </div>
                            <!-- <button type="submit" class="btn amado-btn w-100">Checkout</button> -->
                            <div class="col-md-12 mt-2 " >
                               <div class="row">
                                    <!-- <div class="col-md-6"> <input type="submit"  name="button" class="btn btn-primary w-100 " value="Dp"></div>
                                    <div class="col-md-6"> <input type="submit" name="button" id="btnFull"  class="btn btn-success w-100 " value="Full" ></div> -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn amado-btn w-100">Checkout</button>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php echo view('_partials/ui/footer');?>
<script type="text/javascript" >
    $(document).ready(function (){
        $('#formcheckout').on('submit', () => {

            if($('#type_pembayaran').val() ==''){
                alert('tentukan tipe pembayaran')
                return false
            }

            var total = <?php echo  $total ?>;
            if($('#type_pembayaran').val() =='Full'){
                if($('#pay').val() >= total){
                    return true;
                }else{
                    alert('Pembayaran tidak boleh kurang dengan tipe pembayaran Full ')
                    return false;
                }
            }else{
                return true;
            }
          
        })


        
        $('#type_pembayaran').on('change', () => {
            var total = <?php echo $total ?>;
            // alert($('#type_pembayaran').val())
            // $('#pay').val
            if($('#type_pembayaran').val() =='Dp' ){
                $('#pay').val((total * (50 /100 ).toString()));
            }else if ($('#type_pembayaran').val() =='Full'){
                $('#pay').val(total.toString());
            }else{
                $('#pay').val('0');
            }
        })
    })
</script>