

	  $(document).ready(function () {
	   
		$("footer").css( "position", "absolute" );
	   	var height = $(document).height() - 50 ;
		$("footer").css( "top", height );
		
		$(window).resize(function(){
		var height = $(document).height() - 50;
		$("footer").css( "top", height+"px" );
		});
      });