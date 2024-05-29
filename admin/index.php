<?php require_once './controller-data.php' ?>

<?php 
    if(isset($_SESSION["username"])){
        header("Location: ./dashboard/");
    exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstonServe | Admin Login</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
     integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
     crossorigin="anonymous" referrerpolicy="no-referrer" 
    />

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            color: #212121;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .left-section {
            width: 50%;
            padding: 50px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #FAF4EB;
        }

        .left-section .konten{
            padding: 0 100px;
            margin-top: -25px;
        }

        .left-section .konten .aston{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin-top: -50px;
        }

        .left-section .konten .aston img {
            max-width: 200px;
            margin: 0 auto;
        }
        .left-section .konten .aston h1{
            text-align: center;
            margin-top: -20px;
            font-size: 21px;
            letter-spacing: 10px;
            font-weight: 900;
        }

        .left-section .konten .aston h1 i{
            color: #13947a;
        }

        .left-section .konten h2 {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: #16a085;
            margin-bottom: 20px;
        }

        .left-section .konten h2 i{
            padding-right: 5px;
        }

        .left-section .konten .welcome-message {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #666;
        }

        .left-section .konten .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .left-section .konten .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .left-section .konten .input-group i {
            position: absolute;
            left: 10px;
            top: 55%;
            color: #aaa;
        }

        .left-section .konten .input-group input {
            width: calc(100% - 80px);
            padding: 15px 40px;
            border: none;
            border-radius: 5px;
            background: #fff;
            font-size: 1rem;
        }

        .left-section .konten .input-group input::placeholder {
            color: #aaa;
        }

        .left-section .konten .input-group input:focus{
            border: 1px solid #13947a;
        }

        .left-section .konten button {
            width: 100%;
            padding: 15px;
            background-color: #16a085;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.5s;
            margin-top: 15px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .left-section .konten button:hover {
            background-color: #13947a;
        }

        .left-section .konten .copyright {
            margin-top: 20px;
            font-size: 1rem;
            color: #aaa;
            text-align: right;
        }

        .right-section {
            width: 50%;
            background: url('../assets/img/image3.jpg');
            background-size: cover;
            background-position: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="konten">
                <div class="aston">
                    <img src="../assets/img/Logo Bisnis Perusahaan Modern Berwarna Hijau.png" alt="aston Logo">
                    <h1><i class="fas fa-user"></i><i class="fas fa-lock"></i></h1>
                </div>
                <hr>
                <h2><i class="fas fa-user-lock"></i> Admin Login</h2>
                <p class="welcome-message">Welcome to the Admin Panel. Please login to continue.</p>
                <form action="./" method="POST">
                    <div class="input-group">
                        <label for="username"><i class="fas fa-user"></i> Username :</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>

                    <div class="input-group">
                        <label for="password"><i class="fas fa-lock"></i> Password :</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <button type="submit" name="login"> <i class="fas fa-right-to-bracket"></i> Login</button>
                </form>
                <p class="copyright">© 2024 Aston   Serve. All rights reserved.</p>
            </div>
        </div>
        <div class="right-section"></div>
    </div>

    <!-- Sweet Alert -->
    <script src="sweetalert2.all.min.js"></script>

    <?php if(isset($errors['username'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $errors['username']; ?>'
            });
        </script>
    <?php endif; ?>
    
</body>
</html>
