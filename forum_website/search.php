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
                #maincontainer{
                        min-height:580px;
                }
       
        </style>
</head>

<body>
        <?php include 'partial/header.php';?>
        <?php include 'partial/db_connect.php';?>
           
        <!-- search result -->

        <div class="container my-3" id="maincontainer">
                <h1>search result for <em>"<?php echo $_GET['search'] ?>"</em></h1>
                <?php
                        $noresult=true;
                        $query=$_GET["search"];
                        $sql="SELECT * FROM `threads` where match (threads_title,threads_desc) against ('$query')";
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result)){
                        $title=$row['threads_title'];
                        $desc=$row['threads_desc'];
                        $threads_id=$row['threads_id'];
                        $url="threads.php?threads_id=". $threads_id;
                        $noresult=false;
                         echo'<div class="result">
                                        <h3><a href="'.$url.'" style="text-decoration:none;" class="text-dark">'.$title.'</a></h3>
                                        <p>'.$desc.'</p>
                                </div>';
                        
                        }
                        if($noresult){
                                echo'  <div class="container my-4" style="background-color:lightblue;border-radius:1rem;">
                                <div class="jumbotron">
                                        <h2>No Result Found</h2>
                                        <p>Suggestions:<ul>
                                                <li>Make sure that all words are spelled correctly.</li>
                                                <li>Try different keywords.</li>
                                                <li>Try more general keywords.</li>
                                                </ul>
                                        </p>
                                       
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