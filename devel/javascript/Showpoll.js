$().ready(getPolls);

function getPolls () {
	$.getJSON("../php/createdPolls.php", poll);
}

function poll (data) {
	$.each(data, showPoll);
}

var pollID = 0;

function showPoll(key,value) {
	console.log(value);
	
	var poll = $(document.createElement('div')).attr("class", 'poll-card');
	poll.append('<h1>' + value['Nome'] + '</h1><div id="poll'+ value['IDpergunta'] + '"><label>Question: </label>' + ' ' + value['pergunta'] + '</div><br><div class="poll-button"><div class="buttons"><form><button class="poll-button poll-button-new" onclick="showStats(this ,' + value['IDpergunta'] + ');return false;" id="showStats' + value['IDpergunta'] + '">Show Stats</button><button class="poll-button poll-button-new" onclick="editPoll(this ,' + value['IDpoll'] + ');return false;">Edit Poll</button><button class="poll-button poll-button-new" onclick="deletePoll(this ,' + value['IDpoll'] + ');return false;">Delete Poll</button><form></div>');
	poll.appendTo("#editMyPollsGroup");
}