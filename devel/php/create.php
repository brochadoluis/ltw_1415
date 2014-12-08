<?php
session_start();
$db = new PDO('sqlite:../database/db.db');
$user = $_SESSION['username'];
echo $user;
$add = $db->prepare('SELECT idUser FROM User WHERE username=:username');
$add->bindParam(':username', $user);
$add->execute();
$idUser = $add->fetchColumn();
echo $idUser;
//Poll
$add = $db->prepare('INSERT INTO Poll(idCreator,title) VALUES (:user,:title)');
$add->bindParam(':user', $idUser);
$add->bindParam(':title', $_POST['title']);
echo $_POST['title'];
$add->execute();
$idPoll = $db->lastInsertID();
//Image
$target_path = "../images/";
$imageFileType = pathinfo(basename($_FILES['pic']['name']),PATHINFO_EXTENSION);
$target_path = $target_path."img".$idPoll.".".$imageFileType;
$imageName= "img".$idPoll.".".$imageFileType;
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
}
else { 
	if(move_uploaded_file($_FILES['pic']['tmp_name'], $target_path)) {
       echo "The file ".  basename( $_FILES['pic']['name']). " has been uploaded";
   } else{
       echo "Sorry, there was an error uploading your file.";
   }
}

$add = $db->prepare('update Poll SET pic = ? where idPoll = ?');
$add->execute (array($imageName, $idPoll));
//Question
$add = $db->prepare('INSERT INTO Question(idPoll,question) VALUES (:id,:question)');
$add->bindParam(':id', $db->lastInsertID());
$add->bindParam(':question',$_POST ['question']);
$add->execute();
$idQuestion = $db->lastInsertID();
//Answer
$i = 1;
$answer = 'answer'.$i;
while(isset($_POST[$answer]) && !empty($_POST[$answer])) {
    $add = $db->prepare('INSERT INTO Answer(idQuestion,answer) VALUES (:id,:answer)');
    $add->bindParam(':id', $idQuestion);
    $add->bindParam(':answer', $_POST[$answer]);
    $add->execute();
    $i++;
    $answer = 'answer'.$i;
}

//header('Location: ' . $_SERVER ['HTTP_REFERER'] );
?>