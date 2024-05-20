<?php 

require_once "../controllerUserData.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | AstonServe</title>
    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap 5 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
      *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      body{
        background-color: #092030;
        color: #212121;
      }
      /* Navbar Start */
      .navbar{
        background-color: #fff;
        padding: 10px;
      }
      .navbar .navbar-nav{
        display: flex;
        flex-direction: row;
        margin-left: 10%;
        gap: 10px;
      }
      .navbar .navbar-nav img{
        width: 75px;
      }
      .navbar .navbar-nav h2{
        margin: auto;
      }
      .navbar .navbar-nav h2 span{
        color: #7fc142;
        letter-spacing: -1px;
        font-style: italic;
        text-shadow: 1px 2px 25px #7fc142;
      }
      /* Navbar End */
      
      /* Konten Start */
      .konten .wrapper{
        display: flex;
        align-items: center;
        height: 80vh;
        background-image: url(../../assets/img/logbg.jpg);
        background-position: top;
      }
      .konten .form{
        background: #fff;
        margin: auto;
        padding: 30px 35px;
        border-radius: 5px;
        box-shadow: 1px 2px 25px #212121;
      }
      .konten .form form .form-control{
          height: 40px;
          font-size: 15px;
      }
      .konten .form form .forget-pass{
          margin: -15px 0 15px 0;
      }
      .konten .form form .forget-pass a{
         font-size: 15px;
      }
      .konten .form form .button{
          background: #092030;
          color: #fff;
          font-size: 17px;
          font-weight: 500;
          transition: all 0.3s ease;
      }
      .konten .form form .button:hover{
          background: #6665ee;
      }
      .konten .form form .link{
          padding: 5px 0;
      }
      .konten .form form .link a{
          color: #6665ee;
      }
      .konten .login-form form p{
          font-size: 14px;
      }
      .konten .row .alert{
          font-size: 14px;
      }
      /* Konten End */

      /* Footer Start */
      /* Footer End */
    </style>
</head>
<body>
  <nav class="navbar">
    <div class="navbar-nav">
      <img src="../../assets/img/Logo Bisnis Perusahaan Modern Berwarna Hijau.png" alt="logo">
      <h2><span>AstonServe</span> Login</h2>
    </div>
  </nav>
    <section class="konten">
        <div class="wrapper">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="./index.php" method="POST">
                    <h2 class="text-center fw-bold">Login</h2>
                    <p class="text-center">Login with your email and password.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control mt-4" type="email" name="email" placeholder="Email" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group mt-4">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left mt-2"><a href="../reset/" class="text-decoration-none">Lupa password?</a></div>
                    <div class="form-group mt-3">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-muted text-center mt-2">Belum punya akun? <a href="../signup/" class="text-decoration-none">Daftar</a></div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer Start -->
    <footer
      class="text-center text-lg-start text-dark"
      style="background-color: #fff;"
    >
      <div
        class="p-1"
        style="background-image: linear-gradient(#080808, #034440);">
      </div>

      <section>
        <div class="container text-center text-md-start mt-5" style="padding:15px 0 50px 0">
          <div class="row mt-3">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Aston Serve</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #7c4dff; height: 2px"
              />
              <p class="fs-6 lh-sm">
              AstonServe adalah sebuah platform web yang memungkinkan pengguna untuk memesan kamar hotel di hotel Aston dengan mudah dan nyaman. <br><br> Platform ini menawarkan pengalaman pemesanan yang mudah  dengan berbagai fitur yang memudahkan mereka dalam memesan kamar sesuai preferensi mereka.
              </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Jelajahi Kami</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #00ffee; height: 2px"
              />
              <div class="d-flex flex-column">
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Tentang Kami</a>
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Kebijakan Privasi</a>
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Kontak Media</a>
              </div>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Layanan Pelanggan</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #7c4dff; height: 2px"
              />
              <div class="d-flex flex-column">
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Bantuan</a>
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Garansi</a>
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Hubungi Kami</a>
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Kelola profile</a>
                <a href="#" class="text-dark mb-1" style="text-decoration: none;">Blog</a>
              </div>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <h6 class="text-uppercase fw-bold">Kontak Kami</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #00ffee; height: 2px"
              />
              <div class="d-flex flex-column mb-3">
                <p class="text-dark mb-1">Email : tinonababan3@gmail.com</p>
                <p class="text-dark mb-1">Phone : +62 813-7583-9812</p>
                <p><i style="font-size: 12px; color: #aaa;">&copy; 2024 jhonvnbb, coder.</i></p> 
              </div>
              <h6 class="text-uppercase fw-bold">Ikuti Kami</h6>
              <hr
                class="mb-2 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #092030; height: 2px"
              />
              <div class="social d-flex justify-content-between" style="width: 220px;">
                <a href="#" class="text-white rounded-1" style="background-color: #1da1f2; padding:5px 10px;"><i data-feather="twitter"></i></a>
                <a href="https://www.youtube.com/@jhonvnababan6072" class="text-white rounded-1" style="background-color: #cd201f; padding: 5px 10px;"><i data-feather="youtube"></i></a>
                <a href="https://instagram.com/jhonnvnbb?igshid=OGQ5ZDc2ODk2ZA==" class="text-white rounded-1" style="background-color: #3b5998; padding: 5px 10px;"><i data-feather="instagram"></i></a>
                <a href="https://github.com/jhonvnbb" class="text-white rounded-1" style="background-color: #010409; padding: 5px 10px;"><i data-feather="github"></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </footer>
    <!-- Footer End -->

    <script>
      feather.replace();
    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

</body>
</html>