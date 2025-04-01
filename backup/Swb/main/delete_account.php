<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_account'])) {
    // Assuming $conn is your database connection
    $user_id = $user_id_sess;
    // echo $user_id;
    // exit;
    if (empty($user_id)) {
        echo '<div class="alert alert-warning">An Error Occurred. Please try again later.</div>';
        exit();
    }

    // Fetch all sweebs and delete associated images
    $sql_sweebs = "SELECT image FROM sweebs WHERE user_id = ?";
    $stmt = $conn->prepare($sql_sweebs);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result_sweebs = $stmt->get_result();

    while ($row = $result_sweebs->fetch_assoc()) {
        if (!empty($row['image'])) {
            $image = $row['image'];
            $website = $_SERVER['DOCUMENT_ROOT'];
            $file_path = $website . '/file/' . $image;
            if (file_exists($file_path)) {
                unlink($file_path); // Delete image file
            }
        }
    }
    $stmt->close();

    // Delete all sweebs from the database
    $sql_delete_sweebs = "DELETE FROM sweebs WHERE user_id = ?";
    $stmt = $conn->prepare($sql_delete_sweebs);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Delete user from members table
    $sql_delete_member = "DELETE FROM members WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_member);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Redirect or provide feedback
    echo "<script>alert('Account deleted successfully.'); window.location.href = 'logout.php';</script>";
    exit();
}
