<?php

class ProductDB
{
  /**
   * @param $category_id
   * @return array
   */
  public static function getProductsByCategory($category_id): array
  {
    $db = Database::getDB();
    $category = CategoryDB::getCategory($category_id);
    $query = "SELECT * FROM products 
              WHERE categoryID = '$category_id' 
              ORDER BY productID";
    $result = $db->query($query);
    $products = array();
    foreach ($result as $row) {
      $product = new Product($category, $row['productCode'], $row['productName'], $row['listPrice']);
      $product->setID($row['productID']);
      $products[] = $product;
    }
    return $products;
  }

  /**
   * @param $product_id
   * @return Product
   */
  public static function getProduct($product_id): Product
  {
    $db = Database::getDB();
    $query = "SELECT * FROM products WHERE productID = '$product_id'";
    $result = $db->query($query);
    $row = $result->fetch();
    $category = CategoryDB::getCategory($row['categoryID']);
    $product = new Product($category, $row['productCode'], $row['productName'], $row['listPrice']);
    $product->setID($row['productID']);
    return $product;
  }

  /**
   * @param $product_id
   * @return false|int
   */
  public static function deleteProduct($product_id): false|int
  {
    $db = Database::getDB();
    $query = "DELETE FROM products WHERE productID='$product_id'";
    return $db->exec($query);
  }

  /**
   * @param $product
   * @return false|int
   */
  public static function addProduct($product): false|int
  {
    $db = Database::getDB();
    $category_id = $product->getCategory()->getId();
    $code = $product->getCode();
    $name = $product->getName();
    $price = $product->getPrice();
    $query = "INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES('$category_id', '$code', '$name', '$price')";
    return $db->exec($query);
  }



}