<?php

// Require
require("../php/pdo.inc.php");

// Order
// This one has to be hard-coded in PDO.
$order = "zscore-buyNowPrice";
if (isset($_GET['sort'])) {
	switch ($_GET['sort']) {
		case 'now':
			$order = "zscore-buyNowPrice";
		break;
		case 'current':
			$order = "zscore-currentPrice";
		break;
		case 'bids':
			$order = "zscore-data-bids";
		break;
	}
}

// Rarity
$rarity = '%';
if (isset($_GET['rarity'])) {
	$rarity = "%".$_GET['rarity']."%";
}

// Category
$category = '%';
if (isset($_GET['category'])) {
	$category = "%".$_GET['category']."%";
}

// Name
$name = '%';
if (isset($_GET['name'])) {
	$name = "%".$_GET['name']."%";
}

// Statement
$stmt = $pdo->prepare("SELECT * FROM `market-everything` WHERE `data-type` LIKE :category AND `rarity-marker` LIKE :rarity AND `abstract-name` LIKE :name ORDER BY `$order` LIMIT 100;");
$stmt->execute(["category" => $category, "rarity" => $rarity, "name" => $name]);
$row = $stmt->fetch();

// Array
$y = array();
while ($row = $stmt->fetch()) {

	// Columns
	$x = array(
		"data-wearableitemid" => $row["data-wearableitemid"],
		"data-itemid"=> $row["data-itemid"],
		"data-type"=> $row["data-type"],
		"rarity-marker"=> $row["rarity-marker"],
		"abstract-name"=> $row["abstract-name"],
		"abstract-type"=> $row["abstract-type"],
		"currentPrice"=> $row["currentPrice"],
		"zscore-currentPrice"=> $row["zscore-currentPrice"],
		"buyNowPrice"=> $row["buyNowPrice"],
		"zscore-buyNowPrice"=> $row["zscore-buyNowPrice"],
		"data-bids"=> $row["data-bids"],
		"zscore-data-bids"=> $row["zscore-data-bids"],
		"abstract-icon"=> "http://eldarya.fr".$row["abstract-icon"]
	);
	
	// Rows
    array_push($y, $x);
}

// Display
header('Content-Type: application/json; charset=utf-8');
echo json_encode($y);

?>