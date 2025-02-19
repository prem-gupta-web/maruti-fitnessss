<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO gallery (image_path) VALUES ('$target_file')";
        $conn->query($sql);
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit">Upload</button>
</form>

<table>
    <tr>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM gallery");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><img src='" . $row['image_path'] . "' width='100'></td>
                <td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>
              </tr>";
    }
    ?>
</table>

<a href="logout.php">Logout</a>
