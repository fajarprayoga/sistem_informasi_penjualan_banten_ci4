
<?php echo view('_partials/ui/header')?>
        <!-- Header Area End -->

        <div class="shop_sidebar_area">
            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Kategori</h6>
                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                    <li class="<?= !isset($_GET['category']) ? 'active' : '' ?>"><a href="<?= base_url('market/shop') ?>">Semua</a></li>
                        <?php 
                            foreach ($categories as $index => $category) { ?>
                                <li class="<?= isset($_GET['category']) && ( $category['category_id'] ==  $_GET['category']) ? 'active' : '' ?>"><a href="<?= base_url('market/shop?category='. $category['category_id']) ?>"><?= $category['category_name'] ?></a></li>
                                
                        <?php   }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">
            <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <div class="product-sorting d-flex">
                                <div class="view-product d-flex align-items-center">
                                    <a href="#" class="search-nav p-2 " style="border: 1px solid #f5f7fa; border-radius: 5px; background-color: #f5f7fa;"><img src="<?php echo base_url('ui-amado'); ?>/img/core-img/search.png" alt=""> Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach($products as $product) :  ?>
                        <!-- Single Product Area -->
                        <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="<?php echo base_url('uploads/'.json_decode($product['product_image'])[0]) ?>" alt="" style="height: 40vh;">
                                    <!-- Hover Thumb -->
                                    <!-- <img class="hover-img" src="<?php echo base_url('ui-amado'); ?>/img/product-img/product2.jpg" alt=""> -->
                                </div>

                                <!-- Product Description -->
                                <div class="product-description d-flex align-items-center justify-content-between">
                                    <!-- Product Meta Data -->
                                    <div class="product-meta-data">
                                        <div class="line"></div>
                                        <p class="product-price"><?php echo 'Rp. '.number_format($product['product_price']); ?></p>
                                        <a href="<?= base_url('market/detail') .'/'. $product['product_id']?>">
                                            <h6><?= $product['product_name'] ?></h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- singe produt area -->
                    <?php endforeach ?>

                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">     <div class="d-flex justify-content-end">
                        <?php if ($pager) :?>
                            <?php echo $pager->links('jq', 'bs_page') ?> 
                        <?php endif ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <?php echo view('_partials/ui/footer');?>