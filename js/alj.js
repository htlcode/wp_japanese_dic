( function( $ ) {
	
	var collection = new Array();
	$(".button-draw").click(function() {
		var id = $(this).attr("data");	
		if(typeof collection[id] !== 'undefined') {
			collection[id].dmak('reset');
			setTimeout(function(){
			    collection[id].dmak('play');
			}, 5000);
		} else {
			var cp = $('#cp'+id).val();
			var url = $('#data_url').val();
			var options = {uri:url, loadCode:true, stroke:{attr:{"stroke": "#999999"},order:{visible:true, attr:{"font-size": "9","fill": "#0000FF"}} }};
		    var dmak = $("#draw"+id).dmak(cp, options);
		    collection[id] = dmak;
		}
	});
	$( "#alj_form" ).submit(function( event ) {
	  	event.preventDefault();
	  	var url = $('#alj_hid_url').val();
		var search = $('#alj_txt_search').val();
		window.location.href = url + '/' + search ;
	});
})( jQuery );