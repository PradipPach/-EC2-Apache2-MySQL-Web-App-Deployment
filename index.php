<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF‑8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My EC2 Project – Styled</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      color: #333;
      margin: 20px;
      padding: 0;
    }
    h1 {
      color: #005f99;
      text-align: center;
    }
    .container {
      max-width: 600px;
      background: #fff;
      margin: 0 auto;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    form {
      margin-bottom: 30px;
    }
    form label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }
    form input[type="text"],
    form input[type="email"] {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 1em;
    }
    form input[type="submit"] {
      background: #005f99;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-top: 15px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1em;
    }
    form input[type="submit"]:hover {
      background: #004b7a;
    }
    .user-list {
      list-style: none;
      padding: 0;
    }
    .user-list li {
      padding: 10px;
      border-bottom: 1px solid #eee;
      display: flex;
      justify-content: space-between;
    }
    .user-list li:nth-child(even) {
      background: #fafafa;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Welcome to My EC2 Web Server!</h1>
    <p>This is a simple PHP application connected to MySQL.</p>

    <h2>Add User</h2>
    <form method="POST" action="">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <input type="submit" name="submit" value="Add User">
    </form>

    <h2>User List</h2>
    <?php
	 $servername = "localhost";
    $username = "myuser";
    $password = "mypassword";
    $dbname = "myproject";

    $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>User added successfully!</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    $sql = "SELECT id, name, email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["name"] . " - " . $row["email"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No users found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
