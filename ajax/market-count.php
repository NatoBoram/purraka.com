<?php

// Require
require "../php/pdo.inc.php";

// Order
$order     = "if(`data-bids` = 0, least(`zscore-buyNowPrice`, `zscore-currentPrice`), `zscore-currentPrice`)";
$bidstring = "`data-bids` >= 0";
if (isset($_GET['sort'])) {
	switch ($_GET['sort']) {
	case 'now':
		$order     = "`zscore-buyNowPrice`";
		$bidstring = "`data-bids` = 0";
		break;
	case 'current':
		$order     = "`zscore-currentPrice`";
		$bidstring = "`data-bids` >= 0";
		break;
	case 'bids':
		$order     = "`zscore-data-bids`";
		$bidstring = "`data-bids` >= 0";
	case "both":
		$order     = "if(`data-bids` = 0, least(`zscore-buyNowPrice`, `zscore-currentPrice`), `zscore-currentPrice`)";
		$bidstring = "`data-bids` >= 0";
		break;
	}
}

// Rarity
$rarity = '%';
if (isset($_GET['rarity'])) {
	$rarity = "%" . $_GET['rarity'] . "%";
}

// Category
$category = '%';
$notegg   = 'EggItem';
if (isset($_GET['category'])) {
	$category = "%" . $_GET['category'] . "%";

	// Anti-Egg Squad
	if ($_GET['category'] == "EggItem") {
		$notegg = "";
	}
}

// Name
$name = '%';
if (isset($_GET['name'])) {
	$name = "%" . $_GET['name'] . "%";
}

// Colour
$colour = "%";
if (isset($_GET['colour'])) {
	$colour = $_GET['colour'] == "" ? "%" : $_GET['colour'];
}

// Type
$type = '%';
if (isset($_GET['type'])) {
	$type = "%" . $_GET['type'] . "%";
}

// Statement
$stmt = $pdo->prepare("SELECT COUNT(*) AS count
FROM `z-market`
	WHERE `data-type` LIKE :category
	AND `rarity-marker` LIKE :rarity
	AND `abstract-name` LIKE :name
	AND `data-wearableitemid` LIKE :colour
	AND `abstract-type` LIKE :type
	AND $bidstring
	AND `data-type` != '$notegg'
;");
$stmt->execute(["category" => $category, "rarity" => $rarity, "name" => $name, "colour" => $colour, "type" => $type]);
$count = $stmt->fetch();

// Display
header('Content-Type: application/json');
echo json_encode($count);
