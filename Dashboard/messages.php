<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "flower";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM messages WHERE id=$id");
    header("Location: messages.php");
    exit;
}

$result = $conn->query("SELECT id, name, email, message FROM messages ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Messages - The Blooming Boutique</title>

  <style>
    :root{
       --bg: #f5d5f8ff;
      --card: #fff;
      --muted: #6b7280;
      --accent: #2563eb;
      --border: #e6e9ef;
      --radius:12px;
      font-family:Georgia;
    }

    body{
      margin:0;
      background:linear-gradient(180deg,#eef2ff 0%,var(--bg) 100%);
      color:#111827;
      min-height:100vh;
      display:flex;
      flex-direction:column;
      font-family:Georgia;
    }

    header{background:var(--card);border-bottom:1px solid var(--border);padding:12px 20px;display:flex;align-items:center;justify-content:space-between;}
    .container {max-width:1100px;margin: 15px auto;width:calc(100% - 40px);}

    h1{text-align:center;margin-bottom:20px;}

    table{
      width:100%;
      border-collapse:collapse;
      background:#fff;
      border-radius:8px;
      overflow:hidden;
      box-shadow:0 2px 6px rgba(0,0,0,0.1);
    }

    th, td{
      border:1px solid #ddd;
      padding:12px;
      text-align:center;
    }

    th{background:#b37fb6; color:white;}

    tr:nth-child(even){background:#f2f2f2;}

    .delete-btn{
      background:#dc3545;
      padding:6px 12px;
      color:white;
      border-radius:6px;
      text-decoration:none;
    }
    .delete-btn:hover{background:#b52a37;}
  </style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="container">
  <h1>Customer Messages</h1>

  <table>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Email</th>
      <th>Message</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><?= nl2br($row['message']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

</body>
</html>
