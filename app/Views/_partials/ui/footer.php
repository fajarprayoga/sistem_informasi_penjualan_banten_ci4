<!-- ##### Newsletter Area Start ##### -->
</div>



<section class="newsletter-area section-padding-100-0">
    <div class="container">
        <div style="margin-bottom: 20px;">
            <div class="row" id="kolom-ucapan">
                <div class="col-sm-12" ><h2 class="heading-title text-center cmb-3 aos-init aos-animate" style="color: white;" data-aos="zoom-out-up">
                    Ulasan dan Bintang</h2>
                    <div class="scroll col-md-12 aos-init aos-animate tampil-rate" data-aos="fade-up">

                           

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12  pb-5">

        <!-- review -->
           <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h3 style="color: white;" >Review dan Bintang</h3>
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                </div>
                            </div>
                            <div id="rating_div">
                                <div class="star-rating">
                                    <span class="fa fa-star fa-2x star-input" data-index="0" style="font-size:20px;"></span>
                                    <span class="fa fa-star fa-2x star-input" data-index="1" style="font-size:20px;"></span>
                                    <span class="fa fa-star fa-2x star-input" data-index="2" style="font-size:20px;"></span>
                                    <span class="fa fa-star fa-2x star-input" data-index="3" style="font-size:20px;"></span>
                                    <span class="fa fa-star fa-2x star-input" data-index="4" style="font-size:20px;"></span>
                                </div>
                                <br>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <!-- <input type="text" class="form-control" name="email" id="email" placeholder="Email"><br> -->
                            <textarea class="form-control" rows="5" placeholder="Silahkan tulis ulasan anda disini" name="remark" id="review" required></textarea><br>
                            <button class="btn btn-default btn-sm btn-info" id="btn_rate">Submit</button> 
                        </div>
                    </div>
                </div>
            <!-- ulasan -->
            <div class="col-md-6">
                <div class="newsletter-text mb-100" style="text-align: justify;">
                    <h2>Selamat Datang di  <span>Nikasa</span></h2>
                    <p>Nikasa Store merupakan usaha kecil yang bergerak di bidang pemasaran. Toko ini didirikan oleh Ni Nyoman Mudiani yang berdiri sejak tahun 2001 hingga sekarang memiliki banyak pelanggan setia. Nikasa Store terletak di Jalan Sri Ram, Desa Legian, Kecamatan Kutra, Kabupaten Badung. Operasional Nikasa Store buka setiap hari mulai dari jam 4 pagi sampai jam 5 sore WITA. </p>
                        <a href="https://api.whatsapp.com/send?phone=6282235265301?>"  style="color: white; font-size: 20px;" class="nav-link">
                        <i class="nav-icon fa fa-phone mx-1"></i><span>6285954518033</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
    <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="<?php echo base_url('ui-amado'); ?>/index.html"><img src="img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item <?=($page_url=current_url() == base_url('market') ||$page_url=current_url() == base_url('') . '/'  ) ? 'active' : null?> ?>">
                                            <a class="nav-link " href="<?php echo base_url('market/home'); ?>">Home</a>
                                        </li>
                                        <li class="nav-item <?=($page_url=current_url() == base_url('market/shop') ) ? 'active' : null?> ?>">
                                            <a class="nav-link" href="<?php echo base_url('market/shop'); ?>">Shop</a>
                                        </li>
                                        <li class="nav-item <?=($page_url=current_url() == base_url('market/cart') ) ? 'active' : null?> ?>">
                                            <a class="nav-link" href="<?php echo base_url('market/cart'); ?>">Cart</a>
                                        </li>
                                        <li class="nav-item  <?=($page_url=current_url() == base_url('market/history') ) ? 'active' : null?> ?>">
                                            <a class="nav-link" href="<?php echo base_url('market/history'); ?>">History</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="<?php echo base_url('ui-amado'); ?>/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url('ui-amado'); ?>/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url('ui-amado'); ?>/js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url('ui-amado'); ?>/js/plugins.js"></script>
    <!-- Active js -->
    <script src="<?php echo base_url('ui-amado'); ?>/js/active.js"></script>

    <script>

var ratedIndex = -1;
var email = '';
var review ='';
$(document).ready(function() {

    $.ajax({
        url:"<?php echo base_url('market/rate');?>",
        type:'Get',
        dataType: 'json',
        success:function(data) {
            // console.log(data);
          
                data.map((item, index) => {
                    var starActive = ' <span class="fa fa-star" style="font-size:15px; color: #ffa600"></span>';
                    var starNoActive = ' <span class="fa fa-star" style="font-size:15px; color:grey"></span>';
                    var result= '';
                    for (let star = 0; star <= item.rate_star; star++) {
                        // const element = array[star];
                        result += starActive
                        
                    }
                    for (let star = 0; star < (4 - item.rate_star); star++) {
                        // const element = array[star];
                        result += starNoActive
                        
                    }
                    
                    // console.log(result);

                    $('.tampil-rate').append(`
                        <div class="box_ucapan">  
                            <div class="row_ucapan">
                                <div class="ucapan">`+item.rate_review+`</div>
                                <div class="quote"></div>
                                <div class="nama" style="color: white;">`+item.email+`</div>
                                <div id="rating_div">
                                    <div class="star-rating p-3">` + 
                                        result
                                     +`
                                    </div>
                                </div>
                            </div>  
                        </div>
                    `)
                })
        
        },
        error: function(err) {
            // alert('data review insert failed');
            console.log(err);
        }
    });






    resetStartColor();


    $('.star-input').on('click', function(){
        ratedIndex = parseInt($(this).data('index'));

    })

    $('.star-input').mouseover(function (){
        // console.log('here');
        resetStartColor();

        var currentIndex = parseInt($(this).data('index'));

       setStars(currentIndex);
    })

    $('.star-input').mouseleave(function (){
        resetStartColor();
        if(ratedIndex != -1){
           setStars(ratedIndex);
        }
    })

    function resetStartColor(){
        $('.star-input').css({'color':'rgb(143, 143, 143)'});
    }
  
});

function setStars(max){
    for (let i = 0; i <= max ; i++) {
        $('.star-input:eq('+i+')').css('color','yellow');
    }
}


$('#btn_rate').on('click', function (){

    var review = $('#review').val();

    if(ratedIndex != -1 && review != ''){

        var data = {
            star : ratedIndex,
            review : review,
        }
        

        $.ajax({
            url:"<?php echo base_url('market/rate/create');?>",
            type:'post',
            data:data,
            success:function(data) {
                // window.location.reload();
                if(data =='200'){
                    alert('komentar di tambahkan')
                    window.location.reload();
                }else{
                    alert('Mohon Login terlebih dahulu')
                    window.location.href = "<?= base_url('auth/login')?>"
                }
            }
        });
    }else{
        alert('mohon lengkapi data')
    }
})
</script>

</body>

</html>