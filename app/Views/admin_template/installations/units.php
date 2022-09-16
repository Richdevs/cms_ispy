<?php

use Config\Services;

?>

<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->

<?= $this->section('content') ?>

<div class="modal fade" id="addUnit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">ADD UNIT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('create-unit') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body ">
                    <div class="table-responsive ">
                        <table class="table table-bordered" style="width:100%">
                            <input type="hidden" name="idinstallation" id="eidins">
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>Registration:</th>
                                <td style="width:30%">
                                    <div class="col-md-12">
                                        <input type="text" id="regno" class="form-control" name="regno">
                                    </div>
                                </td>
                                <th>Make:</th>
                                <td style="width:30%">
                                    <div class="col-md-12">
                                        <input type="text" id="make" class="form-control" name="make">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>Device Type:</th>
                                <td>
                                    <div class="col-md-12">
                                        <select class="custom-select " id="device_type" name="device_type">
                                            <option selected>Choose Device type</option>
                                            <option Value="HELIOS-ADVANCED">HELIOS-ADVANCED</option>
                                            <option value="HELIOS-TT">HELIOS-TT</option>
                                            <option Value="FMB920">FMB-920</option>
                                            <option Value="FMB120">FMB-120</option>
                                            <option value="FMB125">FMB-125</option>
                                            <option value="FMB140">FMB-140</option>
                                        </select>
                                    </div>
                                </td>
                                <th>Subscription:</th>
                                <td>
                                    <div class="col-md-12">
                                        <select class="custom-select my-1 mr-2 " id="subscription" name="subscription">
                                            <option disabled selected>Select Subscription</option>
                                            <option value="FLEET">FLEET</option>
                                            <option value="FULL ECTS">FULL-ECTS</option>
                                            <option value="ECTS TIPPER">ECTS-TIPPER</option>
                                            <option value="FUEL CANBUS">FUEL-CANBUS</option>
                                            <option value="FUEL PROBE">FUEL-PROBE</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th> Upload Image:</th>
                                <td>
                                    <div class="input-group col-md-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input imgUpload" name="imagePath" onchange="previewFile2(this);" id="imgUpload">
                                            <label class="custom-file-label" id="upload-label2" for="inputGroupFile04">Choose file</label>
                                        </div>

                                    </div>

                                </td>
                                <th>Simcard:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="simcard" name="simcard" placeholder="Enter Serial Number">

                                    </div>
                                </td>
                            </tr>


                            <tr>

                                <th>Serial:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="serial" name="serial" placeholder="Enter Serial Number">

                                    </div>
                                </td>
                                <th>Vehicle Image:</th>
                                <td rowspan="5">

                                    <div class="image-area mt-0 rounded">

                                        <img src="#" alt="" class="imageresult" height="300px" width="300px">
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <th>Company:</th>
                                <td>
                                    <div class="col-md-12">
                                        <select class="custom-select my-1 mr-2" id="idclient" name="idclient">
                                            <option disabled selected>Select Client</option>
                                            <?php
                                            foreach ($client as $row) : {
                                                    echo '<option value="' . $row['clientname'] . '">' . $row['clientname'] . '</option>';
                                                }
                                            endforeach;
                                            ?>

                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>Color:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" id="color" class="form-control" name="color" placeholder="Enter Vehicle Color">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>Installation Date:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="date" class="form-control" name="insdate" id="insdate" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>User:</th>
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
                    </div>
                    </td>

                    </tr>
                    <tr>
                        <th>Device Warranty? :</th>
                        <td>
                            <div class="col-12">
                                <div class="wrapper">

                                    <input type="radio" id="warranty" name="warranty" value="Yes"> &nbsp;Yes</input> &nbsp;

                                    <input type="radio" id="warranty" name="warranty" Value="No">&nbsp;No</input>
                                </div>
                            </div>
                        </td>
                        <th></th>
                        <td>
                            &nbsp;
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


