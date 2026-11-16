<?php

include "../model/m_user.php";

$user = new User();


// =================================
// TAMBAH USER
// =================================

if (isset($_POST['tambah'])) {

    $nama = $_POST['nama'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    // Akun yang dibuat dari halaman ini hanya boleh menjadi Peminjam.
    $role = 'peminjam';


    if (
        $nama === '' ||
        $username === '' ||
        $password === ''
    ) {

        die("Data user belum lengkap.");

    }


    $hasil = $user->tambah(
        $nama,
        $username,
        $password,
        $role
    );


    if ($hasil) {

        header(
            "Location: ../view/v_user.php?pesan=tambah"
        );

        exit;

    } else {

        die(
            "Gagal menambahkan user: "
            . mysqli_error(
                $GLOBALS['koneksi']->koneksi
            )
        );

    }
}


// =================================
// EDIT USER
// =================================

if (isset($_POST['edit'])) {

    $id = $_POST['id_user'] ?? 0;

    $nama = $_POST['nama'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Data user pada halaman ini selalu menjadi PEMINJAM.
    // Role tidak lagi dikirim dari form edit agar tidak bisa diubah menjadi admin/petugas.
    $role = 'peminjam';


    if (
        $id == 0 ||
        $nama === '' ||
        $username === ''
    ) {

        die("Data user belum lengkap.");

    }


    $hasil = $user->edit(
        $id,
        $nama,
        $username,
        $password,
        $role
    );


    if ($hasil) {

        header(
            "Location: ../view/v_user.php?pesan=edit"
        );

        exit;

    } else {

        die(
            "Gagal mengedit user: "
            . mysqli_error(
                $GLOBALS['koneksi']->koneksi
            )
        );

    }
}


// =================================
// HAPUS USER
// =================================

if (isset($_GET['hapus'])) {

    $id = (int) $_GET['hapus'];


    if ($id <= 0) {

        die("ID user tidak valid.");

    }


    $hasil = $user->hapus($id);


    if ($hasil) {

        header(
            "Location: ../view/v_user.php?pesan=hapus"
        );

        exit;

    } else {

        die(
            "Gagal menghapus user: "
            . mysqli_error(
                $GLOBALS['koneksi']->koneksi
            )
        );

    }
}

?>