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
    <?php include 'partials/_connect.php' ?>

    <!-- svg -->
    <div class="svgc">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#000" fill-opacity="1" d="M0,192L48,165.3C96,139,192,85,288,85.3C384,85,480,139,576,138.7C672,139,768,85,864,90.7C960,96,1056,160,1152,176C1248,192,1344,160,1392,144L1440,128L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>
    </div>

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=" . $id . "";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $thread_id = $row['thread_id'];
        $thread_title = $row['thread_title'];
        $thread_desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        $thread_time = $row['time'];

        $sql_name = "SELECT * FROM `users` WHERE sno = " . $thread_user_id . "";
        $result_name = mysqli_query($conn, $sql_name);
        while ($row = mysqli_fetch_assoc($result_name)) {
            $user_id = $row['sno'];
            $user_name = $row['user_name'];
            $user_avt_id = $row['avatar_id'];
        }

        $sql_icon = "SELECT * FROM `avatar` WHERE avatar_id = " . $user_avt_id . "";
        $result_icon = mysqli_query($conn, $sql_icon);
        while ($row = mysqli_fetch_assoc($result_icon)) {
            $user_icon = $row['avatar_add'];
        }

        // managing time display using _timer.php
        $sting_atime =  strtotime(date("Y-m-d H:i:s")) + 12600 - strtotime($thread_time);
        include 'partials/_timer.php';

        echo '<div class="container my-4 border border-info rounded  black-bg">
      <div class="jumbotron py-4  black-bg ">
          <h3 class="text-light"><img style="height:40px;width:40px;border-radius:50%;margin:10px;" src="' . $user_icon . '" alt="">'.$user_name.' * ' . $display_time . '<p>' . $thread_title . ' </p></h3>
          <p class="lead text-light">' . $thread_desc . '</p>
          </div>
          <p>
        <button class="text-info black-bg border border-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">';
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '    Comment
        </button>
        </p>
        <div class="collapse" id="collapseExample">
        
        <form action="'; ?><?php echo $_SERVER['REQUEST_URI'] ?><?php echo '" method="post">
            <div class="mb-3">
                <textarea class="form-control" name="comment" id="exampleInputPassword1" cols="30" rows="5"  required></textarea>
            </div>
            <button name="insert" class="btn btn-info">Post</button>
        </form><br>';
        } else {
            echo 'You are not logged in. Please loggin to post a comment';
        }
        echo '
        </div>
    </div>';
    }
    ?>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sess_user_id = $_SESSION['userid'];
    }
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['insert'])) {
            $comment = $_POST['comment'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ('$comment', '$thread_id', CURRENT_TIMESTAMP, '$sess_user_id')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>window.location = "answer.php?threadid='.$id.'"</script>';
            }
        }
        if (isset($_POST['delete'])) {
            $delid = $_POST['del_id'];
            $sql = "DELETE FROM `comments` WHERE `comments`.`comment_id` = $delid";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>window.location = "answer.php?threadid='.$id.'"</script>';
            }
        }
    }
    ?>

    <div class="container border border-info rounded black-bg border">
        <h1 class="text-light">Discussions</h1>
        <hr>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=" . $id . " ORDER BY `comment_time` DESC";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $comment_id = $row['comment_id'];
            $comment_content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_user_id = $row['comment_by'];

            $sql_name = "SELECT * FROM `users` WHERE sno = " . $comment_user_id . "";
            $result_name = mysqli_query($conn, $sql_name);
            while ($row = mysqli_fetch_assoc($result_name)) {
                $user_name = $row['user_name'];
                $user_avt_id = $row['avatar_id'];
            }

            $sql_icon = "SELECT * FROM `avatar` WHERE avatar_id = " . $user_avt_id . "";
            $result_icon = mysqli_query($conn, $sql_icon);
            while ($row = mysqli_fetch_assoc($result_icon)) {
                $user_icon = $row['avatar_add'];
            }

            // managing time display using _timer.php
            $sting_atime =  strtotime(date("Y-m-d H:i:s")) + 16200 - strtotime($comment_time);
            include 'partials/_timer.php';

            echo '<div class="d-flex">
                <div class="flex-shrink-0 ">
                    <img src="' . $user_icon . '" alt="...">
                </div>
                <div class="flex-grow-1 ms-3 text-light">
                    ' . $user_name . ' * ' . $display_time . '
                </div>';
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                if ($sess_user_id == $comment_user_id) {
                    echo '
                        <form action="'; ?><?php echo $_SERVER['REQUEST_URI'] ?><?php echo '" method="post">
                        <input type="hidden" name="del_id" class="form-control" value=' . $comment_id . '>
                        <button name="delete" class="btn btn-info">Delete</button>
                        </form>
                        ';
                }
            }
            echo '</div><h4 class="ms-5 text-light">' . $comment_content . '</h4><hr>';
            }
            if ($noResult) {
                echo '
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p class="display-4">No Result Found</p>
                    <p class="lead">Be the first to ask a question</p>
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