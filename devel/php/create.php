<?
session_start();
if(!empty($_POST['answer2'])) {
  
  $db = new PDO('sqlite:../database/db.db');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $user = $_SESSION['username'];

  echo $user;
  $add = $db->prepare('SELECT idUser FROM User WHERE username=:username');
  $add->bindParam(':username', $user);
  $add->execute();
  $idUser = $add->fetchColumn();
  echo $idUser;
//Poll
  $title = $_POST['title'];
  $pic = $_FILES['pic'];
  $stmt = $db->prepare("INSERT INTO Poll (idCreator,title,pic) VALUES ('$idUser','$title','$pic')");
//$stmt->bindParam(':user', $idUser, PDO::PARAM_STR);
//$stmt->bindParam(':title', $title, PDO::PARAM_STR);
//$stmt->bindParam(':pic', $pic, PDO::PARAM_STR);
//echo $_POST['title'];
  $stmt->execute();
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
 $question = $_POST ['question'];
 $add = $db->prepare('INSERT INTO Question(idPoll,question) VALUES (:id,:question)');
 $id = $db->lastInsertID();
 $add->bindParam(':id', $id);
 $add->bindParam(':question', $question);
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
header('Location: ../html/Poll.html');
//header('Location: ' . $_SERVER ['HTTP_REFERER'] );
}
else {
  $_SESSION['errMsg1'] = "A poll requires at least two answers";
  header('Location: ' . $_SERVER ['HTTP_REFERER'] );

}
