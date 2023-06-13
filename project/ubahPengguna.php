<div class="page-header">
    <h1>Edit Pengguna</h1>
</div>
<?php
$row = $db->get_row("SELECT * FROM user WHERE id='$_GET[ID]'");
?>
<?php if ($_POST) include 'aksi.php' ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Pengaturan</h3>
    </div>
    <div class="panel-body">
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" value="<?= $row->nama ?>" />
                    </div>
                    <div class="form-group">
                        <label>Username Baru<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username baru" value="<?= $row->username ?>" />
                    </div>
                    <div class="form-group">
                        <label>Password Baru <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="password baru" value="<?= $row->password ?>" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"> <span class="glyphicon glyphicon-print"></span> Simpan</button>
                        <a class="btn btn-danger" href="?m=lihatPengguna"><span class="glyphicon glyphicon-arrow-left"></span> BATAL</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
