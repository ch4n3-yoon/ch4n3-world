<?php
$conn = mysql_connect('localhost', 'respect', 'pt197080');

$db_id=mysql_select_db("respect", $conn);

if($db_id){
	echo "good";
}

else {
	echo "ha";
}

?>
