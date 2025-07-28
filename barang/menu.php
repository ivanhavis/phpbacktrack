<?php
session_start();
if (empty($_SESSION['username']))
{
    header("location:index.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: MENU UTAMA :: </title>
    <link rel="stylesheet" href="../assets/css/menu.css"> <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

    <video autoplay muted loop id="full-page-background-video">
        <source src="../assets/videos/Drifting_Car_Video_Generated.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="main-content-wrapper">

        <div class="menu-grid-container">

            <a href="tampil_barang.php" class="grid-panel show-panel">
                <div class="panel-content">
                    <span class="panel-text">SHOW</span>
                </div>
            </a>

            <a href="form_barang.php" class="grid-panel edit-panel">
                <div class="panel-content">
                    <span class="panel-text">EDIT</span>
                </div>
            </a>

            <a href="logout.php" class="grid-panel out-panel">
                <div class="panel-content">
                    <span class="panel-text">OUT</span>
                </div>
            </a>

            <div class="grid-panel admin-label-panel">
                <div class="panel-content">
                    <span class="admin-text"><?php echo $_SESSION['username']; ?></h5></span>
                </div>
            </div>

        </div>
    </div>

</body>
</html>