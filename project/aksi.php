<?php
require_once 'functions.php';

/** LOGIN */
if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM user WHERE username='$user' AND password='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->username;
        $_SESSION['nama'] = $row->nama;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:index.php?m=login");
} else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
}

/** jenis */
elseif ($mod == 'jenis_tambah') {
    $kode_jenis = $_POST['kode_jenis'];
    $nama_jenis = $_POST['nama_jenis'];
    if ($kode_jenis == '' || $nama_jenis == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_jenis WHERE kode_jenis='$kode_jenis'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_jenis (kode_jenis, nama_jenis) VALUES ('$kode_jenis', '$nama_jenis')");
        redirect_js("index.php?m=jenis");
    }
} else if ($mod == 'jenis_ubah') {
    $nama_jenis = $_POST['nama_jenis'];

    if ($nama_jenis == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_jenis SET nama_jenis='$nama_jenis' WHERE kode_jenis='$_GET[ID]'");
        redirect_js("index.php?m=jenis");
    }
} else if ($act == 'jenis_hapus') {
    $db->query("DELETE FROM tb_data WHERE kode_jenis='$_GET[ID]'");
    $db->query("DELETE FROM tb_jenis WHERE kode_jenis='$_GET[ID]'");
    header("location:index.php?m=jenis");
}

/** data */
elseif ($mod == 'data_tambah') {
    $tanggal = $_POST['tanggal'];
    $kode_jenis = 'J02';
    $pendidikan = $_POST['pendidikan'];
    $kesehatan = $_POST['kesehatan'];
    $dayabeli = $_POST['dayabeli'];
    $jumlah = ($pendidikan*$kesehatan*$dayabeli)**(1/3);
    if ($tanggal == '' || $kode_jenis == '' || $jumlah == '' || $pendidikan=='' || $kesehatan=='' || $dayabeli=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
        // print_msg("Berhasil kesehatan='$kesehatan', pendidikan='$pendidikan', dayabeli='$dayabeli'");
    else {
        $db->query("INSERT INTO tb_data (tanggal, kode_jenis, jumlah, pendidikan, kesehatan, dayabeli) VALUES ('$tanggal', '$kode_jenis', '$jumlah', '$pendidikan', '$kesehatan', '$dayabeli')");
        redirect_js("index.php?m=data");
    }
} else if ($mod == 'data_ubah') {
    $tanggal = $_POST['tanggal'];
    $kode_jenis = 'J02';
    $pendidikan = $_POST['pendidikan'];
    $kesehatan = $_POST['kesehatan'];
    $dayabeli = $_POST['dayabeli'];
    $jumlah = ($pendidikan*$kesehatan*$dayabeli)**(1/3);
    if ($tanggal == '' || $kode_jenis == '' || $jumlah == '' || $pendidikan=='' || $kesehatan=='' || $dayabeli=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_data SET tanggal='$tanggal', kode_jenis='$kode_jenis', jumlah='$jumlah', pendidikan='$pendidikan', kesehatan='$kesehatan', dayabeli='$dayabeli' WHERE id_data='$_GET[ID]'");
        redirect_js("index.php?m=data");
    }
}else if ($mod == 'tambahPengguna') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($nama == '' || $username == '' || $password == '')
    print_msg("Field tidak boleh kosong!");
    // print_msg("Berhasil kesehatan='$kesehatan', pendidikan='$pendidikan', dayabeli='$dayabeli'");
    else {
        $db->query("INSERT INTO user (nama, username, password) VALUES ('$nama', '$username', '$password')");
        redirect_js("index.php?m=lihatPengguna");
    }
} else if ($mod == 'ubahPengguna') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($nama == '' || $username == '' || $password == '')
        print_msg("Field tidak boleh kosong!");
    else {
        $db->query("UPDATE user SET nama='$nama', username='$username', password='$password' WHERE id='$_GET[ID]'");
        redirect_js("index.php?m=lihatPengguna");
    }
} else if ($act == 'hapusPengguna') {
    $db->query("DELETE FROM user WHERE id='$_GET[ID]'");
    header("location:index.php?m=lihatPengguna");
} else if ($act == 'data_hapus') {
    $id_data = $_GET['ID'];
    $db->query("DELETE FROM tb_data WHERE id_data='$id_data'");
    header("location:index.php?m=data");
}
