$( window ).load(function() {
	$(".confirmDelete").on("click", function(){
		return confirm('Удалить?');
	})
});