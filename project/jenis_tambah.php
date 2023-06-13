<div class="page-header">
    <h1>Tambah Jenis</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_jenis" value="<?= set_value('kode_jenis', kode_oto('kode_jenis', 'tb_jenis', 'J', 2)) ?>" />
            </div>
            <div class="form-group">
                <label>Nama Jenis <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_jenis" value="<?= set_value('nama_jenis') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=jenis"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>