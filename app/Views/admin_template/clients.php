<?php

use Config\Services;
?>

<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->

<?= $this->section('content') ?>

<div class="modal fade" id="addClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add Unit</h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('client/insert') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="clientname" class="col-form-label">Client Name</label>
                        <input type="text" id="clientname" class="form-control" name="clientname" placeholder="Enter Client's Name">
                    </div>
                    <div class="form-group">
                        <label for="contactperson" class="col-form-label">Contact Person</label>
                        <input type="text" class="form-control" name="contactperson" id="contactperson" placeholder="Enter Contact Person's Name">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Phone</label>
                        <input type="text" id="phone" class="form-control" name="phone" placeholder="Enter Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Enter Contact's Email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"> Save </button>
                    </div>
                </div>
            </form>
        </div>


    </div>

</div>
<div class="modal fade" id="editClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="<?= base_url('client/update/') ?>" method="post">

                <div class="modal-body">
                    <div class="form-group" >
                        <input type="hidden" id="id" name="idclient">
                        <label for="clientname" class="col-form-label">Client Name</label>
                        <input type="text" class="form-control" name="clientname"
                               id="cname">
                    </div>
                    <div class="form-group">
                        <label  for="contactperson" class="col-form-label">Contact Person</label>
                        <input type="text" class="form-control" name="contactperson"
                               id="contact" >
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Phone</label>
                        <input type="text" id="cphone" class="form-control"
                               name="phone">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" id="cemail" class="form-control"
                               name="email">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


</div>

<div class="modal fade" id="viewClient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white-50" id="exampleModalLabel">View Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <tbody>

                        <tr>
                            <th>Company No. :</th>
                            <td>
                                <div id="vid"> </div>
                            </td>
                            <th>Client Name:</th>
                            <td>
                                <div id="vname"> </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Contact Person:</th>
                            <td>
                                <div id="vcontact"></div>
                            </td>
                            <th>Phone No. :</th>
                            <td>
                                <div id="vphone"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Email Address:</th>
                            <td>
                                <div id="vemail"></div>
                            </td>
                            <th>Date Added:</th>
                            <td>
                                <div id="vcreatedat"></div>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-success " onclick="loadClient()" id="view_client_close"> Edit</button>
            </div>


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
            <h6 class="m-0 font-weight-bold text-black-50">Client Profile
                <button type="button" class="btn btn-success" href="<?php echo base_url('modal') ?>" data-toggle="modal" data-target="#addClient">
                    Add Client
                </button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="clientTable">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>CLIENT NAME</th>
                            <th>CONTACT PERSON</th>
                            <th>PHONE</th>
                            <th>EMAIL</th>
                            <th>CREATED AT</th>
                            <th>ACTIONS</th>

                        </tr>
                    </thead>
             
                </table>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>