<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>I-SPY TECHNICAL CMS</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('public/assets');?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo base_url('public/assets');?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/assets');?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">I-SPY TECHNICAL</h2>
            <div class="text-center mb-5 text-dark">CLIENT MANAGEMENT SYSTEM</div>
            <div class="card my-5">

                <form class="card-body cardbody-color p-lg-5" action="<?= base_url('login')?>" method="post">
                    <?=csrf_field()?>
                    <div class="text-center">
                        <img src="<?php echo base_url('public/logo.png')?>" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                             width="200px" alt="profile">
                    </div>
                    <hr>
                    <?php if (session()->get('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                               placeholder="Enter Your Email" value="<?= set_value('email') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" name="pwd" id="pwd"
                               placeholder="Enter Your Password" value="">
                    </div>

                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger px-5 mb-5 w-100" >Login</button>
                    </div>
                    <div class="text-center">
                        <h6>Having issues logging in? Contact Administrator</h6>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</body>
</html>