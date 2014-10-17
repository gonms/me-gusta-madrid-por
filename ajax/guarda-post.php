<?php

	include("bbdd.inc.php");
	
	$sql = "INSERT INTO post (texto, id_categoria, hora, ip) VALUES ('" . utf8_decode(mysql_real_escape_string($_POST['texto'])) . "','" . mysql_real_escape_string($_POST['categoria']) . "', NOW(), '" . $_SERVER['REMOTE_ADDR'] . "')";
	$res = mysql_query($sql);
	
	$tot = mysql_affected_rows();
	
	if ($tot > 0)
	{
		$sql = "SELECT p.id, p.texto, c.nombre FROM post p
				INNER JOIN categorias c on c.id = p.id_categoria
				ORDER BY id DESC LIMIT 0,1";
				
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		
		$result = '<li>
						<span>POR...</span> 
						' . $row['texto'] . '
						<div class="datos">
							<p class="categoria"><span class="azul">Categor&iacute;a:</span> ' . $row['nombre'] . '</p>
							<p class="hora">hace unos segundos</p>
						</div>
						<div class="clear datos">
							<p class="gusta"><a href="#" onclick="megusta(\'' . $row['id'] . '\');return false;"><img src="img/megusta.png" width="32px" height="32px" style="margin-right:2%;" id="imgGusta_' . $row['id'] . '" /></a></p>
							<p class="valor" id="gustas_' . $row['id'] . '">' . $row['total'] . '</p>
							<p class="twitter"><a href="#" onclick="twitter(\'' . $row['id'] . '\');return false;"><img src="img/twitter.png" width="32px" height="32px" /></a></p>
							<p id="comentarios_' . $row['id'] . '" class="comentario"><a href="#" class="aComentarios" onclick="comentarios(\'' . $row['id'] . '\');return false;">comentarios</a></p>
						</div>
						<div class="clear"></div>
						</li>';
	}
	else
	{
		$result = "ERROR";
	}
	
	mysql_close($conn);

	echo utf8_encode($result);
?>