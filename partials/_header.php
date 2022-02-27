<?php
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark black-bg">
<div class="container-fluid">
  <a class="navbar-brand cc" href="index.php" ><img class="logo" src="https://i.ibb.co/ydPh9mv/logo.png" alt=""></a>
  <button class="navbar-toggler cnt" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link  text-light" style="text-shadow: 0 0 10px white" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-success dropdown-toggle" style="text-shadow: 0 0 10px white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Hot*
        </a>
        <ul class="dropdown-menu bg-info" aria-labelledby="navbarDropdown">';

        $sql = "SELECT * FROM `categories` LIMIT 10";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
          echo '<li class="black-bg"><a class="dropdown-item text-info" href="threads.php?catid=' . $row['category_id'] . '">'. $row['catagory_name'] .'</a></li>
                <li><hr class="dropdown-divider"></li>
                ';
        }
       echo ' </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" style="text-shadow: 0 0 10px white" href="contact.php">Contact</a>
      </li>';
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["username"]=='admin') {
        echo '<li class="nav-item">
                <a class="nav-link text-info" style="text-shadow: 0 0 10px cyan" href="admin.php">Admin Panel*</a>
              </li>';
      }
    echo '</ul>
    <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </form><br>
    <div class="mx-2 d-flex flex-row">';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $uavatar = $_SESSION['avtid'];
  $avSql = "SELECT * FROM `avatar` WHERE avatar_id = $uavatar";
  $avResult = mysqli_query($conn,$avSql);
  $avUrl = "";
  while($row = mysqli_fetch_assoc($avResult)){
      $avUrl = $row['avatar_add'];
  } 
  echo '
  <a href="partials/_logout.php" type="button" class="btn btn-info me-2" >LogOut</a>
  <button type="button" class="btn btn-info position-relative d-flex flex-row">
  '.$_SESSION["username"].'&nbsp&nbsp&nbsp&nbsp
  <div class="">
    <img src="'.$avUrl.'" alt="...">
  </div>
</button>
  ';
} else {
  echo '
  <button class="btn btn-info border-0 cbgc" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>&nbsp
  <button class="btn btn-info border-0 cbgc" data-bs-toggle="modal" data-bs-target="#signupModal">signup</button>
  ';
}
echo '
    </div>
  </div>
</div>
</nav>
';
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
