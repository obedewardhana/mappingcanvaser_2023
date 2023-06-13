<div class="page-header">
    <h1>Data</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="data" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= _get('q') ?>" />
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=data_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <!-- <th>Kode</th> -->
                <!-- <th>Nama jenis</th> -->
                <th>Pendidikan</th>
                <th>Kesehatan</th>
                <th>Daya Beli</th>
                <th>IPM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field(_get('q'));
        $pg = new Paging();
        $limit = 25;
        $offset = $pg->get_offset($limit, _get('page'));

        $where = "WHERE p.kode_jenis LIKE '%$q%' OR p.nama_jenis LIKE '%$q%'";
        $from = "FROM tb_data d INNER JOIN tb_jenis p ON p.kode_jenis=d.kode_jenis";

        $rows = $db->get_results("SELECT * $from $where ORDER BY tanggal, p.kode_jenis LIMIT $offset, $limit");
        $jumrec = $db->get_var("SELECT COUNT(*) $from $where");
        $no = $offset;

        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->tanggal ?></td>
                <!-- <td><?= $row->kode_jenis ?></td> -->
                <!-- <td><?= $row->nama_jenis ?></td> -->
                <td><?= $row->pendidikan ?></td>
                <td><?= $row->kesehatan ?></td>
                <td><?= $row->dayabeli ?></td>
                <td><?= $row->jumlah ?></td>
                <td>
                    <a class="btn btn-xs btn-warning" href="?m=data_ubah&ID=<?= $row->id_data ?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=data_hapus&ID=<?= $row->id_data ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <div class="panel-footer">
        <ul class="pagination"><?= $pg->show("m=data&q=$q&page=", $jumrec, $limit, _get('page')) ?></ul>
    </div>
</div>