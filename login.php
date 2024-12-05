<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

unset($_SESSION['name']);

function login() {
  global $fout;
  $fout = '';
  $password = 'dasfq1f42rg3rrwg324@#@FFQ!';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
      $fout = '<h4 class="foutmelding">Please enter your name</h4>';
    } else {
      $attempts = file('content/loginattempts.txt', FILE_IGNORE_NEW_LINES);
      if (!in_array($_POST['name'], $attempts)) {
        file_put_contents('content/loginattempts.txt', $_POST['name'] . PHP_EOL, FILE_APPEND);
      }
    }
    if (empty($_POST['password'])) {
      $fout = '<h4 class="foutmelding">Please enter a password</h4>';
    } elseif(!empty($_POST['password']) && $_POST['password'] == $password) {
      $_SESSION['name'] = $_POST['name'];
      header('Location: projects.php');
      exit;
    } elseif (!empty($_POST['password']) && $_POST['password'] != $password) {
      $fout = '<h4 class="foutmelding">Incorrect password</h4>';
    }
  }
}
$fout = login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://kit.fontawesome.com/60e1a8883b.js" crossorigin="anonymous"></script>   
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main>
        <a href="landingpage.php">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="loginbox">
            <div class="loginboxlvl2">
                <form action="<?php echo login(); ?>" method="POST">
                    <div class="input">
                        <label for="name">First and Last name</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="input">
                        <label for="password">Passcode</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="input">
                        <input type="submit" value="Submit">
                    </div>
                    <div class="error input">
                        <?php echo $fout; ?>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>