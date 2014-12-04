<?php
function createUser($username, $name, $password, $email, $conn)
{
    $stmt = $conn->prepare("INSERT INTO User (username, name, password, email) VALUES('$username','$name','$password','$email')");
    $result = $stmt->execute();
    return $result;
}

function getUserByUsername($username, $conn)
{
    $stmt = $conn->prepare("SELECT * FROM User WHERE username LIKE ?");
    $stmt->execute(array($username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchUserByUsername($username, $conn)
{
    $stmt = $conn->prepare("SELECT * FROM User WHERE UPPER(username) LIKE ?");
    $stmt->execute(array($username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function login($username, $password, $conn)
{
    $stmt = $conn->prepare('SELECT * FROM User WHERE username LIKE ? AND password LIKE ?;');
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

function checkIfUserExists($username, $email, $conn)
{
    $stmtUsername = $conn->prepare('SELECT username FROM User WHERE username LIKE ?;');
    $stmtEmail = $conn->prepare('SELECT email FROM User WHERE email LIKE ?;');
    $stmtUsername->bindValue(':username', $username, PDO::PARAM_STR);
    $stmtEmail->bindValue(':email', $email, PDO::PARAM_STR);
    $stmtUsername->execute([$username]);
    $stmtEmail->execute([$email]);
    $resultName = $stmtUsername->fetch(PDO::FETCH_ASSOC);
    $resultEmail = $stmtEmail->fetch(PDO::FETCH_ASSOC);
    if ($resultName == true || $resultEmail == true)
        return true;
    else
        return false;
}

function logout()
{
    // delete the session of the user
    $_SESSION = array();
    session_destroy();
    // return a little feeedback message
    echo "You have been logged out.";
}

function updatePassword($username, $password, $conn)
{
    $stmt = $conn->prepare("UPDATE User SET password = '" . $password . "' WHERE username LIKE '" . $username . "'");
    return $stmt->execute(array($password, $username));
}

function editUser($username, $email, $name, $conn)
{
    $conn->beginTransaction();
    $stmt = $conn->prepare("UPDATE User SET  email = '" . $email . "' , nome = '" . $name . "' WHERE username LIKE '" . $username . "'");
    $result = $stmt->execute();
    if ($result == false) {
        $conn->rollBack();
        return false;
    }
    $conn->commit();
    return true;
}

function sendMessage($sender, $receiver, $title, $body, $conn)
{
    $stmt = $conn->prepare("INSERT INTO Message(sender, receiver, title, content) VALUES('$sender','$receiver','$title','$body')");
    return $stmt->execute(array($sender, $receiver, $title, $body));
}

function getSentMessages($username, $conn)
{
    $stmt = $conn->prepare("SELECT Message.idMessage, Message.receiver, Message.title FROM Message WHERE Mesage.sender = ? AND Message.receiver != ? ORDER BY Message.idMessage DESC");
    $stmt->execute(array($username, $username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getReceivedMessages($username, $conn)
{
    $stmt = $conn->prepare("SELECT Message.idMessage, Message.title FROM Message WHERE Messagem.sender != ? AND Message.receiver = ? ORDER BY Message.idMessage DESC");
    $stmt->execute(array($username, $username));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMessage($id, $conn)
{
    $stmt = $conn->prepare("SELECT Message.receiver, Message.sender, Message.title, Message.content FROM Message WHERE Message.idMessage = ?");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteMessage($idMessage, $conn)
{
    $stmt = $conn->prepare("DELETE FROM Message WHERE idMessage = ?");
    return $stmt->execute(array($idMessage));
}

?>