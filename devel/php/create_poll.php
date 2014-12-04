<?php
session_start();
$db = new PDO('sqlite:../database/db.db');

function add_question(){
	$questions = array();
	$i = 0;
	if(isset($_POST['Question'])){
		while(isset($_POST['answer'.$i])){
			$questions[$i] = $_POST['answer'.$i];
			$i++;
		}
	}
	return $questions;
}

function insert($idPoll,$question){
	global $db;
	$ins = $db->prepare('INSERT INTO Question (idQuestion,idPoll,question) Values (?, ?, ?)');
	$ins->execute(array($idQuestion,$idPoll,$question));
		$chk = $db->prepare('SELECT * FROM Question WHERE question = ? AND idPoll = ? AND idQuestion = ?');
		$chk->execute(array($question,$idPoll, $idQuestion));
		$row = $chk->fetch();
		$ins = $db->prepare('INSERT INTO Answer (idAnswer,idQuestion,answer,votes) Values (?,?,?,0)');
		$ins->execute(array($idPoll,$row['idQuestion'],$question));
}
function check_poll($poll){
	global $db;
	$chk = $db->prepare('SELECT * FROM Poll WHERE title = ?');
	$chk->execute(array($poll));
	if(!$chk->fetch())
		return true;
	else
		return false;
}
function create_poll(){
	if(check_poll($_POST['question'])){

		if (empty($_FILES['fileToUpload']['name'])) {
			$image = "default.jpg";
		}
		else{
			include_once("upload.php");
			$image = $_FILES["fileToUpload"]["name"];
		}

		if(isset($_SESSION['Msg'])){
			echo $_SESSION['Msg'];
		}
		else{
			global $db;
			if(isset($_POST['private'])){
				if(!isset($_SESSION['username']))
				{
					$_SESSION['Msg'] = "Must login first to create a private poll";
					header('Location: ../html/Index.html');
					die("Must login first to create a poll");
				}
				$private = 1;
			}
			else{
				$private = 0;
			}

			$chk = $db->prepare('SELECT * FROM User WHERE user = ?');
			$chk->execute(array($_SESSION['username']));
			if(!($row = $chk->fetch())){
				$idUser = 0;
			}
			else{
				$idUser = $row['idUser'];
			}

			$questions = add_question();

			$ins = $db->prepare('INSERT INTO Poll (idUser,name,image, permission, state) Values (?, ?, ?)');
	
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