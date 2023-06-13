<?php include 'functions.php'; ?>
<!doctype html>
<html>

<head>
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 13px;
        }

        h1 {
            font-size: 14px;
            border-bottom: 4px double #000;
            padding: 3px 0;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 3px;
        }

        .wrapper {
            margin: 0 auto;
            width: 980px;
        }
    </style>
    <script src="assets/js/highcharts.js"></script>
    <script src="assets/js/modules/exporting.js"></script>
    <script src="assets/js/modules/export-data.js"></script>
    <script src="assets/js/modules/accessibility.js"></script>
</head>

<body onload="window.print()">
    <div class="wrapper">
        <?php

        if (is_file($mod . '_cetak.php'))
            include $mod . '_cetak.php';
        ?>
    </div>
</body>

</html>