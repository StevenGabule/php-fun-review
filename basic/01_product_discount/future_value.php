<?php
// get the data from the form
$investment = $_POST['investment'];
$interest_rate = $_POST['interest_rate'];
$years = $_POST['years'];

// validate investment entry
if (empty($investment)) {
	$error_message = 'Investment is a required filed.';
} else if (!is_numeric($investment)) {
	$error_message = 'Investment must be a valid number.';
} else if ($investment <= 0) {
	$error_message = 'Investment must be greater than zero.';
} else if (empty($interest_rate)) {
	$error_message = 'Interest rate is a required field.';
} else if (!is_numeric($interest_rate)) {
	$error_message = 'Interest rate must be a valid number.';
} else if ($interest_rate <= 0) {
	$error_message = 'Interest rate must be greater than zero.';
} else {
	$error_message = '';
}

$future_value = $investment;

for ($i = 1; $i < $years; $i++) {
	$future_value = ($future_value + ($future_value * $interest_rate * .01));
}

// apply currency and percent formatting
$investment_f = '$' . number_format($investment, 2);
$yearly_rate_f = $interest_rate.'%';
$future_value_f = '$' . number_format($future_value, 2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Future Value Calculator</title>
</head>

<body>
	<div id="content">
		<h1>Future Value Calculator</h1>
		<?php if (!empty($error_message)) { ?>
			<p class="error"><?= $error_message; ?></p>
		<?php } ?>
		<form action="future_alue.php" method="post">
			<div id="data">
				<label>Investment Amount:</label>
				<input type="text" name="investment" value="<?= $investment ?>" /><br />

				<label>Yearly Interest Rate:</label>
				<input type="text" name="interest_rate" value="<?= $interest_rate ?>" /><br />

				<label>Number of Years:</label>
				<input type="text" name="years" value="<?= $years ?>" /><br />
			</div>
			<div id="buttons">
				<label>&nbsp;</label>
				<input type="submit" value="Calculate"><br />
			</div>
		</form>
	</div>
</body>

</html>