<?php
/*$hash = password_hash('password_user', PASSWORD_ARGON2I, ['memory_cost' => 1024, 'time_cost' => 1, 'threads' => 1]);*/

if (!empty($_GET['token'])) {
    if (password_verify('password_user', $_GET['token'])) {
      echo '¡La contraseña es válida!';
  } else {
      echo 'La contraseña no es válida.';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
</head>
<body>

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="argon2-browser/lib/argon2.js"></script>
  <script>
     function redirect(token) {
      setTimeout(function () {
          window.location.href = "index.php?token="+token;
        }, 3000);
    }
    jQuery(document).ready(function($) {
      let contra = argon2.hash({
        pass    : 'password_user',
        salt    : 'somesalt',
        type    : argon2.ArgonType.Argon2i,
        distPath: '/argon2/argon2-browser/dist'
      })
      .then(h =>
        //console.log(h.hash, h.hashHex, h.encoded)
        //console.log(h.hash)
        //console.log(h.hashHex)
        redirect(h.encoded)
      )
      .catch(e =>
        console.error(e.message, e.code)
      );

    });
  </script>
</body>
</html>