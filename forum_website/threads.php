<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $loggedin=true;
      }
      else{
        $loggedin=false;
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

</head>

<body>
<nav class="navbar navbar-expand-lg bg-info">
                <div class="container-fluid">
                        <a class="navbar-brand" href="#">iDiscuss</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                                <a class="nav-link active" aria-current="page" href="/PHP/PHPALLcodes/forum_website/">Home</a>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link" href="#">About</a>
                                        </li>
                                        <li class="nav-item">
                                                <a class="nav-link" href="/contact.php">Contact</a>
                                         </li>
                                       
                                </ul>
                                <form class="d-flex" role="search">
                                        <input class="form-control me-2" type="search" placeholder="Search"
                                                aria-label="Search">
                                        <button class="btn btn-outline-success me-2 " type="submit">Search</button>
                                        <!-- <?php echo "<p class='text-light my-2'>welcome-</p>"?>  -->
                                        <?php 
                                        $t=$_SESSION["username"];
                                        echo 'Welcome '.$t;
                                        ?>                           
                                </form>
                        </div>
                </div>
        </nav>
        <?php include 'partial/db_connect.php';?>
        <?php
        $id=$_GET['threads_id'];
        $sql="SELECT * FROM `threads` where threads_id=$id";
                  $result=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){
                        $title=$row['threads_title'];
                        $desc=$row['threads_desc'];

                  }
        ?>
        <?php
                $showalert=false;
                $method=$_SERVER['REQUEST_METHOD'];
                if($method=='POST'){
                        //INSERT DATA INTO TABLE
                        $comment=$_POST['comment'];
                        $sql="INSERT INTO `comments` (`comment_content`, `threads_id`, `comment_time`, `comment_by`) 
                        VALUES ('$comment', '$id', current_timestamp(), '0');";
                        $result=mysqli_query($conn,$sql);
                        $showalert=true;
                        if($showalert){
                                echo '
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Success!</strong> Your Comment has been added!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                ';
                        }
                }

        ?>
        <div class="container my-4" style="background-color:lightblue;border-radius:1rem;">
                <div class="jumbotron">
                        <h1 class="display-4"><?php echo $title?> </h1>
                        <p class="lead"><?php echo $desc?></p>
                        <hr class="my-4">
                        <p>This is a peer to peer forum to sharing knowledge with each other</p>
                        <p style="min-height:3rem;"><b>Posted by-durgesh sharma</b></p>
                </div>
        </div>
        <div class="container">
                <h1>Post a Comment</h1>
                <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
                        <div class="form-group">
                                <label for="exampleFormControlTextarea1 ">Type Your Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3"
                                        style="margin-top:1rem;"></textarea>

                        </div>
                        <button type="submit" class="btn btn-success">Post Comment</button>
                </form>
        </div>
        
        <div class="container" style="min-height:450px;">
                <h1>Discussion</h1>

                 <?php
                                $id=$_GET['threads_id'];
                                $sql="SELECT * FROM `comments` WHERE threads_id=$id";
                                        $result=mysqli_query($conn,$sql);
                                        $noresult=true;
                                        while($row=mysqli_fetch_assoc($result)){
                                                $noresult=false;
                                                $id=$row['comment_id'];
                                                $content=$row['comment_content'];
                                                $time=date("d M Y");
                                                $threads_user_id=$row['comment_by'];
                                                $sql2="SELECT user_email FROM `users` where sno='$threads_user_id'";
                                                $result2=mysqli_query($conn,$sql2);
                                                $row2=mysqli_fetch_assoc($result2);
                                                echo '<div class="media my-3" style="display:flex;">
                                                        <div>
                                                                <img src="default.webp" width="54px" class="mr-3" alt="...">
                                                        </div>
                                                        <div class="media-body" style="margin-left:10px;">
                                                        <p class="fw-bold my-0">|PostedBy : '.$row2['user_email'].' at '.$time.'</p>      
                                                        '.$content.'
                                                        </div>

                                                 </div>';

                                        }
                                        if($noresult){
                                                echo '<div class="jumbotron jumbotron-fluid"style="background-color:lightblue;border-radius:0.5rem;" >
                                                        <div class="container">
                                                                <p class="display-4">No Threads Found</p>
                                                                <p class="lead" style="min-height:3rem;">Be the first person to ask a question</p>
                                                        </div>
                                                       </div>';
                                                
                                                
                                                
                                        }
                ?> 
        </div>
        <?php include 'partial/footer.php';?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
</body>

</html>