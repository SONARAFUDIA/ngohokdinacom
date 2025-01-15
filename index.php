<?php
session_start();

// Periksa apakah sesi username sudah ada
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Jika sesi tidak ada, arahkan kembali ke login
if (empty($username)) {
    echo "<script>
            alert('Anda harus login terlebih dahulu!');
            document.location='login.php';
          </script>";
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
        <link rel="stylesheet" href="CSS/foot.css">
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
                            <a class="nav-link" href="release.php">Release</a>
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
        <!-- Pengenalan -->
        <section id="pengenalan" class="text-center">
            <div class="d-md-flex align-items-center">
                <img
                    width="50%"
                    src="https://img.freepik.com/free-photo/authentic-scene-young-person-undergoing-psychological-therapy_23-2150161911.jpg?t=st=1736654347~exp=1736657947~hmac=066640a7d658d3751348f30871c6a6851cfd7174e2447c3d1edad91f989b01d0&w=1480"
                    alt=""
                />
                <div class="container text-md-end p-5">
                    <h1><b>Pengenalan</b></h1>
                    <p class="fs-4" >
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Inventore aut
                        quasi, deserunt, quae atque asperiores omnis odit dolor incidunt soluta
                        labore mollitia voluptatibus ducimus nam? Repellendus asperiores itaque odit
                        illo?
                    </p>
                </div>
            </div>
        </section>
        <!-- Section -->
        <!-- Tujuan -->
        <section id="tujuan" class="pb-5 text-md-start text-center">
            <div class="container pt-5 pb-5">
                <h1><b>Tujuan Kami</b></h1>
                <p class="fs-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nostrum reiciendis
                    atque mollitia nemo aliquam vitae distinctio vel, fugiat facilis officia
                    aspernatur pariatur rerum sint, quam repellat praesentium. Officiis,
                    consectetur!
                </p>
            </div>
        </section>

        <section class="mt-5 mb-5">
            <h2 class="text-center pb-5">Berita terkait kesehatan mental</h2>
            <!-- Slider main container -->
            <div>
                <swiper-container
                    class="mySwiper"
                    slides-per-view="3"
                    centered-slides="true"
                    space-between="100"
                    pagination="true"
                    pagination-type="none"
                    navigation="true"
                >
                    <swiper-slide>
                        <img src="asset/konsul.jpg" alt="">
                        <div class="info" id="content">
                            <h4>TETS</h4>
                            <p style="color: white;">Lorem ipsum dolor sit amet.</p>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <img src="asset/p02.jpg" alt="">
                        <div class="info" id="content">
                            <h4>TETS</h4>
                            <p style="color: white;">Lorem ipsum dolor sit amet.</p>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <img src="asset/konsul.jpg" alt="">
                        <div class="info" id="content">
                            <h4>TETS</h4>
                            <p style="color: white;">Lorem ipsum dolor sit amet.</p>
                        </div>
                    </swiper-slide>
                    <swiper-slide>
                        <img src="asset/konsul.jpg" alt="">
                        <div class="info" id="content">
                            <h4>TETS</h4>
                            <p style="color: white;">Lorem ipsum dolor sit amet.</p>
                        </div>
                    </swiper-slide>
                    
                    
                </swiper-container>
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

        <!-- CDN script -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    </body>
</html>
