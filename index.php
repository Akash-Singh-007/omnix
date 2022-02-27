<?php include 'partials/_connect.php' ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="shortcut icon" href="https://i.ibb.co/Hdnvn8L/favicon-32x32.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <title>omnix</title>
</head>

<body>
  <?php
  if (isset($_REQUEST['error'])) {
    $error = $_GET['error'];
    if($error == 'Passfail'){
      echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Password do not match</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    }else if($error == 'Userexits'){
      echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>User already exists</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    }
  }
  if (isset($_REQUEST['success'])) {
    $success = $_GET['success'];
    if ($success == 'true') {
      echo '
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
      <strong>You have been successfully registered </strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    }else if ($success == 'usernotfound') {
      echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>User not found. Please register first.</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    } else if ($success == 'failpass') {
      echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Incorrect Password</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    }  else if ($success == 'false') {
      echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Invalid credentials</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
    } 
  }
  ?>
  <!-- header added -->
  <?php include 'partials/_header.php' ?>

  <!-- Slider starts here -->
  <div id="carouselExampleIndicators" class="carousel slide merge" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://i.ibb.co/2NDTR2C/banner1.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://i.ibb.co/VHvY04z/banner2.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://i.ibb.co/Cmdx9bc/banner3.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div>
  </div>
  <!-- svg -->
  <div class="svgc">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#000" fill-opacity="1" d="M0,192L48,165.3C96,139,192,85,288,85.3C384,85,480,139,576,138.7C672,139,768,85,864,90.7C960,96,1056,160,1152,176C1248,192,1344,160,1392,144L1440,128L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
    </svg>
  </div>

  <!-- cards -->
  <div class="row">

    <!-- using a loop to iterate cattegories from database-->
    <?php
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['category_id'];
      $cat = $row['catagory_name'];
      $desc = $row['category_description'];
      $img = $row['image'];
      echo '
        <div class="col-md-4 d-flex justify-content-center">
        <div class="card mb-3" style="width: 18rem;">
          <img class="bcc" src="' . $img . '" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><a class="text-decoration-none text-dark" href="threads.php?catid=' . $id . '">' . $cat . '</a></h5> <!-- Sending catid to thread page for specific thresad -->
            <p class="card-text">' . substr($desc, 0, 80) . ' . . .</p>
            <a href="threads.php?catid=' . $id . '" class="btn btn-primary">Read More</a> <!-- Sending catid to thread page for specific thresad -->
          </div>
        </div>
      </div>
        ';
    }
    ?>
  </div>

  <!-- footer added -->
  <?php include 'partials/_footer.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>