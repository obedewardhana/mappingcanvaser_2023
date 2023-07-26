<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Role</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Role</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-success btn-sm btn-show-add" data-toggle="modal" data-target="#compose"><i
                    class="fa fa-plus"></i> Tambah Role</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th style="width:10%">#</th>
                            <th style="width:30%">Nama</th>
                            <th style="width:30%">Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="compose" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="composeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="title" autocomplete="off" class="form-control" id="title">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Konfirmasi?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-del-confirm">Hapus</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="privilege" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Tambah Hak akses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="privilegeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Hak Akses</label>
                        <input type="hidden" name="role" />
                        <select name="moduls" autocomplete="new-moduls" class="form-control js-select2-multiple"
                            multiple="multiple" id="moduls">
                            <?php foreach ($dataModul as $m) { ?>
                                <option value="<?= $m->id; ?>"><?= $m->title; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $(document).on('select2:select', '.js-select2-multiple', function (e) {

            var currentchoice = $(this).val();
            var role = $(this).attr('id');
            var roleid = role.replace('moduls-', '');
            var modlen = currentchoice.length;

            var form = new FormData();

            form.append("idr", roleid);

            for (i = 0; i < modlen; i++) {
                form.append("role[]", roleid);
                form.append("moduls[]", currentchoice[i]);
            }
            var action = "<?= base_url(); ?>role/insert_privilege";

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) {
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        ).then((result) => {
                            // jQuery("#data").DataTable().ajax.reload(null, true);
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal',
                            data.msg,
                            'error'
                        )
                    }
                }
            });
        });

        $(document).on('select2:unselect', '.js-select2-multiple', function (e) {

            var currentchoice = $(this).val();
            var role = $(this).attr('id');
            var roleid = role.replace('moduls-', '');
            var modlen = currentchoice.length;

            var form = new FormData();

            form.append("idr", roleid);

            for (i = 0; i < modlen; i++) {
                form.append("role[]", roleid);
                form.append("moduls[]", currentchoice[i]);
            }
            var action = "<?= base_url(); ?>role/insert_privilege";

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) {
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        ).then((result) => {
                            // jQuery("#data").DataTable().ajax.reload(null, true);
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal',
                            data.msg,
                            'error'
                        )
                    }
                }
            });
        });

    });

    $(".btn-show-add").on("click", function () {
        jQuery("input[name=title]").val("");
        jQuery("#compose .modal-title").html("Tambah Role");
        jQuery('#moduls').val(null).trigger('change');
        jQuery("#composeForm").attr("action", "<?= base_url("Role/insert"); ?>");
        jQuery("#composeForm").validate().resetForm();
    });

    $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url("Role/json"); ?>"
        },
        "drawCallback": function () {
            $('.js-select2-multiple').select2();
        }
    });

    $(".no-space").on({
        keydown: function (e) {
            if (e.which === 32)
                return false;
        },
        change: function () {
            this.value = this.value.replace(/\s/g, "");
        }
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1000000)
    }, 'File size must be less than {0} MB');

    $("#composeForm").validate({
        rules: {
            title: {
                required: true
            }
        },
        messages: {
            title: {
                required: "*Masukkan nama."
            }
        },
        submitHandler: function (form) {
            var form = new FormData();

            var title = jQuery('input[name=title]').val();

            form.append("title", jQuery('input[name=title]').val());

            var action = jQuery("#composeForm").attr("action");

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) {
                        jQuery("input[name=title]").val("");
                        jQuery("#compose").modal('toggle');
                        jQuery("#data").DataTable().ajax.reload(null, true);
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Gagal',
                            data.msg,
                            'error'
                        )
                    }
                }
            });
        },
        errorPlacement: function (label, element) {
            label.addClass('error');
            element.after(label);
        }
    });

    $("#privilegeForm").validate({
        rules: {
            moduls: {
                required: true
            }
        },
        messages: {
            moduls: {
                required: "*Pilih Hak akses."
            },
        },
        submitHandler: function (form) {
            var form = new FormData();

            var modlen = jQuery('.select2-selection__rendered li').length;
            var role = jQuery('input[name=role]').val();
            var moduls = jQuery('select[name=moduls]').val();

            for (i = 0; i < modlen; i++) {
                form.append("role[]", role);
                form.append("moduls[]", moduls[i]);
            }
            var action = jQuery("#privilegeForm").attr("action");

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) {
                        jQuery('#moduls').val(null).trigger('change');
                        jQuery("#privilege").modal('toggle');
                        jQuery("#data").DataTable().ajax.reload(null, true);
                        Swal.fire(
                            'Berhasil',
                            data.msg,
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Gagal',
                            data.msg,
                            'error'
                        )
                    }
                }
            });
        },
        errorPlacement: function (label, element) {
            label.addClass('error');
            element.after(label);
        }
    });

    $('#moduls').on('select2:select', function (e) {
        $("#moduls-error").remove();
        var modlen = jQuery('.select2-selection__rendered li').length;
    });

    $('body').on("click", ".btn-delete", function () {
        var id = jQuery(this).attr("data-id");
        var title = jQuery(this).attr("data-title");
        jQuery("#delete .modal-body").html("Anda yakin ingin menghapus data ini?</b>");
        jQuery("#delete").modal("toggle");

        jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
    })

    function deleteData(id) {
        jQuery.getJSON("<?= base_url(); ?>role/delete/" + id, function (data) {
            console.log(data.status);
            if (data.status) {
                jQuery("#delete").modal("toggle");
                jQuery("#data").DataTable().ajax.reload(null, true);
                Swal.fire(
                    'Berhasil',
                    data.msg,
                    'success'
                )
            } else {
                Swal.fire(
                    'Gagal',
                    data.msg,
                    'error'
                )
            }
        })
    }

    function isNumber(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }


    $("body").on("click", ".btn-edit", function () {

        var id = jQuery(this).attr("data-id");
        var title = jQuery(this).attr("data-title");

        jQuery("#compose .modal-title").html("Edit Role");
        jQuery("#composeForm").attr("action", "<?= base_url(); ?>role/update/" + id);
        jQuery("input[name=title]").val(title);

        jQuery(".form-group label.error").remove();
        jQuery(".form-group input").removeClass('.error');
        jQuery("#compose").modal("toggle");
    });

    $("body").on("click", ".btn-privilege", function () {

        $("#moduls-error").remove();

        jQuery('#moduls').val(null).trigger('change');

        var role = jQuery(this).attr("data-id");

        jQuery("#privilege .modal-title").html("Tambah Hak Akses");
        jQuery("#privilegeForm").attr("action", "<?= base_url(); ?>role/insert_privilege");

        jQuery("input[name=role]").val(role);

        jQuery("#privilege").modal("toggle");
    });

</script>