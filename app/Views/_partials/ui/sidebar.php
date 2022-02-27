  
        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.html"><img src="<?php echo base_url('ui-amado'); ?>/img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li  class="<?=($page_url=current_url() == base_url('market') ||$page_url=current_url() == base_url('') . '/'  ) ? 'active' : null?> ?>"><a href="index.html">Beranda</a></li>
                    <li><a href="<?php echo base_url('market/profile'); ?>">Akun</a></li>
                    <li class="<?=$page_url=current_url() == base_url('market/shop') ? 'active' : null?> ?>"><a href="<?php echo base_url('market/shop'); ?>">Daftar Produk</a></li>
                    <!-- <li><a href="<?php echo base_url('ui-amado'); ?>/product-details.html">Product</a></li> -->
                    <li class="<?=$page_url=current_url() == base_url('market/cart') ? 'active' : null?> ?>" ><a href="<?php echo base_url('market/cart'); ?>">Keranjang</a></li>
                    <li class="<?=$page_url=current_url() == base_url('market/history') ? 'active' : null?> ?>"><a href="<?php echo base_url('market/history'); ?>">Histori Order</a></li>
                    <li><a href="<?php echo base_url('market/term-and-service'); ?>">Syarat & Layanan</a></li>
                </ul>
            </nav>
            <!-- Button Group -->
            <!-- <div class="amado-btn-group mt-30 mb-100"> -->
            <div class="amado-btn-group mt-30 mb-100">  
                <?php 
                    if(session()->get('name')){
                        ?>
                            <a href="<?php echo base_url('auth/logout'); ?>" class="btn amado-btn bg-danger mb-15">Keluar</a>
                        <?php
                    }else{
                        ?>
                            <a href="<?php echo base_url('auth/login'); ?>" class="btn amado-btn mb-15">Masuk</a>
                            <a href="<?php echo base_url('auth/register'); ?>" class="btn amado-btn active">Daftar Akun </a>
                        <?php
                    }
                ?>
            </div>
            <!-- </div> -->
            <!-- Cart Menu -->
            <!-- <div class="cart-fav-search mb-100">
               
                <a href="#" class="search-nav"><img src="<?php echo base_url('ui-amado'); ?>/img/core-img/search.png" alt=""> Search</a>
            </div> -->
            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->