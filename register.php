<?php
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "Registration successful";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>
<form method="post" action="">
  Username: <input type="text" name="username"><br>
  Email: <input type="email" name="email"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Register">
</form>
