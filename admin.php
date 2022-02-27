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
 
  <!-- header added -->
  <?php include 'partials/_header.php' ?> 

   <!-- svg -->
   <div class="svgc">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#000" fill-opacity="1" d="M0,192L48,165.3C96,139,192,85,288,85.3C384,85,480,139,576,138.7C672,139,768,85,864,90.7C960,96,1056,160,1152,176C1248,192,1344,160,1392,144L1440,128L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
    </svg>
  </div>

  <!-- topics information -->
    <div class="container" style="overflow-x:scroll; scrollbar-arrow-color: red; ">
    <table class="table table-bordered table-dark table-striped align-middle table-responsive">
  <thead>
    <tr>
      <th>Remove</th>
      <th>Id</th>
      <th>Topic</th>
      <th>Image</th>
      <th>Description</th>      
    </tr>
  </thead>
  <tbody>

  <?php
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['category_id'];
      $cat = $row['catagory_name'];
      $desc = $row['category_description'];
      $img = $row['image'];
      echo '
      <tr>
      <td><button class="btn btn-danger">Delete</button></td>
      <td>'.$id.'</td>
      <td>'.$cat.'</td>
      <td>'.$img.'</td>
      <td>'.$desc.'</td>
    </tr>
        ';
    }
    ?>
   
  </tbody>
</table>
    </div>

  <!-- footer added -->
  <?php include 'partials/_footer.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>