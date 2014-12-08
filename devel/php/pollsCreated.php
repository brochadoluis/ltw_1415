<?php
session_start();
$db = new PDO ('sqlite:../database/db.db');
$stmt = $db->prepare('SELECT idUser FROM User WHERE username = ?');
$stmt->execute(array($_SESSION['username']));
$userID = $stmt->fetchColumn();
$add = $db->prepare('select * from Poll,Question where Question.idPoll = Poll.idPoll and Poll.idCreator = ?');
$add->execute(array($userID));
$titles = $add->fetchAll();
$result = array();
foreach ($titles as $row) {
    $result[] = $row;
}
echo json_encode($result);
?>