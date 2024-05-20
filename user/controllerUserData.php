<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

//signup button
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (name, email, password, code, status)
                        values('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: tinonababan3@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: ./verify/');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['pekerjaan'] = $pekerjaan;
                $_SESSION['no_hp'] = $no_hp;
                $_SESSION['alamat'] = $alamat;
                $_SESSION['jenis_kelamin'] = $jenis_kelamin;
                $_SESSION['tanggal_lahir'] = $tanggal_lahir;
                header('location: ../../login/');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: ../');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: ../signup/verify/');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "Sepertinya Anda belum mempunyai akun! Klik tautan paling bawah untuk mendaftar.";
        }
    }

    //continue button in reset folder
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: tinonababan3@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: ./verify/');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Silakan buat kata sandi baru sesuai dengan yang Anda mau.";
            $_SESSION['info'] = $info;
            header('location: ../new/');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    // change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email'];
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: ../changed/');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //login now button
    if(isset($_POST['login-now'])){
        header('Location: ../../user/login/');
    }

    // Unggah gambar di profile
    function uploadFile($file) {
        $target_dir = "../upload-profile/";
        $target_file = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;
        $maxFileSize = 1000000; // 1MB

        // Cek gambar atau tidak
        $check = getimagesize($file["tmp_name"]);
        if($check === false) {
            return "File is not an image.";
        }

        // Ukuran gambar
        if ($file["size"] > $maxFileSize) {
            return "Sorry, your file is too large.";
        }

        // Format gambar
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return "Sorry, only JPG, JPEG, & PNG files are allowed.";
        }

        // Unik nama file
        // $uniqueFileName = uniqid() . '.' . $imageFileType;
        // $target_file = $target_dir . $uniqueFileName;

        // Cek eror
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update button
    if(isset($_POST['update'])){
        $email = $_SESSION['email'];
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $pekerjaan = mysqli_real_escape_string($con, $_POST['pekerjaan']);
        $no_hp = mysqli_real_escape_string($con, $_POST['no_hp']);
        $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
        $jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
        $tanggal_lahir = mysqli_real_escape_string($con, $_POST['tanggal_lahir']);
        $profile_image_path = "";

        // Buat unggah gambar
        if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $profile_image_path = uploadFile($_FILES['profile_image']);
            if(strpos($profile_image_path, 'Sorry') !== false) {
                $errors['file'] = $profile_image_path;
                $profile_image_path = ""; // Reset profile
            }
        }

        if(empty($errors)){
            $update_query = "UPDATE usertable SET 
                                name = '$name', 
                                pekerjaan = '$pekerjaan', 
                                no_hp = '$no_hp', 
                                alamat = '$alamat', 
                                jenis_kelamin = '$jenis_kelamin', 
                                tanggal_lahir = '$tanggal_lahir'";

            if($profile_image_path != "") {
                $update_query .= ", profile_image = '$profile_image_path'";
            }

            $update_query .= " WHERE email = '$email'";
        
            $update_result = mysqli_query($con, $update_query);
        
            if($update_result){
                $info = "Profile updated successfully.";
                $_SESSION['info'] = $info;
                header('location: ./');
                exit();
            } else {
                $errors['db-error'] = "Failed to update profile! " . mysqli_error($con);
            }
        }
    }

    // Pesan button
    if(isset($_POST['pesan'])){
        $email = $_SESSION['email'];
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $no_hp = mysqli_real_escape_string($con, $_POST['no_hp']);
        $alamat = mysqli_real_escape_string($con, $_POST['alamat']);
        $kamar = mysqli_real_escape_string($con, $_POST['kamar']);
        $tanggal_checkin = mysqli_real_escape_string($con, $_POST['tanggal_checkin']);
        $tanggal_checkout = mysqli_real_escape_string($con, $_POST['tanggal_checkout']);

        $total_harga = mysqli_real_escape_string($con, $_POST['total_harga']);
        $formatted_total_harga = number_format($total_harga, 0, ',', '.');
        $total_harga_rupiah = 'Rp.' . $formatted_total_harga;

        $status = 'waiting';

        $insert_query = "INSERT INTO pesanan (email, name, no_hp, alamat, kamar, tanggal_checkin, tanggal_checkout, total_harga, status) 
                         VALUES ('$email', '$name', '$no_hp', '$alamat', '$kamar', '$tanggal_checkin', '$tanggal_checkout', '$total_harga_rupiah', '$status')";

        $insert_result = mysqli_query($con, $insert_query);

        if($insert_result){
            $info = "Berhasil melakukan pemesanan kamar.";
            $_SESSION['info'] = $info;
            header('location: ./');
            exit();
        } else {
            $errors['db-error'] = "Gagal melakukan pemesanan kamar!";
        }
    }
    
    // Batal Button
    if(isset($_POST['batal'])) {
        $email = $_SESSION['email'];
        $id = mysqli_real_escape_string($con, $_POST['id']);
    
        $delete_sql = "DELETE FROM pesanan WHERE id = '$id' AND email = '$email'";
        $delete_query = mysqli_query($con, $delete_sql);
        if($delete_query) {
            $info = "Pesanan berhasil dibatalkan.";
            $_SESSION['info'] = $info;
            header('Location: ./');
            exit();
        } else {
            $errors['db-error'] = "Gagal membatalkan pesanan: " . mysqli_error($con);
        }
    }    

?>