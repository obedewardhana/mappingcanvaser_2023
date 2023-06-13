<div class="page-header">
    <h1>Import Data</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data">
            <?php
            if ($_POST) {

                $row = 0;
                move_uploaded_file($_FILES['data']['tmp_name'], 'import/' . $_FILES['data']['name']) or die('Upload gagal');

                $arr = array();

                if (($handle = fopen('import/' . $_FILES['data']['name'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);

                        if ($row > 0) {
                            for ($c = 1; $c < $num; $c++) {
                                $arr[$row][$c] = $data[$c];
                            }
                        }
                        $row++;
                    }
                    fclose($handle);
                }
                $tb_data = array();
                foreach ($arr as $key => $val) {
                    $date = date_create($val[1], timezone_open("Europe/Oslo"));
                    $tb_data[] = array(
                        'tanggal' => date_format($date, "Y-m-d"),
                        'kode_jenis' => $val[2],
                        'jumlah' => $val[3],
                    );
                }
                if (_post('truncate'))
                    $db->query("TRUNCATE tb_data");
                $db->multi_query('tb_data', $tb_data);
                print_msg('Data berhasil diimport!', 'success');
            }
            ?>
            <div class="form-group">
                <label>Pilih file</label>
                <input class="form-control" type="file" name="data" />
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="truncate" value="1"> Hapus Data Sebelumnya
                </label>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="import"><span class="glyphicon glyphicon-import"></span> Import</button>
                <a class="btn btn-danger" href="?m=data"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>