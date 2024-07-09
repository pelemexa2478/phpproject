<?php

$conn = new mysqli('localhost', 'root', '', 'BD_SHOP');

if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

if (isset($_POST['login']) && isset($_POST['password'])) {
  $login = $_POST['login'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE login = '$login'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $isPasswordCorrect = $row['password'] == $password;

    if ($isPasswordCorrect) {
      $success = true;
      $message = "";
      $role = $row['role'];

      session_start();

      $_SESSION['isLoggedIn'] = true;
      $_SESSION['userRole'] = $role;

    } else {
      $success = false;
      $message = "Неверный логин или пароль!";
    }
  } else {
    $success = false;
    $message = "Неверный логин или пароль!";
  }

  echo json_encode(array("success" => $success, "message" => $message, "role" => $role));

} else if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  session_start();

  if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    session_unset();
    session_destroy();
  }

  header("Location: index.php"); 
  exit;
}

$conn->close();

?>
