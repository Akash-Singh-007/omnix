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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=" . $id . "";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat = $row['catagory_name'];
        $desc = $row['category_description'];
        $img = $row['image'];
    }
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sess_user_id = $_SESSION['userid'];
    }
    ?>
    <?php
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['insert'])) {
            $subject = $_POST['subject'];
            $descr = $_POST['desc'];
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ('$subject', '$descr', '$id', '$sess_user_id', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>window.location = "threads.php?catid='.$id.'"</script>';
            }
            $showAlert = true;
            if ($showAlert) {
                echo '
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>Your concern has been posted!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['delete'])) {
            $delid = $_POST['del_id'];
            $sql =  "DELETE FROM `threads` WHERE `threads`.`thread_id` = $delid";
            $result = mysqli_query($conn, $sql);
            $sql =  "DELETE FROM `comments` WHERE `comments`.`thread_id` = $delid";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<script>window.location = "threads.php?catid='.$id.'"</script>';
            }
            $showAlert = true;
            if ($showAlert) {
                echo '
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>Your post is deleted</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
        }
    }
    ?>
    <?php
    echo '
    <div class="container my-4 border border-info rounded  black-bg">
        <div class="jumbotron py-4  black-bg ">
            <h1 class="display-4 text-light"><img style="height:60px;width:60px;border-radius:50%;margin:20px;" src="' . $img . '" alt="">' . $cat . ' Talks</h1>
            <p class="lead text-light">' . $desc . '</p>
            <hr class="my-4">
            <p class="text-light">This is a peer to peer forum for sharing knowledge with each other. Do not post copyright-infringing content.</p>
        </div>
        <p>
        <button class="text-info black-bg border border-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo 'Ask
            </button>
        </p>
        <div class="collapse" id="collapseExample">
        
        <form action="'; ?><?php echo $_SERVER['REQUEST_URI'] ?><?php echo '" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1"  class="form-label text-light">Whats on your mind?</label>
                <input type="text" name="subject" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label text-light">Ellaborate Your Concern</label>
                <textarea class="form-control" name="desc" id="exampleInputPassword1" cols="30" rows="5"  required></textarea>
            </div>
            <button name="insert" class="btn btn-info">Post</button>
        </form><br>
            ';
                                                            } else {
                                                                echo 'You are not logged in. Please loggin to post a concern.';
                                                            }
                                                            echo '        
        </div>
    </div>
    ';
                                                                ?>

    <div class="container border border-info rounded black-bg border">
        <h1 class="text-light">Browse Questions</h1>
        <hr>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=" . $id . " ORDER BY `time` DESC";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
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
            $sting_atime =  strtotime(date("Y-m-d H:i:s")) + 16200 - strtotime($thread_time);
            include 'partials/_timer.php';

            echo '<div class="d-flex">
                <div class="flex-shrink-0 ">
                    <img src="' . $user_icon . '" alt="...">
                </div>
                <div class="flex-grow-1 ms-3 text-light">
                    <h5>'.$user_name.' * ' . $display_time . '</h5>
                    <h5 class="mt-0 text-light"><a class="text-decoration-none text-light" href="answer.php?threadid=' . $thread_id . '">' . $thread_title . '</a></h5>
                    ' . $thread_desc . '
                </div>';
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {    
                if($sess_user_id == $user_id){
                    echo '
                    <form action="'; ?><?php echo $_SERVER['REQUEST_URI'] ?><?php echo '" method="post">
                    <input type="hidden" name="del_id" class="form-control" value='.$thread_id.'>
                    <button name="delete" class="btn btn-info">Delete</button>
                    </form>
                    ';
                }
            }
            echo '</div><hr>';
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