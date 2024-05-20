<?php require_once "../controllerUserData.php"; ?>

<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if($email != false && $password != false){
  $sql = "SELECT * FROM usertable WHERE email = '$email'";
  $sql1 = "SELECT * FROM pesanan WHERE email = '$email'";
  $run_Sql = mysqli_query($con, $sql);
  $run_Sql1 = mysqli_query($con, $sql1);

  if($run_Sql && $run_Sql1){
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

      // Mengambil data pesanan
      $pesanan = [];
      while($row = mysqli_fetch_assoc($run_Sql1)) {
          $pesanan[] = $row;
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
    <title><?php echo $fetch_info['name'] ?> | Pesanan</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="../../assets/css/pesan.css">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                <li><a class="dropdown-item" href="../profile/">Profile</a></li>
                <li><a class="dropdown-item" href="./">Pesanan Saya</a></li>
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

    <section class="pesanan">
    <div class="wrapper">
        <div class="sidebar">
            <div class="title">
                <h6><?php echo $fetch_info['name']; ?></h6>
                <a href="./"><i class="fa fa-pen"></i> Pesanan Saya</a>
            </div>
            <div class="isi">
                <a href="../profile/"><i class="fa fa-user"></i> Akun Saya</a>
                <a href="./" style="color: #16a085;"><i class="fa fa-book"></i> Pesanan Saya</a>
            </div>
        </div>
        <div class="konten">
            <div class="ticket">
                <div class="ticket-header">
                    <img src="<?php echo isset($profile_image_path) && $profile_image_path ? $profile_image_path : '../../assets/img/Logo Bisnis Perusahaan Modern Berwarna Hijau.png'; ?>" alt="Profile Image" width="150">
                    <div class="ticket-info">
                        <h5><?php echo $fetch_info['name']; ?></h5>
                        <p>Email: <?php echo $fetch_info['email']; ?></p>
                        <p>Nomor HP: <?php echo $fetch_info['no_hp']; ?></p>
                        <p>Alamat: <?php echo $fetch_info['alamat']; ?></p>
                    </div>
                </div>
                <div class="ticket-body">

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

                    <h4>Daftar Pesanan</h4>
                    <?php if(count($pesanan) > 0): ?>
                        <?php foreach($pesanan as $item): ?>
                          <hr>
                          <hr>
                            <form action="./" method="post" enctype="multipart/form-data">
                                <div class="pesanan-item">
                                    <p>Kamar : <span><?php echo $item['kamar']; ?></span></p>
                                    <p>Tanggal Check-In : <span><?php echo $item['tanggal_checkin']; ?></span> </p>
                                    <p>Tanggal Check-Out : <span><?php echo $item['tanggal_checkout']; ?></span></p>
                                    <p class="harga">Total Harga : <br> <span><?php echo $item['total_harga']; ?></span></p>
                                    <hr>
                                </div>
                                <div class="mb-3">
                                    <label for="bukti_bayar_<?php echo $item['id']; ?>" class="form-label">Upload Bukti Pembayaran:</label>
                                    <input type="file" class="form-control" id="bukti_bayar_<?php echo $item['id']; ?>" name="bukti_bayar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status_<?php echo $item['id']; ?>" class="form-label">Status:</label>
                                    <input type="text" class="form-control" id="status_<?php echo $item['id']; ?>" name="status" value="<?php echo $item['status']; ?>" readonly>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" name="bayar">PAY NOW</button>
                                </div>
                            </form>
                            <form action="./" method="post">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="button" class="btn btn-cancel" style="background-color: #cd201f; transition: all 0.5s; color:#fff" onclick="confirmCancellation('<?php echo $item['id']; ?>')">Batal Pesan</button>
                            </form>
                            <hr>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada pesanan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
  function confirmCancellation(orderId) {
      Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Pesanan ini akan dibatalkan.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, batalkan!',
          cancelButtonText: 'Tidak, lanjutkan!'
      }).then((result) => {
          if (result.isConfirmed) {
              var form = document.createElement("form");
              form.method = "post";
              form.action = "./";

              var inputId = document.createElement("input");
              inputId.type = "hidden";
              inputId.name = "id";
              inputId.value = orderId;

              var inputBatal = document.createElement("input");
              inputBatal.type = "hidden";
              inputBatal.name = "batal";
              inputBatal.value = true;

              form.appendChild(inputId);
              form.appendChild(inputBatal);
              document.body.appendChild(form);
              form.submit();
          }
      });
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

    <script src="sweetalert2.all.min.js"></script>

    <script>
      feather.replace();
    </script>
  </body>
</html>
