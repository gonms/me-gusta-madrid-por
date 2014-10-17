<?php

	include("bbdd.inc.php");
	
	$sql = "SELECT p.id, p.texto, p.hora, c.nombre, g.total FROM post p
			INNER JOIN categorias c on c.id = p.id_categoria
			LEFT OUTER JOIN gusta g on g.id_post = p.id
			ORDER BY id DESC LIMIT 0,10";
	$res = mysql_query($sql);
	
	if (mysql_num_rows($res) > 0)
	{
		while($row = mysql_fetch_array($res))
		{
			$time = time() - strtotime($row['hora']);

		    $days = floor($time/86400);
		    if ($days > 0)
		    	$tiempo = $days . " d&iacute;as";
		    else
		    {
		    	$hours = floor(($time-($days*86400))/3600);
		    	if ($hours > 0)
		    	{
		    		$tiempo = $hours . " horas";	
		    	}
		    	else
		    	{
		    		$mins = floor (($time-($days*86400)-($hours*3600))/60);
		    		$tiempo = $mins . " minutos";
		    	}
			}
			
			$result .= '
						<li>
						<span>POR...</span> 
						' . $row['texto'] . '
						<div class="datos">
							<p class="categoria"><span class="azul">Categor&iacute;a:</span> ' . $row['nombre'] . '</p>
							<p class="hora">hace ' . $tiempo . '</p>
						</div>
						<div class="clear datos">
							<p class="gusta"><a href="#" onclick="megusta(\'' . $row['id'] . '\');return false;"><img src="img/megusta.png" width="32px" height="32px" style="margin-right:2%;" id="imgGusta_' . $row['id'] . '" /></a></p>
							<p class="valor" id="gustas_' . $row['id'] . '">' . $row['total'] . '</p>
							<p class="twitter">
								<a href="https://twitter.com/intent/tweet?text=%23megustaMadridpor%20' . urlencode(utf8_encode($row['texto'])) . '" class="twitter-hashtag-button" data-lang="es"><img src="img/twitter.png" width="32px" height="32px" /></a>
							</p>
							<p id="comentarios_' . $row['id'] . '" class="comentario"><a href="#" class="aComentarios" onclick="comentarios(\'' . $row['id'] . '\');return false;">comentarios</a></p>
						</div>
						<div class="clear"></div>
						</li>';
		}
	}
	else
	{
		$result = "<li><span>Ocurri&oacute; un error al obtener los comentarios</span></li>";
	}
	
	echo utf8_encode($result);
?>