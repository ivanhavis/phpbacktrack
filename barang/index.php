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
  <div class="l-form">
    <div class="shape1"></div>
    <div class="shape2"></div>

    <div class="form">
      <div class="form__img">
    <img src="../gambar/Timeline 1.gif" alt="Welcome" class="welcome-gif" width="400" height="200"  />
      </div>

      <form id="login" method="post" name="login" action="login_proses.php" class="form__content">
        <h1 class="form__title"></h1>

        <div class="form__div form__div-one">
          <div class="form__icon">
            <i class='bx bx-user-circle'></i>
          </div>
          <div class="form__div-input">
            <input name="username" type="text" class="form__input" id="username" placeholder=" " required>
            <label for="username" class="form__label">Username</label>
          </div>
        </div>

        <div class="form__div">
          <div class="form__icon">
            <i class='bx bx-lock'></i>
          </div>
          <div class="form__div-input">
            <input name="password" type="password" class="form__input" id="password" placeholder=" " required>
            <label for="password" class="form__label">Password</label>
          </div>
        </div>

        <input name="login" type="submit" class="form__button" id="login" value="Login">
      </form>
    </div>
  </div>

  <script>
    const inputs = document.querySelectorAll('.form__input');
    inputs.forEach(input => {
      input.addEventListener('focus', () => {
        input.parentNode.parentNode.classList.add('focus');
      });
      input.addEventListener('blur', () => {
        if (input.value === "") {
          input.parentNode.parentNode.classList.remove('focus');
        }
      });
    });
  </script>
</body>
</html>