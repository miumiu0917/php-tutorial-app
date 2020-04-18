<?php
require_once('../lib/db.php');

function getUser($id) {
  $mysql = connect();
  $stmt = $mysql->prepare("select name, email, age from users where id = ?;");
  $stmt->bind_param('s', $id);
  $stmt->execute();
  $stmt->bind_result($name, $email, $age);


  $stmt->fetch();
  
  $stmt->close();
  $mysql->close();

  return [
    'name' => $name,
    'email' => $email,
    'age' => $age
  ];
}

$id = $_GET['id'];
$user = getUser($id);

$message = '';
if (isset($_GET['action'])) {
  $action = $_GET['action'];

  if ($action === 'new') {
    $message = 'User was successfully created.';
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web万屋エンジニアチャンネル</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <p id="notice"><?php echo $message; ?></p>
  <p><strong>Name: </strong><?php echo $user['name']; ?></p>
  <p><strong>Email: </strong><?php echo $user['email']; ?></p>
  <p><strong>Age: </strong><?php echo $user['age']; ?></p>
  <a href="/users/edit.php">Edit</a> | <a href="/users.php">Back</a>
</body>
</html>