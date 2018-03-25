<?php

// Require
require("../php/pdo.inc.php");

// Statement
$stmt = $pdo->query("SELECT * FROM `market-everything` LIMIT 100");
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
header('Content-Type: application/json');
echo json_encode($y);

?>