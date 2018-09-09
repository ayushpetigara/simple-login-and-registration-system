<?php
function UserID($email)
{
	global $db;
	
	$query = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");
	$row = mysqli_fetch_assoc($query);
	
	return $row['id'];
}

?>