<?
include 'users.php';
session_start();
if (isset($_SESSION ['permission'])) {
    echo json_encode('Success!');
} else {
    echo json_encode('asdasdsadasdsasda');
    exit;
    if ((isset($_POST ['username']) && $_POST['username'] != "") && (isset($_POST ['password']) && $_POST['password'] != "")) {
        try {
            $db = new PDO ('sqlite:../database/db.sql');

        } catch (PDOException $e) {
            echo '{"error":{"code":205,"reason":"' . $e->getMessage() . '"}}';
        }
        if (login($_POST['username'], $_POST['password']) == false) {
            echo json_encode('Error!');
        } else
            echo json_encode('Success!');
    } else
        echo json_encode('Data not defined');
}
