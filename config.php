<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_mbg");
if (!$conn) { 
    die("Koneksi gagal: " . mysqli_connect_error()); 
}

if (isset($_GET['lang'])) { 
    $_SESSION['lang'] = $_GET['lang']; 
}
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'id';

$teks = [
    'id' => [
        'login' => 'Masuk', 'logout' => 'Keluar',
        'title' => 'Pendataan Makan Bergizi Gratis (MBG)', 
        'add' => 'Tambah Penerima',
        'nisn' => 'NISN', 'nama' => 'Nama Siswa', 'sekolah' => 'Asal Sekolah', 'alergi' => 'Catatan Alergi', 
        'aksi' => 'Aksi', 'save' => 'Simpan Data', 'edit' => 'Ubah', 'delete' => 'Hapus',
        'empty' => 'Semua kolom wajib diisi!'
    ],
    'en' => [
        'login' => 'Login', 'logout' => 'Logout',
        'title' => 'Free Nutritious Meal Data', 
        'add' => 'Add Recipient',
        'nisn' => 'Student ID', 'nama' => 'Student Name', 'sekolah' => 'School Name', 'alergi' => 'Allergy Notes', 
        'aksi' => 'Action', 'save' => 'Save Data', 'edit' => 'Edit', 'delete' => 'Delete',
        'empty' => 'All fields are required!'
    ]
];
?>