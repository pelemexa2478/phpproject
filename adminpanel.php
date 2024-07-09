<?php

session_start();

$conn = new mysqli('localhost', 'root', '', 'BD_SHOP');

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$sql = "SELECT product_id, name FROM products";
$result = $conn->query($sql);

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '    <meta charset="UTF-8">';
echo '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '    <title>Admin Panel</title>';
echo '    <link rel="stylesheet" href="css/admin_style.css">';
echo '</head>';
echo '<body>';

echo '    <div id="admin-panel">';
echo '        <a href="../index.php" id="logout-btn">Выйти</a>';

echo '        <div id="product-list-panel">';
echo '            <h2>Список абонементов</h2>';
echo '            <ul id="product-list-items">';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<li class='product-item' data-id='" . $row['product_id'] . "'>" . $row['name'] . "</li>";
    }
}

echo '            </ul>';
echo '        </div>';

echo '        <div id="product-details-panel">';
echo '            <h2>Детали абонементов</h2>';
echo '            <form id="product-details-form" method="post" action="index.php">'; 
echo '                <input type="hidden" id="product-id" name="product-id">';

echo '                <label for="product-name">Название Абонемента:</label>';
echo '                <input type="text" id="product-name" name="product-name" required>';

echo '                <label for="product-price">Цена:</label>';
echo '                <input type="number" step="0.01" id="product-price" name="product-price" required>';

echo '                <label for="product-description">Описание:</label>';
echo '                <textarea id="product-description" name="product-description" required></textarea>';

echo '                <button type="submit">Сохранить</button>';
echo '                <button type="button" id="delete-product-btn">Удалить</button>';
echo '            </form>';

echo '            <h2>Добавить новый абонемент</h2>';
echo '            <form id="add-product-form" method="post" action="add_product.php">'; 
echo '                <label for="new-product-name">Название Абонемента:</label>';
echo '                <input type="text" id="new-product-name" name="new_product_name" required>'; 

echo '                <label for="new-product-price">Цена:</label>';
echo '                <input type="number" step="0.01" id="new-product-price" name="new_product_price" required>'; 

echo '                <label for="new-product-description">Описание:</label>';
echo '                <textarea id="new-product-description" name="new_product_description" required></textarea>';

echo '                <button type="submit">Добавить</button>';
echo '            </form>';
echo '        </div>';
echo '    </div>';

echo '    <script src="js/script.js"></script>';  
echo '</body>';
echo '</html>';


if (isset($_GET['action']) && $_GET['action'] == 'edit') {      
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

$conn->close();

  
