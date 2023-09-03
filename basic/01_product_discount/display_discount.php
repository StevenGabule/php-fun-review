<?php
// get the data from the form
$product_description = $_POST['product_description'];
$list_price = $_POST['list_price'];
$discount_percent = $_POST['discount_percent'];

// calculate the distance
$discount = $list_price * $discount_percent * .01;
$discount_price = $list_price - $discount;

// Apply currency formatting to the dollar and percent amounts
$list_price_formatted = "$" . number_format($list_price, 2);
$discount_percent_formatted = "$" . number_format($discount_percent, 2);
$discount_formatted = "$" . number_format($discount, 2);
$discount_price_formatted = "$" . number_format($discount_price, 2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Discount Calculator</title>
</head>

<body>
	<div id="content">
		<h1>Product Discount Calculator</h1>
		<label>Product Description</label>
		<span><?= $product_description ?></span><br />

		<label>List Price</label>
		<span><?= $list_price_formatted ?></span><br />

		<label>Standard Discount</label>
		<span><?= $discount_percent_formatted ?></span><br />

		<label>Discount Amount</label>
		<span><?= $discount_formatted ?></span><br />

		<label>Discount Price</label>
		<span><?= $discount_price_formatted ?></span><br />
	</div>
</body>

</html>