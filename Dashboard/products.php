<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "flower";
$conn = new mysqli($host, $user, $pass, $db);
$message = "";
$message_type = "";
if (isset($_POST['add_product'])) {
    $name     = $conn->real_escape_string($_POST['name']);
    $price    = (float) $_POST['price'];
    $category = $conn->real_escape_string($_POST['category']);
    $stock    = (int) $_POST['stock'];
    $image    = $conn->real_escape_string($_POST['image']);

    $conn->query("INSERT INTO products (name, price, category, stock, image)
                  VALUES ('$name','$price','$category','$stock','$image')");

    $message = "Product Added Successfully!";
    $message_type = "success";
}

if (isset($_POST['update_product'])) {
    $id       = (int) $_POST['id'];
    $name     = $conn->real_escape_string($_POST['name']);
    $price    = (float) $_POST['price'];
    $category = $conn->real_escape_string($_POST['category']);
    $stock    = (int) $_POST['stock'];
    $image    = $conn->real_escape_string($_POST['image']);

    $conn->query("UPDATE products 
                  SET name='$name', price='$price', category='$category', stock='$stock', image='$image'
                  WHERE id=$id");

    $message = "Product Updated Successfully!";
    $message_type = "success";
}
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");

    $message = "Product Deleted Successfully!";
    $message_type = "success";
}
$result = $conn->query("SELECT * FROM products ORDER BY id ASC");
$total  = $result->num_rows;

$edit_id = isset($_GET['edit']) ? (int) $_GET['edit'] : 0;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin Panel — Products</title>

  <style>
:root{
   --bg: #dccedeff;   
   --card:#fff;
   --border:#e6e9ef;
   --muted:#6b7280;
   font-family:"Inter",system-ui;
}

*{box-sizing:border-box}
body{
  margin:0;
  background:linear-gradient(180deg,#eef2ff 0%,var(--bg) 100%);
  color:#111827;
  min-height:100vh;
}

.container {max-width:1200px;margin: 10px auto;width:calc(100% - 40px);display:flex;flex-direction:column;}

h1 {text-align: center;margin-bottom: 20px;color: #333;}

.cards{display:flex;justify-content:center;margin-bottom:20px;gap:20px;}

.card {
  flex: 1;
  background: #b37fb6ff;
  color: white;
  padding: 25px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.card p {margin: 5px 0 0;font-size: 18px;}

.msg-box{
  padding:12px;
  margin:15px auto;
  border-radius:8px;
  border-left:5px solid #059669;
  font-size:17px;
  text-align:center;
  width:100%;
}
.success{
  background:#d1fae5;
  color:#065f46;
}

form {
  margin-bottom: 20px;
  padding: 15px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
input, select {
  padding: 8px;
  margin: 5px;
  border: 1px solid #ccc;
  border-radius: 6px;
}
button {
  padding: 8px 14px;
  border: none;
  border-radius: 6px;
  background: #b37fb6ff;
  color: white;
  cursor: pointer;
}

table {width: 100%;border-collapse: collapse;margin-top: 15px;background: #fff;border-radius: 8px;overflow: hidden;box-shadow: 0 2px 5px rgba(0,0,0,0.1);}
th, td {border: 1px solid #ddd;padding: 12px;text-align: center;}
th {background: #b37fb6ff;color: white;}
tr:nth-child(even) {background: #f2f2f2;}

.action-btn {
  padding: 6px 12px;border-radius: 6px;font-size: 14px;text-decoration: none;color: #fff;margin: 2px;display: inline-block;
}
.edit-btn { background: #28a745; }
.edit-btn:hover { background: #63b374ff; }
.delete-btn { background: #dc3545; }
.delete-btn:hover { background: #e28d96ff; }

img {width: 60px; height: 60px; object-fit: cover; border-radius: 6px;}
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
  <h1>Products Management</h1>

  <?php if ($message != ""): ?>
    <div class="msg-box <?= $message_type ?>">
        <?= $message ?>
    </div>
  <?php endif; ?>


  <div class="cards">
    <div class="card">
      <h2><?= $total ?></h2>
      <p>Total Products</p>
    </div>
  </div>

  <form method="POST">
    <h3>Add New Product</h3>
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" name="price" placeholder="Price" step="0.01" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <input type="text" name="image" placeholder="Image URL">
    <button type="submit" name="add_product">Add Product</button>
  </form>

  <table>
    <tr>
      <th>ID</th>
      <th>Product Name</th>
      <th>Price</th>
      <th>Category</th>
      <th>Stock</th>
      <th>Image</th>
      <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <?php if ($edit_id == $row['id']): ?>
        <form method="POST">
          <td><?= $row['id'] ?><input type="hidden" name="id" value="<?= $row['id'] ?>"></td>
          <td><input type="text" name="name" value="<?= $row['name'] ?>" required></td>
          <td><input type="number" name="price" value="<?= $row['price'] ?>" step="0.01" required></td>
          <td><input type="text" name="category" value="<?= $row['category'] ?>" required></td>
          <td><input type="number" name="stock" value="<?= $row['stock'] ?>" required></td>
          <td><input type="text" name="image" value="<?= $row['image'] ?>"></td>
          <td>
            <button type="submit" name="update_product">Save</button>
            <a class="action-btn delete-btn" href="products.php">Cancel</a>
          </td>
        </form>

      <?php else: ?>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td>₹<?= number_format($row['price'],2) ?></td>
        <td><?= $row['category'] ?></td>
        <td><?= $row['stock'] ?></td>
        <td>
          <?php if ($row['image']): ?>
            <img src="<?= $row['image'] ?>" alt="Product">
          <?php else: ?>
            No Image
          <?php endif; ?>
        </td>
        <td>
          <a class="action-btn edit-btn" href="products.php?edit=<?= $row['id'] ?>">Edit</a>
          <a class="action-btn delete-btn" href="products.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
      <?php endif; ?>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
<script>
setTimeout(() => {
    let m = document.querySelector(".msg-box");
    if (m) {
        m.style.transition = "0.5s";
        m.style.opacity = "0";
    }
}, 3000);
</script>

</body>
</html>
