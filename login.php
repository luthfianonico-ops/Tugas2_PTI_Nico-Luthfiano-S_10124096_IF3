<?php
require 'config.php';
if (isset($_SESSION['login'])) { header("Location: index.php"); exit; }

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); 
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        header("Location: index.php"); 
        exit;
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $teks[$lang]['login'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            color: #ffffff;
        }
        .form-control { background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: white; border-radius: 10px; }
        .form-control:focus { background: rgba(255, 255, 255, 0.15); border-color: #fff; color: white; box-shadow: none; }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.5); }
        .btn-glass { background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 10px; transition: 0.3s; }
        .btn-glass:hover { background: rgba(255, 255, 255, 0.25); color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="glass-card p-5">
                    <h3 class="text-center mb-4 fw-bold"><?= $teks[$lang]['login'] ?> Program Makan Bergizi Gratis (MBG)</h3>
                    <div class="text-center mb-4">
                        <a href="?lang=id" class="badge bg-light text-dark text-decoration-none">ID</a>
                        <a href="?lang=en" class="badge bg-light text-dark text-decoration-none">EN</a>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger" style="background: rgba(255,0,0,0.2); border:none; color:#ffb3b3;">Username / Password Salah!</div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Silahkan Isi Username Anda!" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Silahkan Isi Password Anda!" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-glass w-100 fw-bold py-2"><?= $teks[$lang]['login'] ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>