<?php
$_POST = $_SESSION['post'];
$n_periode = $_POST['n_periode'];
$alpha = $_POST['alpha'];
$beta = $_POST['beta'];
$rows = $db->get_results("SELECT * FROM tb_data ORDER BY tanggal");
$data = array();
foreach ($rows as $row) {
    $data[$row->tanggal] = $row->jumlah * 1;
    $last_periode = $row->tanggal;
}

$f = new DESHolt($data, $alpha, $beta, $n_periode);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Perhitungan</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-right">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>Actual (Yt)</th>
                    <th>Lt</th>
                    <th>Tt</th>
                    <th>Ft</th>
                    <th>e</th>
                    <th>|e|</th>
                    <th>e<sup>2</sup></th>
                    <th>[e]/yt</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            foreach ($f->yt as $key => $val) :
                $categories[$key] = date('M Y', strtotime($key)); ?>
                <tr>
                    <td><?= date('M Y', strtotime($key)) ?></td>
                    <td><?= round($val, 4) ?></td>
                    <td><?= isset($f->lt[$key]) ? round($f->lt[$key], 4) : '' ?></td>
                    <td><?= isset($f->tt[$key]) ? round($f->tt[$key], 4) : '' ?></td>
                    <td><?= isset($f->ft[$key]) ? round($f->ft[$key], 4) : '' ?></td>
                    <td><?= isset($f->e[$key]) ? round($f->e[$key], 4) : '' ?></td>
                    <td><?= isset($f->e_abs[$key]) ?  round($f->e_abs[$key], 4) : '' ?></td>
                    <td><?= isset($f->e2[$key]) ?  round($f->e2[$key], 4) : '' ?></td>
                    <td><?= isset($f->e_abs_yt[$key]) ? round($f->e_abs_yt[$key], 4)  : '' ?></td>
                </tr>
            <?php $no++;
            endforeach;
            reset($f->ft);
            $series = array();
            $series[0]['name'] = 'Aktual';
            foreach ($f->yt as $key => $val) {
                $series[0]['data'][$key] = $val * 1;
                $series[1]['data'][$key] = null;
            }


            $series[1]['name'] = 'Forecast';
            foreach ($f->ft as $key => $val) {
                $series[1]['data'][$key] = round($val * 1, 4);
            }
            ?>
        </table>
    </div>
    <div class="panel-body">

        MAPE (Mean Absolute Percent Error) : <?= number_format(array_sum($f->e_abs_yt) / count($f->e_abs_yt) * 100, 2) ?>%<br />
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Periode</th>
                    <th>Ft</th>
                </tr>
            </thead>
            <?php
            $next_periode = $last_periode;
            foreach ($f->ft_next as $key => $val) :
                $next_periode = date('Y-m-d', strtotime($next_periode . " 1 months"));
                $series[0]['data'][$next_periode] = null;
                $series[1]['data'][$next_periode] = round($val, 4);
                $categories[$next_periode] = date('M Y', strtotime($next_periode)) ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= date('M Y', strtotime($next_periode)) ?></td>
                    <td><?= number_format($val, 2) ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <?php
    $series[0]['data'] = array_values($series[0]['data']);
    $series[1]['data'] = array_values($series[1]['data']);
    ?>
    <div class="panel-footer">
        <div id="container" style="height: 500px; min-width: 500px"></div>
        <script type="text/javascript">
            Highcharts.chart('container', {
                title: {
                    text: 'Grafik Perbandingan Aktual dan Forecasting'
                },

                // subtitle: {
                //     text: 'Source: thesolarfoundation.com'
                // },

                yAxis: {
                    title: {
                        text: 'Jumlah'
                    }
                },
                xAxis: {
                    categories: <?= json_encode(array_values($categories)) ?>
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                series: <?= json_encode($series) ?>,

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
        </script>
    </div>
</div>
<?=sleep(2)?>