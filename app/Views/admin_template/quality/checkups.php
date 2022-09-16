<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->
<?= $this->section('content') ?>

<!-- NEW CHECKUP STRUCTURE -->
<div class="modal fade" id="addCheckup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">NEW CHECKUP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('checkup/add') ?>" method="post" id="frmCheckup"accept-charset="utf-8" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>REGISTRATION:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="custom-select" name="regno">
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
                                <th>UPLOAD IMAGE:</th>
                                <td>
                                    <div class="input-group col-md-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" onchange="previewFile(this);" name="imagePath" id="img_upload">
                                            <label class="custom-file-label upload" id="upload-label" for="inputGroupFile04">Choose file</label>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>ISSUE:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="issue">
                                        </div>
                                    </div>

                                </td>
                                <th></th>
                                <td rowspan="5">

                                    <div class="image-area mt-0 rounded">

                                        <img src="#" alt="" class="imageresult1" id="imageResult" height="320px" width="410px">
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <th>FINDINGS:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="findings">
                                        </div>

                                    </div>
                                </td>
                                
                            </tr>
                            <tr>
                            <th>SOLUTION:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="solution">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
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
                            <tr>
                                <th>CONVERTER:</th>
                                <td>
                                    <div class="col-12">
                                        <div class="wrapper">

                                            <input type="radio" name="converter" value="  YES-5amps"> &nbsp;5AMPS</input> &nbsp;

                                            <input type="radio"  name="converter" Value="YES-10amps">&nbsp;10AMPS</input>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                            <tr>
                            <th>UNITID:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="uid">
                                        </div>
                                    </div>
                                </td>
                                <th>AVL READER:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="avl">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <th>CHECKUP DATE:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="date" class="form-control" name="chkdate">
                                        </div>
                                    </div>
                                </td>
                                <th>COMMENTS:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="remarks"></textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                        </table>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="save"> Save</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
<div class="modal fade" id="editCheckup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">EDIT CHECKUP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('checkups/update') ?>" method="post" id="frmCheckup"accept-charset="utf-8" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" id="refno" name="refno" >
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>REGISTRATION:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="custom-select" id="regno" name="regno">
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
                                <th>UPLOAD:</th>
                                <td>
                                <div class="input-group col-md-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input imgUpload" name="imagePath" onchange="previewFile2(this);" id="imgUpload">
                                            <label class="custom-file-label" id="upload-label2" for="inputGroupFile04">Choose file</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>ISSUE:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="issue" name="issue">
                                        </div>
                                    </div>

                                </td>
                                <th></th>
                                <td rowspan="5">

                                    <div class="image-area mt-0 rounded">

                                        <img src="#" alt="" class="imageresult" height="360px" width="420px">
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <th>FINDINGS</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="findings" name="findings">
                                        </div>

                                    </div>
                                </td>
                                
                            </tr>
                            <tr>
                            <th>SOLUTION:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="solution" name="solution">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <th>INSTALLER:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                    <select class="custom-select" id="Installer" name="installer">
                                        <option disabled selected>Select Installer</option>
                                        <?php
                                        foreach ($installers as $row) : {
                                                echo '<option value="' . $row['userName'] . '">' . $row['userName'] . '</option>';
                                            }
                                        endforeach;
                                        ?>
                                    </select>
                                        </div>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <th>CONVERTER:</th>
                                <td>
                                <div class="form-group">
                                      
                                    <div class="col-md-12">
                                        <div class="wrapper">

                                            <input type="radio" id="conv" name="converter" value="  YES-5amps"> &nbsp;5AMPS</input> &nbsp;

                                            <input type="radio" id="conv" name="converter" Value="YES-10amps">&nbsp;10AMPS</input>
                                        </div>
                                    </div>
                                </div>
                                </td>
                                </tr>
                            <tr>
                            <th>UNIT ID:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="uid" name="uid">
                                        </div>
                                    </div>
                                </td>
                                <th>AVL READER:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="avl" name="avl">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            <th>CHECKUP DATE:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="date" class="form-control" id="chdate" name="chkdate">
                                        </div>
                                    </div>
                                </td>
                                <th>COMMENTS:</th>
                                <td>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" id="remarks" name="remarks"></textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                        </table>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="save"> Save</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

<!-- END OF NEW CHECK UP STRUCTURE -->


<div class="modal fade" id="addCheckup2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-gray">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">NEW CHECKUP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('checkup/add') ?>" method="post" id="frmCheckup">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="table-layout:fixed">
                            <tr>
                                <th>Registration:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="custom-select" id="regno" name="regno">
                                                <option selected disabled> Choose Registration</option>
                                                <?php
                                                //  foreach ($unit as $unit) : {
                                                echo '<option value="' . $unit['idinstallation'] . '">' . $unit['regno'] . '</option>';
                                                // }
                                                //   endforeach;
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Issue:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="issue" name="issue">
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th>Findings</th>
                                <td rowspan="2">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" id="findings" name="findings" rows="3"></textarea>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            
                        </table>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="save"> Save</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
<div class="modal fade" id="editCheckup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-gray">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">EDIT CHECKUP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('checkups/update') ?>" method="post" id="frmCheckup">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                    <input type="hidden" name="refno" id="refno">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="table-layout:fixed">
                            <tr>
                                <th>Registration:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select class="custom-select" id="eregno" name="regno">
                                                <option selected disabled> Choose Registration</option>
                                                <?php
                                               // foreach ($units as $reg) : {

                                                        echo '<option value="' . $reg['idinstallation'] . '">' . $reg['regno'] . '</option>';
                                                    //}
                                                //endforeach;
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Issue:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="eissue" name="issue">
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th>Findings</th>
                                <td rowspan="2">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" id="efindings" name="findings" rows="3"></textarea>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger data-dismiss=" modal">Close</button>
                        <button type="submit" class="btn btn-success" id="save"> Update</button>
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
            <h6 class="m-0 font-weight-bold text-dark">Units Checkups</h6>
            <h6 class="m-0 font-weight-bold text-dark">
                <button type="button" class="btn btn-outline-success" href="<?= base_url("modal") ?>" data-toggle="modal" data-target="#addCheckup">
                    New Check
                </button>
            </h6>
            <h6 class="m-0 font-weight-bold text-dark">

            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="checkupsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>REG</th>
                            <th>COMPANY</th>
                            <th>ISSUE</th>
                            <th>FINDINGS</th>
                            <th>SOLUTION</th>
                            <th>CONVERTER</th>
                            <th>UID</th>
                            <th>AVL</th>
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