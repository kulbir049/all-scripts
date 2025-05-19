<?php include 'db.php'; ?>
<h2>Product List</h2>
<a href="create.php">Add Product</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Qty</th><th>Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM products");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['description']}</td>
            <td>{$row['price']}</td>
            <td>{$row['quantity']}</td>
            <td>
                <a href='edit.php?id={$row['id']}'>Edit</a> |
                <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Delete this product?')\">Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>
