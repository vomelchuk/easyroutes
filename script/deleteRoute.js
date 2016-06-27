
$(document).ready(function(){
	$("#year").text(new Date().getFullYear());

	//alert(0);

	$(".routes option").click(function(){
		$( this ).toggleClass( "active" );
	});
	
	$(".deletes option").click(function(){
		$( this ).toggleClass( "active" );
	});

	$("#forward").on("click", function() {
		$(".routes .active").each(function(index ){
			$("<option value="+$(this).val()+">"+$(this).text()+"</option>").prependTo(".deletes");
		});
		$(".routes .active").remove();
	});



	$("#remove").on("click", function() {
		
		var res = [];
		$(".deletes option").each(function(index ){
			res.push( $(this).val() );
		});

		$.ajax({
		  data: 'id='+res.toString(),
		  success: function(){
		  	$(".deletes option").each(function(index){
				$(this).remove();
			});
		  },
		});

	});

});
	