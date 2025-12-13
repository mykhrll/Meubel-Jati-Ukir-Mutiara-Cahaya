<?php
include 'config.php'; 
include 'db.php';

// LOGIKA LOGIN
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Cek password
        if ($password == $row['password']) {

            // Set session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nama']    = $row['nama_lengkap'];
            $_SESSION['role']    = $row['role'];

            // PERUBAHAN DISINI:
            // Baik Admin maupun User diarahkan ke index.php
            // Tapi pesannya dibedakan agar admin tahu dia login sebagai admin
            if ($row['role'] === 'admin') {
                echo "<script>
                        alert('Login Admin Berhasil! Mode Edit Aktif.');
                        window.location.href='index.php'; 
                      </script>";
            } else {
                echo "<script>
                        alert('Login Berhasil! Selamat Datang, " . $row['nama_lengkap'] . "');
                        window.location.href='index.php';
                      </script>";
            }

        } else {
            echo "<script>alert('Password salah!');</script>";
        }

    } else {
        echo "<script>alert('Email tidak terdaftar!');</script>";
    }
}

// REGISTER
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi_password'];

    if ($password === $konfirmasi) {

        // Cek email sudah ada?
        $cek_email = $conn->query("SELECT email FROM users WHERE email = '$email'");
        if ($cek_email->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar, gunakan email lain!');</script>";
        } else {

            // Register akan jadi role "user" secara default
            $sql = "INSERT INTO users (nama_lengkap, email, password, role) 
                    VALUES ('$nama', '$email', '$password', 'user')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Pendaftaran Berhasil! Silakan Login.');
                        window.location.href='login.php';
                      </script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Password konfirmasi tidak cocok!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Daftar - Meubel Jati Ukir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --brown: #8B5E3C; --cream: #F5E9DA; }
        body { background: linear-gradient(135deg, var(--cream), #fff); min-height: 100vh; }
        .login-card { border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); overflow: hidden; border: none; }
        .login-image { background: url('img/login.jpg') center/cover; min-height: 550px; }
        .nav-pills .nav-link { color: var(--brown); font-weight: bold; }
        .nav-pills .nav-link.active { background-color: var(--brown); color: white; }
        .btn-primary { background-color: var(--brown); border: none; }
        .btn-primary:hover { background-color: #7a5134; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card login-card">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-block login-image"></div>
                        <div class="col-lg-6">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h3 class="text-brown fw-bold">Meubel Jati Ukir</h3>
                                    <p class="text-muted">Login atau Daftar Akun</p>
                                </div>

                                <ul class="nav nav-pills nav-justified mb-4" id="pills-tab">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-login">Login</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-register">Daftar</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    
                                    <div class="tab-pane fade show active" id="pills-login">
                                        <form method="POST" action="">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                            <button type="submit" name="login" class="btn btn-primary w-100 py-2 rounded-pill">Masuk</button>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="pills-register">
                                        <form method="POST" action="">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" minlength="6" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Konfirmasi Password</label>
                                                <input type="password" name="konfirmasi_password" class="form-control" required>
                                            </div>
                                            <button type="submit" name="register" class="btn btn-primary w-100 py-2 rounded-pill">Daftar Sekarang</button>
                                        </form>
                                    </div>

                                </div>
                                <div class="text-center mt-4">
                                    <a href="index.php" class="text-decoration-none text-muted">Kembali ke Beranda</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>