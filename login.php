<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT password FROM users WHERE username='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      echo "Login successful";
    } else {
      echo "Invalid password";
    }
  } else {
    echo "No user found";
  }

  $conn->close();
}
?>
<form method="post" action="">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Login">
</form>
