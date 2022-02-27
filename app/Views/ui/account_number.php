
<?php echo view('_partials/ui/header')?>
        <!-- Header Area End -->

        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12 mt-3">
                        <h3>Account Number</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Account</td>
                                    <td>Number</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(!empty(getenv('rek_bni'))){
                                        ?>
                                            <tr>
                                                <td>1</td>
                                                <td>BNI</td>
                                                <td><?= getenv('rek_bni') ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>

                                <?php 
                                    if(!empty(getenv('rek_bri'))){
                                        ?>
                                            <tr>
                                                <td>2</td>
                                                <td>BRI</td>
                                                <td><?= getenv('rek_bri') ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>

                                <?php 
                                    if(!empty(getenv('rek_bca'))){
                                        ?>
                                            <tr>
                                                <td>3</td>
                                                <td>BCA</td>
                                                <td><?= getenv('rek_bca') ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                             
                                <?php 
                                    if(!empty(getenv('rek_bpd'))){
                                        ?>
                                            <tr>
                                                <td>3</td>
                                                <td>BPD</td>
                                                <td><?= getenv('rek_bpd') ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
<?php echo view('_partials/ui/footer');?>