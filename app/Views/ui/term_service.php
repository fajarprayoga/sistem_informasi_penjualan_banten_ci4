
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
                            <!-- <ul style="color: black;" >
                                <li class="list-custom" >1. Pengiriman seluruh Bali dikenakan biaya Rp. <?= number_format(getenv('delivery')) ?></li>
                                <li class="list-custom" >2. Pemesanan Banten dilakukan minimal 7 hari sebelum acara</li>
                                <li class="list-custom" >3. Banten akan diproses setelah melakukan pembayaran</li>
                                <li class="list-custom" >4. Setiap pemesanan yang dilakukan tidak dapat dilakukan pembatalan sepihak, apabila terjadi pembatalan sepihak maka pembayaran yang telah dilakukan tidak dapat dikembalikan</li>
                                <li class="list-custom" >5. Banten akan dikirim sehari sebelum tanggal booking</li>
                            </ul> -->
                            <table style="vertical-align: top;" >
                                <tr>
                                    <td>1. </td>
                                    <td style="width: 10px;" ></td>
                                    <td>Pengiriman seluruh Bali dikenakan biaya Rp. <?= number_format(getenv('delivery')) ?></td>
                                </tr>
                                <tr>
                                    <td>2. </td>
                                    <td style="width: 10px;" ></td>
                                    <td>Pemesanan Banten dilakukan minimal 7 hari sebelum acara</td>
                                </tr>
                                <tr>
                                    <td>3. </td>
                                    <td style="width: 10px;" ></td>
                                    <td>Banten akan diproses setelah melakukan pembayaran</td>
                                </tr>
                                <tr>
                                    <td>4. </td>
                                    <td style="width: 10px;" ></td>
                                    <td>Setiap pemesanan yang dilakukan tidak dapat dilakukan pembatalan sepihak, apabila terjadi pembatalan sepihak maka pembayaran yang telah dilakukan tidak dapat dikembalikan</td>
                                </tr>
                                <tr>
                                    <td>5. </td>
                                    <td style="width: 10px;" ></td>
                                    <td>Banten akan dikirim sehari sebelum tanggal booking</td>
                                </tr>
                            </table>
                            
                        </div>
                    <div class="col-1"></div>
                </div>
               </div>
                
            </div>
        </div>
<?php echo view('_partials/ui/footer');?>