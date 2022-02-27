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

    <div class="container border border-info rounded black-bg border">
        <h1 class="text-wrap text-light mt-3">Search result for : <em>"<?php echo $_GET['search']; ?>"</em></h1>

        <?php
        $noResult = true;
        $search = $_GET["search"];
        $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) AGAINST ('$search')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $thread_user_id = $row['thread_user_id'];
            $thread_time = $row['time'];
            $url = "thread.php?threadid=" . $thread_id;

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

            //Display the search results
            echo '<div class="d-flex">
            <div class="flex-shrink-0 ">
                <img src="' . $user_icon . '" alt="...">
            </div>
            <div class="flex-grow-1 ms-3 text-light">
                <h5>'.$user_name.' * ' . $display_time . '</h5>
                <h5 class="mt-0 text-light"><a class="text-decoration-none text-light" href="answer.php?threadid=' . $thread_id . '">' . $thread_title . '</a></h5>
                ' . $thread_desc . '
            </div>
            </div><hr>';
        }
        if ($noResult) {
            echo '<div class="container border border-info rounded my-3  bg-dark">
            <h1 class="display-4 text-light">Oops! no result found.</h1>
                <h3 class="lead text-light">Suggestions:</h3>
                <p class="lead text-light"><em>Try different keywords.</em></p>
                <p class="lead text-light"><em>Try more general keywords.</em></p>
                <p class="lead text-light"><em>Try fewer keywords.</em></p>
            </div>';
        }

        ?>
    </div>
    <!-- footer added -->
    <?php include 'partials/_footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>