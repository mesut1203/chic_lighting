<?php
require 'server/connection.php';
mysqli_set_charset($conn, 'UTF8');

// Handle Update Product
if (isset($_POST['update_product'])) {
    if (!empty($_POST['checkbox'])) {
        foreach ($_POST['checkbox'] as $product_id) {
            $product_id = intval($product_id); // Ensure it's an integer
            $sql = "UPDATE product SET title = 'Updated Title', price = 'Updated Price', discount = 'Updated Discount', image_product = 'Updated Image', description = 'Updated Description' WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            if ($stmt->execute()) {
                echo "Product with ID $product_id updated successfully.<br>";
            } else {
                echo "Error updating product with ID $product_id: " . $conn->error . "<br>";
            }
            $stmt->close();
        }
    } else {
        echo "No products selected for update.";
    }
}

// Handle Add Product
if (isset($_POST['add_product'])) {
    // You might want to use a separate form for adding products
    $title = $_POST['title'] ?? '';
    $price = $_POST['price'] ?? '';
    $discount = $_POST['discount'] ?? '';
    $image_product = $_POST['image_product'] ?? '';
    $description = $_POST['description'] ?? '';

    $sql = "INSERT INTO product (title, price, discount, image_product, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsss", $title, $price, $discount, $image_product, $description);
    if ($stmt->execute()) {
        echo "New product added successfully.<br>";
    } else {
        echo "Error adding product: " . $conn->error . "<br>";
    }
    $stmt->close();
}

// Handle Delete Product
if (isset($_POST['delete_product'])) {
    if (!empty($_POST['checkbox'])) {
        foreach ($_POST['checkbox'] as $product_id) {
            $product_id = intval($product_id); // Ensure it's an integer
            $sql = "DELETE FROM product WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            if ($stmt->execute()) {
                echo "Product with ID $product_id deleted successfully.<br>";
            } else {
                echo "Error deleting product with ID $product_id: " . $conn->error . "<br>";
            }
            $stmt->close();
        }
    } else {
        echo "No products selected for deletion.";
    }
}

$conn->close();
?>
