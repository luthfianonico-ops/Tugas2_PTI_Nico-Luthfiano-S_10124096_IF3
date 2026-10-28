<?php
require 'config.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$id = (int)$_GET["id"];
$mhs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM penerima_mbg WHERE id=$id"));

if (isset($_POST["submit"])) {
    $nisn = htmlspecialchars(trim($_POST["nisn"]));
    $nama = htmlspecialchars(trim($_POST["nama"]));
    $sekolah = htmlspecialchars(trim($_POST["sekolah"]));
    $alergi = htmlspecialchars(trim($_POST["alergi"]));

    if (!empty($nisn) && !empty($nama) && !empty($sekolah) && !empty($alergi)) {
        mysqli_query($conn, "UPDATE penerima_mbg SET nisn='$nisn', nama='$nama', sekolah='$sekolah', alergi='$alergi' WHERE id=$id");
        header("Location: index.php");
        exit;
    } else {
        $error = $teks[$lang]['empty'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $teks[$lang]['edit'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); min-height: 100vh; display: flex; align-items: center; font-family: 'Segoe UI', sans-serif; color: white; padding: 2rem 0; }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(16px); border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); padding: 2rem; }
        .form-control { background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px; color: white; }
        .form-control:focus { background: rgba(255, 255, 255, 0.15); border-color: #fff; box-shadow: none; color: white; }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.5); }
        .btn-glass { background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 10px; transition: 0.3s; }
        .btn-glass:hover { background: rgba(255, 255, 255, 0.25); color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="glass-card">
                    <h3 class="text-center mb-4 fw-bold"><?= $teks[$lang]['edit'] ?></h3>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger" style="background: rgba(255,0,0,0.2); border:none; color:#ffb3b3;"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?= $teks[$lang]['nisn'] ?></label>
                            <input type="text" name="nisn" class="form-control" value="<?= htmlspecialchars($mhs['nisn']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?= $teks[$lang]['nama'] ?></label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mhs['nama']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><?= $teks[$lang]['sekolah'] ?></label>
                            <input type="text" name="sekolah" class="form-control" value="<?= htmlspecialchars($mhs['sekolah']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold"><?= $teks[$lang]['alergi'] ?></label>
                            <input type="text" name="alergi" class="form-control" value="<?= htmlspecialchars($mhs['alergi']) ?>" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-glass px-4">Batal</a>
                            <button type="submit" name="submit" class="btn btn-warning fw-bold px-4 text-dark" style="border-radius: 10px;"><?= $teks[$lang]['save'] ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>