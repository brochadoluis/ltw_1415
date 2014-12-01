<?
include 'users.php';
session_start();
if (isset($_SESSION ['permission'])) {
    echo json_encode('Success!');
} else {

    if ((isset($_POST ['username']) && $_POST['username'] != "") && (isset($_POST ['password']) && $_POST['password'] != "")) {
        try {
            echo json_encode('asdasdsadasdsasda');
            exit;
            $db = new PDO ('sqlite: ../database/db.db');
        } catch (PDOException $e) {
            echo '{"error":{"code":205,"reason":"' . $e->getMessage() . '"}}';
        }
        if (login($_POST['username'], $_POST['password']) == false) {
            echo json_encode('Error!');
        } else
            echo json_encode('Success!');

    } else
        $error = "Username or Password is invalid";
}