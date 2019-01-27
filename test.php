<?php
 
$mysql = new mysqli("localhost", "darth-vader", "password", "track");

$query = "select * from visits";

$stmt = $mysql->prepare($query);
$stmt->execute();

$res = $stmt->get_result();

while($row = $res->fetch_row()){
    echo $row[1];
}
