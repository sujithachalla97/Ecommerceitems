<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
  $user = $_SESSION['username'];
  $cart = json_decode($_POST['cart'], true);
  $totalPrice = $_POST['totalPrice'];

  $userIdQuery = "SELECT id FROM users WHERE username='$user'";
  $userIdResult = $conn->query($userIdQuery);
  $userId = $userIdResult->fetch_assoc()['id'];

  $orderQuery = "INSERT INTO orders (user_id, total_price) VALUES ('$userId', '$totalPrice')";
  if ($conn->query($orderQuery) === TRUE) {
    $orderId = $conn->insert_id;
    foreach ($cart as $item) {
      $productName = $item['product'];
      $price = $item['price'];
      $quantity = 1;  // Assuming quantity is 1 for simplicity
      $orderItemQuery = "INSERT INTO order_items (order_id, product_name, price, quantity) VALUES ('$orderId', '$productName', '$price', '$quantity')";
      $conn->query($orderItemQuery);
    }
    echo "Order processed successfully";
  } else {
    echo "Error: " . $orderQuery . "<br>" . $conn->error;
  }
}

$conn->close();
?>
<form method="post" action="process_order.php">
  <input type="hidden" name="cart" value='<?php echo json_encode($cart); ?>'>
  <input type="hidden" name="totalPrice" value='<?php echo $totalPrice; ?>'>
  <input type="submit" value="Place Order">
</form>
