<?php

use Config\Services;

?>


<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->
<?= $this->section('content') ?>


<div class="modal fade" id="viewChange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white-50" id="exampleModalLabel">View Changes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <input type="hidden" id="refno" name="refno"> -->
            <div class="table-responsive bg-light">
                <table class="table table-bordered" id="dataTable">
                    <tbody>

                        <tr>
                            <th>Registration Number:</th>
                            <td>
                                <div id="tregno"></div>
                            </td>
                            <th>Unit Type:</th>
                            <td>
                                <div id="tunit"></div>
                            </td>
                            <th>Unit Serial:</th>
                            <td>
                                <div id="tserial"></div>
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <div id="lblFrom"></div>
                            </th>
                            <td>
                                <div id="changeFrom"></div>
                            </td>
                            <th><div id="lblTo">
                            </div></th>
                            <td>
                                <div id="changeTo"></div>
                            </td>
                            <th>Date:</th>
                            <td>
                                <div id="tCreatedAt"></div>
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-danger">Delete</button>
                <!-- <button type="button" class="btn btn-success"> UNDO</button> -->
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
            <h6 class="m-0 font-weight-bold text-dark">TRANSFERS PROFILE
                <!-- <a href="<?php echo base_url('changes/report') ?>" class="btn btn-outline-success float-right"><i class="fas fa-file-excel"></i>
                    Export</a> -->
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="transferTable">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>REG NO</th>
                            <th>DEV-TYPE</th>
                            <th>SERIAL</th>
                            <th>CHANGE-FROM</th>
                            <th>CHANGE-TO</th>
                            <th>CHANGE-TYPE</th>
                            <th>ADDED-BY</th>
                            <th>DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>




<?= $this->endSection() ?>