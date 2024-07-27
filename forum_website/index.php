<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("Location:/PHP/PHPALLcodes/forum_website/partial/login.php");
        exit;
}
?>

<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>iDiscuss - Coding Forum</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
                crossorigin="anonymous">
        <style>
     
       
        </style>
</head>

<body>
        <?php include 'partial/header.php';?>
        <?php include 'partial/db_connect.php';?>
        <!--slider start here-->
       
        <!-- welcome- <?php echo $_SESSION['username']?> -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                        <div class="carousel-item active">
                                <img src="spiderman.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                                <img src="programmer.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                                <img src="spiderman.jpg" class="d-block w-100" alt="...">
                        </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                </button>
        </div>
        <!--fetch all the category-->
        <h2 class="text-center">Browse categories</h2>
        <div class="container" style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
                


                <div class="row">
                <?php 
                  $sql="SELECT * FROM `categories`";
                  $result=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){
                          // echo $row['categories_id'];
                          // echo $row['categories_name'];
                          // echo $row['categories_description'];
                          $id=$row['categories_id'];
                          $cat=$row['categories_name'];
                          $dog=$row['categories_description'];
                          echo '<div class="col-md-4 my-2">
                        <div class="card" style="width: 18rem;">
                                        <img src="card-'.$id.'.jpeg" class="card-img-top" alt="..." style="height:10rem;width:18rem;">
                                        <div class="card-body">
                                                <h5 class="card-title"><a href="threads_list.php?catid='. $id .'"  style="text-decoration:none;">'.$cat.'</a></h5>
                                                <p class="card-text">'.substr($dog ,0,120).'...</p>
                                                <a href="threads_list.php?catid='. $id .'" class="btn btn-primary">View Threads</a>
                                        </div>
                                </div>
                        </div>';
                  }
        ?>
        </div>
        </div>
                <!--categories container start here-->



                <!--while loop iterator start here-->


               
        <?php include 'partial/footer.php';?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
</body>

</html>