
<?php echo view('_partials/ui/header')?>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Keranjang Anda</h2>
                        </div>
                        <p style="color: black;">
                            Silahkan melakukan pembayaran Ke <strong>Rekening BNI a/n <?= getenv('rek_bni') ?></strong> 
                            atas Nama  <strong> <?= getenv('nama_rek_bni') ?></strong> dan Upload bukti pembayaran di histori order
                        </p>
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
                                        if($carts != null){
                                            ?>
                                                 <?php foreach ($carts as $index => $cart): ?>
                                                    <tr style="font-size: 2vh;">
                                                        <td class="cart_product_img" >
                                                            <a href="#"><img src="<?php echo base_url('uploads/'.json_decode($cart['image'])[0]) ?>" style="height: 10vh; width: 100%;" alt="Product"></a>
                                                        </td>
                                                        <td class="cart_product_desc">
                                                            <span><?= $cart['name'] ?></h5>
                                                        </td>
                                                        <td class="price">
                                                            <span><?php echo 'Rp. '.number_format($cart['price']);  ?></span>
                                                        </td>
                                                        <td class="qty">
                                                            <div class="qty-btn d-flex">
                                                                <!-- <p style="font-size: 2vh;">Qty</p> -->
                                                                <div class="quantity" >
                                                                    <span  class="qty-minus" onclick="qty('min', <?=$cart['id']?>,  <?=$cart['price']?>)"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                                    <input  disabled type="number" class="qty-text" id="qty<?= $cart['id']?>" step="1" min="1" max="3"  name="quantity" value="<?= $cart['qty'] ?>">
                                                                    <span class="qty-plus" onclick="$('#qty' + <?=$cart['id']?>).val() < 3 ? qty('plus',  <?=$cart['id']?>,  <?=$cart['price']?>) : alert($('#qty' + <?=$cart['id']?>).val())"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                                </div>
                                                                <div class="m-3"></div>
                                                                <span onclick="deletById(<?=$cart['id']?>)" class="btn btn-danger" >
                                                                    <i style="font-size: 2vh; color: white;" class="fa fa-trash"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach?>
                                            <?php
                                        }
                                   ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Total</h5>
                            <ul class="summary-table">
                                <li><span>Sub Total  Produk:</span> <span id="subtotal"></span></li>
                                <li><span>Ongkos Kirim :</span> <span><?php echo 'Rp. '.number_format(getenv('delivery') ); ?></span></li>
                                <li><span>Total:</span> <span id="total">Rp. 0</span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="<?= base_url('market/checkout') ?>" class="btn amado-btn w-100">Pembayaran</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url('themes/plugins'); ?>/jquery/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                // let sum = objects.reduce((totalValue, currentValue) => {
                //     console.log(`totalValue: ${totalValue}, currentValue: ${currentValue}`)
                //     return totalValue + currentValue.x;
                // }, 0);
                let total = <?php echo $total ?>;
                $('#subtotal').text(formatRupiah(total.toString(), 'Rp'));
                $('#total').text(formatRupiah((total).toString(), 'Rp'))
                $('#total_desc').text(formatRupiah((total).toString(), 'Rp'))
            });


            

            function qty(type, id, price) {
                var total = parseInt($('#qty' + id).val());
                var qty =  parseInt($('#qty' + id).val());
                // alert('qty');
                $idQty =  $('#qty' +id)
                
                if(type == 'plus'){
                    qty = $idQty.val(total + 1);
                    edit(id, total+1, price, type);
                }else if('min'){
                    if(total > 1){
                      qty = $idQty.val(total - 1);
                      edit(id, total-1, price, type);
                    }
                }
            }

            function edit (id, qty, price, type){
                var cart= {
                    'id': id,
                    'qty':  qty
                }
                // let result = false;
                let subtotal = parseInt(formatNumber($('#subtotal').text()));
                $.ajax({  
                    url:'<?php echo base_url('market/edit-cart'); ?>',
                    type: 'post',
                    dataType:'html',
                    data:{cart:cart},
                    success:function(data){
                        // alert(data);
                        // console.log(data);
                        if(data == 'success'){
                            if(type == 'plus'){
                                subtotal +=price;
                                $('#subtotal').text(formatRupiah(subtotal.toString(),'Rp'))
                                // console.log(subtotal);
                            }else{
                                subtotal -=price;
                                $('#subtotal').text(formatRupiah(subtotal.toString(),'Rp'))
                            }
                            $('#total').text(formatRupiah((subtotal).toString(), 'Rp'))
                            $('#total_desc').text(formatRupiah((subtotal).toString(), 'Rp'))
                        }else{
                            return false;
                        }
                    }  
                });
            }


            function deletById(id){
                $.ajax({  
                    url:'<?php echo base_url('market/select-destroy-cart'); ?>',
                    type: 'post',
                    dataType:'html',
                    data:{id:id},
                    success:function(data){
                       alert(data)
                       location.reload();
                    }  
                });
            }

            function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
    
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            function formatNumber(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '' : '';
                    rupiah += separator + ribuan.join('');
                }
    
                // rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                // return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                return rupiah;
            }
        </script>

<?php echo view('_partials/ui/footer');?>