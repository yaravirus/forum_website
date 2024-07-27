<?php 
        $login=false;
        $showerror=false;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'db_connect.php';
        $email=$_POST['email'];
        $password=$_POST['password'];
        
        $sql="SELECT * FROM `users` where user_email = '$email' AND user_pass = '$password'";
        $result=mysqli_query($conn,$sql);       
        $num=mysqli_num_rows($result);
        if($num==1){
                $login=true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $email;
                header("location:/PHP/PHPALLcodes/forum_website/index.php");
        }

        else{
                $showerror="invalid credentials";
        }

}


?>

<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous">
        <style>

                body{
                        background-image: url(spiderman1.jpg);
                        background-repeat: no-repeat;
                        background-position: fixed;
                        background-size: cover;

                }
        </style>
</head>

<body >
        <?php require 'header.php'?>
        <?php
        if($login){
                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are Logged In.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($showerror){
                echo ' <div class="alert alert-danger  alert-dismissible fade show" role="alert">
        <strong>Error!</strong>'.$showerror.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        ?>
        <div class="container">
                <h1 class="text-center">login</h1>
                <form action="/PHP/PHPALLcodes/forum_website/partial/login.php" method="post"
                        style="display: flex;flex-direction:column;align-items:center;justify-content:center;">
                        <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                        aria-describedby="emailHelp">

                        </div>
                        <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                        </div>
                       
                        <button type="submit" class="btn btn-primary col-md-6">login</button>
                </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
</body>

</html>