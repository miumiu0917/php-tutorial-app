<?php
require_once('../../lib/db.php');

function deleteUser($id) {
  $mysql = connect();
  $stmt = $mysql->prepare("delete from users where id = ?;");
  $stmt->bind_param('s', $id);

  $stmt->execute();
  
  $stmt->close();
  $mysql->close();
}

$id = $_GET['id'];
deleteUser($id);
$server = $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"];
header('Location: http://' . $server . '/users.php?action=delete');