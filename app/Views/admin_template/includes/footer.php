<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Richdevs <?php date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- End of Content Wrapper -->
</div>
<div id="spinner-div" class="hidden">
    <div class="d-flex justify-content-center align-items-center position-fixed " style="background-color:black;top: 0px;left: 0px;z-index: 9999;width: 100%;height: 100%;opacity: .85">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.editUser', function() {
        var row = $(this).closest('tr');
        var id = row.find("td:eq(0)").html();
        $.ajax({
            type: 'Get',
            url: '<?= base_url('user/edit/') ?>' + '/' + id,
            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {
                $('spinner-div').attr('hidden');
                $('#userid').val(data.userid);
                $('#username').val(data.userName);
                $('#Email').val(data.email);
                $('#location').val(data.slocation);
                $('#designtion').val(data.designation);
                $('#password').val(data.pwd);
            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            },
        });
    });



    $(document).ready(function() {
        $(document).on('click', '.changeClient', function() {
            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();

            $.ajax({
                type: 'Get',
                url: '<?= base_url('units/edit/') ?>' + '/' + id,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    $('#idins').val(data[0].idinstallation)
                    $('#regnum').val(data[0].regno);
                    $('#serial').val(data[0].device_serial);
                    $('#client').val(data[0].idclient);
                    $('#unitSubscr').val(data[0].subscription);
                    $('#change_type').val("CLIENT-CHANGE");
                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },
            });

        });

    });

    function savefault() {

        if ($.trim($('#fault').val()).length == 0) {
            error_fault = 'Fault required';
            $('#error_fault').text(error_fault);
        } else {
            error_fault = '';
            $('#error_fault').text(error_fault);
        }
        if (error_fault != '') {
            return false;
        } else {

            $.ajax({
                type: 'post',
                url: '<?= base_url('save-fault') ?>',
                data: $('#frmFault').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },

                success: function(data) {
                    $('#add_fault').modal('hide');
                    $('#add_fault').find('input').val('');


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.status,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                }
            });

        }

    }


    $(document).ready(function() {
        $(document).on('click', '.viewReturn', function() {
            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();

            $.ajax({
                type: 'Get',
                url: '<?= base_url('return/view') ?>' + '/' + id,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    $('#eidins').val(data.id)
                    $('#vserial').html(data.device_serial);
                    $("#vregno").html(data.regno);
                    $('#imgeResult').attr('src', '<?= base_url() . '/public/uploads' ?>' + '/' + data.image);
                    $('#imagename').html(data.image);
                    $('#vfault').html(data.fault_type);
                    $('#vdiagnosis').html(data.diagnosis);
                    $('#vusername').html(data.username);
                    $('#vinsdate').html(data.created_at);
                    $('#vstatus').html(data.status);

                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },
            });

        });

    });
    $(document).ready(function() {
        $(document).on('click', '.editReturn', function() {
            var id = $(this).closest('tr').find('.sorting_1').text();

            $.ajax({
                type: 'Get',
                url: '<?= base_url('return/view/') ?>' + '/' + id,

                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    $('#idins').val(data.id);
                    $('#imageResult').attr('src', '<?= base_url() . '/public/uploads' ?>' + '/' + data.image);
                    $('#efault option:selected').text(data.fault_type);
                    $('.upload').html(data.image);
                    $('#diag').val(data.diagnosis);
                    $('#devserial').val(data.device_serial);
                    $('#estatus').val(data.status);

                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },
            });


        })

    })

    $(document).ready(function() {
        $(document).on('click', '.changeUnit', function() {
            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();

            $.ajax({
                type: 'Get',
                url: '<?= base_url('units/edit/') ?>' + '/' + id,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    $('#idinst').val(data[0].idinstallation)
                    $('#sregno').val(data[0].regno);
                    $('#unitype').val(data[0].device_type);
                    $('#devserial').val(data[0].device_serial);
                    $('#Subscr').val(data[0].subscription);
                    $('#changetype').val("UNIT-CHANGE");
                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },
            });

        });

    });
    $(document).ready(function() {
        $(document).on('click', '.upgrade', function() {
            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();

            $.ajax({
                type: 'Get',
                url: '<?= base_url('units/edit/') ?>' + '/' + id,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    $('#idinstallation').val(data[0].idinstallation)
                    $('#sRegno').val(data[0].regno);
                    $('#sdtype').val(data[0].device_type);
                    $('#dev_serial').val(data[0].device_serial);
                    $('#sSubscr').val(data[0].subscription);
                    $('#changeType').val("UPGRADE");
                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },
            });

        });

    });
    $(document).ready(function() {
        $(document).on('click', '.downgrade', function() {
            var id = $(this).closest('tr').find('.sorting_1').text();
            $.ajax({
                type: 'Get',
                url: '<?= base_url('units/edit/') ?>' + '/' + id,
                success: function(data) {
                    $('#idinstallation').val(data[0].idinstallation)
                    $('#sRegno').val(data[0].regno);
                    $('#sdtype').val(data[0].device_type);
                    $('#dev_serial').val(data[0].device_serial);
                    $('#sSubscr').val(data[0].subscription);
                    $('#changeType').val("DOWNGRADE");
                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },
            });


        });

    });


    $(document).ready(function() {
        unitsTable();
        $('#clientTable').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": "<?= base_url('clientTbl'); ?>",

        });
        $(document).on('click', '.view_Unit', function() {
            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();


            $.ajax({
                type: 'Get',

                url: '<?= base_url('units/view/') ?>' + '/' + id,
                data: {
                    'id': id
                },
                dataType: 'json',

                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {

                    $('spinner-div').attr('hidden');
                    $('#vid').val(data[0].idinstallation);
                    $('#vregno').html(data[0].regno);
                    $('#vmake').html(data[0].make);
                    $('#vcolor').html(data[0].color);
                    $('#vimage').html('');
                    $('#vimage').attr('src', '<?= base_url() . '/public/uploads' ?>' + '/' + data[0].image);
                    $('#vclientname').html(data[0].clientname);
                    $('#vwarranty').html(data[0].warranty);
                    $('#vserial').html(data[0].device_serial);
                    $('#vdevicetype').html(data[0].device_type);
                    $('#vcreatedat').html(data[0].createdat);
                    $('#vsubscription').html(data[0].subscription);
                    $('#vsimcard').html(data[0].simcard);
                    $('#vusername').html(data[0].username);
                    $('#vInstaller').html(data[0].installer);
                    //console.log(data)


                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },

            });
        });

    })
    $(document).on('click', '#rm_image', function() {
        var image = $('#eidins').val();

        $.ajax({
            type: 'get',
            // async:true,
            url: '<?= base_url('removeImage') ?>' + '/' + image,
            dataType: 'json',
            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: data.status,
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            }
        });

    });



    function unitUpdate() {
        var id = document.getElementById('vid').value;
        $.ajax({
            type: 'Get',
            async: true,
            url: '<?= base_url('units/edit') ?>' + '/' + id,
            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {
                $('#unitid').val(data[0].idinstallation);
                $('#eregno').val(data[0].regno);
                $('#edevice_type').val(data[0].device_type);
                $('#edevice_serial').val(data[0].device_serial);
                $('.upload').html(data[0].image);
                $('#esimcard').val(data[0].simcard);
                $('#emake').val(data[0].make);
                $('#ecolor').val(data[0].color);
                $('#imageResult').attr('src', '<?= base_url() . '/public/uploads' ?>' + '/' + data[0].image);
                $('#eidclient').children('option:first').val(data[0].client).text(data[0].client);
                $('#esubscription').val(data[0].subscription);
                $('#einsdate').val(data[0].created_at);
                $('#einstaller').children('option:first').val(data[0].installer).text(data[0].installer);
                $("[name=warranty]").val([data[0].warranty])
                $('#editUnit').modal('show');
                $('#viewUnit').modal('hide');
            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            },

        });
    }
    //  Ajax code for Viewing client
    $(document).ready(function() {
        $(document).on('click', '.viewClient', function() {

            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();

            $.ajax({
                type: 'Get',
                url: '<?= base_url('client/edit') ?>' + '/' + id,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    $('#vid').html(data.idclient);
                    $('#vname').html(data.clientname);
                    $('#vcontact').html(data.contactperson);
                    $('#vphone').html(data.phone);
                    $('#vemail').html(data.email);
                    $('#vcreatedat').html(data.created_at);

                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },

            });

        });
    });
    $(document).ready(function() {
        $(document).on('click', '.viewChanges', function() {


            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();

            $.ajax({
                type: 'Get',
                url: '<?= base_url('changes/view') ?>' + '/' + id,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    var dta = data[0].change_type;

                    if (dta == "SUBSCRIPTION CHANGE") {
                        $('#lblFrom').html('PREVIOUS SUBSCRIPTION');
                        $('#lblTo').html('NEW SUBSCRIPTION');
                    } else if (dta == "UNIT-CHANGE") {
                        $('#lblFrom').html('PREVIOUS UNIT');
                        $('#lblTo').html('NEW UNIT');
                    } else if (dta == "REGISTRATION CHANGE") {
                        $('#lblFrom').html('PREVIOUS REGISTRATION');
                        $('#lblTo').html('NEW REGISTRATION');
                    } else {
                        $('#lblFrom').html('PREVIOUS CLIENT');
                        $('#lblTo').html('NEW CLIENT');
                    }

                    $('#tregno').html(data[0].regno);
                    $('#tunit').html(data[0].device_type);
                    $('#tserial').html(data[0].device_serial);
                    $('#changeFrom').html(data[0].change_from);
                    $('#changeTo').html(data[0].change_to);
                    $('#tCreatedAt').html(data[0].created_at);

                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },

            });

        });
    });

    $(document).ready(function() {
        $(document).on('click', '.viewCheckup', function() {
            var row = $(this).closest('tr');
            var id = row.find("td:eq(0)").html();
            $.ajax({
                type: 'Get',
                url: '<?= base_url('checkups/edit') ?>' + '/' + id,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },
                success: function(data) {
                    $('#refno').val(data[0].refno);
                    $('#eregno').val(data[0].idinstallation);
                    $('#eissue').val(data[0].issue);
                    $('#efindings').val(data[0].findings);


                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                },

            });

        });
    });
    $(document).ready(function() {
        $(document).on('click', '.delCheckup', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var row = $(this).closest('tr');
                    var id = row.find("td:eq(0)").html();
                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('checkups/delete') ?>' + '/' + id,
                        beforeSend: function() {
                            $('#spinner-div').removeClass("hidden");
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'Success',
                                title: 'Success',
                                text: 'Check up deleted'
                            })

                        },
                        complete: function() {
                            $('#spinner-div').addClass('hidden')
                            $(document).ajaxStop(function() {
                                window.location.reload();
                            });
                        },

                    })
                }



            })
        });

    });

    $(document).ready(function() {
        $(document).on('click', '.deleteUnit', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var row = $(this).closest('tr');
                    var id = row.find("td:eq(0)").html();
                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('units/delete') ?>' + '/' + id,
                        beforeSend: function() {
                            $('#spinner-div').removeClass("hidden");
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'Success',
                                title: 'Success',
                                text: 'Unit Removed'
                            })

                        },
                        complete: function() {
                            $('#spinner-div').addClass('hidden')
                            $(document).ajaxStop(function() {
                                window.location.reload();
                            });
                        },

                    })
                }



            })
        });

    });

    $(document).ready(function() {
        $(document).on('click', '.delacc', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var row = $(this).closest('tr');
                    var id = row.find("td:eq(0)").html();

                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('accessory/delete') ?>' + '/' + id,
                        beforeSend: function() {
                            $('#spinner-div').removeClass("hidden");
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'Success',
                                title: 'Success',
                                text: 'Accessory deleted'
                            })

                        },
                        complete: function() {
                            $('#spinner-div').addClass('hidden')
                            $(document).ajaxStop(function() {
                                window.location.reload();
                            });
                        },

                    })
                }



            })
        });

    });
    $(document).ready(function() {
        $(document).on('click', '.delReturn', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var row = $(this).closest('tr');
                    var id = row.find("td:eq(0)").html();

                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('returns/delete') ?>' + '/' + id,
                        beforeSend: function() {
                            $('#spinner-div').removeClass("hidden");
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'Success',
                                title: 'Success',
                                text: 'Return Removed'
                            })

                        },
                        complete: function() {
                            $('#spinner-div').addClass('hidden')
                            $(document).ajaxStop(function() {
                                window.location.reload();
                            });
                        },

                    })
                }



            })
        });

    });
    $(document).ready(function() {
        $(document).on('click', '.delUser', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Remove User!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var row = $(this).closest('tr');
                    var id = row.find("td:eq(0)").html();

                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('user/delete') ?>' + '/' + id,
                        beforeSend: function() {
                            $('#spinner-div').removeClass("hidden");
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'Success',
                                title: 'Success',
                                text: 'User Removed'
                            })

                        },
                        complete: function() {
                            $('#spinner-div').addClass('hidden')
                            $(document).ajaxStop(function() {
                                window.location.reload();
                            });
                        },

                    })
                }



            })
        });

    });


    function loadClient() {
        //  
        var idclient = document.getElementById('vid').innerHTML;

        $.ajax({
            type: 'Get',

            url: '<?= base_url('client/edit') ?>' + '/' + idclient,
            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {
                $('#id').val(data.idclient);
                $('#cname').val(data.clientname);
                $('#contact').val(data.contactperson);
                $('#cphone').val(data.phone);
                $('#cemail').val(data.email);
                $('#createdat').val(data.created_at);
                $('#editClient').modal('show');
                $('#viewClient').modal('hide');

            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            },
        });
    }

    function unitsTable() {
        $('#unitTable').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": "<?= base_url('units/load'); ?>",





        });

    };
    $(document).ready(function() {
        $('#userTable').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": "<?= base_url('user/userTbl'); ?>"


        });

    });
    $(document).ready(function() {
        $('#transferTable').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": "<?= base_url('transfer/transferTbl'); ?>",


        });

    });
    $('#accTable').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": "<?= base_url('accessory/load'); ?>",

    });
    $('#accviewTable').DataTable({
        "processing": true,
        "serverSide": true,

        // "ajax": "<?= base_url('accview/load'); ?>",

    });
    $('#checkupsTable').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": "<?= base_url('checkups/load'); ?>",

    });
    $('#archiveTable').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": "<?= base_url('archive/load'); ?>",

    });
    $('#accessoryViewTable').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": "<?= base_url('accss/load'); ?>",

    });

    $('#frmFault').submit(function(e) {

        e.preventDefault();
        if ($.trim($('#fault').val()).length == 0) {
            error_fault = 'Fault required';
            $('#error_fault').text(error_fault);
        } else {
            error_fault = '';
            $('#error_fault').text(error_fault);
        }
        if (error_fault != '') {
            return false;
        } else {
            var form = this;
            $.ajax({
                method: $(form).attr('method'),
                url: $(form).attr('action'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('#spinner-div').removeClass("hidden");
                },

                success: function(data) {
                    $('#add_fault').modal('hide');
                    $('#add_fault').find('input').val('');


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.status,
                        showConfirmButton: false,
                        timer: 3000
                    });
                },
                complete: function() {
                    $('#spinner-div').addClass('hidden')
                }
            });

        }

    });
    $('#returnsTable').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": "<?= base_url('loadTbl'); ?>",

    });

    function previewFile(input) {
        var file = $('#img_upload').get(0).files[0];
        var filename = $('#img_upload')[0].files[0].name;

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $("#imageResult").attr("src", reader.result);
            }
            $('#upload-label').text(filename);

            reader.readAsDataURL(file);
        }
    }

    function previewFile2(input) {
        var file = $('#imgUpload').get(0).files[0];
        var file_name = $('#imgUpload')[0].files[0].name;

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $(".imageresult").attr("src", reader.result);
            }
            $('#upload-label2').text(file_name);
            reader.readAsDataURL(file);
        }
    }

    $(document).on('click', '.v_Unit', function() {
        var row = $(this).closest('tr');
        var id = row.find("td:eq(0)").html();
        $.ajax({
            type: 'Get',

            url: '<?= base_url('archive/view/') ?>' + '/' + id,
            data: {
                'id': id
            },
            dataType: 'json',

            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {

                $('spinner-div').attr('hidden');
                $('#vid').val(data[0].idinstallation);
                $('#vregno').html(data[0].regno);
                $('#vmake').html(data[0].make);
                $('#vcolor').html(data[0].color);
                $('#vimage').html('');
                $('#vimage').attr('src', '<?= base_url() . '/public/uploads' ?>' + '/' + data[0].image);
                $('#vclientname').html(data[0].clientname);
                $('#vwarranty').html(data[0].warranty);
                $('#vserial').html(data[0].device_serial);
                $('#vdevicetype').html(data[0].device_type);
                $('#vcreatedat').html(data[0].createdat);
                $('#vsubscription').html(data[0].subscription);
                $('#vsimcard').html(data[0].simcard);
                $('#vusername').html(data[0].username);
                $('#vInstaller').html(data[0].installer);
                //console.log(data)


            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            },

        });
    });
    $(document).on('click', '.view_Unit', function() {
        var row = $(this).closest('tr');
        var id = row.find("td:eq(0)").html();


        $.ajax({
            type: 'Get',

            url: '<?= base_url('removals/view/') ?>' + '/' + id,
            data: {
                'id': id
            },
            dataType: 'json',

            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {

                $('spinner-div').attr('hidden');
                $('#vid').val(data[0].idinstallation);
                $('#vregno').html(data[0].regno);
                $('#vmake').html(data[0].make);
                $('#vcolor').html(data[0].color);
                $('#vimage').html('');
                $('#vimage').attr('src', '<?= base_url() . '/public/uploads' ?>' + '/' + data[0].image);
                $('#vclientname').html(data[0].clientname);
                $('#vwarranty').html(data[0].warranty);
                $('#vserial').html(data[0].device_serial);
                $('#vdevicetype').html(data[0].device_type);
                $('#vcreatedat').html(data[0].createdat);
                $('#vsubscription').html(data[0].subscription);
                $('#vsimcard').html(data[0].simcard);
                $('#vusername').html(data[0].username);
                $('#vInstaller').html(data[0].installer);
                //console.log(data)


            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            },

        });
    });

    $(document).ready(function() {
        $(document).on('click', '.restoreUnit', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var row = $(this).closest('tr');
                    var id = row.find("td:eq(0)").html();
                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('removals/restore') ?>' + '/' + id,
                        beforeSend: function() {
                            $('#spinner-div').removeClass("hidden");
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'Success',
                                title: 'Success',
                                text: 'Unit Restored'
                            })

                        },
                        complete: function() {
                            $('#spinner-div').addClass('hidden')
                            $(document).ajaxStop(function() {
                                window.location.reload();
                            });
                        },

                    })
                }



            })
        });

    });
    $('#removalsTable').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": "<?= base_url('removals/load'); ?>",

    });
    $('#armingsTable').DataTable({
        "processing": true,
        "serverSide": true,

        "ajax": "<?= base_url('armings/load'); ?>",

    });
    $(function() {

        var start = moment().subtract(1, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format("YYYY-MM-DD") + ' - ' + end.format("YYYY-MM-DD"));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });

    $('#reportrange').click(function() {
        //var range = $('#reportrange').daterangepicker.getRange();
    var strt= $('#reportrange').value();
        $('#datefrom').val(strt);
        $('#dateto').val(endd);
        alert(strt)
    })
    




    $(document).on('click', '.editAccessory', function() {
        var row = $(this).closest('tr');
        var id = row.find("td:eq(0)").html();
        $.ajax({
            type: 'Get',
            url: '<?= base_url('accss/edit') ?>' + '/' + id,
            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {
                $('spinner-div').attr('hidden');
                $('#idinst').val(data[0].idInstallation);
                $('#refno').val(data[0].refno);
                $('#eavl').val(data[0].avl);
                $("input[name=converter][value=" + data[0].converter + "]").prop('checked', true);
                $('#eprobe').val(data[0].probe);
                $('#e_can').val(data[0].ecan);
                $("input[name=immobilizer][value=" + data[0].immobilizer + "]").prop('checked', true);
                $('#e_xtra').val(data[0].extra);
                // $('#einstaller').val(data[0].installer);
                $('#einstaller').children('option:first').val(data[0].installer).text(data[0].installer);
                $('#einsdate').val(data[0].created_at);

            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            },
        });
    });
    $(document).on('click', '.viewChk', function() {
        var row = $(this).closest('tr');
        var id = row.find("td:eq(0)").html();
        $.ajax({
            type: 'Get',
            url: '<?= base_url('checkups/edit') ?>' + '/' + id,
            beforeSend: function() {
                $('#spinner-div').removeClass("hidden");
            },
            success: function(data) {
                $('spinner-div').attr('hidden');
                $('#regno').val(data[0].idinstallation);
                $('#refno').val(data[0].refno);
                $('#findings').val(data[0].findings);
                $('#issue').val(data[0].issue);
                $('#solution').val(data[0].solution);
                $('#upload-label2').html(data[0].image);
                $('.imageresult').attr('src', '<?= base_url() . '/public/uploads' ?>' + '/' + data[0].image);
                $('#Installer').children('option:first').val(data[0].Installer).text(data[0].Installer);
                $("input[name=converter][value=" + data[0].converter + "]").prop('checked', true);
                $('#uid').val(data[0].unitid);
                $('#avl').val(data[0].avl);
                $('#remarks').val(data[0].remarks);
                $('#chdate').val(data[0].created_at);

            },
            complete: function() {
                $('#spinner-div').addClass('hidden')
            },
        });
    });
</script>

</body>

</html>