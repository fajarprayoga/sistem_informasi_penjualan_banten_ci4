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
        <div class="row justify-content-md-center">
            <?php
                $errors = session()->getFlashdata('errors');
                if(!empty($errors)){ ?>
                <div class="alert alert-danger w-100" role="alert">
                    Whoops! Gagal melakukan perubahan::
                    <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php } ?>
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Akun</h5>
                        <form action="<?= base_url('market/profile/update') ?>" method="POST">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" value="<?= $user['username']?>" id="username" name='username' >
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="<?= $user['name']?>" id="name" name='name'  >
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" class="form-control" value="<?= $user['email']?>" id="email" name='email'  >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label> <span style="color: grey;" >Optional</span>
                                <input type="password" class="form-control" id="exampleInputPassword1" name='password' >
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label> <span style="color: grey;">Optional</span>
                                <input type="password" class="form-control"  id="confirm_password" name='confirm_password' >
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">No Hp</label>
                                <input type="number" class="form-control" value="<?= $user['phone']?>" id="phone" name='phone' >
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>   
        </div>
    </div>
</div>
</script>
