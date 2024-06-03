<?php require_once "../controller-data.php"; ?>

<?php 
  $username = $_SESSION['username'];

  if($username != false && isset($_SESSION['username'])){
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $username = $fetch_info['username'];
    }
  }else{
    header('Location: ../');
  }

  $sql = "SELECT * FROM pesanan";
    $result = mysqli_query($con, $sql);

    if(!$result) {
        echo "Error fetching data: " . mysqli_error($con);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstonServe</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/pesanan-admin.css">

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
        <a href="../dashboard/" class="link">
          <img src="../../assets/svg/dashboard.svg" alt="">
          <span class="hidden">Dashboard</span>
        </a>
        <a href="../kamar/" class="link">
          <img src="../../assets/svg/kamar.svg" alt="">
          <span class="hidden">Kamar</span>
        </a>
        <a class="link active">
          <img src="../../assets/svg/pesanan.svg" alt="">
          <span class="hidden">Pesanan</span>
        </a>
        <a href="../user/" class="link">
          <img src="../../assets/svg/user.svg" alt="">
          <span class="hidden">User</span>
        </a>
      </div>

      <div class="sidebar-bottom">
        <div class="sidebar-links">
          <a class="link">
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
            <a href="../dashboard/">Dashboard</a>
            <a href="../kamar/">Kamar</a>
            <a href="../user/">User</a>
            <a href="#" onclick="return confirmLogout()" style="color: #c90101"><i class="fas fa-lock" style="margin-right: 5px;"></i>Logout</a>
          </div>
        </div>
      </header>

      <section class="content">
        <h2>Daftar Pesanan</h2>
        <table class="booking-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Room</th>
              <th>Check-in Date</th>
              <th>Check-out Date</th>
              <th>Total Price</th>
              <th>Payment Proof</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['no_hp']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['kamar']; ?></td>
                <td><?php echo $row['tanggal_checkin']; ?></td>
                <td><?php echo $row['tanggal_checkout']; ?></td>
                <td><?php echo $row['total_harga']; ?></td>
                <td><a href="<?php echo '../../user/upload-bayar/' . $row['bukti_bayar']; ?>" target="_blank">Lihat Bukti Bayar</a></td>
                <td class="<?php 
                  if ($row['status'] === 'PESANAN DIVERIFIKASI') {
                    echo 'verified';
                  } elseif ($row['status'] === 'PESANAN DITOLAK') {
                    echo 'rejected';
                  }
                ?>">
                  <span class="status-text"><?php echo $row['status']; ?></span>
                  <button class="edit-icon-btn" onclick="openEditModal('<?php echo $row['id']; ?>')">
                    <i class="fas fa-edit edit-icon"></i>
                  </button>
                </td>

              </tr>
            <?php } ?>
          </tbody>
        </table>

        <footer>
        <div class="social-icons">
            <a href="https://github.com/jhonvnbb" target="_blank"><i class="fab fa-github"></i></a>
            <a href="https://www.youtube.com/channel/UCML2M8j1wTcXTP8D0mHPhgw" target="_blank"><i class="fab fa-youtube"></i></a>
            <a href="https://www.instagram.com/jhonnvnbb" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2024 <span>Aston Serve</span>. All Rights Reserved.</p>
      </footer>
    </section>

    <!-- Edit Status -->
    <div id="editModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Status Pesanan</h2>
        <form action="./" method="POST" class="edit-form">
          <input type="hidden" id="editId" name="id" value="">
          <label for="status">Status:</label>
          <select id="status" name="status">
            <option value="PESANAN DITOLAK">PESANAN DITOLAK</option>
            <option value="PESANAN DIVERIFIKASI">PESANAN DIVERIFIKASI</option>
          </select>
          <button type="submit" class="save-btn" name="edit_status">Simpan</button>
        </form>
      </div>
    </div>

    <script>
        var modal = document.getElementById('editModal');
        var btn = document.getElementsByClassName("edit-icon-btn");
        var span = document.getElementsByClassName("close")[0];

        function openEditModal(id) {
          modal.style.display = "block";
          document.getElementById('editId').value = id;
        }

        function closeEditModal() {
          modal.style.display = "none";
        }

        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
    </script>


    <!-- Log out -->
    <script>
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