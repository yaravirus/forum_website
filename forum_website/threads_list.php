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
        <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

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
        $id=$_GET['catid'];
        $sql="SELECT * FROM `categories` where categories_id=$id";
                  $result=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){
                        $catname=$row['categories_name'];
                        $catdesc=$row['categories_description'];

                  }
        ?>
        <?php
                $showalert=false;
                $method=$_SERVER['REQUEST_METHOD'];
                if($method=='POST'){
                        //INSERT DATA INTO TABLE
                        $th_title=$_POST['title'];
                        $th_desc=$_POST['desc'];
                        $sql="INSERT INTO `threads` (`threads_title`, `threads_desc`, `threads_cat_id`, `thrreads_user_id`, `timestamp`) 
                        VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp());";
                        $result=mysqli_query($conn,$sql);
                        $showalert=true;
                        if($showalert){
                                echo '
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Success!</strong> Your threads has been added! please wait for community to respond
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                ';
                        }
                }

        ?>
        <div class="container my-4" style="background-color:lightblue;border-radius:0.5rem;">
                <div class="jumbotron">
                        <h1 class="display-4">Welcome to <?php echo $catname?> forums</h1>
                        <p class="lead"><?php echo $catdesc?></p>
                        <hr class="my-4">
                        <p>This is a peer to peer forum to sharing knowledge with each other</p>
                        <button class="btn btn-success btn-lg" href="#" role="button">Learn More</button>
                </div>
        </div>
        <div class="container">
                <h1>Start a Discussion</h1>
                <form action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post">
                        <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                        aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="exampleFormControlTextarea1 ">Elaborate Your Concern</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3"
                                        style="margin-top:1rem;"></textarea>

                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                </form>
        </div>

        <div class="container" style="min-height:450px;">
                <h1>Browse Question</h1>

                <?php
                                $id=$_GET['catid'];
                                $sql="SELECT * FROM `threads` WHERE threads_cat_id=$id";
                                        $result=mysqli_query($conn,$sql);
                                        $noresult=true;
                                        while($row=mysqli_fetch_assoc($result)){
                                                $noresult=false;
                                                $id=$row['threads_id'];
                                                $title=$row['threads_title'];
                                                $desc=$row['threads_desc'];
                                                $time=date("d M Y");
                                                $threads_user_id=$row['thrreads_user_id'];
                                                $sql2="SELECT user_email FROM `users` where sno='$threads_user_id'";
                                                $result2=mysqli_query($conn,$sql2);
                                                $row2=mysqli_fetch_assoc($result2);
                                                echo '<div class="media my-3" style="display:flex;">
                                                        <div>
                                                                <img src="default.webp" width="54px" class="mr-3" alt="...">
                                                        </div>
                                                        <div class="media-body" style="margin-left:10px;">'.
                                                                
                                                                '<h5 class="mt-0"><a class="text-dark" style="text-decoration:none;" href="threads.php?threads_id='.$id.'">'.$title.'</a></h5>
                                                        '.$desc.'
                                                        </div>'  .  '<p class="fw-bold my-0">|PostedBy : '.$row2['user_email'].' at '.$time.
                                                        '</p>'. 

                                                 '</div>';

                                        }
                                        if($noresult){
                                                echo '<div class="jumbotron jumbotron-fluid"style="background-color:lightblue;border-radius:0.5rem;" >
                                                        <div class="container">
                                                                <p class="display-4">No Result Found</p>
                                                                <p class="lead" style="min-height:3rem;">Be the first person to ask a question</p>
                                                        </div>
                                                       </div>';
                                                
                                                
                                                
                                        }
                ?>
                <!-- <div class="container" style="display:flex;justify-content:center;align-items:center;">
                          <table class="table" id="myTable">
                          <thead>
                            <tr>
                              <th scope="col">Threads_sno</th>
                              <th scope="col">Threads_Title</th>
                              <th scope="col">Threads_Desc</th>
                            
                            </tr>
                          </thead>
                          <tbody>
                          <!-- <?php
                            $sql= "SELECT * FROM `threads`";
                            $result = mysqli_query($conn,$sql);
                            $sno=0;
                            while($row = mysqli_fetch_assoc($result)){
                              $sno=$sno+1;
                              $time=date("d M Y");
                              echo "<tr>
                              <th>".$row['threads_id']."</th>
                              <td>".$row['threads_title']."</td>
                              <td>". $row['threads_desc']. "</td
                             
                              </tr>";

                            }

                    ?> -->
                </tbody>
                </table>
        </div>
        <hr>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
      crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script> 
        </div><br> -->
        <?php include 'partial/footer.php';?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
</body>

</html>