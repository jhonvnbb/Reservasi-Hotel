<?php require_once "controllerUserData.php"; ?>
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

        $total_kamar_query = "SELECT COUNT(*) as total_kamar FROM kamar";
        $total_user_query = "SELECT COUNT(*) as total_user FROM usertable";
        $total_admin_query = "SELECT COUNT(*) as total_admin FROM admin";
        $total_tersedia_query = "SELECT SUM(tersedia) as total_tersedia FROM kamar";

        $total_kamar_result = mysqli_fetch_assoc(mysqli_query($con, $total_kamar_query))['total_kamar'];
        $total_user_result = mysqli_fetch_assoc(mysqli_query($con, $total_user_query))['total_user'];
        $total_admin_result = mysqli_fetch_assoc(mysqli_query($con, $total_admin_query))['total_admin'];
        $total_tersedia_result = mysqli_fetch_assoc(mysqli_query($con, $total_tersedia_query))['total_tersedia'];

        if($status == "verified"){
            if($code != 0){
                header('Location: ../user/reset/verify/');
            }
        }else{
            header('Location: ../user/signup/verify/');
        }
    }
}else{
    header('Location: ../user/login/');
}

// Fetch room data
$room_query = "SELECT * FROM kamar";
$room_result = mysqli_query($con, $room_query);
$rooms = [];
while($row = mysqli_fetch_assoc($room_result)) {
    $rooms[] = $row;
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../assets/css/home.css" />
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
            <li><a href="#home">home</a></li>
            <li><a href="#about">about</a></li>
            <li><a href="#rooms">rooms</a></li>
            <!-- <li><a href="#review">Review</a></li> -->
            <!-- <li><a href="#news">news</a></li> -->
            <li><a href="#contact">contact</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-success" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> <?php echo $fetch_info['name'] ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="./profile/">Profile</a></li>
                <li><a class="dropdown-item" href="./pesanan/">Pesanan Saya</a></li>
                <li><a class="dropdown-item" href="./logout-user.php">Log out</a></li>
              </ul>
            </li>
          </ul>
          <!-- <span class="fa fa-bars"></span> -->
        </div>
      </div>
    </header>

    <!-- <script>
        var menulist = document.getElementById('menulist');
        menulist.style.maxHeight = "0px";

        function menutoggle(){
            if(menulist.style.maxHeight == "0px"){
                menulist.style.maxHeight = "100vh";
            } else{
                menulist.style.maxHeight = "0px";
            }
        }
    </script> -->

    <!-- Home -->
    <section class="home" id="home">
      <div class="content">
        <div class="owl-carousel owl-theme">
          <div class="item">
            <img src="../assets/img/image1.jpg" alt="room" />
            <div class="text">
              <h1>Buat Kenangan Indah</h1>
              <p>
                Inspirasi, inovasi, integritas - Aston Serve
              </p>
              <div class="flex">
                <button class="primary-btn" name="read-more" onclick="window.location.href='./#about'">READ MORE</button>
                <button class="secondary-btn" name="contact" onclick="window.location.href='./#contact'">CONTACT</button>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="../assets/img/image5.jpg" alt="room" />
            <div class="text">
              <h1>Buat Kenangan Indah</h1>
              <p>
                Inspirasi, inovasi, integritas - Aston Serve
              </p>
              <div class="flex">
                <button class="primary-btn" onclick="window.location.href='./#about'">READ MORE</button>
                <button class="secondary-btn" onclick="window.location.href='./#contact'">CONTACT</button>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="../assets/img/image7.jpg" alt="room" />
            <div class="text">
              <h1>Buat Kenangan Indah</h1>
              <p>
                Inspirasi, inovasi, integritas - Aston Serve
              </p>
              <div class="flex">
                <button class="primary-btn" onclick="window.location.href='./#about'">READ MORE</button>
                <button class="secondary-btn" onclick="window.location.href='./#contact'">CONTACT</button>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="../assets/img/b5.jpg" alt="room" />
            <div class="text">
              <h1>Buat Kenangan Indah</h1>
              <p>
                Inspirasi, inovasi, integritas - Aston Serve
              </p>
              <div class="flex">
                <button class="primary-btn" onclick="window.location.href='./#about'">READ MORE</button>
                <button class="secondary-btn" onclick="window.location.href='./#contact'">CONTACT</button>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="../assets/img/b3.jpg" alt="image1" />
            <div class="text">
              <h1>Buat Kenangan Indah</h1>
              <p>
                Inspirasi, inovasi, integritas - Aston Serve
              </p>
              <div class="flex">
                <button class="primary-btn" onclick="window.location.href='./#about'">READ MORE</button>
                <button class="secondary-btn" onclick="window.location.href='./#contact'">CONTACT</button>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="../assets/img/image8.jpg" alt="image1" />
            <div class="text">
              <h1>Buat Kenangan Indah</h1>
              <p>
                Inspirasi, inovasi, integritas - Aston Serve
              </p>
              <div class="flex">
                <button class="primary-btn" onclick="window.location.href='./#about'">READ MORE</button>
                <button class="secondary-btn" onclick="window.location.href='./#contact'">CONTACT</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
      integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
      integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <script>
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots:false,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        navText:["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
        responsive: {
          0: {
            items: 1,
          },
          768: {
            items: 1,
          },
          1000: {
            items: 1,
          },
        },
      });
    </script>

    <!-- Deskripsi -->
    <div class="col-12">
      <div
        class="card"
        style="display: flex; flex-direction: row; align-items: center; background: #efefef;"
      >
        <img
          src="../assets/img/Logo Bisnis Perusahaan Modern Berwarna Hijau.png"
          alt="Room1"
          style="
            width: 250px;
            height: 160px;
            padding-left: 50px;
            border-left: 5px solid #12785d;
            margin: 0 20px 0 50px;
          "
        />
        <div style="max-width: 750px">
          <h2>Inspirasi, inovasi, integritas - Aston Serve</h2>
          <h6>
            📍Jl. Prof. Dr. Ir. Sumantri Brojonegoro No.1, Gedong Meneng, Kec.
            Rajabasa, Kota Bandar Lampung, Lampung 35141
          </h6>
        </div>
      </div>
    </div>

    <!-- <section class="book">
      <div class="container flex_space">
        <div class="text">
          <h1><span>Book</span> Your Rooms</h1>
        </div>
        <div class="form">
          <form action="" class="grid">
            <input type="date" placeholder="Araival Date">
            <input type="date" placeholder="Departure Date">
            <input type="number" placeholder="Adults">
            <input type="number" placeholder="Children">
            <input type="submit" value="CHECK AVAILABILITY">
          </form>
        </div>
      </div>
    </section> -->

    <!-- About -->
    <section class="about top" id="about">
      <div class="container flex">
        <div class="left">
          <div class="heading">
            <h1>WELLCOME</h1>
            <h2>Aston Serve</h2>
          </div>
          <p>Aston Serve adalah sebuah Sistem Informasi (SI) yang dirancang untuk membantu pengguna
            dalam mengelola dan mengatur informasi tentang kamar yang dikelola oleh hotel. Sistem ini
            memiliki berbagai fitur yang berbeda, seperti pencarian kamar, pengaturan pengguna, dan
            laporan statistik. Pengguna dapat mengakses informasi tentang kamar, seperti harga, fasilitas,
            dan lokasi, melalui Sistem Informasi hotel.
            </p>
          <button class="primary-btn" onclick="window.location.href='./#contact'">CONTACT</button>
        </div>
        <div class="right">
          <img src="../assets/img/image3.jpg" alt="">
        </div>
      </div>
    </section>

    <!-- Counter -->
    <section class="counter top">
      <div class="container grid">
        <div class="box">
          <h1><?php echo $total_user_result; ?></h1>
          <span>Customer</span>
        </div>
        <div class="box">
          <h1><?php echo $total_tersedia_result; ?></h1>
          <span>Total Rooms</span>
        </div>
        <div class="box">
          <h1><?php echo $total_admin_result; ?></h1>
          <span>Admin</span>
        </div>
        <div class="box">
          <h1><?php echo $total_kamar_result; ?></h1>
          <span>Room Model</span>
        </div>
      </div>
    </section>

    <!-- <section class="rooms" id="rooms">
      <div class="container top">
        <div class="heading">
          <h1>EXPLORE</h1>
          <h2>Our Rooms</h2>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, odit.</p>
        </div>
        <div class="content mtop">
          <div class="owl-carousel owl-carousel1 owl-theme">
            <div class="items">
              <div class="image">
                <img src="../assets/img/image1.jpg" alt="">
              </div>
              <div class="text">
                <h2>Suite Rooms</h2>
                <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, architecto?</p>
                <div class="button flex">
                  <button class="primary-btn" onclick="window.location.href='./rooms/suite-rooms/'">BOOK NOW</button>
                  <h3>IDR 2000K <span><br>Per Malam</span></h3>
                </div>
              </div>
            </div>
            <div class="items">
              <div class="image">
                <img src="../assets/img/b1.jpg" alt="" style="height: 270px;">
              </div>
              <div class="text">
                <h2>Deluxe Rooms</h2>
                <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, architecto?</p>
                <div class="button flex">
                  <button class="primary-btn" onclick="window.location.href='./rooms/deluxe-rooms/'">BOOK NOW</button>
                  <h3>IDR 1750K <span><br>Per Malam</span></h3>
                </div>
              </div>
            </div>
            <div class="items">
              <div class="image">
                <img src="../assets/img/b2.webp" alt="" style="height: 270px;">
              </div>
              <div class="text">
                <h2>Presidential Suites</h2>
                <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, architecto?</p>
                <div class="button flex">
                  <button class="primary-btn" onclick="window.location.href='./rooms/presidential-suites/'">BOOK NOW</button>
                  <h3>IDR 3050K <span><br>Per Malam</span></h3>
                </div>
              </div>
            </div>
            <div class="items">
              <div class="image">
                <img src="../assets/img/b3.jpg" alt="">
              </div>
              <div class="text">
                <h2>Single Rooms</h2>
                <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-half"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, architecto?</p>
                <div class="button flex">
                  <button class="primary-btn" onclick="window.location.href='./rooms/single-rooms/'">BOOK NOW</button>
                  <h3>IDR 1000K <span><br>Per Malam</span></h3>
                </div>
              </div>
            </div>
            <div class="items">
              <div class="image">
                <img src="../assets/img/b4.webp" alt="" style="height: 270px;">
              </div>
              <div class="text">
                <h2>Twin Rooms</h2>
                <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, architecto?</p>
                <div class="button flex">
                  <button class="primary-btn" onclick="window.location.href='./rooms/twin-rooms/'">BOOK NOW</button>
                  <h3>IDR 1750K <span><br>Per Malam</span></h3>
                </div>
              </div>
            </div>
            <div class="items">
              <div class="image">
                <img src="../assets/img/b6.jpg" alt="" style="height: 270px;">
              </div>
              <div class="text">
                <h2>Junior Suites</h2>
                <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, architecto?</p>
                <div class="button flex">
                  <button class="primary-btn" onclick="window.location.href='./rooms/junior-suites/'">BOOK NOW</button>
                  <h3>IDR 2050K <span><br>Per Malam</span></h3>
                </div>
              </div>
            </div>
            <div class="items">
              <div class="image">
                <img src="../assets/img/b5.jpg" alt="" style="height: 270px;">
              </div>
              <div class="text">
                <h2>Suite Royal</h2>
                <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, architecto?</p>
                <div class="button flex">
                  <button class="primary-btn" onclick="window.location.href='./rooms/suite-royal'">BOOK NOW</button>
                  <h3>IDR 5000K <span><br>Per Malam</span></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- Rooms -->
    <section class="rooms" id="rooms">
        <div class="container top">
            <div class="heading">
                <h1>EXPLORE</h1>
                <h2>Our Rooms</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, odit.</p>
            </div>
            <div class="content mtop">
                <div class="owl-carousel owl-carousel1 owl-theme">
                    <?php foreach($rooms as $room): ?>
                    <div class="items">
                        <div class="image">
                          <img src="<?php echo '../admin/upload-barang/' . basename($room['gambar']); ?>" alt="<?php echo $room['model']; ?>" style="height: 270px;">
                        </div>
                        <div class="text">
                            <h2><?php echo $room['model']; ?></h2>
                            <div class="rate flex">
                                <?php 
                                $rating = rand(3, 5); // Random Rating Star
                                for($i = 0; $i < $rating; $i++) {
                                    echo '<i class="fa fa-star"></i>';
                                }
                                if($rating < 5) {
                                    echo '<i class="fa fa-star-half"></i>';
                                }
                                ?>
                            </div>
                            <p><?php echo substr($room['deskripsi'], 0, 100) . '...'; ?></p>
                            <div class="button flex">
                                <button class="primary-btn" onclick="showRoomDetail(<?php echo $room['id']; ?>)">BOOK NOW</button>
                                <h3>IDR <?php echo number_format($room['harga']/1000, 0, ',', '.'); ?>K <span><br>Per Malam</span></h3>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <script>
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 40,
        nav: true,
        dots:false,
        navText:["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
        responsive: {
          0: {
            items: 1,
          },
          768: {
            items: 2,
            margin:10,
          },
          1000: {
            items: 3,
          },
        },
      });

      function showRoomDetail(roomId) {
          window.location.href = './rooms/?id=' + roomId;
      }
    </script>

    <!-- Galery -->
    <section class="gallery">
      <div class="container top">
        <div class="heading">
          <h1>PHOTOS</h1>
          <h2>Our Gallery</h2>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis, odio!</p>
        </div>
      </div>  
      <div class="content mtop">
        <div class="owl-carousel owl-carousel1 owl-theme">
          <div class="items">
            <div class="img">
              <img src="../assets/img/image1.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>  
          <div class="items">
            <div class="img">
              <img src="../assets/img/b1.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/b2.webp" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/b3.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/b4.webp" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/b5.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/b6.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image2.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image3.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image4.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image5.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image6.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image7.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image8.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/logbg.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/Logo Bisnis Perusahaan Modern Berwarna Hijau.png" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image11.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image10.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image12.jpeg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image13.jpeg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image14.webp" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image15.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image16.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
          <div class="items">
            <div class="img">
              <img src="../assets/img/image9.jpg" alt="" style="height: 170px;">
            </div>
            <div class="overlay">
              <!-- <span class="fa fa-plus"></span> -->
              <h3>AstonServe.</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots:false,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        navText:["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
        responsive: {
          0: {
            items: 1,
          },
          768: {
            items: 4,
          },
          1000: {
            items: 6,
          },
        },
      });
    </script>

    <!-- Fasilitas -->
    <section class="facilities top">
      <div class="container">
        <div class="heading">
          <h1>FACILITIES</h1>
          <h2>Our Facility</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, nisi!</p>
        </div>
        <div class="content flex_space">
          <div class="left grid2">
            <div class="box">
              <div class="text">
                <i class="fa-solid fa-utensils"></i>
                <h3>Delicious Food</h3>
              </div>
            </div>
            <div class="box">
              <div class="text">
                <i class="fa-solid fa-person-biking"></i>
                <h3>Bicycle Track</h3>
              </div>
            </div>
            <div class="box">
              <div class="text">
                <i class="fa-solid fa-dumbbell"></i>
                <h3>Fitness</h3>
              </div>
            </div>
            <div class="box">
              <div class="text">
                <i class="fa-solid fa-poo"></i>
                <h3>Swimming Pool</h3>
              </div>
            </div>
          </div>
          <div class="right">
            <img src="../assets/img/image11.jpg" alt="">
          </div>
        </div>
      </div>
    </section>

    <!-- <section class="Customer top" id="review">
      <div class="container">
        <div class="owl-carousel owl-carousel2 owl-theme">
          <div class="item">
            <i class="fa-solid fa-quote-right"></i>
            <p>"Pengalaman menginap di hotel ini sungguh luar biasa, dengan pemandangan yang memukau dan pelayanan yang ramah serta profesional."</p>
            <h3>Nadya Maharani</h3>
            <label for="">Nadya Maharani</label>
          </div>
          <div class="item">
            <i class="fa-solid fa-quote-right"></i>
            <p>"Kamar-kamar yang luas dan nyaman dilengkapi dengan fasilitas modern, menciptakan suasana istirahat yang sempurna bagi tamu."</p>
            <h3>Jhon V Nababan</h3>
            <label for="">Jhon V Nababan</label>
          </div>
          <div class="item">
            <i class="fa-solid fa-quote-right"></i>
            <p>"Selain itu, restoran di hotel ini menyajikan hidangan lezat dengan berbagai pilihan menu yang memanjakan lidah."<p>
            <h3>Muhammad Hafizh Taufiqurrohamn </h3>
            <label for="">Muhammad Hafizh Taufiqurrohamn</label>
          </div>
          <div class="item">
            <i class="fa-solid fa-quote-right"></i>
            <p>"Dengan lokasi yang strategis dan akses mudah ke tempat-tempat wisata terkenal, hotel ini menjadi pilihan utama untuk liburan yang tak terlupakan."<p>
            <h3>Riziq Ashidiqi</h3>
            <label for="">Riziq Ashidiqi</label>
          </div>
        </div>
      </div>
    </section> -->

    <!-- <script>
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots:true,
        responsive: {
          0: {
            items: 1,
          },
          768: {
            items: 1,
          },
          1000: {
            items: 1,
          },
        },
      });
    </script> -->

    <!-- <section class="news top rooms" id="news">
      <div class="container">
        <div class="heading">
          <h1>NEWS</h1>
          <h2>Our News</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, cumque?</p>
        </div>
        <div class="content flex">
          <div class="left grid2">
            <div class="items">
              <div class="image">
                <img src="../assets/img/image12.jpeg" alt="">
              </div>
              <div class="text">
                <h2>Tim Nasional U23</h2>
              </div>
              <div class="admin flex">
                <i class="fa fa-user"></i>
                <label for="">Aston Serve</label>
                <i class="fa fa-heart"></i>
                <label for="">12301</label>
                <i class="fa fa-comments"></i>
              </div>
              <p>"Hotel ini selalu menjadi pilihan utama untuk menginap pemain timnas U23 setiap akan melakoni laga melawan Badak Lampung karena menawarkan fasilitas dan layanan yang memenuhi standar kebutuhan atlet profesional."</p>
            </div>
            <div class="items">
              <div class="image">
                <img src="../assets/img/image13.jpeg" alt="" style="height: 270px;">
              </div>
              <div class="text">
                <h2>Presiden Joko Widodo</h2>
              </div>
              <div class="admin flex">
                <i class="fa fa-user"></i>
                <label for="">Aston Serve</label>
                <i class="fa fa-heart"></i>
                <label for="">198076</label>
                <i class="fa fa-comments"></i>
              </div>
              <p>Presiden Jokowi bersama rombongan menginap di salah satu hotel di Bandar Lampung yaitu Hotel Aston sebelum mengunjungi Universitas Lampung terkait korupsi yang dilakukan oleh rektor dari kampus tersebut. </p>
            </div>
          </div>
          <div class="right">
            <div class="box flex">
              <div class="img">
                <img src="../assets/img/image14.webp" alt="">
              </div>
              <div class="stext">
                <h2>Hari Natal</h2>
                <p>Menjelang Natal 2024 Hotel Aston memberikan diskon 30% per malam bagi para pelanggannya.</p>
              </div>
            </div>
            <div class="box flex">
              <div class="img">
                <img src="../assets/img/image15.jpg" alt="">
              </div>
              <div class="stext">
                <h2>Presiden Aston</h2>
                <p>Bapak Rifqi Bili selaku pemilik Aston dinyatakan tewas setelah mabok berat.</p>
              </div>
            </div>
            <div class="box flex">
              <div class="img">
                <img src="../assets/img/image16.jpg" alt="">
              </div>
              <div class="stext">
                <h2>Halloween</h2>
                <p>Simpan tanggalnya! 19 Mei 2024. Hotel Aston akan mengadakan party kecil-kecilan dalam merayakan hari Halloween</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <!-- Kontak -->
    <section class="kontak" id="contact">
      <div class="konten">
        <div class="deskripsi">
          <h2><span>Contact</span> Us</h2>
          <p>
            Ayo kita gabungkan keahlian kita dalam proyek dan ciptakan
            sesuatu yang luar biasa bersama! Tertarik? Silahkan hubungi kami.
          </p>
        </div>
        <form action="#" onsubmit="sendMessageToWhatsapp()">
          <input id="nama" type="text" placeholder="your name" required />
          <input id="email" type="email" placeholder="your email" required />
          <textarea id="message" placeholder="Message" required></textarea>
          <button type="submit" class="submit">SEND MESSAGE</button>
        </form>
      </div>
    </section>

    <script>
      function sendMessageToWhatsapp() {
        const messageText = 
        ` Nama: ${nama.value}
          Email: ${email.value}
          Pesan: ${message.value} `;
        const urlToWhatsapp = `https://wa.me/6281375839812?text=${encodeURIComponent(messageText)}`;
        window.open(urlToWhatsapp, "_blank");
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
