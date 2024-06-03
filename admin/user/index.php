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

  $sql = "SELECT * FROM usertable";
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
    <link rel="stylesheet" href="../../assets/css/kamar-admin.css">

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

    <!-- Mark JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js" integrity="sha512-5CYOlHXGh6QpOFA/TeTylKLWfB3ftPsde7AnmhuitiTX4K5SqCLBeKro6sPS8ilsz1Q4NRx3v8Ko2IBiszzdww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .highlight {
            background-color: yellow;
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
        <a href="../dashboard/" class="link">
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
        <a class="link active">
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
            <a href="../pesanan/">Pesanan</a>
            <a href="#" onclick="return confirmLogout()" style="color: #c90101"><i class="fas fa-lock" style="margin-right: 5px;"></i>Logout</a>
          </div>
        </div>
      </header>

      <section id="barang" class="barang">
            <div class="header-barang">
                <h1>Daftar User</h1>
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Cari user...">
                    <button id="searchBtn" onclick="searchUser()"><i class="fas fa-search"></i> Search</button>
                </div>
            </div>

            <!-- Edit User -->
            <div id="editUser" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditUser()">&times;</span>
                    <h2>Edit User</h2>
                    <hr>
                    <form action="./" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_name">Nama :</label>
                            <input type="text" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email :</label>
                            <input type="email" id="edit_email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_pekerjaan">Pekerjaan :</label>
                            <input type="text" id="edit_pekerjaan" name="pekerjaan" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_no_hp">No HP :</label>
                            <input type="text" id="edit_no_hp" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_alamat">Alamat :</label>
                            <input type="text" id="edit_alamat" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_jenis_kelamin">Jenis Kelamin :</label>
                            <select id="edit_jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_tanggal_lahir">Tanggal Lahir :</label>
                            <input type="date" id="edit_tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_profile_image">Profile Image:</label>
                            <input type="file" id="edit_profile_image" name="profile_image" onchange="previewEditImage(event)" hidden>
                            <img id="preview_edit_gambar" class="table-img" src="#" alt="Preview Image" style="display: none;" hidden>
                            <img id="current_profile_image" class="table-img" src="#" alt="Current Image" style="display: none;">
                        </div>
                        <button type="submit" name="edit-user" class="btn-submit">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pekerjaan</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Profile Image</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['pekerjaan']; ?></td>
                            <td><?php echo $row['no_hp']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['jenis_kelamin']; ?></td>
                            <td><?php echo $row['tanggal_lahir']; ?></td>
                            <td>
                                <?php if (!empty($row['profile_image'])): ?>
                                    <img src="../../user/upload-profile/<?php echo $row['profile_image']; ?>" alt="Profile Image" width="100">
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="POST" action="./">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="button" class='action-btn edit' onclick="openEditUser(<?php echo htmlspecialchars(json_encode($row)); ?>)"><i class="fas fa-edit"></i></button>
                                    <button type="submit" class='action-btn delete' name="hapus-user"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>

      <footer>
        <div class="social-icons">
            <a href="https://github.com/jhonvnbb" target="_blank"><i class="fab fa-github"></i></a>
            <a href="https://www.youtube.com/channel/UCML2M8j1wTcXTP8D0mHPhgw" target="_blank"><i class="fab fa-youtube"></i></a>
            <a href="https://www.instagram.com/jhonnvnbb" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2024 <span>Aston Serve</span>. All Rights Reserved.</p>
      </footer>
    </div>

    <!-- Search -->
    <script>
        function searchUser() {
            var searchTerm = document.getElementById('searchInput').value;

            var context = document.querySelector(".main-content");
            var instance = new Mark(context);
            instance.unmark();

            if (searchTerm) {
                instance.mark(searchTerm, {
                    "element": "span",
                    "className": "highlight"
                });
            }
        }
    </script>

    <!-- Edit User -->
    <script>
      function openEditUser(user) {
          document.getElementById('edit_id').value = user.id;
          document.getElementById('edit_name').value = user.name;
          document.getElementById('edit_email').value = user.email;
          document.getElementById('edit_pekerjaan').value = user.pekerjaan;
          document.getElementById('edit_no_hp').value = user.no_hp;
          document.getElementById('edit_alamat').value = user.alamat;
          document.getElementById('edit_jenis_kelamin').value = user.jenis_kelamin;
          document.getElementById('edit_tanggal_lahir').value = user.tanggal_lahir;

          if (user.profile_image) {
              document.getElementById('current_profile_image').src = `../../user/upload-profile/${user.profile_image}`;
              document.getElementById('current_profile_image').style.display = 'block';
          } else {
              document.getElementById('current_profile_image').style.display = 'none';
          }

          document.getElementById('editUser').style.display = 'block';
      }

      function closeEditUser() {
          document.getElementById('editUser').style.display = 'none';
      }

      function previewEditImage(event) {
          var reader = new FileReader();
          reader.onload = function() {
              var output = document.getElementById('preview_edit_gambar');
              output.src = reader.result;
              output.style.display = 'block';
          }
          reader.readAsDataURL(event.target.files[0]);
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

    <!-- Upload File Error -->
    <?php
      if(isset($_SESSION['upload_error'])): ?>
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: '<?php echo $_SESSION['upload_error']; ?>'
              });
          </script>
          <?php
        unset($_SESSION['upload_error']);
      endif;
    ?>

    <!-- Notif -->
    <?php
      if (isset($_SESSION['upload_error'])): ?>
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: '<?php echo $_SESSION['upload_error']; ?>'
              });
          </script>
          <?php
          unset($_SESSION['upload_error']);
      endif;

      if (isset($_SESSION['db_error'])): ?>
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: '<?php echo $_SESSION['db_error']; ?>'
              });
          </script>
          <?php
          unset($_SESSION['db_error']);
      endif;

      if (isset($_SESSION['info'])): ?>
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: '<?php echo $_SESSION['info']; ?>'
              });
          </script>
          <?php
          unset($_SESSION['info']);
      endif;
    ?>

  </body>
</html>