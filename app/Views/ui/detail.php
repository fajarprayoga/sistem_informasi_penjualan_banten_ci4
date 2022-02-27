
<?php echo view('_partials/ui/header')?>
        <!-- Header Area End -->

        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 mt-3">
                        <h3>Detail Produk</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <!-- <div class="single_product_thumb"> -->
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <div class="">
                                    <div class=" ">
                                        <a class="gallery_img" href="<?php echo base_url('uploads/'.$product['product_image']) ?>">
                                            <!-- <img class="d-block w-100" style="height: 50vh;" src="<?php echo base_url('uploads/'.$product['product_image']) ?>"> -->
                                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                <?php foreach(json_decode($product['product_image'] ) as $index => $image ) : ?>
                                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?=$index?>" class="<?= $index == 0 ? 'active' : '' ?>"></li>
                                                    <?php endforeach?>
                                                </ol>
                                                <div class="carousel-inner">
                                                <?php foreach(json_decode($product['product_image'] ) as $index => $image ) : ?>
                                                    <div class="carousel-item <?= $index==0 ? 'active' : ''?>">
                                                    <img src="<?php echo base_url('uploads/'.$image) ?>" class="d-block w-100" alt="..." height="300px">
                                                    </div>
                                                <?php endforeach?>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price"><?php echo 'Rp. '.number_format($product['product_price']); ?></p>
                                <h6><?= $product['product_name'] ?></h6>
                              
                                <!-- Avaiable -->
                                <p>Category : <?= $product['category_name'] ?> </p>
                            </div>
 
                            <div class="short_overview my-5">
                                <p>
                                    <?= $product['product_description'] ?>
                                </p>
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix">
                                <div class="cart-btn d-flex mb-50">
                                    <p>Jumlah</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="qty('min')"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="<?= $cart != false ? $cart['qty'] : 1 ?>">
                                        <span class="qty-plus" onclick="qty('plus')"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <a id='addcart' name="addtocart" value="5" class="btn amado-btn">Tambah Keranjang</a>
                            </form>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('themes/plugins'); ?>/jquery/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            function qty(type) {
                var total = parseInt($('#qty').val());
                // alert('qty');
                if(type == 'plus'){
                    $('#qty').val(total + 1);
                }else if('min'){
                    if(total > 0){
                        $('#qty').val(total - 1);
                    }
                }
            }

            $('#addcart').on('click', function(){
                var total_qty = parseInt($('#qty').val());
                // alert(total)

                if(total_qty <=0){
                    alert('Jumlah minuman pesanan 1 ')
                }else{
                    var id = <?= $product['product_id'] ?>

                    var cart= {
                        'id': id,
                        'qty':  total_qty
                    }

                    // console.log(cart);

                    $.ajax({  
                        url:'<?php echo base_url('market/add-cart'); ?>',
                        type: 'post',
                        dataType:'html',
                        data:{cart:cart},
                        success:function(data){
                            // alert(data);
                            // console.log(data);
                            alert(data)
                            // location.href(<?= base_url('market/cart') ?>)
                        } ,
                    });
                }
            })
        </script>
<?php echo view('_partials/ui/footer');?>