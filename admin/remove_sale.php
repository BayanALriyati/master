<?php include '../components/connect.php';

$id = $_GET['removeSale'];

$xx = $conn->prepare("UPDATE products set is_sale='0',price_discount = '0'
                        WHERE product_id='$id'");
$xx->execute();
header('location:product.php');