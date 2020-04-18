<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web万屋エンジニアチャンネル</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <h1>New User</h1>
  <form action="/users.php" method="post" accept-charset="utf-8">
    <div class="field">
      <label for="user_name">Name</label>
      <input type="text" name="user[name]" id="user_name">
    </div>
    <div class="field">
      <label for="user_name">Email</label>
      <input type="text" name="user[email]" id="user_email">
    </div>
    <div class="field">
      <label for="user_age">Age</label>
      <input type="number" name="user[age]" id="user_age">
    </div>
    <div class="actions">
      <input type="submit" name="commit" value="Create User">
    </div>
  </form>
  <a href="/users.php">Back</a>
</body>
</html>