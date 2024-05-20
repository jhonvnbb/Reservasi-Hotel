<?php require_once "../../controllerUserData.php"; ?>
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
        $no_hp = $fetch_info['no_hp'];
        $alamat = $fetch_info['alamat'];
        if($status == "verified"){
            if($code != 0){
                header('Location: ../../user/reset/verify/');
            }
        }else{
            header('Location: ../../user/signup/verify/');
        }
    }
}else{
    header('Location: ../../user/login/');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $fetch_info['name'] ?> | Twin-Rooms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../../../assets/css/room.css" />
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

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
      integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
      integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <script
      src="https://code.jquery.com/jquery-1.12.4.min.js"
      integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
      crossorigin="anonymous"
    ></script>
    
  </head>
  <body>
    <header>
      <div class="content flex_space">
        <div class="logo mt-3">
          <a><span>Aston </span>Serve</a>
        </div>
        <div class="navlinks mt-4">
          <ul id="menulist">
            <li><a href="../../#home">home</a></li>
            <li><a href="../../#about">about</a></li>
            <li><a href="../../#rooms">rooms</a></li>
            <!-- <li><a href="#review">Review</a></li> -->
            <li><a href="../../#news">news</a></li>
            <li><a href="../../#contact">contact</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-success" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> <?php echo $fetch_info['name'] ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="../../profile/">Profile</a></li>
                <li><a class="dropdown-item" href="../../pesanan/">Pesanan Saya</a></li>
                <li><a class="dropdown-item" href="../../logout-user.php">Log out</a></li>
              </ul>
            </li>
          </ul>
          <!-- <span class="fa fa-bars"></span> -->
        </div>
      </div>
    </header>

    <section class="rooms">
    <div class="wrapper">
        <div class="konten">
            <img src="../../../assets/img/b4.webp" alt="suite-rooms">
            <div class="about-rooms">
                <h2>Twin Rooms</h2>
                <div class="deskripsi">
                    <h5>Deskripsi</h5>
                    <p>Kamar twin berisi dua tempat tidur dalam satu ruangan, perbedaannya berkaitan dengan ukuran tempat tidur dan jumlah tamu yang dapat menginap di kamar tersebut. Kamar twin berisi dua tempat tidur single, sehingga diperuntukkan bagi maksimal dua tamu. Namun, kamar double dapat menampung hingga empat orang karena berisi dua tempat tidur berukuran double. Keduanya berisi semua akomodasi dasar yang Anda harapkan temukan di kamar hotel. Kamar seringkali lebih baik bagi mereka yang bepergian dengan teman atau mitra bisnis, dan kamar twin lebih baik untuk keluarga dengan satu atau dua anak kecil atau kelompok lain dengan 3-4 orang yang bepergian bersama.</p>
                    <div class="rate">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="fasilitas">
                  <h5>Fasilitas</h5>
                    <ul>
                        <li>2 Kamar Tidur</li>
                        <li>Area Duduk</li>
                        <li>Akses Fasilitas Hotel</li>
                        <li>Fasilitas Tambahan</li>
                        <li>Mini Bar</li>
                    </ul>
                </div>
                <div class="harga">
                    <h3>Rp.1.750.000,00 <br> <span>/ Per Malam</span></h3>
                </div>
            </div>
        </div>
        <div class="book">
            <form action="" method="">
                <h2>AstonServe Payment</h2>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $fetch_info['email'] ?>" disabled>

                <label for="name">Username</label>
                <input type="text" name="name" id="name" value="<?php echo $fetch_info['name'] ?>" disabled>

                <label for="no_hp">No Handphone</label>
                <input type="text" name="no_hp" id="no_hp" value="<?php echo $fetch_info['no_hp'] ?>" disabled>
                
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="<?php echo $fetch_info['alamat'] ?>" disabled>

                <label for="kamar">Kamar</label>
                <input type="text" name="kamar" id="kamar" value="Twin-Rooms" disabled>

                <label for="tanggal_checkin">Tanggal Check In</label>
                <input type="date" name="tanggal_checkin" id="tanggal_checkin" required onchange="calculatePrice()">

                <label for="tanggal_checkout">Tanggal Check Out</label>
                <input type="date" name="tanggal_checkout" id="tanggal_checkout" required onchange="calculatePrice()">

                <div class="total-harga">
                    <h3>Total Harga: <br> <span id="total-harga">---</span></h3>
                </div>

                <button type="submit" name="pesan">Pesan Sekarang</button>
            </form>
        </div>
    </div>
</section>

<script>
    function calculatePrice() {
        const checkin = document.getElementById('tanggal_checkin').value;
        const checkout = document.getElementById('tanggal_checkout').value;
        const pricePerNight = 1750000;

        if (checkin && checkout) {
            const checkinDate = new Date(checkin);
            const checkoutDate = new Date(checkout);
            const timeDiff = checkoutDate - checkinDate;
            const dayDiff = timeDiff / (1000 * 3600 * 24);

            if (dayDiff > 0) {
                const totalPrice = dayDiff * pricePerNight;
                document.getElementById('total-harga').textContent = `Rp.${totalPrice.toLocaleString('id-ID')},00`;
            } else {
                document.getElementById('total-harga').textContent = "Tanggal tidak valid";
            }
        }
    }
</script>

    <!-- Footer Start -->
    <footer
      class="text-center text-lg-start text-light"
      style="background-color: #282834;"
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
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Tentang Kami</a>
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Kebijakan Privasi</a>
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Kontak Media</a>
                </div>
              </div>
  
              <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold">Layanan Pelanggan</h6>
                <hr
                  class="mb-4 mt-0 d-inline-block mx-auto"
                  style="width: 100%; background-color: #7c4dff; height: 2px"
                />
                <div class="d-flex flex-column">
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Bantuan</a>
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Garansi</a>
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Hubungi Kami</a>
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Kelola profile</a>
                  <a href="#" class="text-light mb-1" style="text-decoration: none;">Blog</a>
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
                  <p><i style="font-size: 12px; color: #aaa;">&copy; 2024 jhonvnbb, coder.</i></p> 
                </div>
                <h6 class="text-uppercase fw-bold">Ikuti Kami</h6>
                <hr
                  class="mb-2 mt-0 d-inline-block mx-auto"
                  style="width: 100%; background-color: #7c4dff; height: 2px"
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