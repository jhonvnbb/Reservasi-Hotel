<?php require_once "../controller-data.php"; ?>

<?php 
  $username = $_SESSION['username'];

  if($username != false && isset($_SESSION['username'])){
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $username = $fetch_info['username'];

        $total_kamar_query = "SELECT COUNT(*) as total_kamar FROM kamar";
        $total_user_query = "SELECT COUNT(*) as total_user FROM usertable";
        $total_admin_query = "SELECT COUNT(*) as total_admin FROM admin";
        $total_pesanan_query = "SELECT COUNT(*) as total_pesanan FROM pesanan";
        $total_tersedia_query = "SELECT SUM(tersedia) as total_tersedia FROM kamar";
        $total_pesananDiverifikasi_query = "SELECT COUNT(*) as total_pesanan_diverifikasi FROM pesanan WHERE status = 'PESANAN DIVERIFIKASI'";

        $total_kamar_result = mysqli_fetch_assoc(mysqli_query($con, $total_kamar_query))['total_kamar'];
        $total_user_result = mysqli_fetch_assoc(mysqli_query($con, $total_user_query))['total_user'];
        $total_admin_result = mysqli_fetch_assoc(mysqli_query($con, $total_admin_query))['total_admin'];
        $total_pesanan_result = mysqli_fetch_assoc(mysqli_query($con, $total_pesanan_query))['total_pesanan'];
        $total_tersedia_result = mysqli_fetch_assoc(mysqli_query($con, $total_tersedia_query))['total_tersedia'];
        $total_pesananDiverifikasi_result = mysqli_fetch_assoc(mysqli_query($con, $total_pesananDiverifikasi_query))['total_pesanan_diverifikasi'];

    }
  }else{
    header('Location: ../');
  }
?>

<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstonServe</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <!-- JS -->
    <script src="../../assets/js/script.js" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
     integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
     crossorigin="anonymous" referrerpolicy="no-referrer" 
    />

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      .popup-settings {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        left: 6.6%; /* Adjust this value based on your layout */
        bottom: 17%; /* Adjust this value based on your layout */
      }

      .popup-settings a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }

      .popup-settings a:hover {
        background-color: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <nav>
      <div class="sidebar-header">
        <a class="logo-wrapper">
          <img src="../../assets/img/Logo Bisnis Perusahaan Modern Berwarna Hijau.png" alt="">
          <h2 class="hidden">AstonServe</h2>
        </a>
        <button class="toggle-btn">
          <img src="../../assets/svg/expand.svg" alt="">
        </button>
      </div>

      <div class="sidebar-links">
        <a class="link active">
          <img src="../../assets/svg/dashboard.svg" alt="">
          <span class="hidden">Dashboard</span>
        </a>
        <a href="../kamar/" class="link">
          <img src="../../assets/svg/kamar.svg" alt="">
          <span class="hidden">Kamar</span>
        </a>
        <a href="../pesanan/" class="link">
          <img src="../../assets/svg/pesanan.svg" alt="">
          <span class="hidden">Pesanan</span>
        </a>
        </li>
        <a href="../user/" class="link">
          <img src="../../assets/svg/user.svg" alt="">
          <span class="hidden">User</span>
        </a>
      </div>

      <div class="sidebar-bottom">
        <div class="sidebar-links">
          <a class="link" id="settings-link">
            <img src="../../assets/svg/settings.svg" alt="">
            <span class="hidden">Settings</span>
          </a>
        </div>

        <div class="admin-profile">
          <div class="admin-avatar">
            <img src="../../assets/img/admin.png" alt="">
          </div>
          <div class="admin-details hidden">
            <p class="username"><?php echo $fetch_info['username'] ?></p>
            <p class="copyright">&copy; 2024 jhonvnbb.coder</p>
          </div>
        </div>
      </div>
    </nav>

    <div class="main-content">
      <header>
        <div class="dropdown" style="float: right; margin: 10px;">
          <button class="dropbtn"><i class="fas fa-user" style="padding-right: 10px;"></i><?php echo $fetch_info['username'] ?></button>
          <div class="dropdown-content">
            <a href="../kamar/">Kamar</a>
            <a href="../pesanan/">Pesanan</a>
            <a href="../user/">User</a>
          </div>
        </div>
      </header>

      <div class="dashboard">
        <div class="dashboard-desk">
          <h1>Dashboard</h1>
          <p>Welcome! <span>AstonServe Admin</span></p>
        </div>
        <div class="dashboard-card">
            <div class="icon"><i class="fas fa-box"></i></div>
            <h3>Total Model Kamar</h3>
            <p><?php echo $total_kamar_result; ?></p>
        </div>
        <div class="dashboard-card">
            <div class="icon"><i class="fas fa-users"></i></div>
            <h3>Total User</h3>
            <p><?php echo $total_user_result; ?></p>
        </div>
        <div class="dashboard-card">
            <div class="icon"><i class="fas fa-cart-plus"></i></div>
            <h3>Total Pesanan Diverifikasi</h3>
            <p><?php echo $total_pesananDiverifikasi_result; ?></p>
        </div>
        <div class="dashboard-card">
            <div class="icon"><i class="fas fa-shopping-cart"></i></div>
            <h3>Total Pesanan</h3>
            <p><?php echo $total_pesanan_result; ?></p>
        </div>
        <div class="dashboard-card">
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <h3>Total Admin</h3>
            <p><?php echo $total_admin_result; ?></p>
        </div>
        <div class="dashboard-card">
        <div class="icon"><i class="fas fa-boxes-packing"></i></div>
          <h3>Total Kamar Tersedia</h3>
          <p><?php echo $total_tersedia_result; ?></p>
        </div>
      </div>

      <footer>
        <div class="social-icons">
            <a href="https://github.com/jhonvnbb" target="_blank"><i class="fab fa-github"></i></a>
            <a href="https://www.youtube.com/channel/UCML2M8j1wTcXTP8D0mHPhgw" target="_blank"><i class="fab fa-youtube"></i></a>
            <a href="https://www.instagram.com/jhonnvnbb" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2024 <span>Aston Serve</span>. All Rights Reserved.</p>
      </footer>
    </div>

    <div class="popup-settings" id="settings-popup">
      <a href="#" onclick="return confirmLogout()" style="color: #c90101"><i class="fas fa-lock" style="margin-right: 5px;"></i>Logout</a>
    </div>

    <script>
      const settingsLink = document.getElementById('settings-link');
      const settingsPopup = document.getElementById('settings-popup');

      settingsLink.addEventListener('click', function(event) {
        event.stopPropagation();
        settingsPopup.style.display = settingsPopup.style.display === 'block' ? 'none' : 'block';
      });

      document.addEventListener('click', function(event) {
        if (!settingsPopup.contains(event.target) && event.target !== settingsLink) {
          settingsPopup.style.display = 'none';
        }
      });

      function confirmLogout() {
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Anda akan keluar dari sesi ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, keluar!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "../logout.php";
          }
        });
        return false;
      }
    </script>
  </body>
</html>
