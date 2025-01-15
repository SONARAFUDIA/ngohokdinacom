<?php
session_start(); // Mulai sesi

include "koneksi.php"; // Sambungkan ke database

// Ambil username dari sesi
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Periksa apakah username tersedia
if (empty($username)) {
    echo "Anda harus login terlebih dahulu.";
    exit;
}

// Query ke database
$tampilkan = "SELECT * FROM user WHERE username = ?";
$user = $conn->prepare($tampilkan);

if (!$user) {
    echo "Gagal mempersiapkan pernyataan: " . $conn->error;
    exit;
}

$user->bind_param("s", $username);

if (!$user->execute()) {
    echo "Gagal menjalankan pernyataan: " . $user->error;
    exit;
}

$result = $user->get_result();

if ($result->num_rows === 0) {
    echo "Pengguna tidak ditemukan.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>NgeCare</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet"
        />
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
        <link rel="stylesheet" href="JS/swiper.js" />
        <link rel="stylesheet" href="CSS/swiper.css" />
        <link rel="stylesheet" href="CSS/foot.css" />
        <style>
            * {
                color: #28282b;
            }
            #tujuan {
                padding-top: 5vw;
                background-color: #94b1ff;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg sticky-top bg-body border-bottom">
            <div class="container-fluid ms-md-5 me-md-5">
                <a class="navbar-brand fs-1 h1" href="#">NgeCare</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span id="mobilebtn"><i class="bi bi-list h1"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto fs-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="article.html">Article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="release.html">Release</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reservasi.html">Reservation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.html">About Us</a>
                        </li>
                        <li class="nav-item d-flex">
                            <a class="nav-link" href="login.php"
                                ><i class="bi bi-person-circle pe-2"></i>Login</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Section -->

        <!-- Section -->
        <section>
            <div class="mt-3">
                <ul
                    class="nav nav-pills mb-3 justify-content-center"
                    id="pills-tab "
                    role="tablist"
                >
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active"
                            id="pills-home-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-home"
                            type="button"
                            role="tab"
                            aria-controls="pills-home"
                            aria-selected="true"
                        >
                            Release & Let it out
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="pills-profile-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-profile"
                            type="button"
                            role="tab"
                            aria-controls="pills-profile"
                            aria-selected="false"
                        >
                            Q&A
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="pills-contact-tab"
                            data-bs-toggle="pill"
                            data-bs-target="#pills-contact"
                            type="button"
                            role="tab"
                            aria-controls="pills-contact"
                            aria-selected="false"
                        >
                            Guide
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div
                        class="tab-pane fade show active"
                        id="pills-home"
                        role="tabpanel"
                        aria-labelledby="pills-home-tab"
                        tabindex="0"
                    >
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="container border p-3 mb-3">
                            <div class="d-flex">
                                <i class="bi bi-person-circle h1"></i>
                                <div class="container">
                                    <textarea
                                        class="form-control"
                                        name="postingan"
                                        id="exampleFormControlTextarea1"
                                        rows="3"
                                    ></textarea>
                                    <div class="d-flex justify-content-between pt-2">
                                        <i class="bi bi-card-image h3"></i>
                                        <input
                                            name="gambar"
                                            type="file"
                                            class="form-control"
                                            accept="image/*"
                                        />
                                        <input
                                            name="simpan"
                                            class="btn btn-primary"
                                            type="submit"
                                            value="Release"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                        <br />
                        <br />
                        <?php
                        while ($row = $result->fetch_assoc()):
                            // Periksa apakah postingan tidak kosong
                            if (!empty($row['postingan'])): ?>
                                <div class="container border p-3 mb-3">
                                    <div class="d-flex">
                                        <i class="bi bi-person-circle h1 me-3"></i>
                                        <div>
                                            <h4><?php echo htmlspecialchars($username); ?></h4>
                                            <p>
                                                <?php echo nl2br(htmlspecialchars($row['postingan'])); ?>
                                            </p>
                                            <div class="d-flex">
                                                <div class="d-flex me-4">
                                                    <i class="bi bi-heart me-1"></i>
                                                    <p>27</p>
                                                </div>
                                                <div class="d-flex me-4">
                                                    <i class="bi bi-chat me-1"></i>
                                                    <p>27</p>
                                                </div>
                                                <div class="d-flex me-4">
                                                    <i class="bi bi-eye me-1"></i>
                                                    <p>27</p>
                                                </div>
                                            </div>
                                            <small>Posted on: <?php echo $row['tanggal']; ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; // Tutup if postingan tidak kosong ?>
                        <?php endwhile; ?>


                        <div class="container border p-3 mb-3">
                            <div class="d-flex">
                                <i class="bi bi-person-circle h1 me-3"></i>
                                <div>
                                    <h4>fabi</h4>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut
                                        atque et officia exercitationem fuga similique minus ipsam
                                        fugiat voluptatibus. Ab similique eos laudantium fugiat
                                        molestias eius qui itaque beatae libero?
                                        <br />
                                        <br />
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut
                                        atque et officia exercitationem fuga similique minus ipsam
                                        fugiat voluptatibus. Ab similique eos laudantium fugiat
                                        molestias eius qui itaque beatae libero?
                                    </p>
                                    <div class="col-8 mb-3">
                                        <img class="card-img" src="asset/sample1.jpg" alt="" />
                                    </div>
                                    <div class="d-flex">
                                        <div class="d-flex me-4">
                                            <i class="bi bi-heart me-1"></i>
                                            <p>27</p>
                                        </div>
                                        <div class="d-flex me-4">
                                            <i class="bi bi-chat me-1"></i>
                                            <p>27</p>
                                        </div>
                                        <div class="d-flex me-4">
                                            <i class="bi bi-eye me-1"></i>
                                            <p>27</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center opacity-50 my-5">
                            <i class="bi bi-emoji-frown h1"></i>
                            <h1>POSTINGAN HABIS</h1>
                        </div>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pills-profile"
                        role="tabpanel"
                        aria-labelledby="pills-profile-tab"
                        tabindex="0"
                    >
                        <div class="container border p-3 mb-3">
                            <div class="d-flex">
                                <i class="bi bi-person-circle h1 me-3"></i>
                                <div>
                                    <h4>fabi</h4>
                                    <p>
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut
                                        atque et officia exercitationem fuga similique minus ipsam
                                        fugiat voluptatibus. Ab similique eos laudantium fugiat
                                        molestias eius qui itaque beatae libero?
                                        <br />
                                        <br />
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut
                                        atque et officia exercitationem fuga similique minus ipsam
                                        fugiat voluptatibus. Ab similique eos laudantium fugiat
                                        molestias eius qui itaque beatae libero?
                                    </p>
                                    <div class="d-flex">
                                        <div class="d-flex me-4">
                                            <img
                                                style="height: 1.5rem;"
                                                class="container"
                                                src="asset/upvote.svg"
                                                alt=""
                                            />
                                            <p>27</p>
                                        </div>
                                        <div class="d-flex me-4">
                                            <img
                                                style="height: 1.5rem;"
                                                class="container"
                                                src="asset/downvote.svg"
                                                alt=""
                                            />
                                            <p>27</p>
                                        </div>
                                        <div class="d-flex me-4">
                                            <i class="bi bi-chat me-1 h5"></i>
                                            <p>27</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pills-contact"
                        role="tabpanel"
                        aria-labelledby="pills-contact-tab"
                        tabindex="0"
                    >
                        <div class="container">
                            <h1>Apa itu release and let it out?</h1>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam
                                obcaecati quis odio maxime ad amet consectetur repellat tempore,
                                reprehenderit veniam sed? Praesentium molestiae porro possimus
                                accusamus a rerum natus tempore!
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam
                                obcaecati quis odio maxime ad amet consectetur repellat tempore,
                                reprehenderit veniam sed? Praesentium molestiae porro possimus
                                accusamus a rerum natus tempore!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <footer>
            <div class="kiri">
                <img src="asset/logso.png" alt="" />
            </div>
            <div class="tengah">
                <h3>Informasi Kontak</h3>
                <div class="em">
                    <i class="bi bi-envelope"></i>
                    <p>kirimsaja@gmail.com</p>
                </div>
                <div class="em">
                    <i class="bi bi-telephone-inbound"></i>
                    <p>@081732983217</p>
                </div>
            </div>

            <div class="kanan">
                <h3>Follow Us</h3>
                <div class="fkanan">
                    <i class="bi bi-instagram"></i>
                    <p>@Ngohok</p>
                </div>
                <div class="fkanan">
                    <i class="bi bi-facebook"></i>
                    <p>@ngohok</p>
                </div>
                <div class="fkanan">
                    <i class="bi bi-twitter-x"></i>
                    <p>@nghohok</p>
                </div>
            </div>
        </footer>
        <div class="copy"><h2>&copy;ngohok 2025</h2></div>

        <?php
        session_start();
        include "koneksi.php";
        include "upload_foto.php";
            if (isset($_POST['simpan'])) {

                // Ambil data dari form
                $tanggal = date("Y-m-d H:i:s");
                $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            
                if (empty($username)) {
                    echo "<script>
                            alert('Anda harus login terlebih dahulu!');
                            document.location='login.php';
                          </script>";
                    exit;
                }
            
                $gambar = '';
                $nama_gambar = $_FILES['gambar']['name'];
            
                // Cek jika ada gambar baru yang diupload
                if ($nama_gambar != '') {
                    // Panggil fungsi upload_foto
                    $cek_upload = upload_file($_FILES["gambar"]);
            
                    if ($cek_upload['status']) {
                        $gambar = $cek_upload['message'];
                    } else {
                        echo "<script>
                                alert('" . $cek_upload['message'] . "');
                                document.location='admin.php?page=gallery';
                              </script>";
                        die;
                    }
                }
                
                $postingan = isset($_POST['postingan']) ? trim($_POST['postingan']) : '';

                // Validasi apakah postingan kosong
                if (empty($postingan)) {
                    echo "<script>
                            alert('Postingan tidak boleh kosong!');
                            document.location='form.php';
                          </script>";
                    exit;
                }

                // Jika ada id, lakukan update
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
            
                    if ($nama_gambar == '') {
                        $gambar = $_POST['gambar_lama']; // Pakai gambar lama
                    } else {
                        // Hapus gambar lama
                        unlink("img/" . $_POST['gambar_lama']);
                    }

                    $stmt = $conn->prepare("UPDATE user SET gambar = ?, tanggal = ?, postingan = ?,  username = ? WHERE id = ?");
                    $stmt->bind_param("ssssi",  $gambar, $tanggal, $postingan, $username, $id);
                    $simpan = $stmt->execute();
                } else {
                    // Insert data baru
                    $stmt = $conn->prepare("INSERT INTO user ( gambar, tanggal, postingan, username) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss",  $gambar, $tanggal, $postingan, $username);
                    $simpan = $stmt->execute();
                }
            
                // Berhasil simpan
                if ($simpan) {
                    echo "<script>
                            document.location='release.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Data gagal disimpan!');
                            document.location='admin.php?page=gallery';
                          </script>";
                }
            
                $stmt->close();
                $conn->close();
            }
        ?>

        <!-- CDN script -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    </body>
</html>
