$().ready(function(){
	
	var counter = 3;
	
	$("#addAns").click(function () {
		
		if(counter>10){
			alert("Only 10 answers allowed");
			return false;
		}   
		
		var newdiv = $(document.createElement('div'))
		.attr("id", 'answer' + counter);
		
		newdiv.after().html('<b>Answer number ' + counter + ':</b></br><input id="answer' + counter + '" name="answer' + counter + '" type="text" maxlength="60" style="width:150px; border:1px solid #999999"/>');
		
		newdiv.appendTo("#answers");
		
		counter++;
	});
	
	$("#remAns").click(function () {
		if(counter==3){
			alert("At least two answers are required!");
			return false;
		}   
		
		counter--;
		
		$("#answer" + counter).remove();
		
	});

});