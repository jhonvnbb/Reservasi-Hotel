<?php
    require 'connection.php';
    session_start();
    $username = "";
    $errors = array();

    // Login Button
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql_admin = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
        $cek_admin = mysqli_num_rows($sql_admin);

        if ($cek_admin > 0) {
            $_SESSION['username'] = $username;
            header('Location: ./dashboard/?username=' . urlencode($_SESSION['username']));
            exit();
        } else {
            $errors['username'] = "Incorrect username or password!";
        }
    }

    // Unggah gambar
    function uploadFile($file) {
        $target_dir = "../upload-barang/";
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $maxFileSize = 5000000;
    
        // Format file yang diizinkan
        $allowedFormats = array('jpg', 'jpeg', 'png');
    
        // Format file
        if (!in_array($imageFileType, $allowedFormats)) {
            $_SESSION['upload_error'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
            return false;
        }
    
        // Cek apakah benar file gambar
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            $_SESSION['upload_error'] = "File is not an image.";
            return false;
        }
    
        // Cek ukuran file
        if ($file["size"] > $maxFileSize) {
            $_SESSION['upload_error'] = "Sorry, your file is too large.";
            return false;
        }
    
        // Unggah file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            $_SESSION['upload_error'] = "Sorry, there was an error uploading your file.";
            return false;
        }
    }    

    // Tambah Kamar Button
    if (isset($_POST['tambah-barang'])) {
        $gambar = "";
        $model = mysqli_real_escape_string($con, $_POST['model']);
        $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);
        $fasilitas1 = mysqli_real_escape_string($con, $_POST['fasilitas1']);
        $fasilitas2 = mysqli_real_escape_string($con, $_POST['fasilitas2']);
        $fasilitas3 = mysqli_real_escape_string($con, $_POST['fasilitas3']);
        $fasilitas4 = mysqli_real_escape_string($con, $_POST['fasilitas4']);
        $fasilitas5 = mysqli_real_escape_string($con, $_POST['fasilitas5']);
        $tersedia = mysqli_real_escape_string($con, $_POST['tersedia']);
        $harga = mysqli_real_escape_string($con, $_POST['harga']);
    
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $gambar = uploadFile($_FILES['gambar']);
            if (strpos($gambar, 'Sorry') !== false) {
                $_SESSION['upload_error'] = $gambar;
                header('Location: ./');
                exit();
            }
        }
    
        if ($gambar != "") {
            $insert_sql = "INSERT INTO kamar (gambar, model, deskripsi, fasilitas1, fasilitas2, fasilitas3, fasilitas4, fasilitas5, tersedia, harga) VALUES ('$gambar', '$model', '$deskripsi', '$fasilitas1', '$fasilitas2', '$fasilitas3', '$fasilitas4', '$fasilitas5', '$tersedia', '$harga')";
            if (mysqli_query($con, $insert_sql)) {
                $_SESSION['info'] = "Kamar berhasil ditambahkan!";
                header('Location: ./');
                exit();
            } else {
                $_SESSION['db_error'] = "Gagal menambahkan kamar! " . mysqli_error($con);
                header('Location: ./');
                exit();
            }
        }
    }

    // Hapus Kamar Button 
    if (isset($_POST['hapus'])) {
        $id_kamar = $_POST['id_kamar'];
        $query = "DELETE FROM kamar WHERE id = $id_kamar";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['info'] = "Kamar berhasil dihapus.";
        } else {
            $_SESSION['info'] = "Terjadi kesalahan saat menghapus kamar: " . mysqli_error($con);
        }
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Edit Kamar Button
    if (isset($_POST['edit-barang'])) {
        $id_kamar = mysqli_real_escape_string($con, $_POST['id_kamar']);
        $model = mysqli_real_escape_string($con, $_POST['model']);
        $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);
        $fasilitas1 = mysqli_real_escape_string($con, $_POST['fasilitas1']);
        $fasilitas2 = mysqli_real_escape_string($con, $_POST['fasilitas2']);
        $fasilitas3 = mysqli_real_escape_string($con, $_POST['fasilitas3']);
        $fasilitas4 = mysqli_real_escape_string($con, $_POST['fasilitas4']);
        $fasilitas5 = mysqli_real_escape_string($con, $_POST['fasilitas5']);
        $tersedia = mysqli_real_escape_string($con, $_POST['tersedia']);
        $harga = mysqli_real_escape_string($con, $_POST['harga']);
    
        if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] == 0) {
            $gambar = uploadFile($_FILES['gambar']);
            if ($gambar === false) {
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $query = "UPDATE kamar SET gambar = '$gambar', model = '$model', deskripsi = '$deskripsi', fasilitas1 = '$fasilitas1', fasilitas2 = '$fasilitas2', fasilitas3 = '$fasilitas3', fasilitas4 = '$fasilitas4', fasilitas5 = '$fasilitas5',  tersedia = '$tersedia',  harga = '$harga' WHERE id = $id_kamar";
            }
        } else {
            $query = "UPDATE kamar SET model = '$model', deskripsi = '$deskripsi', fasilitas1 = '$fasilitas1', fasilitas2 = '$fasilitas2', fasilitas3 = '$fasilitas3', fasilitas4 = '$fasilitas4', fasilitas5 = '$fasilitas5',  tersedia = '$tersedia',  harga = '$harga' WHERE id = $id_kamar";
        }
    
        $result = mysqli_query($con, $query);
    
        if ($result) {
            $_SESSION['info'] = "Kamar berhasil diedit.";
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['db_error'] = "Terjadi kesalahan saat mengedit kamar: " . mysqli_error($con);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Edit Status Button
    if(isset($_POST['edit_status'])) {
        $id = $_POST['id'];
        $new_status = $_POST['status'];
    
        $update_sql = "UPDATE pesanan SET status = '$new_status' WHERE id = '$id'";
        $result = mysqli_query($con, $update_sql);
    
        if($result) {
            $getUserInfo = "SELECT email FROM pesanan WHERE id = '$id'";
            $userInfoResult = mysqli_query($con, $getUserInfo);
            $userInfo = mysqli_fetch_assoc($userInfoResult);
            $userEmail = $userInfo['email'];
    
            $to = $userEmail;
            $subject = 'Status Pesanan AstonServe';
            $message = '';
    
            if($new_status === 'PESANAN DIVERIFIKASI') {
                $message = 'Pesanan anda telah diverifikasi oleh admin, silahkan lihat dan download tiket anda untuk ditunjukkan pada saat check-in.';
            } elseif($new_status === 'PESANAN DITOLAK') {
                $message = 'Maaf, pesanan anda telah ditolak oleh admin. Silahkan hubungi customer service kami untuk informasi lebih lanjut.';
            }
    
            $headers = 'From: tinonababan3@gmail.com' . "\r\n" .
                       'Reply-To: tinonababan3@gmail.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
    
            mail($to, $subject, $message, $headers);
    
            header('Location: ./?status=success');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    
        mysqli_close($con);
    }

    if (isset($_POST['hapus-user'])) {
        $id_user = $_POST['id'];
        $query = "DELETE FROM usertable WHERE id = $id_user";
        $result = mysqli_query($con, $query);
    
        if ($result) {
            $_SESSION['info'] = "User berhasil dihapus.";
        } else {
            $_SESSION['info'] = "Terjadi kesalahan saat menghapus user: " . mysqli_error($con);
        }
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
    
    if (isset($_POST['edit-user'])) {
        $id_user = mysqli_real_escape_string($con, $_POST['id']);
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pekerjaan = mysqli_real_escape_string($con, $_POST['pekerjaan']);
        $no_hp = mysqli_real_escape_string($con, $_POST['no_hp']);
        $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
        $jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
        $tanggal_lahir = mysqli_real_escape_string($con, $_POST['tanggal_lahir']);
        $profile_image = "";
    
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $profile_image = uploadProfileImage($_FILES['profile_image']);
            if ($profile_image === false) {
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit();
            }
        }
    
        if ($profile_image != "") {
            $query = "UPDATE usertable SET name = '$name', email = '$email', pekerjaan = '$pekerjaan', no_hp = '$no_hp', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', tanggal_lahir = '$tanggal_lahir', profile_image = '$profile_image' WHERE id = $id_user";
        } else {
            $query = "UPDATE usertable SET name = '$name', email = '$email', pekerjaan = '$pekerjaan', no_hp = '$no_hp', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', tanggal_lahir = '$tanggal_lahir' WHERE id = $id_user";
        }
    
        if (mysqli_query($con, $query)) {
            $_SESSION['info'] = "User berhasil diedit.";
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['db_error'] = "Terjadi kesalahan saat mengedit user: " . mysqli_error($con);
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    
    function uploadProfileImage($file)
    {
        $target_dir = "../../user/upload-profile/";
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $maxFileSize = 5000000;
        $allowedFormats = array('jpg', 'jpeg', 'png');
    
        if (!in_array($imageFileType, $allowedFormats)) {
            $_SESSION['upload_error'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
            return false;
        }
    
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            $_SESSION['upload_error'] = "File is not an image.";
            return false;
        }
    
        if ($file["size"] > $maxFileSize) {
            $_SESSION['upload_error'] = "Sorry, your file is too large.";
            return false;
        }
    
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return basename($file["name"]);
        } else {
            $_SESSION['upload_error'] = "Sorry, there was an error uploading your file.";
            return false;
        }
    }
    
?>