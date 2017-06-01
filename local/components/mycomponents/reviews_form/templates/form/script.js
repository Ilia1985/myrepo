$(function(){
	$("form[name=myreviewsForm]").on('submit', function(){
		var data  = $(this).serialize();
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data: data,
			success: function(data){
				if( data.errors.length > 0 )
				{					
					var errors = data.errors.join('\n');
					alert("Errors:\n" + errors );
				}
				else
				{
					$('#myreviewsForm [name=autor], #myreviewsForm [name=text]').val('');
					alert('Отзыв добавлен');
					if( data.html.length > 0 )
						$('#myreviewsList').empty().html(data.html);
				}
			},
			error: function(data){
				alert('ajax query error');
			},
			dataType: 'json'
		});		
		return false;
	});
});

