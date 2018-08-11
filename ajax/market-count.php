<?php

// Require
require("../php/pdo.inc.php");

// Order
$order = "zscore-buyNowPrice";
$bidless = 0;
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
			$bidless = 1;
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

// Colour
$colour = "%";
if (isset($_GET['colour'])) {
	$colour = $_GET['colour'] == "" ? "%" : $_GET['colour'];
}

// Type
$type = '%';
if (isset($_GET['type'])) {
	$type = "%".$_GET['type']."%";
}

// Statement
$stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM `z-market` WHERE `data-type` LIKE :category AND `rarity-marker` LIKE :rarity AND `abstract-name` LIKE :name AND `data-wearableitemid` LIKE :colour AND `abstract-type` LIKE :type AND `data-bids` >= :bidless ;");
$stmt->execute(["category" => $category, "rarity" => $rarity, "name" => $name, "colour" => $colour, "type" => $type, "bidless" => $bidless]);
$count = $stmt->fetch();

// Display
header('Content-Type: application/json');
echo json_encode($count);

?>