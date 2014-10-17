<?php
	include("bbdd.inc.php");
	
	$sql = "SELECT * FROM categorias ORDER BY nombre";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res))
	{
		$result .= '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
	}
	
	echo '<option value="">Categoría</option>' . utf8_encode($result);

?>