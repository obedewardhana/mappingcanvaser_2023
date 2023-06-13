<div class="page-header">
    <h1>Data Pengguna</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="data" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= _get('q') ?>" />
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=tambahPengguna"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <?php
        $q = esc_field(_get('q'));
        $pg = new Paging();
        $limit = 25;
        $offset = $pg->get_offset($limit, _get('page'));

        $rows = $db->get_results("SELECT * from user");
        $jumrec = $db->get_var("SELECT COUNT(*) from user");
        $no = $offset;

        foreach ($rows as $row) : ?>
            <tr>
                <td><?= ++$no ?></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->username ?></td>
                <td><?= $row->password ?></td>
                <td>
                    <a class="btn btn-xs btn-warning" href="?m=ubahPengguna&ID=<?= $row->id ?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=hapusPengguna&ID=<?= $row->id ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
    <div class="panel-footer">
        <ul class="pagination"><?= $pg->show("m=data&q=$q&page=", $jumrec, $limit, _get('page')) ?></ul>
    </div>
</div>