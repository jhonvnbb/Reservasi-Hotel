<?php require_once "../controllerUserData.php"; ?>

<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
  $sql = "SELECT * FROM usertable WHERE email = '$email'";
  $run_Sql = mysqli_query($con, $sql);
  if($run_Sql){
      $fetch_info = mysqli_fetch_assoc($run_Sql);
      $status = $fetch_info['status'];
      $code = $fetch_info['code'];
      $pekerjaan = $fetch_info['pekerjaan'];
      $no_hp = $fetch_info['no_hp'];
      $alamat = $fetch_info['alamat'];
      $jenis_kelamin = $fetch_info['jenis_kelamin'];
      $tanggal_lahir = $fetch_info['tanggal_lahir'];
      $profile_image_path = $fetch_info['profile_image'];
      if($status == "verified"){
          if($code != 0){
              header('Location: ../reset/verify/');
          }
      }else{
          header('Location: ../signup/verify/');
      }
  }
}else{
  header('Location: ../login/');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $fetch_info['name'] ?> | Profile</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="../../assets/css/myprofile.css">
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
  </head>
  <body>
    <header>
      <div class="content flex_space">
        <div class="logo mt-3">
          <a><span>Aston </span>Serve</a>
        </div>
        <div class="navlinks mt-4">
          <ul id="menulist">
            <li><a href="../#home">home</a></li>
            <li><a href="../#about">about</a></li>
            <li><a href="../#rooms">rooms</a></li>
            <!-- <li><a href="../#review">Review</a></li> -->
            <li><a href="../#news">news</a></li>
            <li><a href="../#contact">contact</a></li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle text-success"
                href="#"
                id="navbarScrollingDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="fa fa-user"></i>
                <?php echo $fetch_info['name'] ?>
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarScrollingDropdown"
                style="background: #7fc142"
              >
                <li><a class="dropdown-item" href="./">Profile</a></li>
                <li><a class="dropdown-item" href="../pesanan/">Pesanan Saya</a></li>
                <li>
                  <a class="dropdown-item" href="../logout-user.php">Log out</a>
                </li>
              </ul>
            </li>
          </ul>
          <!-- <span class="fa fa-bars"></span> -->
        </div>
      </div>
    </header>

    <section class="profile">
      <div class="wrapper">
        <div class="sidebar">
          <div class="title">
            <h6><?php echo $fetch_info['name'] ?></h6>
            <a href="./"> <i class="fa fa-pen"></i> Edit Profile </a>
          </div>
          <div class="isi">
            <a href="./" style="color: #16a085;"> <i class="fa fa-user"></i> Akun Saya </a>
            <ul>
              <li><a href="./">Profil</a></li>
              <li><a href="../reset/">Ubah Password</a></li>
            </ul>
            <a href="../pesanan/"> <i class="fa fa-book"></i> Pesanan Saya </a>
          </div>
        </div>
        <div class="konten">
          <form action="./" method="post" enctype="multipart/form-data">
            <h2 class="mb-2" style="font-weight: 700;">Profil Saya</h2>
            <p><i style="color: #aaa;">Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</i></p>

            <div class="image">
              <img id="profileImage" src="<?php echo isset($profile_image_path) && $profile_image_path ? $profile_image_path : '../../assets/img/Logo Bisnis Perusahaan Modern Berwarna Hijau.png'; ?>" alt="logo">
              <div class="file-upload">
                <a class="btn">Pilih Gambar</a>
                <input type="file" name="profile_image" id="profile_image" accept="image/*" onchange="previewImage(event)" />
                <p>Ukuran gambar: maks. 1 MB <br> Format gambar: .JPEG, .JPG, .PNG</p>
              </div>
            </div>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $fetch_info['email'] ?>" disabled />

            <label for="name">Username</label>
            <input type="text" name="name" id="name" value="<?php echo $fetch_info['name'] ?>" required />

            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" name="pekerjaan" id="pekerjaan" value="<?php echo $fetch_info['pekerjaan'] ?>" required />

            <label for="no_hp">No Handphone</label>
            <input type="tel" name="no_hp" id="no_hp" value="<?php echo $fetch_info['no_hp'] ?>" required />

            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" value="<?php echo $fetch_info['alamat'] ?>" required />

            <label>Jenis Kelamin</label>
            <div class="gender-options">
              <input type="radio" id="male" name="jenis_kelamin" value="male" <?php echo ($fetch_info['jenis_kelamin'] == 'male') ? 'checked' : '' ?> required />
              <label for="male">Male</label>
              <input type="radio" id="female" name="jenis_kelamin" value="female" <?php echo ($fetch_info['jenis_kelamin'] == 'female') ? 'checked' : '' ?> required />
              <label for="female">Female</label>
            </div>

            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo htmlspecialchars($fetch_info['tanggal_lahir'], ENT_QUOTES); ?>" required />

            <?php
              if(count($errors) > 0){
                  foreach($errors as $error){
                      echo "<div class='alert alert-danger text-center'>$error</div>";
                  }
              }
              if(isset($_SESSION['info'])){
                  echo "<div class='alert alert-success text-center'>".$_SESSION['info']."</div>";
                  unset($_SESSION['info']);
              }
            ?>

            <button type="submit" name="update">SIMPAN</button>
          </form>
        </div>
      </div>
    </section>

    <script>
      function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('profileImage');
          output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>

    <!-- Footer Start -->
    <footer
      class="text-center text-lg-start text-light"
      style="background-color: #282834"
    >
      <div
        class="p-1"
        style="background-image: linear-gradient(#080808, #034440)"
      ></div>
      <section>
        <div
          class="container text-center text-md-start mt-5"
          style="padding: 15px 0 50px 0"
        >
          <div class="row mt-3">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Aston Serve</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #7c4dff; height: 2px"
              />
              <p class="fs-6 lh-sm">
                AstonServe adalah sebuah platform web yang memungkinkan pengguna
                untuk memesan kamar hotel di hotel Aston dengan mudah dan
                nyaman. <br /><br />
                Platform ini menawarkan pengalaman pemesanan yang mudah dengan
                berbagai fitur yang memudahkan mereka dalam memesan kamar sesuai
                preferensi mereka.
              </p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Jelajahi Kami</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #00ffee; height: 2px"
              />
              <div class="d-flex flex-column">
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Tentang Kami</a
                >
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Kebijakan Privasi</a
                >
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Kontak Media</a
                >
              </div>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold">Layanan Pelanggan</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #7c4dff; height: 2px"
              />
              <div class="d-flex flex-column">
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Bantuan</a
                >
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Garansi</a
                >
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Hubungi Kami</a
                >
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Kelola profile</a
                >
                <a
                  href="#"
                  class="text-light mb-1"
                  style="text-decoration: none"
                  >Blog</a
                >
              </div>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <h6 class="text-uppercase fw-bold">Kontak Kami</h6>
              <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #00ffee; height: 2px"
              />
              <div class="d-flex flex-column mb-3">
                <p class="text-light mb-1">Email : tinonababan3@gmail.com</p>
                <p class="text-light mb-1">Phone : +62 813-7583-9812</p>
                <p>
                  <i style="font-size: 12px; color: #aaa"
                    >&copy; 2024 jhonvnbb, coder.</i
                  >
                </p>
              </div>
              <h6 class="text-uppercase fw-bold">Ikuti Kami</h6>
              <hr
                class="mb-2 mt-0 d-inline-block mx-auto"
                style="width: 100%; background-color: #7c4dff; height: 2px"
              />
              <div
                class="social d-flex justify-content-between"
                style="width: 220px"
              >
                <a
                  href="#"
                  class="text-white rounded-1"
                  style="background-color: #1da1f2; padding: 5px 10px"
                  ><i data-feather="twitter"></i
                ></a>
                <a
                  href="https://www.youtube.com/@jhonvnababan6072"
                  class="text-white rounded-1"
                  style="background-color: #cd201f; padding: 5px 10px"
                  ><i data-feather="youtube"></i
                ></a>
                <a
                  href="https://instagram.com/jhonnvnbb?igshid=OGQ5ZDc2ODk2ZA=="
                  class="text-white rounded-1"
                  style="background-color: #3b5998; padding: 5px 10px"
                  ><i data-feather="instagram"></i
                ></a>
                <a
                  href="https://github.com/jhonvnbb"
                  class="text-white rounded-1"
                  style="background-color: #010409; padding: 5px 10px"
                  ><i data-feather="github"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </footer>
    <!-- Footer End -->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

    <script>
      feather.replace();
    </script>
  </body>
</html>
