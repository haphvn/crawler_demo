$( "#btn-update" ).click(function() {
	var table = $('#main-table').tableToJSON();
	var request = $.ajax({
		url: "/crawler-demo/index.php/test/update",
		method: "POST",
		data: {data: JSON.stringify(table)},
	});
	 
	request.done(function( resp ) {
		$("#data-table").empty();
		$("#data-table").html(resp);
		$("#btn-control").empty();
		$("#btn-control").html("<p>Data in the table have been grouped.</p>");
	});
	 
	request.fail(function( jqXHR, textStatus ) {
		alert( "Request failed: " + textStatus );
	});
});