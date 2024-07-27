<?php
// session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin=true;
}
else{
  $loggedin=false;
}
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="#">iDiscuss</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="http://localhost/PHP/PHPALLcodes/forum_website/">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Categories
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="http://localhost/PHP/PHPALLcodes/forum_website/threads_list.php?catid=5">PHP</a></li>
        <li><a class="dropdown-item" href="http://localhost/PHP/PHPALLcodes/forum_website/threads_list.php?catid=2">Javascript</a></li>
        <li><a class="dropdown-item" href="http://localhost/PHP/PHPALLcodes/forum_website/threads_list.php?catid=3">Django</a></li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/contact.php">Contact</a>
    </li>
  </ul>';
  if(!$loggedin){
    echo '<form class="d-flex me-2" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success" type="submit">Search</button>
    <button class="btn btn-outline-success " type="submit" data-bs-toggle="modal" data-bs-target="#signupModal"><a href="/PHP/PHPALLcodes/forum_website/partial/signup.php" style="text-decoration:none;color:white;">Signup</a></button>
    <button class="btn btn-outline-success " type="submit" data-bs-toggle="modal" data-bs-target="#signupModal"><a href="/PHP/PHPALLcodes/forum_website/partial/login.php" style="text-decoration:none;color:white;">Login</a></button>
  </form>';
  }
  if($loggedin ){
  echo'<form class="d-flex me-2" role="search">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-success me-2" type="submit">Search</button>
  <p class="text-light my-0 me-2">Welcome<br>'.$_SESSION['username'].'</p> 
  <button class="btn btn-outline-success " type="submit" data-bs-toggle="modal" data-bs-target="#signupModal"><a href="/PHP/PHPALLcodes/forum_website/partial/logout.php" style="text-decoration:none;color:white;">Logout</a></button>
</form>'; 
  }
  echo '    
</div>
</div>
</nav>';


?>
