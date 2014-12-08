<?php
require_once 'users.php';
/**
 * Created by IntelliJ IDEA.
 * User: Luís
 * Date: 03/12/2014
 * Time: 12:06
 */
$isnt_username_set = !isset ($_POST ['username']) || $_POST ['username'] == "";
$isnt_password_set = !isset ($_POST ['password']) || $_POST ['password'] == "";
$isnt_name_set = !isset ($_POST ['name']) || ($_POST ['name']) == "";
$isnt_email_set = !isset ($_POST ['email']) || ($_POST ['email']) == "";
session_start();
if (isset($_SESSION['permission'])) {
    echo json_encode("You're already logged in!");
} else {
    if (!$isnt_username_set && !$isnt_password_set && !$isnt_name_set && !$isnt_email_set) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        try {
            $db = new PDO ('sqlite:../database/db.db');
        } catch (PDOException $e) {
            echo json_decode('{"error":{"code":205,"reason":"' . $e->getMessage() . '"}}', true);
        }
        if (checkIfUserExists($username, $email, $db) == false) {
            $stmt = $db->prepare('INSERT INTO User (username, name, password, email) VALUES(:user,:name,:pass,:email)');
            $stmt->bindParam(':user',$_POST['username']);
            $stmt->bindParam(':name',$_POST['name']);
            $stmt->bindParam(':pass',$_POST['password']);
            $stmt->bindParam(':email',$_POST['email']);
            $stmt->execute();
            login($username, $password, $db);
            header('Location: ../html/User.php');
        } else {
            header('Location: ../html/index.php');
        }
    }
}
