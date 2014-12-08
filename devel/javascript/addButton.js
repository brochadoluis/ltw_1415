var counter = 3;
function addInput() {

	var newdiv = document.createElement('div');
	newdiv.attr("id", 'answer' + counter);

	newdiv.after().html('<b>Answer number ' + counter + ':</b></br><input id="answer' + counter + '" name="answer' + counter + '" type="text" maxlength="60" style="width:150px; border:1px solid #999999"/>');

	newdiv.appendTo("#answers");

	counter++;
}

function removeInput() {
	if(counter==3) {
		alert("At least two answers are required!");
		return false;
	}   

	counter--;

	$("#answer" + counter).remove();

}