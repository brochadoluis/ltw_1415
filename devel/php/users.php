<?php
function createUser($username, $name, $town, $password, $email, $ocupation, $pic)
{
    //global $conn;
    $stmt = $conn->prepare("INSERT INTO Editor VALUES(DEFAULT,?,?,?,?,?,?,?,?)");
    $result = $stmt->execute(array($username, $name, $town, $password, $email, $ocupation, $pic));
    return $result;
}

function getUserByUsername($username)
{
    //global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE username LIKE ?");
    $stmt->execute(array($username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchUserByUsername($username)
{
    // global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE UPPER(username) LIKE ?");
    $stmt->execute(array($username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getuserPhoto($username)
{
    //global $conn;
    $stmt = $conn->prepare("SELECT photograph FROM User WHERE username LIKE ?");
    $stmt->execute(array($username));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserByLocal($town)
{
    // global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE UPPER(localidade) LIKE ?");
    $stmt->execute(array($local));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserByWork($ocupation)
{
    //global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE UPPER(ocupation) = ?");
    $stmt->execute(array($ocupation));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function login($username, $password, $conn)
{
    //global $conn;
    $stmt = $conn->prepare('SELECT idUser FROM User WHERE username LIKE ? AND password LIKE ?;');
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user != false) {
        return $user;
    } else {
        return false;
    }
}

function doLogout()
{
    // delete the session of the user
    $_SESSION = array();
    session_destroy();
    // return a little feeedback message
    $this->messages[] = "You have been logged out.";
}

function updatePassword($username, $password)
{
    //global $conn;
    $stmt = $conn->prepare("UPDATE User SET password = ? WHERE username LIKE ?");
    return $stmt->execute(array($password, $username));
}

function updatePhoto($username, $pic)
{
    // global $conn;
    $conn->beginTransaction();
    $stmt = $conn->prepare("UPDATE User SET photograph = ? WHERE username LIKE ?");
    $stmt->execute(array($pic, $username));
    $result = $stmt->fetch();
    if ($result == false) {
        $conn->rollBack();
        return false;
    }
    return true;
}

function editUser($username, $town, $ocupation, $email, $name, $pic)
{
    // global $conn;
    $conn->beginTransaction();
    $stmt = $conn->prepare("UPDATE Editor SET town = '" . $town . "' , ocupation = '" . $ocupation . "' , email = '" . $email . "' , name = '" . $name . "' , photograph = '" . $pic . "' WHERE username LIKE '" . $username . "'");
    $result = $stmt->execute();
    if ($result == false) {
        $conn->rollBack();
        return false;
    }
    $conn->commit();
    return true;
}

function sendMessage($sender, $receiver, $title, $body)
{
    // global $conn;
    $stmt = $conn->prepare("INSERT INTO Message VALUES(DEFAULT,?,?,?,?)");
    return $stmt->execute(array($sender, $receiver, $title, $body));
}

function getSentMessages($username)
{
    // global $conn;
    $stmt = $conn->prepare("SELECT Message.idMessage, Message.receiver, Message.title FROM Message WHERE Mesage.sender = ? AND Message.receiver != ? ORDER BY Message.idMessage DESC");
    $stmt->execute(array($username, $username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getReceivedMessages($username)
{
    //global $conn;
    $stmt = $conn->prepare("SELECT Message.idMessage, Message.title FROM Message WHERE Messagem.sender != ? AND Message.receiver = ? ORDER BY Message.idMessage DESC");
    $stmt->execute(array($username, $username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMessage($id)
{
    // global $conn;
    $stmt = $conn->prepare("SELECT Message.receiver, Message.sender, Message.title, Message.content FROM Message WHERE Message.idMessage = ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteMessage($idMessage)
{
    // global $conn;
    $stmt = $conn->prepare("DELETE FROM Message WHERE idMessage = ?");
    return $stmt->execute(array($idMessage));
}

?>