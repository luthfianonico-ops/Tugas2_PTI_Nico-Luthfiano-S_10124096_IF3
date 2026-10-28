<?php
require 'config.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$data = mysqli_query($conn, "SELECT * FROM penerima_mbg ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $teks[$lang]['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); 
            min-height: 100vh; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: white; 
            padding-top: 3rem; 
            padding-bottom: 3rem; 
        }
        .glass-container { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px);
            border-radius: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); 
            padding: 2rem; 
        }
        .table { color: white; }
        .table thead th { background: rgba(255, 255, 255, 0.1); border-bottom: none; color: white; }
        .table tbody td { background: transparent; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .table-hover tbody tr:hover td { background: rgba(255, 255, 255, 0.1); color: white; }
        .btn-glass { 
            background: rgba(255, 255, 255, 0.15); 
            border: 1px solid rgba(255, 255, 255, 0.3); 
            color: white; 
            transition: 0.3s; 
        }
        .btn-glass:hover { background: rgba(255, 255, 255, 0.25); color: white; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header & Navigasi -->
        <div class="d-flex justify-content-between align-items-center mb-4 glass-container" style="padding: 1rem 2rem;">
            <h4 class="mb-0 fw-bold"><?= $teks[$lang]['title'] ?></h4>
            <div class="d-flex align-items-center">
                <a href="?lang=id" class="btn btn-glass btn-sm me-1">ID</a>
                <a href="?lang=en" class="btn btn-glass btn-sm me-3">EN</a>
                <a href="ganti_password.php" class="btn btn-warning btn-sm me-2 text-dark fw-bold" style="border-radius: 8px;">Ubah Sandi</a>
                <a href="logout.php" class="btn btn-danger btn-sm px-3" style="border-radius: 8px;"><?= $teks[$lang]['logout'] ?></a>
            </div>
        </div>

        <!-- Tabel Data Penerima MBG -->
        <div class="glass-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Daftar Penerima Bantuan</h5>
                <a href="tambah.php" class="btn btn-light fw-bold" style="border-radius: 10px; color:#0f172a;">+ <?= $teks[$lang]['add'] ?></a>
            </div>
            
            <div class="table-responsive mt-4">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%" style="border-top-left-radius: 10px;">No</th>
                            <th><?= $teks[$lang]['nisn'] ?></th>
                            <th><?= $teks[$lang]['nama'] ?></th>
                            <th><?= $teks[$lang]['sekolah'] ?></th>
                            <th><?= $teks[$lang]['alergi'] ?></th>
                            <th class="text-center" width="15%" style="border-top-right-radius: 10px;"><?= $teks[$lang]['aksi'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= htmlspecialchars($row["nisn"]); ?></td>
                            <td><?= htmlspecialchars($row["nama"]); ?></td>
                            <td><?= htmlspecialchars($row["sekolah"]); ?></td>
                            <td><span class="badge bg-warning text-dark"><?= htmlspecialchars($row["alergi"]); ?></span></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-glass btn-sm text-white"><?= $teks[$lang]['edit'] ?></a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-outline-light btn-sm" onclick="return confirm('Hapus data siswa ini?');"><?= $teks[$lang]['delete'] ?></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>