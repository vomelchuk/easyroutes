
$(document).ready(function(){
	$("#year").text(new Date().getFullYear());

	//alert(0);

	$(".selectStops option").bind("dblclick", function() {
		var par = '#' + $(this).parent().parent().parent().prop("id") + " .allStops select";
		$("<option value="+$(this).val()+">"+$(this).text()+"</option>").prependTo(par);
		$(this).remove();
	});

	$(".allStops option").bind("dblclick", function() {
		var par = '#' + $(this).parent().parent().parent().prop("id") + " .selectStops select";
		$("<option value="+$(this).val()+">"+$(this).text()+"</option>").prependTo(par);
		$(this).remove();
	});


	$("#save").on("click", function() {
		var res = [0, 1];
		res[0] = [];
		res[1] = [];
		$(".forward .selectStops select option").each(function(index ){
			res[0].push( $(this).val() );
		});
		$(".backward .selectStops select option").each(function(index ){
			res[1].push( $(this).val() );
		});
		alert (res[0] + '\n' + res[1]);
	});
	


});
	