<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $desc, $price, $qty);
    $stmt->execute();
    header("Location: index.php");
}
?>
<h2>Add Product</h2>
<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Description: <textarea name="description"></textarea><br><br>
    Price: <input type="number" step="0.01" name="price" required><br><br>
    Quantity: <input type="number" name="quantity" required><br><br>
    <input type="submit" value="Save">
</form>
