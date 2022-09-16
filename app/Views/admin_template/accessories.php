<?php

use Config\Services;

?>

<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->

<?= $this->section('content') ?>

<div class="modal fade" id="addAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add Unit Accessories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('accessories') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="accserial" class="form-label">Serial Number </label>
                        <input type="text" id="accserial" class="form-control" name="accserial" placeholder="Enter Serial Number">
                    </div>
                    <div class="form-group">
                        <label for="accname" class="form-label">Accessory</label>
                        <select class="custom-select" id="accname" name="accname">
                            <option selected>Choose Accessory</option>
                            <option Value="RF-READER">RF-READER</option>
                            <option Value="CONVERTER">CONVERTER</option>
                            <option value="FUEL-PROBE">FUEL-PROBE</option>
                            <option value="EYE-BEACON">EYE-BEACON</option>
                            <option value="E-CAN">E-CAN</option>
                            <OPTION value="IMMOBILIZER">IMMOBILIZER</OPTION>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                    </div>
                    <div class="form-group">
                        <label for="idinstallation" class="form-label">Unit</label>
                        <select class="custom-select" id="idinstallation" name="idinstallation">
                            <option disabled selected>Select Unit</option>
                            <?php
                            foreach ($unit as $row) : {
                                    echo '<option value="' . $row['device_serial'] . '">' . $row['regno'] . '</option>';
                                }
                            endforeach;
                            ?>
                        </select>
                        <div class="form-group">
                        <label for="installer" class="form-label">Installer</label>
                        <select class="custom-select" id="installer" name="installer">
                            <option disabled selected>Select Installer</option>
                            <?php
                            foreach ($installer as $row) : {
                                    echo '<option value="' . $row['userName'] . '">' . $row['userName'] . '</option>';
                                }
                            endforeach;
                            ?>
                        </select>
                        </div>
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
<div class="modal fade" id="editAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">Edit Accessories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="table-responsive">

                    <table class="table table-bordered" style="width:100%" id="accviewTable">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>REG NO</th>
                                <th>SERIAL</th>
                                <th>ACCESSORY</th>
                                <th>INSTALLER</th>
                                <th>DATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>

                    </table>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>


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
            <h6 class="m-0 font-weight-bold text-black-50">Unit Accessories
                <button type="button" class="btn btn-success" href="<?php echo base_url('modal') ?>" data-toggle="modal" data-target="#addAcc">
                    Add Accessory
                </button>
            </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="accTable">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>REG NO</th>
                            <th>TYPE</th>
                            <th>SERIAL</th>
                            <th>READER</th>
                            <th>IMMOBILIZER</th>
                            <th>CONVERTER</th>
                            <th>FUEL PROBE</th>
                            <th>E-CAN</th>
                            <th>ACTION</th>

                        </tr>
                    </thead>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>