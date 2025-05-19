<?php
include 'db.php';

$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, quantity=? WHERE id=?");
    $stmt->bind_param("ssdii", $name, $desc, $price, $qty, $id);
    $stmt->execute();
    header("Location: index.php");
}
?>
<h2>Edit Product</h2>
<form method="post">
    Name: <input type="text" name="name" value="<?= $product['name'] ?>" required><br><br>
    Description: <textarea name="description"><?= $product['description'] ?></textarea><br><br>
    Price: <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required><br><br>
    Quantity: <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required><br><br>
    <input type="submit" value="Update">
</form>
