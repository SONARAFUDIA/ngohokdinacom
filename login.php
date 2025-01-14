

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngohok</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="CSS/login.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="login-wrapper">
            <h1 class="login-header">Login</h1>
            <form class="login-form-container" method="POST" action="">
                <div class="input-wrapper">
                    <label for="username" class="visually-hidden">Username/Email</label>
                    <input type="text" id="username" name="username" class="form-input" placeholder="Username/Email" required aria-label="Username or Email">
                </div>
                <div class="input-wrapper">
                    <label for="password" class="visually-hidden">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Password" required aria-label="Password">
                </div>
                <a href="lupapw.php" class="forgot-password" tabindex="0">Lupa Password?</a>
                <button type="submit" class="submit-button">Login</button>
                <div class="auth-toggle" role="group" aria-label="Authentication options">
                    <button type="button" class="toggle-button toggle-button-active">Login</button>
                    <button type="button" class="toggle-button toggle-button-inactive">
                        <a class="nav-link active fs-5" href="register.php">Register</a>
                    </button>
                </div>
            </form>
            <?= login(); ?>
        </div>
    </div>
    <?php 
    session_start();

    function login(): void {
        include "koneksi.php"; // Pastikan koneksi.php memiliki koneksi yang valid
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Mengambil input dari form
            $input = trim($_POST['username']); 
    
            // Menentukan apakah input adalah email atau username
            if (filter_var($input, FILTER_VALIDATE_EMAIL)) { 
                $email = $input;
                $username = null; // Clear username jika input adalah email
            } else {
                $username = $input;
                $email = null; // Clear email jika input adalah username
            }
    
            // Enkripsi password menggunakan md5 (disarankan menggunakan password_hash)
            $password = md5($_POST['password']);
    
            if ($email) {
                // Query untuk email
                $stmt = $conn->prepare("SELECT email, password FROM user WHERE email=? AND password=?");
                $stmt->bind_param("ss", $email, $password); // hanya email yang dipakai
            } else {
                // Query untuk username
                $stmt = $conn->prepare("SELECT username, password FROM user WHERE username=? AND password=?");
                $stmt->bind_param("ss", $username, $password); // hanya username yang dipakai
            }
    
            // Eksekusi query
            $stmt->execute();
            $hasil = $stmt->get_result();
            $row = $hasil->fetch_array(MYSQLI_ASSOC);

            // Memeriksa apakah password yang dimasukkan cocok dengan yang ada di database
            if (!empty($row)) {
                //jika ada, simpan variable username pada session
                $_SESSION['username'] = $row['username'];                
                //mengalihkan ke halaman admin
                header("location:index.html");
              } else {
              //jika tidak ada (gagal), alihkan kembali ke halaman login
                header("location:login.php");
              }
    
            // Menutup koneksi
            $stmt->close();
            $conn->close();
        }
    }
    ?>
</body>
</html>
