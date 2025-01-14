

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
            <h1 class="login-header">Lupa Password</h1>
            <form class="login-form-container" method="POST" action="">
                <div class="input-wrapper">
                    <label for="username" class="visually-hidden">Username/Email</label>
                    <input type="text" id="username" name="username" class="form-input" placeholder="Username/Email" required aria-label="Username or Email">
                </div>

                <div class="input-wrapper">
                    <label for="password" class="visually-hidden">Password Baru</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="New Password" required aria-label="Password">
                </div>

                <div class="input-wrapper">
                  <label for="confirm-password" class="visually-hidden">Confirm Password</label>
                  <input type="password" id="confirm-password" name="confirm-password" class="form-input" placeholder="Confirm Password" 
                  requirdivaria-label="Confirm Password" autocomplete="off">
                </div>
                
                <button type="submit" class="submit-button">Konfirmasi</button>

                <div class="auth-toggle" role="group" aria-label="Authentication options">
                    <button type="button" class="toggle-button toggle-button-active">Login</button>
                    <button type="button" class="toggle-button toggle-button-inactive">
                        <a class="nav-link active fs-5" href="register.php">Register</a>
                    </button>
                </div>
            </form>
            <?= lupapw(); ?>
        </div>
    </div>
    <?php 
    session_start();

    //jika tombol simpan diklik
    function lupapw(): void {
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = trim($_POST['username']); 
    
        // Menentukan apakah input adalah email atau username
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) { 
            $email = $input;
            $username = null; // Clear username jika input adalah email
        } else {
            $username = $input;
            $email = null; // Clear email jika input adalah username
        }

        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm-password']);
    
        if ($password !== $confirm_password) {
            echo "Password dan Konfirmasi Password tidak cocok.";
            return;
        }
            
        $password = md5($_POST['password']);

        if ($email) {
            // Query untuk email
            $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email=?");
            $stmt->bind_param("ss", $password, $email); // hanya email yang dipakai
        } else {
            // Query untuk username
            $stmt = $conn->prepare("UPDATE user SET password = ? WHERE username=?");
            $stmt->bind_param("ss", $password, $username); // hanya username yang dipakai
        }
        
        $result = $stmt->execute();

        if ($result) {
            echo "<script>
                    alert('Password Berhasil Diganti!');
                    document.location='login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Password belum berhasil!');
                    document.location='lupapw.php';
                  </script>";
        }

        $stmt->close();
        $conn->close();
    }
}
    ?>
</body>
</html>
