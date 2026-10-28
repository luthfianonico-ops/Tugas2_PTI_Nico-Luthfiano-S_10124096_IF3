<?php
require 'config.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

if (isset($_POST["submit"])) {
    $pass_lama = md5($_POST["pass_lama"]);
    $pass_baru = $_POST["pass_baru"];
    $konfirmasi = $_POST["konfirmasi"];

    // Cek apakah password lama sesuai dengan data di database (ID 1)
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE id=1 AND password='$pass_lama'");
    
    if (mysqli_num_rows($cek) === 1) {
        if ($pass_baru === $konfirmasi) {
            // Update password baru ke database
            $pass_baru_md5 = md5($pass_baru);
            mysqli_query($conn, "UPDATE users SET password='$pass_baru_md5' WHERE id=1");
            
            // Hapus sesi login dan alihkan langsung ke halaman login
            session_unset();
            session_destroy();
            echo "<script>
                    alert('Password berhasil diubah! Silakan masuk kembali dengan password baru.'); 
                    window.location='login.php';
                  </script>";
            exit;
        } else {
            $error = "Konfirmasi password baru tidak cocok!";
        }
    } else {
        $error = "Password lama yang kamu masukkan salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - MBG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: white; 
            padding: 2rem 0; 
        }
        .glass-card { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px);
            border-radius: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); 
            padding: 2rem; 
        }
        .form-control { 
            background: rgba(255, 255, 255, 0.1); 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            border-radius: 10px; 
            color: white; 
        }
        .form-control:focus { 
            background: rgba(255, 255, 255, 0.15); 
            border-color: #fff; 
            box-shadow: none; 
            color: white; 
        }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.5); }
        .btn-glass { 
            background: rgba(255, 255, 255, 0.15); 
            border: 1px solid rgba(255, 255, 255, 0.3); 
            color: white; 
            border-radius: 10px; 
            transition: 0.3s; 
        }
        .btn-glass:hover { background: rgba(255, 255, 255, 0.25); color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="glass-card">
                    <h3 class="text-center mb-4 fw-bold">Ganti Password</h3>
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger" style="background: rgba(255,0,0,0.2); border:none; color:#ffb3b3;">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Saat Ini</label>
                            <input type="password" name="pass_lama" class="form-control" placeholder="Masukkan password lama" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="pass_baru" class="form-control" placeholder="Masukkan password baru" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi" class="form-control" placeholder="Ketik ulang password baru" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-glass px-4">Batal</a>
                            <button type="submit" name="submit" class="btn btn-warning fw-bold px-4 text-dark" style="border-radius: 10px;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>