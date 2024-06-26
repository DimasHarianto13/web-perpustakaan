<?php 

require 'koneksi.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$buku = "SELECT nama_buku, pengarang, penerbit,thn_terbit, gambar FROM buku";
$result = $conn->query($buku);


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Perpustakaan</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets-lp/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets-lp/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Perpustakaan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Daftar Buku</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                       
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To Perpustakaan!</div>
                <br><br>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Get Start</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
            <div class="text-center">
                    <h2 class="section-heading text-uppercase">Daftar Buku</h2>
                    <h3 class="section-subheading text-muted">sekumpulan daftar buku</h3>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                if ($i % 3 == 0) {
                                    if ($i == 0) {
                                        echo '<div class="carousel-item active">';
                                    } else {
                                        echo '<div class="carousel-item">';
                                    }
                                    echo '<div class="row justify-content-center">';
                                }
                                echo '<div class="col-md-4">';
                                echo '<div class="card border-0 shadow rounded-3 p-3">';
                                echo '<img src="img/' . $row["gambar"] . '" class="card-img-top" alt="..." style="height: 300px; width: 300px; object-fit: cover;">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title text-warning"><strong>' . $row["nama_buku"] . '</strong></h5><br>';
                                echo '<p class="card-text"> ' . $row["pengarang"] . '</p>';
                                echo '<p class="card-text"></i> ' . $row["penerbit"] . '</p>';
                                echo '<p class="card-text">' . $row["thn_terbit"] . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                $i++;
                                if ($i % 3 == 0) {
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                            if ($i % 3 != 0) {
                                echo '</div>';
                                echo '</div>';
                            }
        
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>


        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tentang Perpustakaan</h2>
                    <h3 class="section-subheading text-muted">sedikit tentang Perpustakaan yang kami berikan</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets-lp/img/about/1.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Tentang Perpustakaan</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Perpustakaan  adalah tempat di mana imajinasi bertemu dengan pengetahuan. Kami berkomitmen untuk menyediakan sumber daya yang mendukung pembelajaran siswa, baik untuk keperluan akademis maupun pengembangan pribadi. Dengan koleksi buku, majalah, dan materi digital yang terus diperbarui, serta berbagai kegiatan menarik seperti klub buku dan workshop kreatif, kami bertujuan untuk menjadi pusat inspirasi dan
                                 inovasi bagi seluruh siswa. Mari jelajahi dunia pengetahuan bersama kami!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets-lp/img/about/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Misi Kami</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Misi kami adalah untuk mendukung kebutuhan pendidikan, budaya, dan rekreasi komunitas kami dengan menyediakan akses ke beragam materi dan program. Kami berupaya menumbuhkan
                                 kecintaan membaca dan pembelajaran seumur hidup dalam ruang yang aman dan inklusif.</p></div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Dimas Harianto | 2024</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
       
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets-lp/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
