<?php


?>

<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->

<?= $this->section('content') ?>

<div class="card-body">
    <div class="mt-2">

    <?php if (session()->has('message')) { ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php } ?>
    <?php $validation = \Config\Services::validation(); ?>


        <form action="<?= base_url('import-csv') ?>" method="post" enctype="multipart/form-data">

            <div class="input-group col-md-5">

                <input type="file" name="file" class="form-control" id="file">&nbsp; &nbsp;
                <input type="hidden" name="euserid" value="<?= session()->get('userName') ?>">
                <button type="submit" name="submit" value="Upload" class="btn btn-success"><i class="fas fa-file-excel"></i> upload</button>

            </div>



        </form>

    </div>
</div>
<div class="container-fluid">

   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">ARMINGS

            </h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- CSRF token -->
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="armingsTable">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>TRUCK</th>
                            <th>COMPANY</th>
                            <th>SEAL</th>
                            <th>OWNERSHIP</th>
                            <th>CARGO</th>
                            <th>CLAMPED</th>
                            <th>LOADING ZONE</th>
                            <th>DESTINATION</th>
                            <th>ARMED BY</th>
                            <th>DATE</th>
                            <th>ACTIONS</th>


                        </tr>
                    </thead>


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>





<?= $this->endSection() ?>