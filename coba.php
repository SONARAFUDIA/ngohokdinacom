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
                <a href="#" class="forgot-password" tabindex="0">Lupa Password?</a>
                <button type="submit" class="submit-button">Login</button>
                <div class="auth-toggle" role="group" aria-label="Authentication options">
                    <button type="button" class="toggle-button toggle-button-active">Login</button>
                    <button type="button" class="toggle-button toggle-button-inactive">
                        <a class="nav-link active fs-5" href="register.php">Register</a>
                    </button>
                </div>
            </form>
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
                $stmt = $conn->prepare("SELECT email, password FROM user WHERE email=?");
                $stmt->bind_param("s", $email); // hanya email yang dipakai
            } else {
                // Query untuk username
                $stmt = $conn->prepare("SELECT username, password FROM user WHERE username=?");
                $stmt->bind_param("s", $username); // hanya username yang dipakai
            }
    
            // Eksekusi query
            $stmt->execute();
            $hasil = $stmt->get_result(); 
    
            // Mengecek apakah ada hasil dari query
            if ($hasil->num_rows > 0) {
                // Ambil data hasil query
                $row = $hasil->fetch_assoc();
    
                // Memeriksa apakah password yang dimasukkan cocok dengan yang ada di database
                if ($password === $row['password']) {
                    // Login berhasil, set session dan alihkan ke halaman utama
                    session_start();
                    $_SESSION['username'] = $row['username']; // Menyimpan username di session
                    echo "<script>
                            alert('Login Berhasil!');
                            document.location='index.html';
                          </script>";
                } else {
                    // Password salah
                    echo "<script>
                            alert('Periksa Kembali Email/Username dan Password Anda!');
                            document.location='login.php';
                          </script>";
                }
            } else {
                // Tidak ada data yang cocok
                echo "<script>
                        alert('Periksa Kembali Email/Username dan Password Anda!');
                        document.location='login.php';
                      </script>";
            }
    
            // Menutup koneksi
            $stmt->close();
            $conn->close();
        }
    }
    ?>
</body>
</html>
