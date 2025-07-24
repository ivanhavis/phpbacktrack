<?php
if(isset($_GET['pesan'])){
//Cek apakah login benar salah
if($_GET['pesan'] == "gagal") {
echo '<script type="text/JavaScript">';
echo  'alert("Silahkan Masukan username dan password dengan benar")';
echo '</script>';
}
}
?>

<html>
<head>
<link rel="stylesheet" href="../assets/css/styles.css">
<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel="stylesheet">
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<title>Login</title>
</head>

<body>
 <div class="1-form">
<div class="shape1"></div>
 <div class="shape2"></div>
 <div class="form">
<lottie-player class="form_img" src="https://assets5.lottiefiles.com/packages/1f20_mrmg8x7w.json"
 background="transparent" speed="1" style="width: 580px; height: 500px;"
 loop autoplay></lottie-player>

<form id="login" method="post" name="login" action="login_proses.php" class="form content">
 <h1 class="form_title">Welcome</h1>
 <div class="form_div form_div-one">
 <div class="form_icon">
 <i class='bx bx-user-circle'></i>
 </div>
 <div class="form_div-input">
 <label for="" class="form_label">Username</label>
 <input name="username" type="text" class="form_input" id="username">
 </div>
 <div class="form_div">
 <div class="form_icon">
 <i class='bx bx-lock' ></i>
 </div>
 <div class="form_div-input">
 <label for="" class="form_label">Password</label>
 <input name="password" type="password" class="form_input" id="password">
 </div>
</div>
<br><br>
<input name="login" type="submit" class="form_button" id="login" value="Login">
</form>
</div>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>