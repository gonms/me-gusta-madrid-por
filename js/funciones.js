$(document).ready(function(){

	$('#fPost').submit(function(){
		var error = "";
		if ($('#texto').val() == "" || $('#texto').val() == "Me gusta Madrid por...")
			error = "Dinos por qué te gusta Madrid";
		else if ($('#categoria').val() == "")
			error = "Indica la categoría de tu comentario";

		if (error != "")
			$('#error').html(error);
		else
			enviaForm();
		return false;
	});
	
	$.get("ajax/categorias.php",function(data){
		$('#categoria').html(data);
	});
	
	$('#texto').focus(function(){
		if ($(this).val() == "Me gusta Madrid por...")
			$(this).val('');
	});
	
	$('#texto').blur(function(){
		if ($(this).val() == "")
			$(this).val('Me gusta Madrid por...');
	});
	
	getPosts();
});

function enviaForm()
{
	$.post("ajax/guarda-post.php",{texto: $('#texto').val(), categoria: $('#categoria').val()}, function(data)
	{
		if (data != "ERROR")
		{
			$('#dForm').slideToggle();
			$(data).prependTo($('#posts')).fadeIn("slow");
			$('#texto').val('Me gusta Madrid por...');
			$('#categoria').val('');
			$('#error').val('');
		}
		else
		{
			alert('Ha habido un problema al guardar tu comentario. Inténtalo más tarde');
		}
	});
}

function getPosts()
{
	$.get("ajax/get-posts.php",function(data){
		$('#posts').html(data);
	});
}

function megusta(pID)
{
	$.post("ajax/me-gusta.php",{id: pID},function(data)
	{
		if (data > 0)
		{
			$('#gustas_' + pID).html(data);
			$('#imgGusta_' + pID).attr('src','/img/megusta_off.png');
		}
	});
}