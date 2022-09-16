<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->
<?= $this->section('content') ?>



<div class="modal fade" id="addReturn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">ADD RETURN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('save-unit') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered" style="table-layout:fixed;">
                            <input type="hidden" name="idinstallation" id="eidins">
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>Device Serial:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control" id="serial" name="serial">
                                        </div>
                                    </div>
                                </td>

                                <td rowspan="6">
                                    <div class="col-md-12">
                                        <div class="image-area mt-0 rounded">

                                            <img id="imageresult" src="#" alt="" class="img-fluid rounded shadow imageresult" height="300px" width="300px">
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <th>Fault Type:</th>
                                <td style="width:30%">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <select class="custom-select" id="fault_type" name="fault_type">
                                                <option selected disabled>Choose Fault Type</option>
                                                <?php
                                                foreach ($fault as $row) : {
                                                        echo '<option value="' . $row['id'] . '">' . $row['fault_type'] . '</option>';
                                                    }
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th> Upload Image:</th>
                                <td>
                                <div class="input-group col-md-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" onchange="previewFile2(this);" name="imagePath" id="imgUpload">
                                        <label class="custom-file-label upload" id="upload-label2" for="inputGroupFile04">Choose file</label>
                                    </div>

                                </div>
                                </td>

                            </tr>
                            <tr>
                                <th>Diagnosis:</th>
                                <td rowspan="2">
                                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3"></textarea>
                                </td>

                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                            </tr>

                            <tr>
                                <th>Device Status</th>
                                <td>
                                    <div class="col-md-12">
                                        <select id="status" class="form-control" name="status">
                                            <option selected disabled>Select Status</option>
                                            <option value="REPAIRED">REPAIRED</option>
                                            <option value="DISCONTINUED">DISCONTINUED</option>
                                            <option value="SERVICE CENTER">SERVICE CENTER</option>
                                            <option value="DEFECTIVE">DEFECTIVE</option>
                                        </select>
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
        </div>
        </form>

    </div>

</div>

<div class="modal fade" id="editReturn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">EDIT RETURN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('returns/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered" style="table-layout:fixed;">
                            <input type="hidden" name="id" id="idins">
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>Device Serial:</th>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <input type="text" class="form-control" id="devserial" name="serial">
                                        </div>
                                    </div>
                                </td>

                                <td rowspan="6">
                                    <div class="col-md-12">
                                        <div class="image-area mt-0 rounded">

                                            <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow" height="300px" width="300px">
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <th>Fault Type:</th>
                                <td style="width:30%">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <select class="custom-select" id="efault" name="fault_type">
                                                <option selected disabled>Choose Fault Type</option>
                                                <?php
                                                foreach ($fault as $row) : {
                                                        echo '<option value="' . $row['id'] . '">' . $row['fault_type'] . '</option>';
                                                    }
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>

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

                            </tr>
                            <tr>
                                <th>Diagnosis:</th>
                                <td rowspan="2">
                                <div class="input-group col-md-12">
                                    <textarea class="form-control" id="diag" name="diagnosis" rows="3"></textarea>
                                            </div>
                                </td>

                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                            </tr>

                            <tr>
                                <th>Device Status</th>
                                <td>
                                    <div class="col-md-12">
                                        <select id="estatus" class="form-control" name="status">
                                            <option selected disabled>Select Status</option>
                                            <option value="REPAIRED">REPAIRED</option>
                                            <option value="DISCONTINUED">DISCONTINUED</option>
                                            <option value="SERVICE CENTER">SERVICE CENTER</option>
                                            <option value="DEFECTIVE">DEFECTIVE</option>
                                        </select>
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
        </div>
        </form>

    </div>

</div>
<!-- EDIT RETURN -->
<div class="modal fade" id="viewReturn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray-">
            <div class="modal-header bg-gradient-dark">
                <h5 class="modal-title text-white" id="exampleModalLabel">VIEW RETURN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered" style="table-layout:fixed;">
                            <input type="hidden" name="idinstallation" id="eidins">
                            <input type="hidden" name="userid" value="<?= session()->get('userid') ?>">
                            <tr>
                                <th>Device Serial:</th>
                                <td>
                                    <div class="col-md-12">
                                        <div id="vserial"></div>
                                        <div class="col-md-12">
                                </td>
                                <td>&nbsp;</td>

                            </tr>
                            <tr>
                                <th>Registration:</th>
                                <td>
                                    <div id="vregno"></div>
                                </td>
                                <td>Device Image:</td>
                            </tr>
                            <tr>
                                <th>Fault Type:</th>
                                <td style="width:30%">
                                    <div id="vfault"></div>
                                </td>
                                <td rowspan="7">
                                

                                    <div class="col-md-12">
                                        <div class="image-area mt-0 rounded">

                                            <img id="imgeResult" src="#" alt="" class="img-fluid rounded shadow" height="300px" width="300px">
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <th> Uploaded Image:</th>
                                <td>
                                <div id="imagename"></div>
                                </td>

                            </tr>
                            <tr>
                                <th>Diagnosis:</th>
                                <td rowspan="2">
                                    <div id="vdiagnosis"></div>
                                </td>

                            </tr>
                            <tr>
                                <th>&nbsp;</th>


                            </tr>
                            <tr>
                                <th>Added By:</th>

                                <td>
                                    <div id="vusername"></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Created At:</th>

                                <td>
                                    <div id="vinsdate"></div>
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td style="width:30%">
                                    <div id="vstatus"></div>
                                </td>

                            </tr>

                        </table>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-success"> EDIT</button> -->
                    </div>
                </div>
        </div>
        </form>

    </div>

</div>
<div class="modal fade" id="add_fault" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Fault Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('save-fault') ?>" id="frmFault" method="Post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fault">Fault Type</label>
                        <input type="text" class="form-control" id="fault" required id="fault" name="fault">
                        <span id="error_fault" class=" text-danger ms-3"></span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="text" class="form-control" id="desc" name="desc">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveFault" class="btn btn-success">Save</button>
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
            <h6 class="m-0 font-weight-bold text-dark">Returns Profile
            
                <button type="button" class="btn btn-outline-success" href="<?= base_url("modal") ?>" data-toggle="modal" data-target="#add_fault">
                    Add Fault Type
                </button>
            
                <button type="button" class="btn btn-outline-success float-right href="<?= base_url("modal") ?>" data-toggle="modal" data-target="#addReturn">
                    Add Return
                </button>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="returnsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>REGNO</th>
                            <th>DEVICE TYPE</th>
                            <th>SERIAL</th>
                            <th>FAULT</th>
                            <th>COMPANY</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>





</div>
<?= $this->endSection() ?>