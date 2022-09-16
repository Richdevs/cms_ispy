<?php

use Config\Services;

?>

<?= $this->extend('admin_template/index') ?>
    <!-- Begin Page Content -->
   <?= $this->section('content') ?>





<div class="modal fade" id="addUserProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?= base_url('user/add')?>" method="post">
                <?=csrf_field()?>
                <div class="modal-body">
                    <div class="form-group" >
                        <label for="userName" class="form-label">User Name </label>
                        <input type="text"  class="form-control" name="userName" id="userName" placeholder="Enter Users full name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Users email">
                    </div>
                    <div class="form-group ">
                        <label for="slocation" class="form-label">Location</label>
                        <select  class="custom-select my-1 mr-2" name="slocation" id="slocation" >
                            <option selected>Choose Location</option>
                            <option Value="Mombasa" >Mombasa</option>
                            <option value="Emali">Emali</option>
                            <option Value="Mlolongo">Mlolongo</option>
                            <option Value="Nairobi">Nairobi</option>
                            <option value="Mai Mahiu">Mai mahiu</option>
                            <option value="Salgaa">Salgaa</option>
                            <option value="Eldoret">Eldoret</option>
                            <option value="Malaba">Malaba</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="designation" class="form-label">Designation</label>
                        <select class="custom-select my-1 mr-2" name="designation" id="designation">
                            <option selected>Choose Designation</option>
                            <option value="Admin">Admin</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Installer">Installer</option>
                            <option value="Controller">Controller</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label id="pwd" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password" >

                    </div>
                    <div class="form-group">
                        <label for="cpwd" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpwd" id="cpwd" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"> Save </button>
                </div>
            </form>
        </div>

    </div>
</div>

<div class="container-fluid">
       <!-- DataTables Example -->
    <?php
    // to print success message
    if (session()->get("success")) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->get("success") ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    <?php } ?>
    <?php
    // to print success message
    if (session()->get("fail")) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->get("fail") ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    <?php } ?>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php foreach ($errors as $field => $error) : ?>
                <p><?= $error ?></p>
            <?php endforeach ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">User Profile
                    <button type="button" class="btn btn-success" href="<?php echo base_url('modal') ?>" data-toggle="modal" data-target="#addUserProfile">
                        Add User
                    </button>
                </h6>
            </div>
            <div class="card-body">
            <div class="panel panel-primary">
		   <div class="panel-heading">ISPY TECHNICAL USERS</div>
		   <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="userTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>LOCATION</th>
                            <th>DESIGNATION</th>
                            <th>CREATED AT</th>
                            <th>ACTIONS</th>

                        </tr>
                        </thead>
                        <tbody>

                       
                    </table>
                </div>

            </div>
        </div>

    </div>

<div class="modal" id="editUserProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?= base_url('user/update')?>" method="post" id="updateUser">

                <?=csrf_field()?>
                <div class="modal-body">
                    <input type="hidden" name="userId" id="userid" class="form-control">
                    <div class="form-group" >

                        <label for="username" class="form-label">User Name </label>
                        <input type="text"  class="form-control" name="userName"
                               id="username" placeholder="Enter Users full name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"
                               id="Email" placeholder="Enter Users email">
                    </div>
                    <div class="form-group ">
                        <label for="slocation" class="form-label">Location</label>
                        <select  class="custom-select my-1 mr-2" name="slocation" id="location"  >

                            <option  disabled selected>Choose Location</option>
                            <option Value="Mombasa" >Mombasa</option>
                            <option value="Emali">Emali</option>
                            <option Value="Mlolongo">Mlolongo</option>
                            <option Value="Nairobi">Nairobi</option>
                            <option value="Mai Mahiu">Mai mahiu</option>
                            <option value="Salgaa">Salgaa</option>
                            <option value="Eldoret">Eldoret</option>
                            <option value="Malaba">Malaba</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="designation" class="form-label">Designation</label>
                        <select class="custom-select my-1 mr-2" name="designation"  id="designtion">
                            <option  disabled selected>Choose Designation</option>
                            <option value="Admin">Admin</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Installer">Installer</option>
                            <option value="Controller">Controller</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="pwd" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password"
                               name="pwd" placeholder="Enter Password" >

                    </div>
                    <div class="form-group">
                        <label for="cpwd" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpwd" id="cpwd" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit"
                            class="btn btn-success"> Update </button>
                </div>
            </form>
        </div>

    </div>
</div>


<?= $this->endSection() ?>

