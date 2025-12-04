<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "flower";
$conn = new mysqli($host, $user, $pass, $db);
$message = "";
$message_type = "";
$edit_id = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;

if (isset($_POST['add_order'])) {
    $customer_name  = $conn->real_escape_string($_POST['customer_name']);
    $customer_email = $conn->real_escape_string($_POST['customer_email']);
    $total_amount   = (float) $_POST['total_amount'];
    $status         = $conn->real_escape_string($_POST['status']);

    $conn->query("INSERT INTO orders (customer_name, customer_email, total_amount, status)
                  VALUES ('$customer_name','$customer_email','$total_amount','$status')");

    $message = "Order Added Successfully!";
    $message_type = "success";
}

if (isset($_POST['update_order'])) {

    $id            = (int) $_POST['order_id'];
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $customer_email= $conn->real_escape_string($_POST['customer_email']);
    $total_amount  = (float) $_POST['total_amount'];
    $status        = $conn->real_escape_string($_POST['status']);

    $conn->query("UPDATE orders 
                  SET customer_name='$customer_name', 
                      customer_email='$customer_email',
                      total_amount='$total_amount',
                      status='$status'
                  WHERE order_id=$id");

    $message = "Order Updated Successfully!";
    $message_type = "success";
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM orders WHERE order_id=$id");

    $message = "Order Deleted Successfully!";
    $message_type = "success";
}

$result = $conn->query("SELECT * FROM orders ORDER BY order_id ASC");
$total  = $result->num_rows;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin Panel — Orders</title>

<style>
:root{
   --bg: #dccedeff;
  --card:#fff;
  --border:#e6e9ef;
  --muted:#6b7280;
  font-family:Georgia;
}
*{box-sizing:border-box}
body{margin:0;background:linear-gradient(180deg,#eef2ff 0%,var(--bg) 100%);color:#111827;min-height:100vh;}
.container{max-width:1200px;margin:15px auto;width:calc(100% - 40px);}
h1{text-align:center;margin-bottom:20px;color:#333;}

.cards{display:flex;justify-content:center;margin-bottom:20px;gap:20px;}
.card{flex:1;background:#b37fb6ff;color:white;padding:25px;border-radius:12px;text-align:center;box-shadow:0 4px 10px rgba(0,0,0,0.1);}
.card p{margin-top:10px;font-size:18px;}
.msg-box{
  padding:12px;margin:15px 0;border-radius:6px;border-left:4px solid;
  font-size:16px;text-align:center;
}
.success{background:#d1fae5;color:#065f46;border-color:#059669;}

form{padding:15px;background:#fff;border-radius:8px;margin-bottom:20px;
     box-shadow:0 2px 5px rgba(0,0,0,0.1);}
input,select{padding:8px;margin:6px;border-radius:6px;border:1px solid #ccc;}
button{padding:8px 14px;border:none;border-radius:6px;background:#b37fb6ff;color:white;cursor:pointer;}

table{width:100%;border-collapse:collapse;margin-top:15px;background:#fff;border-radius:8px;
      overflow:hidden;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
th,td{border:1px solid #ddd;padding:12px;text-align:center;}
th{background:#b37fb6ff;color:white;}
tr:nth-child(even){background:#f2f2f2;}
.action-btn{padding:6px 12px;border-radius:6px;font-size:14px;text-decoration:none;color:white;}
.edit-btn{background:#28a745;}
.delete-btn{background:#dc3545;}
.edit-btn:hover{background:#63b374ff;}
.delete-btn:hover{background:#e28d96ff;}

.status-badge{
  padding:6px 10px;
  border-radius:6px;
  color:white;
}
.pending{background:orange;}
.completed{background:green;}
.cancelled{background:#d03333;}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="container">
<h1>Orders Management</h1>
<?php if ($message != ""): ?>
<div class="msg-box <?= $message_type ?>"><?= $message ?></div>
<?php endif; ?>

<div class="cards">
  <div class="card">
    <h2><?= $total ?></h2>
    <p>Total Orders</p>
  </div>
</div>

<form method="POST">
  <h3>Add New Order</h3>

  <input type="text" name="customer_name" placeholder="Customer Name" required>
  <input type="email" name="customer_email" placeholder="Customer Email" required>
  <input type="number" step="0.01" name="total_amount" placeholder="Total Amount" required>

  <select name="status">
    <option value="Pending">Pending</option>
    <option value="Completed">Completed</option>
    <option value="Cancelled">Cancelled</option>
  </select>

  <button type="submit" name="add_order">Add Order</button>
</form>

<table>
  <tr>
    <th>ID</th>
    <th>Customer Name</th>
    <th>Email</th>
    <th>Total Amount</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>

    <?php if ($edit_id == $row['order_id']): ?>
      <form method="POST">
        <td>
          <?= $row['order_id'] ?>
          <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
        </td>

        <td><input type="text" name="customer_name" value="<?= $row['customer_name'] ?>" required></td>
        <td><input type="email" name="customer_email" value="<?= $row['customer_email'] ?>" required></td>
        <td><input type="number" step="0.01" name="total_amount" value="<?= $row['total_amount'] ?>" required></td>

        <td>
          <select name="status">
            <option <?= $row['status']=="Pending"?"selected":"" ?>>Pending</option>
            <option <?= $row['status']=="Completed"?"selected":"" ?>>Completed</option>
            <option <?= $row['status']=="Cancelled"?"selected":"" ?>>Cancelled</option>
          </select>
        </td>

        <td>
          <button type="submit" name="update_order">Save</button>
          <a class="action-btn delete-btn" href="orders.php">Cancel</a>
        </td>
      </form>

    <?php else: ?>
      <td><?= $row['order_id'] ?></td>
      <td><?= $row['customer_name'] ?></td>
      <td><?= $row['customer_email'] ?></td>
      <td>₹<?= number_format($row['total_amount'],2) ?></td>

      <td>
        <span class="status-badge <?= strtolower($row['status']) ?>">
            <?= $row['status'] ?>
        </span>
      </td>

      <td>
        <a class="action-btn edit-btn" href="orders.php?edit=<?= $row['order_id'] ?>">Edit</a>
        <a class="action-btn delete-btn" href="orders.php?delete=<?= $row['order_id'] ?>"
           onclick="return confirm('Delete this order?')">Delete</a>
      </td>

    <?php endif; ?>

  </tr>
  <?php endwhile; ?>
</table>

</div>
<script>
setTimeout(()=>{
 let m=document.querySelector(".msg-box");
 if(m){ m.style.transition="0.5s"; m.style.opacity="0"; }
},3000);
</script>

</body>
</html>
