<?php

use Config\Services;

?>

<?= $this->extend('admin_template/index') ?>
<!-- Begin Page Content -->

<?= $this->section('content') ?>

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
            </div>


        </div>



    </div>

</div>
<div class="container-fluid">
    <!-- DataTables Example -->
  
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">REMOVALS
               
                <a href="<?php echo base_url('') ?>" class="btn btn-outline-success float-right"><i class="fas fa-file-excel"></i>
                    Export</a>

            </h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- CSRF token -->
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <table class="table table-bordered" id="removalsTable">
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