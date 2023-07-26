<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Candidates</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="<?= base_url("dashboard"); ?>">Dashboard</a></li>
                    <li class="active">Candidates</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-success btn-sm btn-show-add" data-toggle="modal" data-target="#compose"><i
                    class="fa fa-plus"></i> Tambah Kandidat</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th style="width:10%">#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Partai</th>
                            <th>Dapil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="previewimg" data-index="">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Preview Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-box text-center">

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="compose" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Tambah Kandidat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="composeForm" autocomplete="chrome-off">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="userfile" accept="photo/webp, photo/jpeg, photo/jpg, photo/png"
                            class="dropify" data-default-file="" value="" />
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" autocomplete="new-name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label>Partai </label>
                        <select name="party" autocomplete="new-party" class="form-control" id="party">
                            <option value="" disabled>-Pilih-</option>
                            <?php foreach ($dataParty as $r) { ?>
                                <option value="<?= $r->id; ?>"><?= $r->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dapil</label>
                        <input type="text" autocomplete="new-dapil" name="location" class="form-control" id="location">
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

<script>
    $(".btn-show-add").on("click", function () {
        jQuery("select[name=party]").val("");
        jQuery("input[name=name]").val("");
        jQuery("input[name=location]").val("");
        jQuery('.dropify-wrapper').find('.img-fit').remove();
        jQuery(".dropify").attr('data-default-file', '');
        jQuery("#compose .modal-title").html("Tambah Kandidat");
        jQuery("#composeForm").attr("action", "<?= base_url("candidates/insert"); ?>");

        jQuery(".dropify-clear").trigger("click");
        jQuery("#composeForm").validate().resetForm();
    });

    $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "autoWidth": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url("Candidates/json"); ?>"
        }
    });

    $("body").on("click", ".btn-previewimg", function () {
        var id = jQuery(this).attr("data-id");
        var photo = jQuery(this).attr("data-photo");
        var url = '<?= base_url(); ?>img/';
        var newurl = url + '' + photo;
        var html = '<img src="' + newurl + '" />';

        if (photo == '') {
            var defaultpic = 'default.png';
            var newurl = url + '' + defaultpic;
            var html = '<img src="' + newurl + '" />';
            jQuery("#previewimg").modal("toggle");
            jQuery('#previewimg').find('.img-box').empty();
            jQuery('#previewimg').find('.img-box').append(html);
        } else {
            jQuery("#previewimg").modal("toggle");
            jQuery('#previewimg').find('.img-box').empty();
            jQuery('#previewimg').find('.img-box').append(html);
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
            userfile: {
                filesize: 1
            },
            party: {
                required: true
            },
            name: {
                required: true
            },
            location: {
                required: true
            }
        },
        messages: {
            userfile: {
                filesize: "Maksimal size gambar 1MB"
            },
            party: {
                required: "*Pilih partai."
            },
            name: {
                required: "*Masukkan nama lengkap."
            },
            location: {
                required: "*Masukkan dapil."
            }
        },
        submitHandler: function (form) {
            var form = new FormData();
            form.append("name", jQuery('input[name=name]').val());
            form.append("location", jQuery('input[name=location]').val());
            form.append("userfile", jQuery('.dropify')[0].files[0]);
            form.append("party", jQuery('select[name=party]').val());
            var action = jQuery("#composeForm").attr("action");
            jQuery('.dropify-wrapper').find('.img-fit').remove();

            console.log(jQuery('.dropify')[0].files[0]);

            jQuery.ajax({
                url: action,
                method: "POST",
                data: form,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) {
                        jQuery("input[name=name]").val("");
                        jQuery("input[name=location]").val("");
                        jQuery("select[name=party]").val("");
                        jQuery("input[name=userfile]").val("");
                        jQuery(".dropify-clear").trigger("click");

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

    $('body').on("click", ".btn-delete", function () {
        var id = jQuery(this).attr("data-id");
        var name = jQuery(this).attr("data-name");
        jQuery("#delete .modal-body").html("Anda yakin ingin menghapus <b>" + name + "</b>");
        jQuery("#delete").modal("toggle");

        jQuery("#delete .btn-del-confirm").attr("onclick", "deleteData(" + id + ")");
    })

    function deleteData(id) {
        jQuery.getJSON("<?= base_url(); ?>candidates/delete/" + id, function (data) {
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

    $("body").on("click", ".btn-edit", function () {
        jQuery(".dropify-clear").trigger("click");
        jQuery('.dropify-wrapper').find('.img-fit').remove();

        var id = jQuery(this).attr("data-id");
        var party = jQuery(this).attr("data-party");
        var name = jQuery(this).attr("data-name");
        var location = jQuery(this).attr("data-location");
        var photo = jQuery(this).attr("data-photo");

        if (photo == '') {
            var url = '<?= base_url(); ?>img/';
            var defaultpic = 'default.png';
            var newurl = url + '' + defaultpic;
            var html = '<img src="' + newurl + '" />';
        } else {
            var url = '<?= base_url(); ?>img/';
            var newurl = url + '' + photo;

            var img = '<img src=' + newurl + '></img>'
        }

        jQuery("#compose .modal-title").html("Edit User");
        jQuery("#composeForm").attr("action", "<?= base_url(); ?>candidates/update/" + id);
        jQuery("input[name=name]").val(name);
        jQuery("input[name=location]").val(location);
        jQuery("select[name=party]").val(party);

        var html = '<img class="img-fit" src="' + newurl + '" />';
        jQuery('.dropify-wrapper').find('.dropify-message').before(html);

        jQuery(".form-group label.error").remove();
        jQuery(".form-group input").removeClass('.error');
        jQuery("#compose").modal("toggle");
    });

    $('.dropify').dropify();
</script>