<!-- TRANSFER MODALS-->
<div class="modal fade" id="upgrade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">CHANGE SUBSCRIPTION</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transfer/update') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <input type="hidden" name="idinstallation" id="idinstallation">
                    <div class="form-group">
                        <label for="changeType" class="form-label">Change Type </label>
                        <input type="text" id="changeType" class="form-control" name="changeType" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="sRegno" class="form-label">Registration </label>
                        <input type="text" id="sRegno" class="form-control" name="regno" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="sdtype" class="form-label">Device Type </label>
                        <input type="text" id="sdtype" class="form-control" name="regno" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="dev_serial" class="form-label">Serial</label>
                        <input type="text" class="form-control" id="dev_serial" name="device_serial" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="sSubscr" class="form-label">Prev-Subscription</label>
                        <input type="text" id="sSubscr" class="form-control" name="sSubscr" readonly="readonly">
                    </div>
                    <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">

                    <div class="form-group">
                        <label for="subscription" class=" col-form-label">New-Subscription</label>
                        <select class="custom-select my-1 mr-2 " id="subscription" name="subscription">
                            <option disabled selected>Select Subscription</option>
                            <option value="FLEET">FLEET</option>
                            <option value="FULL ECTS">FULL-ECTS</option>
                            <option value="ECTS TIPPER">ECTS-TIPPER</option>
                            <option value="FUEL CANBUS">FUEL-CANBUS</option>
                            <option value="FUEL PROBE">FUEL-PROBE</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="unit-change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">CHANGE SUBSCRIPTION</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transfer/unitChange') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <input type="hidden" name="idinstallation" id="idinst">
                    <div class="form-group">
                        <label for="changetype" class="form-label">Change Type </label>
                        <input type="text" id="changetype" class="form-control" name="changeType" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="sregno" class="form-label">Registration </label>
                        <input type="text" id="sregno" class="form-control" name="regno" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="unitype" class="form-label">Device Type</label>
                        <select class="custom-select border border-success" id="unitype" name="unitype">
                            <option selected>Choose Device type</option>
                            <option Value="HELIOS-ADVANCED">HELIOS-ADVANCED</option>
                            <option value="HELIOS-TT">HELIOS-TT</option>
                            <option Value="FMB920">FMB-920</option>
                            <option Value="FMB120">FMB-120</option>
                            <option value="FMB125">FMB-125</option>
                            <option value="FMB140">FMB-140</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="devserial" class="form-label">Prev-Serial</label>
                        <input type="text" class="form-control" id="devserial" name="devserial" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="newserial" class="form-label">New-Serial</label>
                        <input type="text" class="form-control border border-success" id="newserial" name="newserial">
                    </div>
                    <div class="form-group">
                        <label for="Subscr" class="form-label">Prev-Subscription</label>
                        <input type="text" id="Subscr" class="form-control" name="Subscr" readonly="readonly">
                    </div>
                    <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="client-change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">CLIENT CHANGE</h5>
                <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transfer/clientChange') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">

                    <input type="hidden" name="idinstallation" id="idins">
                    <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                    <div class="form-group">
                        <label for="change_type" class="form-label">Change Type </label>
                        <input type="text" id="change_type" class="form-control" name="changeType" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="regnum" class="form-label">Registration </label>
                        <input type="text" id="regnum" class="form-control" name="regno" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="serial" class="form-label">Serial</label>
                        <input type="text" class="form-control" id="serial" name="devserial" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="unitSubscr" class="form-label">Prev-Subscription</label>
                        <input type="text" id="unitSubscr" class="form-control" name="Subscr" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="client" class="form-label">EXISTING-CLIENT</label>
                        <select class="custom-select my-1 mr-2" id="client" name="client">
                            <option disabled selected>Select Client</option>
                            <?php
                            foreach ($client as $row) : {
                                    echo '<option value="' . $row['idclient'] . '">' . $row['clientname'] . '</option>';
                                }
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="idclient" class="form-label">CHANGE CLIENT</label>
                        <select class="custom-select my-1 mr-2" id="idclient" name="idclient">
                            <option disabled selected>Select Client</option>
                            <?php
                            foreach ($client as $row) : {
                                    echo '<option value="' . $row['idclient'] . '">' . $row['clientname'] . '</option>';
                                }
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="viewUnit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white-50" id="exampleModalLabel">View Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="vid" name="vid">
            <div class="table-responsive bg-light">
                <table class="table table-bordered" id="dataTable">
                    <tbody>

                        <tr>
                            <th>Registration Number:</th>
                            <td>
                                <div id="vregno"></div>
                            </td>
                            <th>Make-Model:</th>
                            <td>
                                <div id="vmake"></div>
                            </td>

                            <td rowspan="6">

                                <img id="vimage" alt="" width='300px' height="300px">
                        </tr>
                        </tr>
                        <tr>
                            <th>Color:</th>
                            <td>
                                <div id="vcolor"></div>
                            </td>
                            <th>Company:</th>
                            <td>
                                <div id="vclientname"></div>
                            </td>
                        </tr>

                        <tr>

                            <th>Subscription:</th>
                            <td>
                                <div id="vsubscription"></div>
                            </td>
                            <th>Warranty:</th>
                            <td>
                                <div id="vwarranty"></div>
                            </td>
                        </tr>
                        <tr>
                            <th>Device Serial:</th>
                            <td>
                                <div id="vserial"></div>
                            </td>
                            <th>Device Type:</th>
                            <td>
                                <div id="vdevicetype"></div>
                            </td>
                        <tr>
                            <th>Device Simcard:</th>
                            <td>
                                <div id="vsimcard"></div>
                            </td>
                            <th>Installation Date:</th>
                            <td>
                                <div id="vcreatedat"></div>
                            </td>
                        </tr>

                        <tr>
                            <th>Added By:</th>
                            <td>
                                <div id="vusername"></div>
                            </td>
                            <th>Installer:</th>
                            <td>
                                <div id="vInstaller"></div>
                            </td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="unitUpdate()" href="javascript:"> Edit</button>
            </div>


        </div>



    </div>

