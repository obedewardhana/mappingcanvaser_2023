<?php
$row = $db->get_row("SELECT * FROM tb_data WHERE id_data='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Data</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="POST">
            <div class="form-group">
                <label>Tanggal <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal', $row->tanggal) ?>" />
            </div>
            <div class="form-group">
                <label>Indeks Kesehatan <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kesehatan" value="<?= set_value('kesehatan') ?>" />
            </div>
            <div class="form-group">
                <label>Indeks Pendidikan <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="pendidikan" value="<?= set_value('pendidikan') ?>" />
            </div>
            <div class="form-group">
                <label>Indeks Daya Beli <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="dayabeli" value="<?= set_value('dayabeli') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=data"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>