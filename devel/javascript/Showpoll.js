$().ready(getPolls);

function getPolls () {
    $.getJSON("../php/pollsCreated.php", poll);
}

function poll (data) {
	$.each(data, showPoll);
}

function showPoll(key,value) {
	console.log(value);
	
	var poll = $(document.createElement('div')).attr("class", 'poll-card');
    poll.append('<h2>' + value['title'] + '</h2><div id="poll' + value['idQuestion'] + '"><label>Question: </label>' + ' ' + value['question'] + '</div><br><div class="poll-button"><div class="buttons"><form><button class="poll-button poll-button-new" onclick="showStats(this ,' + value['idQuestion'] + ');return false;" id="showStats' + value['idQuestion'] + '">Show Stats</button><button class="poll-button poll-button-new" onclick="editPoll(this ,' + value['idPoll'] + ');return false;">Edit Poll</button><button class="poll-button poll-button-new" onclick="deletePoll(this ,' + value['idPoll'] + ');return false;">Delete Poll</button><form></div>');
    poll.append('<div class="poll-card image-card"><img src="../images/' + value['pic'] + '" width="200" height="200"></div>')
    $('#yourPolls').append(poll);
}