<?php

include '../functions.php';

$conn = db__connect("yulu");

$rand = rand(1, db__rowNum($conn, "yulu"));

$words = db__getData($conn, "yulu", "wid", $rand);

echo $words[0]['words'];

