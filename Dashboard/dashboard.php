<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'flower';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die('DB connection failed: ' . $conn->connect_error);
}

function countTable(mysqli $conn, string $table): int {
  $sql = "SELECT COUNT(*) AS c FROM `$table`";
  $res = $conn->query($sql);
  if ($res) {
    $row = $res->fetch_assoc();
    return (int)$row['c'];
  }
  return 0;
}
$adminCount = 1; 

$products = countTable($conn, 'products');
$orders   = countTable($conn, 'orders');
$messages = countTable($conn, 'messages');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Panel — Dashboard</title>

<style>
  :root{
    --card:#fff;
    --muted:#6b7280;
    --border:#e5e7eb;
    --radius:16px;
    font-family:Georgia;
  }

  body{
    margin:0;
    background:#8c3494;
    min-height:100vh;
  }

  .container{
    max-width:1050px;
    margin:40px auto;
    padding:0 20px;
  }

  .page-title{
    text-align:center;
    font-size:32px;
    font-weight:700;
    color:#0e0d0dff;
    margin-bottom:25px;
  }

  .grid{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:22px;
    margin-bottom:20px;
  }

  .grid-2{
    display:flex;
    justify-content:center;
    gap:22px;
  }

  .grid-2 .card{
    width:320px;
    max-width:90%;
  }

  .card{
    background:var(--card);
    border-radius:var(--radius);
    padding:28px;
    height:180px;
    border:1px solid var(--border);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:12px;
    transition:0.25s;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
  }

  .big{
    font-size:30px;
    font-weight:700;
  }
  .label{
    font-size:17px;
    color:var(--muted);
  }

  .btn{
    margin-top:6px;
    padding:9px 16px;
    border-radius:10px;
    border:1px solid #d4d4d8;
    background:#f4f4f5;
    cursor:pointer;
    font-weight:600;
  }
</style>
</head>

<body>

<?php include 'header.php'; ?>

<main class="container">

<div class="page-title">Dashboard</div>
<div class="grid">

  <div class="card">
    <div class="big"><?php echo $adminCount; ?></div>
    <div class="label">Admin</div>
    <button class="btn" onclick="location.href='admins.php'">See Admin</button>
  </div>

  <div class="card">
    <div class="big"><?php echo $products; ?></div>
    <div class="label">Total Products</div>
    <button class="btn" onclick="location.href='products.php'">See Products</button>
  </div>

  <div class="card">
    <div class="big"><?php echo $orders; ?></div>
    <div class="label">Total Orders</div>
    <button class="btn" onclick="location.href='orders.php'">See Orders</button>
  </div>
</div>

<div class="grid-2">

  <div class="card">
    <div class="big"><?php echo $messages; ?></div>
    <div class="label">New Messages</div>
    <button class="btn" onclick="location.href='messages.php'">See Messages</button>
  </div>

  <div class="card">
    <div class="big">Logout</div>
    <div class="label">End Session</div>
    <button class="btn" onclick="location.href='logout.php'">Are You Sure?</button>
  </div>

</div>

</main>
</body>
</html>
