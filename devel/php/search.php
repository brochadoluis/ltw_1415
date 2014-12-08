<?php
echo "string";
if(isset($_GET['searchData'])){
  $db = new PDO('sqlite:..database/db.db');

  $poll = $_GET['searchData'];
  $stmt = $db->prepare('SELECT * FROM Poll WHERE title Like ?');
  $stmt->execute(array('%'.$poll.'%'));
  while($row = $stmt->fetch()){
    if($row['private'] == 0){
    $sResults .= '<p> '. $row['idPoll']. ' <a href=vote_poll.php?poll='. $row['title'].' title='.$row['title'].' >'.$row['title'].'</a></p><br>';
    }
  }

  echo   $sResults;
}
?>