<?
require_once 'users.php';
session_start();
if (isset($_SESSION ['permission'])) {
    echo json_encode('Success!');
} else {

    if ((isset($_POST ['username']) && $_POST['username'] != "") && (isset($_POST ['password']) && $_POST['password'] != "")) {
        try {
            $db = new PDO ('sqlite:../database/db.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode('{"error":{"code":205,"reason":"' . $e->getMessage() . '"}}');
        }
        if (login($_POST['username'], $_POST['password'], $db) == false) {
            echo json_encode('Error!');
            $_SESSION['errMsg'] = "Invalid username or password";
            header ( 'Location: ' . $_SERVER ['HTTP_REFERER'] );

        } else {
            echo json_encode('Success!');
            $_SESSION['username'] = $username;
            header('Location: ../html/User.php');
        }
    } else {
        $_SESSION['errMsg'] = "Invalid username or password";
    }
        
}