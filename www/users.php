<?php
require_once('../lib/db.php');

function getUsers() {
  $mysql = connect();
  $result = $mysql->query("select * from users;");
  $users = $result->fetch_all(MYSQLI_ASSOC);
  $result->close();
  $mysql->close();

  return $users;
}

function createUser($name, $email, $age) {
  $mysql = connect();
  $stmt = $mysql->prepare("insert into users (name, email, age, created_at, updated_at) values (?, ?, ?, ?, ?);");
  $stmt->bind_param('ssiss', $name, $email, $age, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));

  $stmt->execute();
  
  $id = $stmt->insert_id;

  $stmt->close();
  $mysql->close();

  return $id;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
  $name = $_POST['user']['name'];
  $email = $_POST['user']['email'];
  $age = $_POST['user']['age'];
  $id = createUser($name, $email, $age);
  $server = $_SERVER["SERVER_NAME"] . ':' . $_SERVER["SERVER_PORT"];
  header('Location: http://' . $server . '/user.php?action=new&id='.$id);
}

$users = getUsers();

$message = '';
if (isset($_GET['action'])) {
  $action = $_GET['action'];

  if ($action === 'delete') {
    $message = 'User was successfully destroyed.';
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

  <h1>Users</h1>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $key => $user) : ?>
        <tr>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td><?php echo $user['age']; ?></td>
          <td><a href="<?php echo '/user.php?id=' . $user['id'] ?>">Show</a></td>
          <td><a href="<?php echo '/users/edit.php?id=' . $user['id'] ?>">Edit</a></td>
          <td><a data-confirm="Are you sure?" href="<?php echo '/users/delete.php?id=' . $user['id'] ?>">Destroy</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="/users/new.php">New User</a>
</body>
</html>