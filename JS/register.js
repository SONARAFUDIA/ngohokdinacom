// Mendapatkan elemen-elemen form dan input
  const form = document.getElementById('register');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const errorMessage = document.getElementById('error-message');

  // Event listener saat form disubmit
  form.addEventListener('submit', function(event) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    // Cek jika password dan confirm password tidak cocok
    if (password !== confirmPassword) {
      // Menghentikan pengiriman form (registrasi dibatalkan)
      event.preventDefault();

      // Menampilkan pesan kesalahan
      errorMessage.style.display = 'block';
      
      // Menambahkan border merah pada confirm password untuk menunjukkan kesalahan
      confirmPasswordInput.style.borderColor = 'red';
    } else {
      // Sembunyikan pesan kesalahan jika password cocok
      errorMessage.style.display = 'none';

      // Reset border color pada confirm password
      confirmPasswordInput.style.borderColor = '';
    }
  });

  // Event listener untuk mengecek kecocokan password secara real-time saat mengetik
  passwordInput.addEventListener('input', checkPasswordsMatch);
  confirmPasswordInput.addEventListener('input', checkPasswordsMatch);

  // Fungsi untuk memeriksa apakah password dan confirm password cocok
  function checkPasswordsMatch() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (password === confirmPassword) {
      errorMessage.style.display = 'none';
      confirmPasswordInput.style.borderColor = '';
    } else {
      errorMessage.style.display = 'block';
      confirmPasswordInput.style.borderColor = 'red';
    }
  }
