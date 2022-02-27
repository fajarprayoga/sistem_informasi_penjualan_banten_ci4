
<?php echo view('_partials/ui/header')?>
        <!-- Header Area End -->
        <style>
            .list-custom {
                margin-bottom: 5px;
                font-size: 20px;
            }
        </style>
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row mb-4">
                    <div class="col-12 mt-3 text-center">
                        <h1>Syarat & Layanan</h1>
                    </div>
                </div>

               <div class="col-12">
                     <div class="row">
                    <div class="col-1"> </div>
                        <div class="col-10">
                            <ul style="color: black;" >
                                <li style="list-style: upper-roman;" class="list-custom" >Pengiriman seluruh Bali dikenakan biaya Rp. <?= number_format(getenv('delivery')) ?></li>
                                <li style="list-style: upper-roman;" class="list-custom" >Pemesanan Banten dilakukan minimal 7 hari sebelum acara</li>
                                <li style="list-style: upper-roman;" class="list-custom" >Banten akan diproses setelah melakukan pembayaran</li>
                                <li style="list-style: upper-roman;" class="list-custom" >Setiap pemesanan yang dilakukan tidak dapat dilakukan pembatalan sepihak, apabila terjadi pembatalan sepihak maka pembayaran yang telah dilakukan tidak dapat dikembalikan</li>
                                <li style="list-style: upper-roman;" class="list-custom" >Banten akan dikirim sehari sebelum tanggal booking</li>
                            </ul>
                            
                        </div>
                    <div class="col-1"></div>
                </div>
               </div>
                
            </div>
        </div>
<?php echo view('_partials/ui/footer');?>