</div>
<div class="modal" id="editUnit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">EDIT UNIT</h5>
                <button type="button" class="close" data-dismiss="modal" id="modalClose" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('units/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body ">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width:100%">
                            <input type="hidden" name="unitid" id="unitid">
                            <input type="hidden" name="image" id="image">
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>Registration:</th>
                                <td style="width:30%">
                                    <div class="col-md-12">
                                        <input type="text" id="eregno" class="form-control" name="regno">
                                    </div>
                                </td>
                                <th>Make:</th>
                                <td style="width:30%">
                                    <div class="col-md-12">
                                        <input type="text" id="emake" class="form-control" name="make">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>Device Type:</th>
                                <td>
                                    <div class="col-md-12">
                                        <select class="custom-select " id="edevice_type" name="device_type">
                                            <option selected>Choose Device type</option>
                                            <option Value="HELIOS-ADVANCED">HELIOS-ADVANCED</option>
                                            <option value="HELIOS-TT">HELIOS-TT</option>
                                            <option Value="FMB920">FMB-920</option>
                                            <option Value="FMB120">FMB-120</option>
                                            <option value="FMB125">FMB-125</option>
                                            <option value="FMB140">FMB-140</option>
                                        </select>
                                    </div>
                                </td>
                                <th>Subscription:</th>
                                <td>
                                    <div class="col-md-12">
                                        <select class="custom-select my-1 mr-2 " id="esubscription" name="subscription">
                                            <option disabled selected>Select Subscription</option>
                                            <option value="FLEET">FLEET</option>
                                            <option value="FULL ECTS">FULL-ECTS</option>
                                            <option value="ECTS TIPPER">ECTS-TIPPER</option>
                                            <option value="FUEL CANBUS">FUEL-CANBUS</option>
                                            <option value="FUEL PROBE">FUEL-PROBE</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Device Serial:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="edevice_serial" name="serial" placeholder="Enter Serial Number">

                                    </div>
                                </td>
                                <th colspan="2" rowspan="8">
                                    <div class="image-area mt-0 rounded">

                                        <img id="imageResult" src="#" alt="" height="470px" width="500px">
                                    </div>

                                </th>
                                <!-- <td rowspan="7">

                                    <div class="image-area mt-0 rounded">

                                        <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow" height="400px" width="600px">
                                    </div>

                                </td> -->

                            </tr>
                            <tr>
                                <th> Upload Image:</th>
                                <td>


                                    <div class="input-group col-md-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" onchange="previewFile(this);" name="imagePath" id="img_upload">
                                            <label class="custom-file-label upload" id="upload-label" for="inputGroupFile04">Choose file</label>
                                        </div>

                                    </div>
                                </td>
                                <!-- <th></th> -->
                                <!-- <td rowspan="5">

                                <div class="image-area mt-0 rounded">

                                    <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow" height="300px" width="300px">
                                </div>

                            </td> -->

                            </tr>
                            <tr>

                                <th>Simcard:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="esimcard" name="simcard" placeholder="Enter Simcard Number">

                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>Company:</th>
                                <td>

                                    <div class="col-md-12">
                                        <select class="custom-select my-1 mr-2" id="eidclient" name="idclient">
                                            <option selected>Select Client</option>
                                            <?php
                                            foreach ($client as $row) : {
                                                    echo '<option value="' . $row['clientname'] . '">' . $row['clientname'] . '</option>';
                                                }
                                            endforeach;
                                            ?>

                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <input type="hidden" name="euserid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>Color:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="text" id="ecolor" class="form-control" name="color" placeholder="Enter Vehicle Color">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>Installation Date:</th>
                                <td>
                                    <div class="col-md-12">
                                        <input type="date" class="form-control insdate" name="insdate" id="einsdate">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th>Installer:</th>
                                <td>
                                    <div class="col-md-12">
                                        <select class="custom-select" id="einstaller" name="installer">
                                            <option selected>Select Installer</option>
                                            <?php
                                            foreach ($installer as $row) : {
                                                    echo '<option value="' . $row['userName'] . '">' . $row['userName'] . '</option>';
                                                }
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <!-- <th>&nbsp;</th>
                                <td>&nbsp;</td> -->
                            </tr>
                            <tr>
                                <th>Device Warranty:</th>


                                <td>
                                    <div class="col-12">
                                        <div class="wrapper">

                                            <input type="radio" id="warranty2" name="warranty" value="Yes"> &nbsp;Yes</input> &nbsp;

                                            <input type="radio" id="warranty2" name="warranty" Value="No">&nbsp;No</input>
                                        </div>
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
        </div>
        </form>

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
            <h6 class="m-0 font-weight-bold text-dark">Unit Profile
                <button type="button" class="btn btn-outline-danger" href="<?php echo base_url('installations/modals/addunit') ?>" data-toggle="modal" data-target="#addUnit">
                    Add Unit

                </button>
                <div class="containter mt-0 m-sm-auto  float-right">
                    <div class=" input-group col-md-12">
                        <label for="reportrange" class="col-form-label">Select Date Range</label> &nbsp;&nbsp;
                        <input type="text" class="form-control " id="reportrange"> &nbsp;&nbsp;
                        <!-- <button type="button" class="btn btn-outline-success" onclick="exports()" id="export_units"> <i class="fas fa-file-excel"></i>
                     Export Data </button> -->
                        <a href="<?php echo base_url('exportUnits') ?>" class="btn btn-outline-success"><i class="fas fa-file-excel"></i>
                            Export</a>
                            <input type="text" name="datefrom" id="datefrom">
                            <input type="text" name="dateto" id="dateto">
                    </div>

                </div>



            </h6>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- CSRF token -->
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="unitTable">
                    <thead>

                        <tr>

                            <th>#</th>
                            <th>REG NO</th>
                            <th>DEVICE TYPE</th>
                            <th>SERIAL</th>
                            <th>COMPANY</th>
                            <th>SUBSCRIPTION</th>
                            <th>INSTALLER</th>
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