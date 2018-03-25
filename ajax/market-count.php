<?php

// Require
require("../php/pdo.inc.php");

// Statement
$stmt = $pdo->query("SELECT COUNT(*) AS count FROM `market-everything`");
$row = $stmt->fetch();

// Display
header('Content-Type: application/json');
echo json_encode($row);

?>