<?php

	include("bbdd.inc.php");
	
	$sql = "SELECT total FROM gusta WHERE id_post = '" . $_POST['id'] . "'";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0)
	{
		$sql = "UPDATE gusta SET total = total + 1 WHERE id_post = '" . $_POST['id'] . "'";
		$res = mysql_query($sql);
		
		$tot = mysql_affected_rows();
	
		if ($tot > 0)
		{
			$res = mysql_query("SELECT total FROM gusta WHERE id_post = '" . $_POST['id'] . "'");
			$row = mysql_fetch_array($res);
			$tot = $row['total'];
		}
	}
	else
	{
		$sql = "INSERT INTO gusta (id_post, total) VALUES ('" . $_POST['id'] . "','1')";
		$res = mysql_query($sql);
		$tot = 1;
	}

	mysql_close($conn);
	
	echo $tot;
?>