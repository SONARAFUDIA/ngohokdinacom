<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ngohok</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ngecare</title>
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="CSS/register.css">
        
        <script src="JS/register.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <div class="login-container">
            <div class="login-wrapper">
              <h1 class="login-header">Register</h1>
              <form class="login-form-container" id="register" method="post">
                <div class="input-wrapper">
                  <label for="email" class="visually-hidden">Email</label>
                  <input type="email" id="email" name="email" class="form-input" placeholder="Email" required aria-label="Username or Email" 
                  autocomplete="off">
                </div>
                <div class="input-wrapper">
                  <label for="username" class="visually-hidden">Username</label>
                  <input type="text" id="username" name="username" class="form-input" placeholder="Username" required aria-label="Username" 
                  autocomplete="off">
                </div>
                <div class="input-wrapper">
                  <label for="password" class="visually-hidden">Password</label>
                  <input type="password" id="password" name="password" class="form-input" placeholder="Password" required aria-label="Password" 
                  autocomplete="off">
                </div>
                
                <div class="input-wrapper">
                  <label for="confirm-password" class="visually-hidden">Confirm Password</label>
                  <input type="password" id="confirm-password" name="confirm-password" class="form-input" placeholder="Confirm Password" 
                  required aria-label="Confirm Password" autocomplete="off">
                </div>
              
                <!-- Pesan peringatan -->
                <div id="error-message" name="error-message" style="color: red; display: none;">Passwords do not match. Please check again.</div>

                <button type="submit" class="submit-button">Register</button>
                <div class="auth-toggle" role="group" aria-label="Authentication options">
                  <button type="button" class="toggle-button toggle-button-active"><a class="nav-link active fs-5" href="login.php">Login</a></button>
                  <button type="button" class="toggle-button toggle-button-inactive">Register</button>
                </div>
              </form>
              <div class="col-md-6 mb-4">
                        <?= register() ?>
                      </div>
              </div>
            </div>
          </div>

          <?php
          function register(): void {
            include "koneksi.php";
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm-password']);
        
                if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                    echo "Semua bidang harus diisi.";
                    return;
                }
        
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "Email tidak valid.";
                    return;
                }
        
                if ($password !== $confirm_password) {
                    echo "Password dan Konfirmasi Password tidak cocok.";
                    return;
                }
                
                $password = md5($_POST['password']);

                $stmt = $conn->prepare("SELECT id_user FROM user WHERE email = ? OR username = ?");
                $stmt->bind_param("ss", $email, $username);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    echo "Email atau Username sudah terdaftar.";
                    $stmt->close();
                    return;
                }

                // Insert data ke dalam tabel user
                $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $password);
                $result = $stmt->execute();
                
                if ($result) {
                    echo "<script>
                            alert('Registrasi Berhasil!');
                            document.location='index.html';
                          </script>";
                } else {
                    echo "<script>
                            alert('Registrasi belum berhasil!');
                            document.location='register.php';
                          </script>";
                }

                $stmt->close();
                $conn->close();
            }
        }
        
      ?>
    </body>
</html>