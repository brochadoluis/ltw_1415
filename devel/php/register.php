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
$isnt_name_set = !isset ($_POST ['name']) || $_POST ['name'] == "";
$isnt_email_set = !isset ($_POST ['email']) || $_POST ['email'] == "";
session_start();
if (isset($_SESSION['permission'])) {
    echo json_encode("You're already logged in!");
} else {
    if (!$isnt_username_set && !$isnt_password_set && !$isnt_name_set && !$isnt_email_set) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        echo json_encode(' Register!');
        try {
            $db = new PDO ('sqlite:../database/db.db');
        } catch (PDOException $e) {
            echo json_decode('{"error":{"code":205,"reason":"' . $e->getMessage() . '"}}', true);
        }
        if (checkIfUserExists($username, $email, $db) == false) {
            createUser($username, $name, $password, $email, $db);

            echo json_encode('Succefull Register!');
            login($username, $password, $db);
            //header('Location: ../html/User.html');

        } else {
            echo json_encode('User already registered, please log in or register with a differente username and/or email!');
            //header('Location: ../html/Index.html');
        }
    }
}
