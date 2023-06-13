<div class="page-header">
    <h1>Perhitungan Double Exponential Smoothing</h1>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Pengaturan</h3>
    </div>
    <div class="panel-body">
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis <span class="text-danger">*</span></label>
                        <select class="form-control" name="kode_jenis">
                            <?= get_jenis_option(set_value('kode_jenis')) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Periode <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="n_periode" value="<?= set_value('n_periode', 3) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nilai Alpha <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="alpha" value="<?= set_value('alpha', 0.3) ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nilai Beta <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="beta" value="<?= set_value('beta', 0.2) ?>" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"> <span class="glyphicon glyphicon-print"></span> Hitung</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if ($_POST) {
    $n_periode = $_POST['n_periode'];
    $alpha = $_POST['alpha'];
    $beta = $_POST['beta'];
    if ($n_periode == '' || $alpha == '' || $beta == '') {
        print_msg('Field bertanda * tidak boleh kosong!');
    } else {
        include 'des_hasil.php';
    }
}

?>