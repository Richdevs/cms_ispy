<?php

use Config\Services;

?>

<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->

<?= $this->section('content') ?>

<div class="modal fade" id="addaccessory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">ADD ACCESSORY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('accss/add') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body ">
                    <div class="table-responsive ">
                        <table class="table table-bordered" style="width:100%">
                            <input type="hidden" name="idinstallation" id="eidins">
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>REGNO:</th>
                                <td style="width:30%">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="custom-select" id="regno" name="regno">
                                                <option selected disabled> Choose Registration</option>
                                                <?php
                                                foreach ($unit as $unit) : {
                                                        echo '<option value="' . $unit['idinstallation'] . '">' . $unit['regno'] . '</option>';
                                                    }
                                                endforeach;
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <th>AVL READER:</th>
                                <td style="width:30%">
                                    <div class="col-md-12">
                                        <input type="text" id="avl" class="form-control" name="avl">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>CONVERTER:</th>
                                <td>
                                    <div class="col-12">
                                        <div class="wrapper">

                                            <input type="radio" id="conv" name="converter" value="  YES-5amps"> &nbsp;5AMPS</input> &nbsp;

                                            <input type="radio" id="conv" name="converter" Value="YES-10amps">&nbsp;10AMPS</input>
                                        </div>
                                    </div>
                                </td>
                                <th>PROBE-SEALING ROPE:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" id="probe" class="form-control" name="probe">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th> E-CAN:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" id="ecan" class="form-control" name="ecan">
                                    </div>

                                </td>
                                <th>IMMOBILIZER</th>
                                <td>
                                    <div class="col-12">
                                        <div class="wrapper">

                                            <input type="radio" name="immobilizer" value=" YES"> &nbsp;YES</input> &nbsp;

                                            <input type="radio"  name="immobilizer" Value="NO">&nbsp;NO</input>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <tr>

                                <th>ADDITIONAL</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="extra" name="extra" placeholder="ACCESSORY NAME:[SERIAL NUMBER]">

                                    </div>
                                </td>
                         
                                <th>INSTALLER:</th>
                                <td>
                                    <select class="custom-select" id="installer" name="installer">
                                        <option disabled selected>Select Installer</option>
                                        <?php
                                        foreach ($installer as $row) : {
                                                echo '<option value="' . $row['userName'] . '">' . $row['userName'] . '</option>';
                                            }
                                        endforeach;
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">

                            <tr>
                                <th>INSTALLATION DATE:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="date" class="form-control" name="insdate" id="insdate" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                </td>

                            </tr>


                        </table>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"> Save</button>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>


<div class="modal fade" id="editaccessory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">EDIT ACCESSORY</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('accss/update') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body ">
                    <div class="table-responsive ">
                        <table class="table table-bordered" style="width:100%">
                         
                            <input type="hidden" name="refno" id="refno">
                            <tr>
                                <th>REGNO:</th>
                                <td style="width:30%">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="custom-select" id="idinst" name="regno">
                                                <option selected disabled> Choose Registration</option>
                                                <?php
                                                foreach ($units as $unit) : {
                                                        echo '<option value="' . $unit['idinstallation'] . '">' . $unit['regno'] . '</option>';
                                                    }
                                                endforeach;
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <th>AVL READER:</th>
                                <td style="width:30%">
                                    <div class="col-md-12">
                                        <input type="text" id="eavl" class="form-control" name="avl">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>CONVERTER:</th>
                                <td>
                                    <div class="col-12">
                                        <div class="wrapper">

                                            <input type="radio" id="econv" name="converter" value="YES-5Amps"> &nbsp;5AMPS</input> &nbsp;

                                            <input type="radio" id="econv" name="converter" Value="YES-10Amps">&nbsp;10AMPS</input>
                                        </div>
                                    </div>
                                </td>
                                <th>PROBE-SEALING ROPE:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" id="eprobe" class="form-control" name="probe">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th> E-CAN:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" id="e_can" class="form-control" name="ecan">
                                    </div>

                                </td>
                                <th>IMMOBILIZER</th>
                                <td>
                                    <div class="col-12">
                                        <div class="wrapper">

                                            <input type="radio" id="eimb" name="immobilizer" value="YES"> &nbsp;YES</input> &nbsp;

                                            <input type="radio" id="eimb" name="immobilizer" Value="NO">&nbsp;NO</input>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <tr>

                                <th>ADDITIONAL</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="e_xtra" name="extra" placeholder="ACCESSORY NAME:[SERIAL NUMBER]">

                                    </div>
                                </td>
                         
                                <th>INSTALLER:</th>
                                <td>
                                    <select class="custom-select" id="einstaller" name="installer">
                                        <option disabled selected>Select Installer</option>
                                        <?php
                                        foreach ($installers as $row) : {
                                                echo '<option value="' . $row['userName'] . '">' . $row['userName'] . '</option>';
                                            }
                                        endforeach;
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">

                            <tr>
                                <th>INSTALLATION DATE:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="date" class="form-control" name="insdate" id="einsdate">
                                    </div>
                                </td>

                            </tr>


                        </table>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"> Update</button>
                    </div>
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
            <h6 class="m-0 font-weight-bold text-black-50">ACTIVE ACCESSORIES
                <button type="button" class="btn btn-success" href="<?php echo base_url('modal') ?>" data-toggle="modal" data-target="#addaccessory">
                    Add Accessory
                </button>
            </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="accessoryViewTable">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th>REG NO</th>
                            <th>TYPE</th>
                            <th>SERIAL</th>
                            <th>AVL</th>
                            <th>CONVERTER</th>
                            <th>PROBE</th>
                            <th>ECAN</th>
                            <th>IMMOBILIZER</th>
                            <th>INSTALLER</th>
                            <th>DATE</th>
                            <th>ACTIONS</th>

                        </tr>
                    </thead>

                </table>
            </div>

        </div>
    </div>

</div>



<?= $this->endSection() ?>