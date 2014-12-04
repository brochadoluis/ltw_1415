<?php
session_start();
$db = new PDO('sqlite:../db/dataBase.db');

function add_question(){
	$questions = array(array());
	$i = 0;
	$j = 0;
	while(isset($_POST['Question'.$j])){
		$questions[$j][0] = $_POST['Question'.$j];
		while(isset($_POST['q'.$j.'answer'.$i])){
			$questions[$j][$i+1] = $_POST['q'.$j.'answer'.$i];
			$i++;
		}
		$i = 0;
		$j++;
	}
	return $questions;
}

function insert($idPoll,$question){
	global $db;
	$ins = $db->prepare('INSERT INTO Question (idPoll,qText) Values (?, ?)');
	$ins->execute(array($idPoll,$question[0]));
	for ($i = 1; $i < count($question); $i++){
		$chk = $db->prepare('SELECT * FROM Question WHERE qText = ? AND idPoll = ?');
		$chk->execute(array($question[0],$idPoll));
		$row = $chk->fetch();
		$ins = $db->prepare('INSERT INTO Answer (idPoll,idQuestion,aText,votes) Values (?,?,?,0)');
		$ins->execute(array($idPoll,$row['idQuestion'],$question[$i]));
	}
}
function check_poll($poll){
	global $db;
	$chk = $db->prepare('SELECT * FROM Poll WHERE name = ?');
	$chk->execute(array($poll));
	if(!$chk->fetch())
		return true;
	else
		return false;
}
function create_poll(){
	if(check_poll($_POST['name'])){

		if(isset($_SESSION['Msg'])){
			echo $_SESSION['Msg'];
		}
		else{
			global $db;
			$chk = $db->prepare('SELECT * FROM User WHERE user = ?');
			$chk->execute(array($_SESSION['username']));
			$row = $chk->fetch();
			$questions = add_question();
			$ins = $db->prepare('INSERT INTO Poll (idUser,name,image) Values (?, ?, ?)');
			$idUser = $row['idUser'];
			$name = $_POST['name'];
			$ins->execute(array($idUser,$name));
			echo $image;
			$chk = $db->prepare('SELECT * FROM Poll WHERE name = ?');
			$chk->execute(array($name));
			$row = $chk->fetch();
			echo $row['idPoll'];
			foreach ($questions as $question){
				insert($row['idPoll'],$question);
			}
		}
	}
	else{
		$_SESSION['Msg'] = "That Poll already exists, please choose another name";
	}
}
create_poll();
//header('Location: main_page_body.php');
?>